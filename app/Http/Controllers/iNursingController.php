<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\iNurDysphagiaScreening;
use App\Models\iNurLimbRestraint;
use App\Models\iNurLimbRestraintReassessment;
use App\Models\iNurDischargeChecklist;
use App\Models\iNurGeneral;
use App\Models\iNurHomeAssessmentChecklist;
use App\Models\iNurHypercyanoticSpellApnoeaSeizure;
use App\Models\iNurMiscellaneous;
use App\Models\iNurPatientAssessmentChecklist;
use App\Models\iNurPeritonealDialysisChart;
use App\Models\iNurPostDischargeVisit;
use App\Models\iNurSafetyChecklist;
use App\Models\iNurWOOrientationTransferMapping;
use App\Models\LookupWards;

use DB;
use Auth;

class iNursingController extends Controller
{
    public function indexWardOrientation(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.wardorientation.index', compact('url'));
    }

    public function getDataWOOrientation(Request $request)
    {
        try
        {            
            $getAllWOOrientation = iNurWOOrientationTransferMapping::select('id', 'inurgenerals_id', 'woorientation_id')
                                                                    ->with(['inurwoorientation' => function ($q) {
                                                                        $q->select('id', 'ward', 'created_by', 'created_at', 'updated_by', 'updated_at')
                                                                            ->with([
                                                                                'lookupward:id,ctloc_desc',
                                                                                'createdby:id,name',
                                                                                'updatedby:id,name',
                                                                        ]);
                                                                    }])
                                                                    ->with(['inurwardorientation' => function ($q) {
                                                                        $q->select('id', 'patientinformation_id', 'episodeno')
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

                $getAllWOOrientation->whereHas('inurwoorientation', function ($q) use ($startDate, $endDate) {
                                        $q->whereBetween('created_at', [$startDate, $endDate]);
                                    });
            }

            $getAllWOOrientation = $getAllWOOrientation->orderBy('id', 'desc')->get();
            
            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllWOOrientation ?? null,
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

    public function getDataWOTransfer(Request $request)
    {
        try
        {            
            $getAllWOTransfer = iNurWOOrientationTransferMapping::select('id', 'inurgenerals_id', 'wotransfer_id')
                                                                    ->with(['inurwotransfer' => function ($q) {
                                                                        $q->select('id', 'ward', 'created_by', 'created_at', 'updated_by', 'updated_at')
                                                                            ->with([
                                                                                'lookupward:id,ctloc_desc',
                                                                                'createdby:id,name',
                                                                                'updatedby:id,name',
                                                                        ]);
                                                                    }])
                                                                    ->with(['inurwardorientation' => function ($q) {
                                                                        $q->select('id', 'patientinformation_id', 'episodeno')
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

                $getAllWOTransfer->whereHas('inurwotransfer', function ($q) use ($startDate, $endDate) {
                                        $q->whereBetween('created_at', [$startDate, $endDate]);
                                    });
            }

            $getAllWOTransfer = $getAllWOTransfer->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllWOTransfer ?? null,
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

    public function indexSafetyChecklist(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.safetychecklist.index', compact('url'));
    }

    public function getDataSafetyChecklist(Request $request)
    {
        try
        {            
            $getAllSafetyChecklist = iNurSafetyChecklist::select('id', 'inurgenerals_id', 'episodeno', 'surgery_procedure', 'location', 'others_loc', 
                                                                 'total_timeout', 'total_signout', 'status_safety', 'last_modified_by', 'last_modified_at')
                                                        ->with([
                                                            'lookupward:id,ctloc_desc',
                                                            'createdby:id,name',
                                                            'lastmodifiedby:id,name',
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

                $getAllSafetyChecklist->whereBetween('created_at', [$startDate, $endDate]);
            }

            $getAllSafetyChecklist = $getAllSafetyChecklist->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllSafetyChecklist ?? null,
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

    public function indexPeritonealDialysisChart(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.peritonealchart.index', compact('url'));
    }

    public function getDataPeritonealDialysisChart(Request $request)
    {
        try
        {     
            $getDataPDCAll = iNurPeritonealDialysisChart::select('id', 'inurgenerals_id', 'episodeno', 'date', 'in_volume', 'out_volume', 
                                                                 'total_volume', 'updated_by', 'updated_at')
                                                            ->with([
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
                                                            ->where('status_id', 2);

            // Filter by Date Range
            if ($request->has('dateRange')) {
                $dateRange = explode(' - ', $request->dateRange);
                $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
                $endDate   = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();

                $getDataPDCAll->whereBetween('date', [$startDate, $endDate]);
            }

            $getDataPDCAll = $getDataPDCAll->orderBy('date', 'desc')
                                           ->orderBy('created_at', 'desc')
                                           ->get();

            $totalsByDate = [];

            if ($getDataPDCAll->count() > 0) {
                foreach ($getDataPDCAll as $pdc) {
                    $date = $pdc->date;
                
                    if (!isset($totalsByDate[$date])) {
                        $patient = optional(optional(optional($pdc->inurgenerals)->patientinformation)->patient);

                        $totalsByDate[$date] = [
                            'mrn'         => $patient->mrn,
                            'name'        => $patient->name,
                            'episodeno'   => $pdc->episodeno,
                            'date'        => $date,
                            'totin'       => 0,
                            'totout'      => 0,
                            'totcycle'    => 0,
                            'updatedby'   => $pdc->updatedby->name,
                            'updatedbydt' => $pdc->updated_at ? Carbon::parse($pdc->updated_at)->setTimezone('Asia/Kuala_Lumpur')->format('d/m/Y h:i A')  : null,
                        ];
                    }
                
                    $totalsByDate[$date]['totin'] += $pdc->in_volume;
                    $totalsByDate[$date]['totout'] += $pdc->out_volume;
                    $totalsByDate[$date]['totcycle'] += $pdc->total_volume;
                }
            } 
            
            $totalsList = array_values($totalsByDate);

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $totalsList,
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

    public function indexLimbRestraint(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        $wards = LookupWards::all();

        return view('ireporting.inursing.limbrestraint.index', compact('url', 'wards'));
    }

    private function updateInurGeneralsIdLimb()
    {
        $getLimbRestraint = iNurLimbRestraint::select('id', 'episodeno')
                                                ->where('inurgenerals_id', null)
                                                ->where('status_id', 2)
                                                ->get();

        if($getLimbRestraint->count() > 0) 
        {
            foreach($getLimbRestraint as $limb)
            {
                $getinurgeneral = iNurGeneral::select('id')
                                             ->where('episodeno', $limb['episodeno'])
                                             ->where('status_id', 2)
                                             ->first();
                
                $limb['inurgenerals_id'] = $getinurgeneral->id;
                $limb->save();
            }

            Log::info('update limb ireporting inurgenerals_id');
        }
    }

    public function getDataLimbRestraintAssmt(Request $request)
    {
        $this->updateInurGeneralsIdLimb();

        try {
            $getiNurLimbRAssmtAll = iNurLimbRestraint::select('id', 'inurgenerals_id', 'episodeno', 'ward', 'reason_restraint', 'reason_restraint_given_to',
                                                              'ordering_doctor', 'date_time', 'created_by', 'created_at', 'updated_by', 'updated_at',
                                                              'lastmodified_by', 'lastmodified_at')
                                                        ->with([
                                                            'lookupward:id,ctloc_desc',
                                                            'createdby:id,name',
                                                            'updatedby:id,name',
                                                            'lastmodifiedby:id,name',
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

                $getiNurLimbRAssmtAll->whereBetween('created_at', [$startDate, $endDate]);
            }

            // Filter by Ward
            if($request->has('ward') && $request->ward[0] != 'all')
            {
                $getiNurLimbRAssmtAll = $getiNurLimbRAssmtAll->whereIn('ward', $request->ward);
            }

            $getiNurLimbRAssmtAll = $getiNurLimbRAssmtAll->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status'  => 'success',
                    'list'    => $getiNurLimbRAssmtAll ?? null
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

    public function indexMiscellaneous(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.miscellaneous.index', compact('url'));
    }

    private function getMiscellaneous($type, $request)
    {
        $query = iNurMiscellaneous::select('id', 'inurgenerals_id', 'episodeno', 'other_monitor', 'remark', 'updated_by', 'updated_at')
                                    ->with([
                                        'updatedby:id,name',
                                        'inurgenerals' => function ($q) {
                                            $q->select('id', 'patientinformation_id')
                                            ->with(['patientinformation' => function ($q) {
                                                $q->select('id', 'patient_id')
                                                    ->with(['patient' => function ($q) {
                                                        $q->select('id', 'mrn', 'name');
                                                    }]);
                                            }]);
                                        }
                                    ])
                                    ->where('misc_type', $type)
                                    ->where('status_id', 2);

        // Apply date filter if present
        if ($request->has('dateRange')) {
            $dateRange = explode(' - ', $request->dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $endDate   = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    private function getHypercyanoticApnoe($type, $request)
    {
        $query = iNurHypercyanoticSpellApnoeaSeizure::with([
                                                        'createdby:id,name',
                                                        'updatedby:id,name',
                                                        'inurgenerals' => function ($q) {
                                                            $q->select('id', 'patientinformation_id')
                                                            ->with(['patientinformation' => function ($q) {
                                                                $q->select('id', 'patient_id')
                                                                    ->with(['patient' => function ($q) {
                                                                        $q->select('id', 'mrn', 'name');
                                                                    }]);
                                                            }]);
                                                        }
                                                    ])
                                                    ->where('finding', $type)
                                                    ->where('status_id', 2);

        // Apply date filter if present
        if ($request->has('dateRange')) {
            $dateRange = explode(' - ', $request->dateRange);
            $startDate = Carbon::createFromFormat('d/m/Y', $dateRange[0])->startOfDay();
            $endDate   = Carbon::createFromFormat('d/m/Y', $dateRange[1])->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        return $query->orderBy('date', 'desc')
                    ->orderBy('time', 'desc')
                    ->orderByRaw("CASE shift 
                        WHEN 'ON' THEN 1 
                        WHEN 'PM' THEN 2 
                        WHEN 'AM' THEN 3 
                        ELSE 4 END")
                    ->get();
    }

    public function getDataMiscellaneous(Request $request)
    {
        try
        {     
            $spiroData     = $this->getMiscellaneous('Spirometry', $request);
            $vomitData     = $this->getMiscellaneous('Vomit', $request);
            $seizureData   = $this->getMiscellaneous('Seizure', $request);
            $abdominalData = $this->getMiscellaneous('Abdominal', $request);
            $othersData    = $this->getMiscellaneous('Others', $request);
            $hyperData     = $this->getHypercyanoticApnoe('Hypercyanotic Spell', $request);
            $apnoeaData    = $this->getHypercyanoticApnoe('Apnoea', $request);

            $response = response()->json(
                [
                    'status'    => 'success',
                    'spiro'     => $spiroData ?? null,
                    'vomit'     => $vomitData ?? null,
                    'seizure'   => $seizureData ?? null,
                    'abdominal' => $abdominalData ?? null,
                    'others'    => $othersData ?? null,
                    'hyper'     => $hyperData ?? null,
                    'apnoea'    => $apnoeaData ?? null,
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

    public function indexPatientAssmtChecklist(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.patientassmntchecklist.index', compact('url'));
    }

    public function getDataPatientAssmtChecklist(Request $request)
    {
        try
        {            
            $getAllPatientAssmntCheck = iNurPatientAssessmentChecklist::select('id', 'inurgenerals_id', 'episodeno', 'date', 'guardian_caretaker', 
                                                                               'status_patcheck', 'created_by', 'created_at', 'lastmodified_by', 'lastmodified_at')
                                                                        ->with([
                                                                            'createdby:id,name',
                                                                            'lastmodifiedby:id,name',
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

                $getAllPatientAssmntCheck->whereBetween('created_at', [$startDate, $endDate]);
            }

            $getAllPatientAssmntCheck = $getAllPatientAssmntCheck->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllPatientAssmntCheck ?? null,
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

    public function indexHomeAssmtChecklist(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.homeassmtchecklist.index', compact('url'));
    }

    public function getDataHomeAssmtChecklist(Request $request)
    {
        try
        {            
            $getAllHomeAssmntCheck = iNurHomeAssessmentChecklist::select('id', 'inurgenerals_id', 'episodeno', 'type_assessment', 'cpid_personperform', 
                                                                         'date_personperform', 'created_by', 'created_at', 'updated_by', 'updated_at')
                                                                ->with([
                                                                    'createdby:id,name',
                                                                    'updatedby:id,name',
                                                                    'careprovider:cpid,cpName',
                                                                    'inurhomechecklistassmt:id,homecheck_id,date_assessed,status_reassessment',
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

                $getAllHomeAssmntCheck->whereBetween('created_at', [$startDate, $endDate]);
            }

            $getAllHomeAssmntCheck = $getAllHomeAssmntCheck->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllHomeAssmntCheck ?? null,
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

    public function indexPostDischarge(Request $request){
        $explode = explode('?', $request->getRequestUri());
        $url     = $explode[1];

        return view('ireporting.inursing.postdischarge.index', compact('url'));
    }

    public function getDataPostDischarge(Request $request)
    {
        try
        {            
            $getAllPostDischarge = iNurPostDischargeVisit::select('id', 'inurgenerals_id', 'episodeno', 'date_visit', 'time_visit', 
                                                                  'type_assessment', 'created_by', 'created_at', 'last_modified_by', 'last_modified_at')
                                                            ->with([
                                                                'createdby:id,name',
                                                                'lastmodifiedby:id,name',
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

                $getAllPostDischarge->whereBetween('created_at', [$startDate, $endDate]);
            }

            $getAllPostDischarge = $getAllPostDischarge->orderBy('id', 'desc')->get();

            $response = response()->json(
                [
                    'status' => 'success',
                    'list'   => $getAllPostDischarge ?? null,
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