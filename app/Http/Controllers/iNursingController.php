<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\iNurLimbRestraint;
use App\Models\iNurLimbRestraintReassessment;
// use App\Models\Inventory;
// use App\Models\BloodInventory;
// use App\Models\BloodLocation;
// use App\Models\BloodDetailProcedure;
// use App\Models\BloodSignSymptom;
// use App\Models\BloodTypeAdverseEvent;
// use App\Models\BloodOutcomeAdverseEvent;
// use App\Models\BloodRelevantInvestigation;
// use App\Models\BloodRelevantHistory;
// use App\Models\BloodBloodComponent;
// use App\Models\Patient;
// use App\Models\PatientInformation;
// use App\Models\Dischargesummary;
// use App\Models\AdrReport;
// use App\Models\AdrList;
// use App\Models\AdrBridge;
// use App\Models\MedShelf;
// use App\Models\MedShelfUser;
// use App\Models\MedShelfUserSSO;
// use App\Models\Sso;
// use App\Models\BloodWardLocation;


use DB;
use Auth;

class iNursingController extends Controller
{
    public function indexLimbRestraint(Request $request){
        // $explode = explode('?', $request->getRequestUri());

        // $url = $explode[1];

        // $inurlimbrestraint_assessment = iNurLimbRestraint::where('status_id', 2)->orderBy('date_time', 'desc')->get();

        // foreach($inurlimbrestraint_assessment as $assessment){
        //     $inurlimbrestraint_reassessment = iNurLimbRestraintReassessment::where('limbrestraint_assessment_id', $assessment->id)->get();
        // }

        // return view('inursing.limbrestraint.index', compact(
        //     'url',
        //     'inurlimbrestraint_reassessment'
        // ));

        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('inursing.limbrestraint.index', compact('url'));
    }

    public function getDataLimbRestraintAssmt(Request $request)
    {
        try {
            $epsno = $request->epsdno;

            $getiNurLimbRAssmt = iNurLimbRestraint::with(['lookupward' => function ($q) {
                                                        $q->select('id', 'ctloc_desc');
                                                    }])
                                                    ->with(['createdby' => function ($q) {
                                                        $q->select('id', 'name');
                                                    }])
                                                    ->with('updatedby', function ($q) {
                                                        $q->select('id', 'name');
                                                    })
                                                    ->where('episodeno', $epsno)
                                                    ->where('status_id', 2)
                                                    ->orderBy('date_time', 'desc')
                                                    ->get();

            $response = response()->json(
                [
                    'status'  => 'success',
                    'data'    => $getiNurLimbRAssmt
                ],
                200
            );

            return $response;
        } catch (\Exception $e) {
            Log::error(
                $e->getMessage(),
                [
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            );

            $response = response()->json(
                [
                    'status'  => 'failed',
                    'message' => 'Internal error happened. Try again'
                ],
                200
            );

            return $response;
        }
    }
}
