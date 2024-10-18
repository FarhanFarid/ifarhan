<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

//models
use App\Models\AccessroleIjnclinicaltc;
use App\Models\PatientInformation;
use App\Models\PatientSurgical;
use App\Models\PatientAllergy;
use App\Models\Patient;
use App\Models\User;

use DB;
use Auth;
use Carbon\Carbon;

class Authsystemtc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $getCodeAccess      = $request->codeaccess;
        $getStaffId         = $request->userid;
        $getStaffUsername   = $request->username;
        $getUsrGrpId        = $request->usrGrpID;
        $getUsrGrp          = $request->usrGrp;
        $getUsrLocId        = $request->usrLocID;
        $getUsrLocDesc      = $request->usrLocDesc;
        
        if($getCodeAccess != 'iClinical1.0') {
            // Unauthorized response if token not there
            return response()->json([
                'error' => 'Code denied'
            ], 401);
        }

        if($getStaffId != null) {   
            //start the transaction
            DB::beginTransaction();

            try
            {
                //convert to int
                $getStaffId = (int) $getStaffId;

                $urlAccess = env('STAFF_ACCESS').$getStaffId;

                //local
                $clientAccess = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

                $responseAccess = $clientAccess->request('GET', $urlAccess);

                $statusCodeAccess   = $responseAccess->getStatusCode();
                $contentAccess      = $responseAccess->getBody();
                $contentAccess      = json_decode($responseAccess->getBody(), true);

                $user = User::where('access_id', $contentAccess['tcid'])
                        ->first();
                
                if($user == null)
                {
                    $store = new User();
                    $store->access_id   = $contentAccess['tcid'];
                    $store->cp_id       = isset($contentAccess['uscpid']) && $contentAccess['uscpid'] != '' ? $contentAccess['uscpid'] : null;
                    $store->username    = $contentAccess['tcusername'];
                    $store->name        = $contentAccess['tcname'];
                    $store->mmcno       = isset($contentAccess['tcmmcno']) ? $contentAccess['tcmmcno'] : null;
                    $store->usergrpid   = $getUsrGrpId;
                    $store->usergrp     = $getUsrGrp;
                    $store->userlocid   = $getUsrLocId;
                    $store->userloc     = $getUsrLocDesc;
                    $store->status_id   = 2;
                    $store->created_at  = Carbon::now();
                    $store->save();
                }
                else
                {
                    $user->cp_id       = isset($contentAccess['uscpid']) && $contentAccess['uscpid'] != '' ? $contentAccess['uscpid'] : null;
                    $user->username    = $contentAccess['tcusername'];
                    $user->name        = $contentAccess['tcname'];
                    $user->mmcno       = isset($contentAccess['tcmmcno']) ? $contentAccess['tcmmcno'] : null;
                    $user->usergrpid   = $getUsrGrpId;
                    $user->usergrp     = $getUsrGrp;
                    $user->userlocid   = $getUsrLocId;
                    $user->userloc     = $getUsrLocDesc;
                    $user->status_id   = 2;
                    $user->updated_at  = Carbon::now();
                    $user->save();
                }
            }
            catch (\Exception $e)
            {
                $response = response()->json(
                    [
                        'status'  => 'failed',
                        'message' => "You don't have permission to login this system . Thank you."
                    ], 200
                );

                return $response;
            }
                            
            $userhold = User::where('access_id', $contentAccess['tcid'])
                            ->first();

            if(Auth::user() == null)
            {
                Auth::login($userhold);
            }
            else
            {
                if(Auth::user()->id != $userhold->id)
                {
                    Auth::login($userhold);
                }
            }

            //commit the transaction
            DB::commit();
        }        

        return $next($request);
    }
}
