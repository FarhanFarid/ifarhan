<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\Inventory;
use App\Models\Patient;
use App\Models\PatientInformation;
use App\Models\Dischargesummary;

use DB;
use Auth;

class iReportingMainController extends Controller
{
    public function indexImilk(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        if($request->usrGrp == "EMY" || $request->usrGrp == "EMYDoctors" || $request->usrGrp == "ICLNurse" || $request->usrGrp == "OTNurse"){

            return view('ireporting.iblood.index', compact('url'));
            
        }elseif($request->usrGrp == "LABManager" || $request->usrGrp == "LABMLT" || $request->usrGrp == "LABTemp" || $request->usrGrp == "LABClerk" || $request->usrGrp == "QualityManagement"){

            return view('ireporting.iblood.atrworklist', compact('url'));
   
        }elseif($request->usrGrp == "Administrator" || $request->usrGrp == "Doctors" || $request->usrGrp == "WardNurse" || $request->usrGrp == "WardNursePrivate" || $request->usrGrp == "WardClerk" || $request->usrGrp == "WardManagerOrMentor" || $request->usrGrp == "OPDNurse"){
            
            return view('ireporting.imilk.index', compact('url'));

        }else{

            return view('ireporting.noaccess', compact('url'));

        }

    }

    public function getImilkInventory(Request $request)
    {
        $data = DB::table('hmilk_inventories as inv')
        ->selectRaw('pats.mrn, inv.episodeNo, patinfo.epsiodedate, inv.batchId, inv.location, inv.created_at, inv.expiryDate, u.username, inv.status')
        ->leftJoin('patient_information as patinfo', 'inv.episodeNo', '=', 'patinfo.episodenumber')
        ->leftJoin('patients as pats', 'patinfo.patient_id', '=', 'pats.id')
        ->leftJoin('users as u', 'u.id', '=', 'inv.created_by');

        // Filter by Date Range
        if ($request->has('dateRange')) {
            $dateRange = explode(' - ', $request->dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
            $data->whereBetween('inv.created_at', [$startDate, $endDate]);
        }

        // Filter by Status
        if ($request->has('status') && $request->status != 'all') {
            $data->where('inv.status', $request->status);
        }

        return response()->json(['data' => $data->get()]);

    }

    public function indexIblood(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('ireporting.iblood.index', compact('url'));

    }

    public function getIbloodInventory(Request $request)
    {
        $data = DB::table('iblood_inventories as inv')
            ->leftJoin('patient_information as patinfo', 'inv.episodeno', '=', 'patinfo.episodenumber')
            ->leftJoin('patients as pats', 'patinfo.patient_id', '=', 'pats.id')
            ->leftJoin('iblood_locations as loc', function($join) {
                $join->on('inv.bagno', '=', 'loc.inventory_bagno')
                     ->on('loc.created_at', '=', DB::raw('(SELECT MAX(created_at) FROM iblood_locations WHERE inventory_bagno = loc.inventory_bagno)'));
            })
            ->selectRaw('pats.mrn, pats.name, inv.episodeno, inv.labno, inv.bagno, inv.reaction, inv.expiry_date, inv.transfuse_status_id, loc.location');

            // Filter by Date Range
            if ($request->has('dateRange')) {
                $dateRange = explode(' - ', $request->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
                $endDate = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
                $data->whereBetween('inv.created_at', [$startDate, $endDate]);
            }

            // Filter by Status
            if ($request->has('status') && $request->status != 'all') {
                $data->where('inv.transfuse_status_id', $request->status);
            }
    
        return response()->json(['data' => $data->get()]);
    }

    public function indexIbloodAtr(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('ireporting.iblood.atrworklist', compact('url'));

    }

    public function getIBloodAtrWorklist(Request $request)
    {
        $data = DB::table('iblood_inventories as inv')
        ->leftJoin('patient_information as patinfo', 'inv.episodeno', '=', 'patinfo.episodenumber')
        ->leftJoin('patients as pats', 'patinfo.patient_id', '=', 'pats.id')
        ->leftJoin('iblood_relevantinvestigation as ri', 'inv.bagno', '=', 'ri.inventory_bagno')
        ->leftJoin('users as u', 'ri.created_by', '=', 'u.id')
        ->selectRaw('
            pats.mrn, 
            inv.episodeno, 
            inv.bagno, 
            inv.transfuse_start_at, 
            inv.expiry_date, 
            inv.transfuse_status_id, 
            ri.created_at, 
            u.name, 
            inv.transfuse_stop_at, 
            ri.status_id
        ')
        ->where(function ($query) {
            $query->where('inv.reaction', 'Yes')
                  ->orWhereNotNull('ri.created_at');
        });

        // Filter by Date Range
        if ($request->has('dateRange')) {
            $dateRange = explode(' - ', $request->dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $endDate = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
            $data->whereBetween('inv.created_at', [$startDate, $endDate]);
        }
    
        // Filter by Status
        if ($request->has('status') && $request->status != 'all') {
            $data->where('ri.status_id', $request->status);
        }

        return response()->json(['data' => $data->get()]);

    }

    public function indexPreAdmission(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('ireporting.noaccess', compact('url'));

    }

    //begin discharge summary
    public function indexDischargeSummary(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('ireporting.dischargesummary.index', compact('url'));
    }

    public function apiGetDataDischargeSummary(Request $request)
    {
        try
        {
            $getEpisodeAll = PatientInformation::where('status_id', 2)
                                ->with('patient', function($q){
                                    $q->select('id', 'mrn', 'name');
                                })
                                ->orderBy('id', 'desc')
                                ->get();

            $dateRange  = explode(' - ', $request->dateRange);
            $startDate  = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $endDate    = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();

            $data = [];

            foreach($getEpisodeAll as $epsd)
            {
                $temp = [];

                $checkIfHasDs = Dischargesummary::where('patientinformation_id', $epsd['id'])
                                ->where('episodeno', $epsd['episodenumber'])
                                ->with('createdby', function($q){
                                    $q->select('id', 'name');
                                })
                                ->with('updatedby', function($q){
                                    $q->select('id', 'name');
                                })
                                ->whereBetween('created_at', [$startDate, $endDate])
                                ->where('status_id', 2)
                                ->first();

                if($checkIfHasDs != null)
                {
                    $holddataencounter = Carbon::parse($checkIfHasDs['created_at'])->format('d/m/Y');

                    $temp['name']                       = $epsd['patient']['name'];
                    $temp['mrn']                        = $epsd['patient']['mrn'];
                    $temp['episode']                    = $epsd['episodenumber'];
                    $temp['episodedate']                = Carbon::parse($epsd['epsiodedate'])->format('Y-m-d');
                    $temp['dischargedate']              = Carbon::parse($checkIfHasDs['dischargedate'])->format('Y-m-d');
                    $temp['reasonforadmission']         = $checkIfHasDs['reasonforadmission'];
                    $temp['primarydiagnosis']           = $checkIfHasDs['primarydiagnosis'];
                    $temp['secondarydiagnosis']         = $checkIfHasDs['secondarydiagnosis'];
                    $temp['previoussurgery']            = $checkIfHasDs['previoussurgery'];
                    $temp['relevantphysicalfinding']    = $checkIfHasDs['relevantphysicalfinding'];
                    $temp['principalprocedurefinding']  = $checkIfHasDs['principalprocedurefinding'];
                    $temp['briefhospitalcourse']        = $checkIfHasDs['briefhospitalcourse'];
                    $temp['briefhospitalcoursedesc']    = $checkIfHasDs['briefhospitalcoursedesc'];
                    $temp['significantinpatientmed']    = $checkIfHasDs['significantinpatientmed'];
                    $temp['conditionpatientdis']        = $checkIfHasDs['conditionpatientdis'];
                    $temp['dischargemedication']        = $checkIfHasDs['dischargemedication'];
                    $temp['followupcareclinicvisit']    = $checkIfHasDs['followupcareclinicvisit'];
                    $temp['planmanagement']             = $checkIfHasDs['planmanagement'];
                    $temp['referringdoctoraddress']     = $checkIfHasDs['referringdoctoraddress'];
                    $temp['finalby']                    = $checkIfHasDs['finalby'];
                    $temp['createdby']                  = $checkIfHasDs['createdby']['name'];
                    $temp['createdat']                  = $checkIfHasDs['created_at'];
                    $temp['updatedby']                  = $checkIfHasDs['updatedby'] != null ? $checkIfHasDs['updatedby']['name'] : null;
                    $temp['updatedat']                  = $checkIfHasDs['updated_at'] != null ? $checkIfHasDs['updated_at'] : null;

                    array_push($data, $temp);
                }
            }

            $response = response()->json(
                [
                  'status'  => 'success',
                  'data'    => $data
                ], 200
            );

            return $response;
        }
        catch(\Exception $e)
        {
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
    //end discharge esummary
}
