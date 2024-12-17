<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\AdrReport;
use App\Models\AdrConcoDrug;
use App\Models\AdrDescription;
use App\Models\AdrSuspectedDrug;

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
        ])->where('episodeno', $request->epsdno)->where('status_id', 1 )->orderBy('id', 'desc')->first();

        // dd($report);

        return view('adr.index', compact('url', 'report'));
    }

    public function genReport(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

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
        ])->where('episodeno', $request->epsdno)->where('status_id', 1 )->orderBy('id', 'desc')->first();

        //PatDemo
        $uri = env('PAT_DEMO'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $patdemo = $content['data'];

        return view('adr.report.subviews.report', compact(
            'url', 
            'report',
            'patdemo',
        ));
    }

    public function saveRecord(Request $request)
    {
        try
        { 
            $formData = $request->formData;
            $suspectedData = $request->suspectedDrugs;
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
            
            $report = AdrReport::where('episodeno', $request->epsdno)->where('status_id', 1 )->orderBy('id', 'desc')->first();
            
            if($report != null){

                $report->episodeno     = $request->epsdno;
                $report->report        = $formValues['report'] ?? null;
                $report->status_id     = 1;
                $report->created_by    = Auth::user()->id;
                $report->created_at    = Carbon::now();
                $report->save();

                $adrdesc = AdrDescription::where('adrreport_id', $report->id)->orderBy('id', 'desc')->first();
                $adrdesc->description     = $formValues['desc'] ?? null;
                $adrdesc->onsettime       = $formValues['onsettime'] ?? null;
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
                $adrdesc->created_at      = Carbon::now();
                $adrdesc->save();


                $adrsuspected = AdrSuspectedDrug::where('adrreport_id', $report->id)->orderBy('id', 'desc')->get();
                if ($adrsuspected != null) {
                    foreach ($adrsuspected as $drug) {
                        $drug->status_id      = 2;
                        $drug->updated_at     = Carbon::now();
                        $drug->save();
                    }
                }
                
                
                foreach ($suspectedData as $drug) {
                    if($drug['productName'] != null){
                        $storesuspected                 = new AdrSuspectedDrug();
                        $storesuspected->adrreport_id   = $report->id;
                        $storesuspected->product        = $drug['productName'] ?? null;
                        $storesuspected->dose           = $drug['doseFrequency'] ?? null;
                        $storesuspected->batchno        = $drug['malBatchNo'] ?? null;
                        $storesuspected->start_date     = !empty($drug['therapyStart']) ? Carbon::createFromFormat('d/m/Y', $drug['therapyStart'])->format('Y-m-d') : null;
                        $storesuspected->stop_date      = !empty($drug['therapyStop']) ? Carbon::createFromFormat('d/m/Y', $drug['therapyStop'])->format('Y-m-d') : null;
                        $storesuspected->indication     = $drug['indication'] ?? null;
                        $storesuspected->status_id      = 1;
                        $storesuspected->created_at     = Carbon::now();
                        $storesuspected->save();
                    }         
                }
                

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
                $storereport->episodeno     = $request->epsdno;
                $storereport->report        = $formValues['report'] ?? null;
                $storereport->status_id     = 1;
                $storereport->created_by    = Auth::user()->id;
                $storereport->created_at    = Carbon::now();
                $storereport->save();

                $storedesc                  = new AdrDescription();
                $storedesc->adrreport_id    = $storereport->id;
                $storedesc->description     = $formValues['desc'] ?? null;
                $storedesc->onsettime       = $formValues['onsettime'] ?? null;
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
                $storedesc->created_at      = Carbon::now();
                $storedesc->save();

                if (!empty($suspectedData)) {
                    foreach ($suspectedData as $drug) {
                        $storesuspected                 = new AdrSuspectedDrug();
                        $storesuspected->adrreport_id   = $storereport->id;
                        $storesuspected->product        = $drug['productName'] ?? null;
                        $storesuspected->dose           = $drug['doseFrequency'] ?? null;
                        $storesuspected->batchno        = $drug['malBatchNo'] ?? null;
                        $storesuspected->start_date     = Carbon::createFromFormat('d/m/Y', $drug['therapyStart'])->format('Y-m-d') ?? null;
                        $storesuspected->stop_date      = Carbon::createFromFormat('d/m/Y', $drug['therapyStop'])->format('Y-m-d') ?? null;
                        $storesuspected->indication     = $drug['indication'] ?? null;
                        $storesuspected->status_id      = 1;
                        $storesuspected->created_at     = Carbon::now();
                        $storesuspected->save();
                    }
                }
                
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

                $report->status_id     = 2;
                $report->finalize_by    = Auth::user()->id;
                $report->created_at    = Carbon::now();
                $report->save();

                $adrsuspected = AdrSuspectedDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrsuspected != null) {
                    foreach ($adrsuspected as $drug) {
                        $drug->status_id      = 3;
                        $drug->updated_at     = Carbon::now();
                        $drug->save();
                    }
                }

                $adrconco = AdrConcoDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrconco  != null) {
                    foreach ($adrconco as $drug) {
                        $drug->status_id    = 3;
                        $drug->updated_at   = Carbon::now();
                        $drug->save();
                    }
                }

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

                $adrsuspected = AdrSuspectedDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrsuspected != null) {
                    foreach ($adrsuspected as $drug) {
                        $drug->status_id      = 3;
                        $drug->updated_at     = Carbon::now();
                        $drug->save();
                    }
                }

                $adrconco = AdrConcoDrug::where('adrreport_id', $report->id)->where('status_id', 1)->orderBy('id', 'desc')->get();
                if ($adrconco  != null) {
                    foreach ($adrconco as $drug) {
                        $drug->status_id    = 3;
                        $drug->updated_at   = Carbon::now();
                        $drug->save();
                    }
                }

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
}
