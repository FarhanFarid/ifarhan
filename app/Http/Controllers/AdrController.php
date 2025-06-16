<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\AdrReport;
use App\Models\AdrConcoDrug;
use App\Models\AdrDescription;
use App\Models\AdrSuspectedDrug;
use App\Models\AdrList;
use App\Models\AdrBridge;
use App\Models\Sso;

use Illuminate\Support\Facades\Mail;
use App\Mail\SuspectedAdrReportMail;

use Auth;

use App\Helpers\UpdatePatient;


class AdrController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $epno = $request->epsdno;
        $epid = $request->epid;
        $patid = $request->patid;
        $patdemo     = new UpdatePatient();
        $datapatdemo = $patdemo->updatepatient($epno, $epid, $patid);

        $report = AdrReport::with([
            'descriptions',
            'susdrugs' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'concodrugs' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'createdby:id,name', 
            'updatedby:id,name',
        ])->where('episodeno', $request->epsdno)->where('adr_id', $request->adrid)->where('status_id', 1 )->orderBy('id', 'desc')->first();
        
        $details = AdrList::where('adr_id', $request->adrid)->first();

        //PatDemo
        $uri = env('PAT_DEMO'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $weight = isset($content['data']['weight']) ? $content['data']['weight'] : '';

        // dd($content['data']['weight']);
        $allergy = isset($content['data']['allergyList']) ? $content['data']['allergyList'] : [];

        $medhistory = isset($content['data']['medHistory']) ? $content['data']['medHistory'] : [];


        $medhistory = $content['data']['medHistory'];

        $latestDrug = null;

        foreach ($medhistory as $drug) {
            if ($drug['Itemdesc'] == $details->drugname) {
                $drugStartDate = Carbon::createFromFormat('d/m/Y', $drug['startdate']);
                if (!$latestDrug || $drugStartDate->gt(Carbon::createFromFormat('d/m/Y', $latestDrug['startdate']))) {
                    $latestDrug = $drug;
                }
            }
        }

        //lab data
        $uri = env('LAB_RESULT_LAT'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $labdata = $content['LabResult'];

        $renal  = [];
        $fbc    = [];
        $inr    = [];
        $lft    = [];

        foreach ($labdata as $lab) {
            if ($lab['TestSetDesc'] === 'Renal Profile') {
                foreach ($lab['TestItem'] as $item) {
                    $renal[$item['TestItemDesc']] = $item['Result'];
                }
            }
            if ($lab['TestSetDesc'] === 'Full Blood Count') {
                foreach ($lab['TestItem'] as $item) {
                    $fbc[$item['TestItemDesc']] = $item['Result'];
                }
            }
            if ($lab['TestSetDesc'] === 'Liver Function Test(LFT)') {
                foreach ($lab['TestItem'] as $item) {
                    $lft[$item['TestItemDesc']] = $item['Result'];
                }
            }
            if ($lab['TestSetDesc'] === 'I. N. R.') {
                foreach ($lab['TestItem'] as $item) {
                    $inr[$item['TestItemDesc']] = $item['Result'];
                }
            }
        }

        // dd(['Renal Profile' => $renal, 'Full Blood Count' => $fbc, 'INR' => $inr, 'LFT' => $lft]);

        return view('adr.index', compact('url', 'report', 'details', 'medhistory', 'latestDrug', 'renal', 'fbc', 'inr', 'lft', 'allergy', 'weight'));
    }

    public function genReport(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        // dd($request->all());

        $report = AdrReport::with([
            'descriptions',
            'susdrugs' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'concodrugs' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'createdby', 
            'updatedby',
        ])->where('episodeno', $request->epsdno)->where('adr_id', $request->adrid)->where('status_id', 1 )->orderBy('id', 'desc')->first();

        //PatDemo
        $uri = env('PAT_DEMO'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $patdemo = $content['data'];

        //SSO
        if (isset($report) && isset($report->createdBy)) {
            $email = $report->createdBy->username . "@ijn.com.my";
            $detail = Sso::where('email', $email)->select('mail', 'position')->first();
        } else {
            $detail = null;
        }

        return view('adr.report.subviews.report', compact(
            'url', 
            'report',
            'patdemo',
            'detail'
        ));
    }

    public function saveRecord(Request $request)
    {
        try
        { 
            $formData = $request->formData;
            $concoData = $request->concomitantDrugs;

            // dd($request->all());
            $formValues = [];

            foreach ($formData as $field) {
                $formValues[$field["name"]] = $field["value"];
            }

            //status id
            //1 - active
            //2 - finalize
            //3 - false report 
            
            $report = AdrReport::where('episodeno', $request->epsdno)->where('adr_id', $request->adrid)->where('status_id', 1 )->orderBy('id', 'desc')->first();
            
            if($report != null){

                $report->adr_id        = $request->adrid;
                $report->episodeno     = $request->epsdno;
                $report->report        = $formValues['report'] ?? null;
                $report->status_id     = 1;
                $report->created_by    = Auth::user()->id;
                $report->created_at    = Carbon::now();
                $report->save();

                $adrdesc = AdrDescription::where('adrreport_id', $report->id)->orderBy('id', 'desc')->first();
                $adrdesc->description     = $formValues['desc'] ?? null;
                $adrdesc->weight          = $formValues['weight'] ?? null;
                $adrdesc->datevalue       = $formValues['datevalue'] ?? null;
                $adrdesc->datetype        = $formValues['datetype'] ?? null;
                $adrdesc->date_start      = $formValues['reactstart'] ?? null;
                $adrdesc->date_end        = $formValues['reactstop'] ?? null;
                $adrdesc->react_subside   = $formValues['reducedose'] ?? null;
                $adrdesc->react_reappear  = $formValues['reintroduce'] ?? null;
                $adrdesc->seriousness     = $formValues['seriousness'] ?? null;
                $adrdesc->extent          = $formValues['extent'] ?? null;
                $adrdesc->treatment       = $formValues['treatment'] ?? null;
                $adrdesc->relationship    = $formValues['relationship'] ?? null;
                $adrdesc->outcome         = $formValues['outcome'] ?? null;
                $adrdesc->fatal_date      = $formValues['fataldate'] ?? null;
                $adrdesc->fatal_cause     = $formValues['causeofdeath'] ?? null;
                $adrdesc->relevantinvest  = $request->relevantinv ?? null;
                $adrdesc->medicalhistory  = $request->relevantmh ?? null;
                $adrdesc->created_at      = Carbon::now();
                $adrdesc->save();

    
                $updatesuspected                 = AdrSuspectedDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->first();
                $updatesuspected->product        = $formValues['susdrugname'] ?? null;
                $updatesuspected->dose           = $formValues['susdose'] ?? null;
                $updatesuspected->frequency      = $formValues['susfreq'] ?? null;
                $updatesuspected->batchno        = $formValues['susbatchno'] ?? null;
                $updatesuspected->start_date     = $formValues['susstartdate'] ?? null;
                $updatesuspected->stop_date      = $formValues['susstopdate'] ?? null;
                $updatesuspected->indication     = $formValues['susindication'] ?? null;
                $updatesuspected->status_id      = 1;
                $updatesuspected->updated_at     = Carbon::now();
                $updatesuspected->save();
                
                $adrconco = AdrConcoDrug::where('adrreport_id', $report->id)->orderBy('id', 'desc')->get();
                if ($adrconco  != null) {
                    foreach ($adrconco as $drug) {
                        $drug->status_id    = 2;
                        $drug->updated_at   = Carbon::now();
                        $drug->save();
                    }
                }
                
                foreach ($concoData as $drug) {
                    if($drug['productName'] != "No data available in table"){
                        $storeconco                 = new AdrConcoDrug();
                        $storeconco->adrreport_id   = $report->id;
                        $storeconco->product        = $drug['productName'] ?? null;
                        $storeconco->dose           = $drug['doseFrequency'] ?? null;
                        $storeconco->batchno        = $drug['malBatchNo'] ?? null;
                        $storeconco->start_date     = !empty($drug['therapyStart']) ? Carbon::createFromFormat('d/m/Y', $drug['therapyStart'])->format('Y-m-d') : null;
                        $storeconco->stop_date      = !empty($drug['therapyStop']) ? Carbon::createFromFormat('d/m/Y', $drug['therapyStop'])->format('Y-m-d') : null;
                        $storeconco->indication     = $drug['indication'] ?? null;
                        $storeconco->status_id  = 1;
                        $storeconco->created_at     = Carbon::now();
                        $storeconco->save();
                    }             
                }

            }else{
                
                $storereport                = new AdrReport();
                $storereport->adr_id        = $request->adrid;
                $storereport->episodeno     = $request->epsdno;
                $storereport->report        = $formValues['report'] ?? null;
                $storereport->status_id     = 1;
                $storereport->created_by    = Auth::user()->id;
                $storereport->created_at    = Carbon::now();
                $storereport->save();

                $updatebridge               = AdrBridge::where('adr_id', $request->adrid)->first();
                $updatebridge->report_id    = $storereport->id;
                $updatebridge->save();

                $storedesc                  = new AdrDescription();
                $storedesc->adrreport_id    = $storereport->id;
                $storedesc->description     = $formValues['desc'] ?? null;
                $storedesc->weight          = $formValues['weight'] ?? null;
                $storedesc->datevalue       = $formValues['datevalue'] ?? null;
                $storedesc->datetype        = $formValues['datetype'] ?? null;
                $storedesc->date_start      = $formValues['reactstart'] ?? null;
                $storedesc->date_end        = $formValues['reactstop'] ?? null;
                $storedesc->react_subside   = $formValues['reducedose'] ?? null;
                $storedesc->react_reappear  = $formValues['reintroduce'] ?? null;
                $storedesc->seriousness     = $formValues['seriousness'] ?? null;
                $storedesc->extent          = $formValues['extent'] ?? null;
                $storedesc->treatment       = $formValues['treatment'] ?? null;
                $storedesc->relationship    = $formValues['relationship'] ?? null;
                $storedesc->outcome         = $formValues['outcome'] ?? null;
                $storedesc->fatal_date      = $formValues['fataldate'] ?? null;
                $storedesc->fatal_cause     = $formValues['causeofdeath'] ?? null;
                $storedesc->relevantinvest  = $request->relevantinv ?? null;
                $storedesc->medicalhistory  = $request->relevantmh ?? null;
                $storedesc->created_at      = Carbon::now();
                $storedesc->save();

                $storesuspected                 = new AdrSuspectedDrug();
                $storesuspected->adrreport_id   = $storereport->id;
                $storesuspected->product        = $formValues['susdrugname'] ?? null;
                $storesuspected->dose           = $formValues['susdose'] ?? null;
                $storesuspected->frequency      = $formValues['susfreq'] ?? null;
                $storesuspected->batchno        = $formValues['susbatchno'] ?? null;
                $storesuspected->start_date     = $formValues['susstartdate'] ?? null;
                $storesuspected->stop_date      = $formValues['susstopdate'] ?? null;
                $storesuspected->indication     = $formValues['susindication'] ?? null;
                $storesuspected->status_id      = 1;
                $storesuspected->created_at     = Carbon::now();
                $storesuspected->save();
            
                
                if (!empty($concoData)) {
                    foreach ($concoData as $drug) {
                        $storeconco                 = new AdrConcoDrug();
                        $storeconco->adrreport_id   = $storereport->id;
                        $storeconco->product        = $drug['productName'] ?? null;
                        $storeconco->dose           = $drug['doseFrequency'] ?? null;
                        $storeconco->batchno        = $drug['malBatchNo'] ?? null;
                        $storeconco->start_date     = Carbon::createFromFormat('d/m/Y', $drug['therapyStart'])->format('Y-m-d') ?? null;
                        $storeconco->stop_date      = Carbon::createFromFormat('d/m/Y', $drug['therapyStop'])->format('Y-m-d') ?? null;
                        $storeconco->indication     = $drug['indication'] ?? null;
                        $storeconco->status_id  = 1;
                        $storeconco->created_at     = Carbon::now();
                        $storeconco->save();
                    }
                }

            }

            $response = response()->json(
                [
                  'status'      => 'success',
                  'response'    => 'Successfully saved',
                ], 200
            );

            return $response;

        }
        catch (\Exception $e){
            Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            $response = response()->json(
                [
                    'status'  => 'failed',
                    'message' => 'Internal error happened. Try again'
                ], 200
            );

            return $response;
        }
    }

    public function saveFinalize(Request $request){
        try
        { 
            $report = AdrReport::where('episodeno', $request->epsdno)->where('status_id', 1 )->orderBy('id', 'desc')->first();
            if($report != null){

                $report->status_id      = 2;
                $report->finalize_by    = Auth::user()->id;
                $report->created_at     = Carbon::now();
                $report->save();

                $adrsuspected                 = AdrSuspectedDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->first();
                $adrsuspected->status_id      = 3;
                $adrsuspected->updated_at     = Carbon::now();
                $adrsuspected->save();

                $adrconco = AdrConcoDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrconco  != null) {
                    foreach ($adrconco as $drug) {
                        $drug->status_id    = 3;
                        $drug->updated_at   = Carbon::now();
                        $drug->save();
                    }
                }

                $updatebridge               = AdrBridge::where('adr_id', $request->adrid)->where('status_id', 1)->first();
                $updatebridge->status_id    = 2;
                $updatebridge->save();

                $response = response()->json(
                    [
                      'status'      => 'success',
                      'response'    => 'Successfully saved',
                    ], 200
                );
    
                return $response;

            }else{

                return $response = response()->json(
                    [
                    'status'      => 'failed',
                    'response'    => 'Report is not ready to be finalized.',
                    ], 200
                );

            }

        }
        catch (\Exception $e){
            Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            $response = response()->json(
                [
                    'status'  => 'failed',
                    'message' => 'Internal error happened. Try again'
                ], 200
            );

            return $response;
        }
    }

    public function saveFalse(Request $request){
        try
        { 

            $report = AdrReport::where('episodeno', $request->epsdno)->where('status_id', 1 )->orderBy('id', 'desc')->first();
            if($report != null){

                $report->status_id     = 3;
                $report->finalize_by    = Auth::user()->id;
                $report->created_at    = Carbon::now();
                $report->save();

                $adrsuspected                 = AdrSuspectedDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->first();
                $adrsuspected->status_id      = 3;
                $adrsuspected->updated_at     = Carbon::now();
                $adrsuspected->save();

                $adrconco = AdrConcoDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrconco  != null) {
                    foreach ($adrconco as $drug) {
                        $drug->status_id    = 3;
                        $drug->updated_at   = Carbon::now();
                        $drug->save();
                    }
                }

                $updatebridge               = AdrBridge::where('adr_id', $request->adrid)->where('status_id', 1)->first();
                $updatebridge->status_id    = 2;
                $updatebridge->save();

                $response = response()->json(
                    [
                      'status'      => 'success',
                      'response'    => 'Successfully saved',
                    ], 200
                );
    
                return $response;

            }else{

                return $response = response()->json(
                    [
                    'status'      => 'failed',
                    'response'    => 'Report is not ready to be finalized.',
                    ], 200
                );

            }

        }
        catch (\Exception $e){
            Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            $response = response()->json(
                [
                    'status'  => 'failed',
                    'message' => 'Internal error happened. Try again'
                ], 200
            );

            return $response;
        }
    }

    public function suspectedEmail(Request $request){
        try
        { 

             // Clear all existing data in AdrList
            AdrList::truncate();

            // Fetch data from external API
            $uri = env('ADV_EVENT_LIVE');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $uri);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            $list = $content['data'];

            // Insert new records into AdrList
            foreach ($list as $record) {
                $storerecord                 = new AdrList();
                $storerecord->adr_id         = $record['data'] ?? null;
                $storerecord->episodeno      = $record['episodeNo'] ?? null;
                $storerecord->drugname       = $record['itemDesc'] ?? null;

                // Save reported_at
                $storerecord->reported_at    = isset($record['advsDateReported']) 
                    ? Carbon::createFromFormat('d/m/Y', $record['advsDateReported'])->format('Y-m-d H:i:s') 
                    : null;

                // Save onset_at (combining advsOnSetDate and advsTimeReported)
                if (!empty($record['advsOnSetDate']) && !empty($record['advsTimeReported'])) {
                    $datetime = $record['advsOnSetDate'] . ' ' . $record['advsTimeReported'];
                    $storerecord->onset_at = Carbon::createFromFormat('d/m/Y H:i:s', $datetime)->format('Y-m-d H:i:s');
                } elseif (!empty($record['advsOnSetDate'])) {
                    $storerecord->onset_at = Carbon::createFromFormat('d/m/Y', $record['advsOnSetDate'])->format('Y-m-d H:i:s');
                } else {
                    $storerecord->onset_at = null;
                }

                $storerecord->severity       = $record['severityDesc'] ?? null;
                $storerecord->description    = $record['Desc'] ?? null;
                $storerecord->errordesc      = $record['advsEnterInErrorReasonDesc'] ?? null;
                $storerecord->created_at     = Carbon::now();
                $storerecord->save();

                // Handle AdrBridge insertion
                $adrId = $record['data'] ?? null;
                if ($adrId && !AdrBridge::where('adr_id', $adrId)->exists()) {
                    $storebridge             = new AdrBridge();
                    $storebridge->adr_id     = $adrId;
                    $storebridge->created_at = Carbon::now();
                    $storebridge->status_id  = 1;
                    $storebridge->save();
                }
            }

            $report = AdrBridge::with(['adrlist'])->where('status_id', 1)->get();

            $enhancedReport = [];
            
            foreach ($report as $item) {
                $episodeno = $item->adrlist->episodeno ?? null;
                $onset_at = $item->adrlist->onset_at ?? null;
            
                $prn = null;
            
                if ($episodeno) {
                    try {
                        $uri = env('PAT_DEMO_LIVE') . $episodeno;
                        $client = new \GuzzleHttp\Client(['verify' => false]);
            
                        $response = $client->request('GET', $uri);
                        $content = json_decode($response->getBody(), true);
            
                        if (isset($content['data']['prn'])) {
                            $prn = $content['data']['prn'];
                        }
                    } catch (\Exception $e) {
                        Log::error('PAT_DEMO API failed for episodeno ' . $episodeno . ': ' . $e->getMessage());
                        $prn = null;
                    }
                }
            
                $enhancedReport[] = [
                    'episodeno' => $episodeno,
                    'onset_at'  => $onset_at,
                    'prn'       => $prn,
                ];
            }

            try {
                Mail::to('farhan@ijn.com.my')->send(new SuspectedAdrReportMail($enhancedReport));
            
                Log::info('Suspected ADR report email sent successfully.', [
                    'timestamp'    => now()->toDateTimeString(),
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send Suspected ADR report email.', [
                    'timestamp'     => now()->toDateTimeString(),
                    'error_message' => $e->getMessage(),
                    'file'          => $e->getFile(),
                    'line'          => $e->getLine(),
                ]);
            }

        }
        catch (\Exception $e){
            Log::error($e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            $response = response()->json(
                [
                    'status'  => 'failed',
                    'message' => 'Internal error happened. Try again'
                ], 200
            );

            return $response;
        }
    }

}
