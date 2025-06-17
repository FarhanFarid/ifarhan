<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\iNurDysphagiaScreening;
use App\Models\iNurLimbRestraint;
use App\Models\iNurLimbRestraintReassessment;
use App\Models\iNurDischargeChecklist;

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

        return view('ireporting.inursing.limbrestraint.index', compact('url'));
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

    public function indexDysphagia(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.dysphagia.index', compact('url'));
    }

    public function getDataDysphagia(Request $request)
    {
        try
        {            
            $getAllDysphagia = iNurDysphagiaScreening::select('id', 'inurgenerals_id', 'episodeno', 'status_dysphagia', 'created_by', 'created_at', 'updated_by', 'updated_at')
                                                        ->with([
                                                            'createdby:id,name',
                                                            'updatedby:id,name',
                                                        ])
                                                        ->with(['inurgenerals' => function ($q) {
                                                            $q->select('id', 'patientinformation_id')
                                                              ->with(['patientinformation' => function ($q) {
                                                                  $q->select('id', 'patient_id')
                                                                    ->with(['patient' => function ($q) {
                                                                        $q->select('id', 'mrn', 'name');
                                                                    }]);
                                                              }]);
                                                        }])
                                                        ->where('status_id', 2)
                                                        ->orderBy('id', 'desc');

            // Filter by Date Range
            if ($request->has('dateRange')) {
                $dateRange = explode(' - ', $request->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
                $endDate   = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();

                $getAllDysphagia->whereBetween('created_at', [$startDate, $endDate]);
            }

            $getAllDysphagia = $getAllDysphagia->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllDysphagia ?? null,
                ], 200
            );

            return $response;
        }
        catch (\Exception $e)
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

    public function indexDischargeChecklist(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.dischargechecklist.index', compact('url'));
    }

    public function getDataDischargeChecklist(Request $request)
    {
        try
        {            
            $getAllDischargeChecklist = iNurDischargeChecklist::select('id', 'inurgenerals_id', 'episodeno', 'created_by', 'created_at', 'lastmodified_by', 'lastmodified_at')
                                                        ->with([
                                                            'createdby:id,name',
                                                            'lastmodifiedby:id,name',
                                                            'inurdcdocumentgiven:id,dc_id,discharge_summary,ds_no_desc',
                                                        ])
                                                        ->with(['inurgenerals' => function ($q) {
                                                            $q->select('id', 'patientinformation_id')
                                                              ->with(['patientinformation' => function ($q) {
                                                                  $q->select('id', 'patient_id')
                                                                    ->with(['patient' => function ($q) {
                                                                        $q->select('id', 'mrn', 'name');
                                                                    }]);
                                                              }]);
                                                        }])
                                                        ->where('status_id', 2);

            // Filter by Date Range
            if ($request->has('dateRange')) {
                $dateRange = explode(' - ', $request->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
                $endDate   = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();

                $getAllDischargeChecklist->whereBetween('created_at', [$startDate, $endDate]);
            }

            // Filter by Discharge Summary
            if($request->has('dischargeSumm') && $request->dischargeSumm != 'all')
            {
                $getAllDischargeChecklist = $getAllDischargeChecklist->whereHas('inurdcdocumentgiven', function ($q) use ($request) {
                                                                        $q->where('discharge_summary', $request->dischargeSumm);
                                                                    });
            }

            $getAllDischargeChecklist = $getAllDischargeChecklist->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllDischargeChecklist ?? null,
                ], 200
            );

            return $response;
        }
        catch (\Exception $e)
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
}