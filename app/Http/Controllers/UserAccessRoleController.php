<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

//models
use App\Models\User;
use App\Models\QuippeItem;
use App\Models\Quipperole;
use App\Models\IdaGeneral;
use App\Models\UserAccessrole;
use App\Models\IdagReassessment;
use App\Models\IdagPlanreferredto;
use App\Models\PatientInformation;
use App\Models\TrakcareSecuritygroup;

use DB;
use Auth;
use Carbon\Carbon;

class UserAccessRoleController extends Controller
{
    public function index(Request $request)
    {

        $username = Auth::user()->name;

        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $explodeParam = explode('&', $url);

        $explodeParamVal = explode('epsdno=', $explodeParam[2]);

        $explodeParamUser = explode('username=', $explodeParam[1]);

        $urlCrdbUser    = env('CRDB_USER').'isFromTrakCare=0OHNkxwoP7&username='.$explodeParamUser[0];

        $clientCrdbUser = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

        try{
            $responseCrdbUser = $clientCrdbUser->request('GET', $urlCrdbUser);

            $statusCodeCrdbUser = $responseCrdbUser->getStatusCode();
            $contentCrdbUser    = $responseCrdbUser->getBody();

            $contentCrdbUser = json_decode($responseCrdbUser->getBody(), true);

            if($contentCrdbUser['status'] == "success") {
                $accesscrdb     = 1;
                $accesscrdbuser = $contentCrdbUser['data'][0]['userName'];
            }
            else {
                $accesscrdb     = 0;
                $accesscrdbuser = null;
            }
        }
        catch (\Exception $e) {
            $accesscrdb     = 0;
            $accesscrdbuser = null;
        }

        $holdcode = $explodeParamVal[1];

        $holdlockstatus     = 0;
        $createdid          = 0;
        $canunlock          = 0;
        $canunlockre        = 0;
        $showreassessment   = 0;

        $userid = Auth::user()->access_id;

        $userloginid = Auth::user()->id;
        
        $securitygroup = Auth::user()->usergrp;

        $disabledlock = 0;

        $checkPatInfo = PatientInformation::where('episodenumber', $explodeParamVal[1])
                        ->where('status_id', 2)
                        ->first();

        if($checkPatInfo['pchcflag'] == "Y")
        {
            if($checkPatInfo['episodedept'] == "CT" || $checkPatInfo['episodedept'] == "CTP")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
            else if($checkPatInfo['episodedept'] == "EMY")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
            else
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 1;
                $yesct      = 0;
            }
        }
        else
        {
            if($checkPatInfo['episodedept'] == "CT" || $checkPatInfo['episodedept'] == "CTP")
            {
                $yesep      = 0;
                $yesiop     = 0;
                $yespchc    = 0;
                $yesct      = 1;
            }
            else if($checkPatInfo['episodedept'] == "EMY")
            {
                $yesep      = 1;
                $yesiop     = 0;
                $yespchc    = 0;
                $yesct      = 0;
            }
            else
            {
                $yesep      = 0;
                $yesiop     = 1;
                $yespchc    = 0;
                $yesct      = 0;
            }
        }

        if($holdcode != null)
        {
            $getIdaGeneral = IdaGeneral::where('episodeno', $holdcode)
                            ->where('status_id', 2)
                            ->first();

            if($getIdaGeneral != null)
            {
                $getDate24 = Carbon::parse($getIdaGeneral['created_at'])->addDays(1);

                if(Carbon::now() > $getDate24)
                {
                    $canunlock = 0;
                }
                else
                {
                    $canunlock = 1;
                }

                $getDate24Re = Carbon::parse($getIdaGeneral['completedat'])->addDays(1);

                if(Carbon::now() > $getDate24Re)
                {
                    $canunlockre = 0;
                }
                else
                {
                    $canunlockre = 1;
                }

                $holdlockstatus = $getIdaGeneral['islock'];
                $createdid      = $getIdaGeneral->created_by;

                $getreferredto = IdagPlanreferredto::where('episodeno', $holdcode)
                                    ->where('status_id', 2)
                                    ->where('specific', $username)
                                    ->first();

                if($getreferredto != null)
                {
                    if($canunlockre == 1)
                    {
                        $getreas = IdagReassessment::where('episodeno', $holdcode)
                                    ->where('status_id', 2)
                                    ->where('reassessmentactivity', null)
                                    ->first();

                        if($getreas != null)
                        {
                            $showreassessment = 1;
                        }
                        else
                        {
                            $showreassessment = 0;
                        }
                    }
                    else
                    {
                        $showreassessment = 0;
                    }
                }
                else
                {
                    $showreassessment = 0;
                }
            }
            else
            {
                $holdlockstatus     = 0;
                $createdid          = 0;
                $canunlock          = 0;
                $canunlockre        = 0;
                $showreassessment   = 0;
            }
        }
        else
        {
            $holdlockstatus     = 0;
            $createdid          = 0;
            $canunlock          = 0;
            $canunlockre        = 0;
            $showreassessment   = 0;
        }

        $getHoldDoctor = IdaGeneral::where('status_id', 2)
                            ->get()
                            ->unique('created_by')
                            ->pluck('created_by')
                            ->toArray();

        $doctors = [];

        foreach($getHoldDoctor as $holddoctor)
        {
            $temp = [];

            $getName = User::where('id', $holddoctor)
                        ->first();

            if($getName != null)
            {
                $temp['id']     = $holddoctor;
                $temp['name']   = $getName['name'];

                array_push($doctors, $temp);
            }
        }

        $getRole = Quipperole::where('status_id', 2)
                    ->get();

        $getSecuritygroup = TrakcareSecuritygroup::where('status_id', 2)
                            ->get(); 

        return view('administrator.useraccessrole.index', compact('url', 'holdlockstatus', 'canunlock', 'createdid', 'showreassessment', 'userid', 'userloginid', 'securitygroup', 'disabledlock', 'yesep', 'yesiop', 'yespchc', 'yesct', 'accesscrdb', 'accesscrdbuser', 'doctors', 'getRole', 'getSecuritygroup'));
    }

    public function apiGetDataUserAccessRole()
    {
        try
        {
            $getUserAccess = UserAccessrole::with('createdby')
                            ->with('updatedby')
                            ->where('status_id', 2)
                            ->get();

            $response = response()->json(
                [
                  'status'  => 'success',
                  'data'    => $getUserAccess
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

    public function apiPostAddUserAccessRole(Request $request)
    {
        try
        {
            $rules = [
                'tcusergroup'    => 'required',
                'quipperolename' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules, [
                'tcusergroup.required'      => __('TrakCare User Group is required'),
                'quipperolename.required'   => __('Quippe Role is required'),
            ]);

            if( $validator->fails() ){
                return response()->json($validator->messages(), 200);
            }

            $storeAccessrole = new UserAccessrole();
            $storeAccessrole->tcusergroup    = $request->tcusergroup;
            $storeAccessrole->quipperolename = $request->quipperolename;
            $storeAccessrole->status_id      = 2;
            $storeAccessrole->created_by     = Auth::user()->id;
            $storeAccessrole->created_at     = Carbon::now();
            $storeAccessrole->save();

            $response = response()->json(
                [
                  'status'  => 'success',
                  'message' => 'Successflly Added'
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

    public function apiGetUpdateUserAccessRole(Request $request)
    {
        try
        {
            $rules = [
                'tcusergroup'    => 'required',
                'quipperolename' => 'required',
            ];

            $validator = Validator::make($request->all(), $rules, [
                'tcusergroup.required'      => __('TrakCare User Group is required'),
                'quipperolename.required'   => __('Quippe Role is required'),
            ]);

            if( $validator->fails() ){
                return response()->json($validator->messages(), 200);
            }

            $updateAccessrole = UserAccessrole::where('id', $request->id)
                                ->where('status_id', 2)
                                ->first();
            $updateAccessrole->tcusergroup    = $request->tcusergroup;
            $updateAccessrole->quipperolename = $request->quipperolename;
            $updateAccessrole->status_id      = 2;
            $updateAccessrole->updated_by     = Auth::user()->id;
            $updateAccessrole->updated_at     = Carbon::now();
            $updateAccessrole->save();

            $response = response()->json(
                [
                  'status'  => 'success',
                  'message' => 'Successflly Updated'
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
