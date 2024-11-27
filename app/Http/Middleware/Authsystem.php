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
use App\Models\UserAccessiccarole;

use DB;
use Auth;
use Carbon\Carbon;

class Authsystem
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
        $getStaffId         = $request->userid;
        $getStaffUsername   = $request->username;
        $getEpsdNo          = $request->epsdno;
        $getCodeAccess      = $request->codeaccess;
        $getHmilkAccess     = $request->hmilkaccess;
        $getPatid           = $request->patid;
        $getEpid            = $request->epid;
        $getUsrGrpId        = $request->usrGrpID;
        $getUsrGrp          = $request->usrGrp;
        $getUsrLocId        = $request->usrLocID;
        $getUsrLocDesc      = $request->usrLocDesc;

        if(isset($request->external) && $request->external == 'ICCA'){
            $staff = UserAccessiccarole::where('username', $request->username)
                        ->first();
                        
            $patient = Patient::where('mrn', $request->mrn)
            ->first();
            $getStaffId = $staff->tcuserid;
            $getUsrGrp = $staff->tcusergroup;
            $getUsrGrpId = $staff->tcusergroup_id;
            $getPatid = $patient->patid;
        }
        
        if($getEpsdNo != null)
        {
            if($getCodeAccess != 'iClinical1.0') {
                // Unauthorized response if token not there
                return response()->json([
                    'error' => 'Code denied'
                ], 401);
            }

            //start the transaction
            DB::beginTransaction();
 
            try
            {
                $urlAccess = env('STAFF_ACCESS').$getStaffId;

                //local
                $clientAccess = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

                //production
                //$clientAccess = new \GuzzleHttp\Client();

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

            // Now let's put the user in the request class so that you can grab it from there
            $request->auth = $user;

            $urlMed    = env('PAT_PREVIOUS').$getEpsdNo;

            //local
            $clientMed = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            //production
            //$client = new \GuzzleHttp\Client();

            $holdMedication = null;
            $arrMedication  = [];
            
            try
            {
                $responseMed = $clientMed->request('GET', $urlMed);

                $statusCodeMed = $responseMed->getStatusCode();
                $contentMed    = $responseMed->getBody();
                $contentMed    = json_decode($responseMed->getBody(), true);

                if($contentMed != null)
                {
                    if($contentMed['status'] == "success")
                    {
                        $holdMedEpiNo   = $contentMed['data']['previousEpiNo'];
                        $holdMedEpiDate = $contentMed['data']['previousEpiDate'];

                        if(isset($contentMed['data']['medHistory']))
                        {
                            if(count($contentMed['data']['medHistory']) > 0)
                            {
                                foreach($contentMed['data']['medHistory'] as $medication)
                                {
                                    array_push($arrMedication, $medication['Itemdesc']);
                                }

                                $holdMedication = implode('; ', $arrMedication);
                            }
                            else
                            {
                                $holdMedication = null;
                            }
                        }
                        else
                        {
                            $holdMedication = null;
                        }
                    }
                    else
                    {
                        $holdMedication = null;
                    }
                }
                else
                {
                    $holdMedEpiNo   = null;
                    $holdMedEpiDate = null;
                    $holdMedication = null;
                }
            }
            catch (\Exception $e)
            {
                $holdMedEpiNo   = null;
                $holdMedEpiDate = null;
                $holdMedication = null;
            }

            $url    = env('PAT_DEMO').$getEpsdNo;

            //local
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            //production
            //$client = new \GuzzleHttp\Client();

            $response = $client->request('GET', $url);

            $statusCode = $response->getStatusCode();
            $content    = $response->getBody();
            $content    = json_decode($response->getBody(), true);

            if($content['status'] == "success")
            {
                $holdAllergy    = null;
                $arrAllergy     = [];
                $holdPayor      = null;
                $arrPayor       = [];

                if(isset($content['data']['allergyList']))
                {
                    if(count($content['data']['allergyList']) > 0)
                    {
                        foreach($content['data']['allergyList'] as $allergy)
                        {
                            if($allergy['status'] == 'active')
                            {
                                if($allergy['substance'] != '')
                                {
                                    array_push($arrAllergy, $allergy['substance']);
                                }
                                else
                                {
                                    array_push($arrAllergy, $allergy['freetxtall']);
                                }
                            }
                        }

                        $holdAllergy = implode(', ', $arrAllergy);
                    }
                    else
                    {
                        $holdAllergy = null;
                    }
                }
                else
                {
                    $holdAllergy = null;
                }

                if(isset($content['data']['payorList']))
                {
                    if(count($content['data']['payorList']) > 0)
                    {
                        foreach($content['data']['payorList'] as $payor)
                        {
                            array_push($arrPayor, $payor['payorDesc']);
                        }

                        $holdPayor = implode(', ', $arrPayor);
                    }
                    else
                    {
                        $holdPayor = null;
                    }
                }
                else
                {
                    $holdPayor = null;
                }

                if(isset($content['data']['vitalSign']))
                {
                    if(isset($content['data']['vitalSign'][1]))
                    {
                        $holdsystolic   = $content['data']['vitalSign'][1]['systolic'] != '' ? str_replace('(mmHg)', '', $content['data']['vitalSign'][1]['systolic']) : null;
                        $holddiastolic  = $content['data']['vitalSign'][1]['diastolic'] != '' ? str_replace('(mmHg)', '', $content['data']['vitalSign'][1]['diastolic']) : null;
                        $holdheartrate  = $content['data']['vitalSign'][1]['pulse'] != '' ? str_replace('(bpm)', '', $content['data']['vitalSign'][1]['pulse']) : null;
                        $holdweight     = strtolower($content['data']['vitalSign'][1]['weight']) != '' && strtolower($content['data']['vitalSign'][1]['weight']) != 'unfit' ? str_replace('kg', '', strtolower($content['data']['vitalSign'][1]['weight'])) : null;
                        $holdheight     = strtolower($content['data']['vitalSign'][1]['height']) != '' && strtolower($content['data']['vitalSign'][1]['height']) != 'unfit' ? str_replace('cm', '', strtolower($content['data']['vitalSign'][1]['height'])) : null;
                        $holdheight     = ($holdheight == '' || $holdheight == 0) ? null : $holdheight;
                        $holdweight     = ($holdweight == '' || $holdweight == 0) ? null : $holdweight;
                        $holdspo2       = $content['data']['vitalSign'][1]['spo2'] != '' ? str_replace('%', '', $content['data']['vitalSign'][1]['spo2']) : null;
                        $holdlastupdate = $content['data']['vitalSign'][1]['lastUpdateDate'] != '' && $content['data']['vitalSign'][1]['lastUpdateTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['vitalSign'][1]['lastUpdateDate'])->format('Y-m-d').' '.$content['data']['vitalSign'][1]['lastUpdateTime'] : null;

                        if($holdweight != null && $holdheight != null)
                        {
                            $heightmeter = $holdheight/100;

                            $holdbmi = round($holdweight/pow(($heightmeter),2),2);
                            $holdbsa = round(0.007184 * pow($holdweight,0.425) * pow($holdheight,0.725),2);
                        }
                        else
                        {
                            $holdbmi = null;
                            $holdbsa = null;
                        }
                        $holdresprate = null;
                    }
                    else
                    {
                        $holdsystolic   = $content['data']['systolic'] != '' ? $content['data']['systolic'] : null;
                        $holddiastolic  = $content['data']['diastolic'] != '' ? $content['data']['diastolic'] : null;
                        $holdheartrate  = $content['data']['HeartRate'] != '' ? $content['data']['HeartRate'] : null;
                        $holdheartratedate = $content['data']['HeartRateDate'] != '' && $content['data']['HeartRateTime'] != '' ? $content['data']['HeartRateDate'].' '.$content['data']['HeartRateTime'] : null;
                        $holdpulse      = $content['data']['pulse'] != '' ? $content['data']['pulse'] : null;
                        $holdpulsedate  = $content['data']['pulseDate'] != '' && $content['data']['pulseTime'] != '' ? $content['data']['pulseDate'].' '.$content['data']['pulseTime'] : null;
                        $holdweight     = $content['data']['weight'] != '' && strtolower($content['data']['weight']) != 'unfit' ? $content['data']['weight'] : null;
                        $holdheight     = $content['data']['height'] != '' && strtolower($content['data']['height']) != 'unfit' ? $content['data']['height'] : null;
                        $holdspo2       = $content['data']['spo2'] != '' ? $content['data']['spo2'] : null;
                        $holdbmi        = $content['data']['bmi'] != '' ? $content['data']['bmi'] : null;
                        $holdbsa        = $content['data']['height'] != '' && strtolower($content['data']['height']) != 'unfit' && $content['data']['weight'] != '' && $content['data']['weight'] != 'unfit' ? round(0.007184 * pow($content['data']['weight'],0.425) * pow($content['data']['height'],0.725),2) : null;
                        $holdresprate   = $content['data']['resprate'] != '' ? $content['data']['resprate'] : null;
                        $holdlastupdate = $content['data']['vupdDate'] != '' && $content['data']['vUpdTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['vupdDate'])->format('Y-m-d').' '.$content['data']['vUpdTime'] : null;
                    }
                }
                else
                {
                    $holdsystolic   = $content['data']['systolic'] != '' ? $content['data']['systolic'] : null;
                    $holddiastolic  = $content['data']['diastolic'] != '' ? $content['data']['diastolic'] : null;
                    $holdheartrate  = $content['data']['HeartRate'] != '' ? $content['data']['HeartRate'] : null;
                    $holdheartratedate = $content['data']['HeartRateDate'] != '' && $content['data']['HeartRateTime'] != '' ? $content['data']['HeartRateDate'].' '.$content['data']['HeartRateTime'] : null;
                    $holdpulse      = $content['data']['pulse'] != '' ? $content['data']['pulse'] : null;
                    $holdpulsedate  = $content['data']['pulseDate'] != '' && $content['data']['pulseTime'] != '' ? $content['data']['pulseDate'].' '.$content['data']['pulseTime'] : null;
                    $holdweight     = $content['data']['weight'] != '' && strtolower($content['data']['weight']) != 'unfit' ? $content['data']['weight'] : null;
                    $holdheight     = $content['data']['height'] != '' && strtolower($content['data']['height']) != 'unfit' ? $content['data']['height'] : null;
                    $holdspo2       = $content['data']['spo2'] != '' ? $content['data']['spo2'] : null;
                    $holdbmi        = $content['data']['bmi'] != '' ? $content['data']['bmi'] : null;
                    $holdbsa        = $content['data']['height'] != '' && strtolower($content['data']['height']) != 'unfit' && $content['data']['weight'] != '' && strtolower($content['data']['weight']) != 'unfit' ? round(0.007184 * pow($content['data']['weight'],0.425) * pow($content['data']['height'],0.725),2) : null;
                    $holdlastupdate = $content['data']['vupdDate'] != '' && $content['data']['vUpdTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['vupdDate'])->format('Y-m-d').' '.$content['data']['vUpdTime'] : null;
                    $holdresprate   = $content['data']['resprate'] != '' ? $content['data']['resprate'] : null;
                }

                $holdmrnpatient = $content['data']['prn'];

                $checkIfMrnExist = Patient::where('mrn', $content['data']['prn'])
                                    ->where('status_id', 2)
                                    ->first();

                if($checkIfMrnExist == null)
                {
                    $storePatient = new Patient();
                    $storePatient->patid        = $getPatid;
                    $storePatient->mrn          = $content['data']['prn'];
                    $storePatient->name         = $content['data']['pName'];
                    $storePatient->nric         = $content['data']['pnric'];
                    $storePatient->dob          = $content['data']['pdob'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['pdob'])->format('Y-m-d') : null;
                    $storePatient->sex          = $content['data']['pgender'];
                    $storePatient->status_id    = 2;
                    $storePatient->created_by   = Auth::user()->id;
                    $storePatient->created_at   = Carbon::now();
                    $storePatient->save();

                    $holpatientid = $storePatient['id'];

                    $storeInfo = new PatientInformation();
                    $storeInfo->episodenumber           = $getEpsdNo;
                    $storeInfo->epid                    = $getEpid;
                    $storeInfo->epsiodedate             = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                    $storeInfo->admissiondate           = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                    $storeInfo->dischargedate           = $content['data']['epiDiscDate'] != '' && $content['data']['epiDiscTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d').' '.$content['data']['epiDiscTime'] : null;
                    $storeInfo->episodedept             = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : null;
                    $storeInfo->episodedeptname         = $content['data']['epiDeptDesc'] != '' ? $content['data']['epiDeptDesc'] : null;
                    $storeInfo->consultantname          = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : null;
                    $storeInfo->patient_id              = $storePatient->id;
                    $storeInfo->age                     = $content['data']['age'] != '' ? $content['data']['age'] : null;
                    $storeInfo->agem                    = $content['data']['ageM'] != '' ? $content['data']['ageM'] : null;
                    $storeInfo->aged                    = $content['data']['ageD'] != '' ? $content['data']['ageD'] : null;
                    $storeInfo->epiward                 = $content['data']['epiWard'] != '' ? $content['data']['epiWard'] : null;
                    $storeInfo->epiroom                 = $content['data']['epiRoom'] != '' ? $content['data']['epiRoom'] : null;
                    $storeInfo->epistat                 = $content['data']['epiStat'] != '' ? $content['data']['epiStat'] : null;
                    $storeInfo->bloodtype               = $content['data']['bgDesc'] != '' ? $content['data']['bgDesc'] : null;
                    $storeInfo->unfit                   = $content['data']['epiunfit'] == 1 ? 1 : null;
                    $storeInfo->pchcflag                = $content['data']['pchcFlag'] != '' ? $content['data']['pchcFlag'] : null;
                    $storeInfo->phosp                   = $content['data']['pHosp'] != '' ? $content['data']['pHosp'] : null;
                    $storeInfo->height                  = $holdheight;
                    $storeInfo->weight                  = $holdweight;
                    $storeInfo->bmi                     = $holdbmi;
                    $storeInfo->sysbp                   = $holdsystolic;
                    $storeInfo->diasbp                  = $holddiastolic;
                    $storeInfo->heartrate               = $holdheartrate;
                    $storeInfo->heartrate_datetime      = $holdheartratedate;
                    $storeInfo->pulse                   = $holdpulse;
                    $storeInfo->pulse_datetime          = $holdpulsedate;
                    $storeInfo->spo2                    = $holdspo2;
                    $storeInfo->resprate                = $holdresprate;
                    $storeInfo->bsa                     = $holdbsa;
                    $storeInfo->temperature             = $content['data']['temp'] != '' ? $content['data']['temp'] : null;
                    $storeInfo->epiinterv               = $content['data']['epiInterv'] != '' ? $content['data']['epiInterv'] : null;
                    $storeInfo->vs_datetime             = $holdlastupdate;
                    $storeInfo->payor                   = $holdPayor;
                    $storeInfo->allergy                 = $holdAllergy;
                    $storeInfo->currentmedication       = $holdMedication;
                    $storeInfo->medicationepisodeno     = $holdMedEpiNo;
                    $storeInfo->medicationepisodedate   = $holdMedEpiDate != null ? Carbon::createFromFormat('d/m/Y', $holdMedEpiDate)->format('Y-m-d') : null;
                    $storeInfo->dischargedate           = $content['data']['epiDiscDate'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d') : null;
                    $storeInfo->ef                      = $content['data']['ef'] != '' ? $content['data']['ef'] : null;
                    $storeInfo->efc                     = $content['data']['efc'] != '' ? $content['data']['efc'] : null;
                    $storeInfo->painscore               = null;
                    $storeInfo->painsite                = null;
                    $storeInfo->status_id               = 2;
                    $storeInfo->created_by              = Auth::user()->id;
                    $storeInfo->created_at              = Carbon::now();
                    $storeInfo->save();

                    if(isset($content['data']['allergyList']))
                    {
                        if(count($content['data']['allergyList']) > 0)
                        {
                            foreach($content['data']['allergyList'] as $allergy)
                            {
                                $storeAllergy = new PatientAllergy();
                                $storeAllergy->patient_id      = $storePatient->id;
                                $storeAllergy->episodenumber   = $getEpsdNo;
                                $storeAllergy->epid            = $getEpid;
                                $storeAllergy->substance       = $allergy['substance'];
                                $storeAllergy->freetxtall      = $allergy['freetxtall'];
                                $storeAllergy->nature          = $allergy['nature'];
                                $storeAllergy->severity        = $allergy['severity'];
                                $storeAllergy->comment         = '-';
                                $storeAllergy->date            = Carbon::createFromFormat('d/m/Y', $allergy['upDate'])->format('Y-m-d');
                                $storeAllergy->time            = $allergy['upTime'];
                                $storeAllergy->algid           = $allergy['ALGID'];
                                $storeAllergy->status_id       = $allergy['status'] == 'inactive' ? 1 : 2;
                                $storeAllergy->created_by      = Auth::user()->id;
                                $storeAllergy->created_at      = Carbon::now();
                                $storeAllergy->save();
                            }
                        }
                    }
                }
                else
                {
                    $updatePatient = Patient::where('id', $checkIfMrnExist->id)
                                        ->where('status_id', 2)
                                        ->first();
                    $updatePatient->patid        = $getPatid;
                    $updatePatient->name         = $content['data']['pName'];
                    $updatePatient->nric         = $content['data']['pnric'];
                    $updatePatient->dob          = $content['data']['pdob'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['pdob'])->format('Y-m-d') : null;
                    $updatePatient->sex          = $content['data']['pgender'];
                    $updatePatient->status_id    = 2;
                    $updatePatient->updated_by   = Auth::user()->id;
                    $updatePatient->updated_at   = Carbon::now();
                    $updatePatient->save();

                    $holpatientid = $updatePatient['id'];

                    $checkIfEpsNoSame = PatientInformation::where('episodenumber', $getEpsdNo)
                                        ->where('patient_id', $updatePatient->id)
                                        ->where('status_id', 2)
                                        ->first();

                    if($checkIfEpsNoSame != null)
                    {
                        $checkIfEpsNoSame->epid                  = $getEpid;
                        $checkIfEpsNoSame->epsiodedate           = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $checkIfEpsNoSame->admissiondate         = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $checkIfEpsNoSame->dischargedate         = $content['data']['epiDiscDate'] != '' && $content['data']['epiDiscTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d').' '.$content['data']['epiDiscTime'] : null;
                        $checkIfEpsNoSame->episodedept           = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : null;
                        $checkIfEpsNoSame->episodedeptname       = $content['data']['epiDeptDesc'] != '' ? $content['data']['epiDeptDesc'] : null;
                        $checkIfEpsNoSame->consultantname        = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : null;
                        $checkIfEpsNoSame->age                   = $content['data']['age'] != '' ? $content['data']['age'] : null;
                        $checkIfEpsNoSame->agem                  = $content['data']['ageM'] != '' ? $content['data']['ageM'] : null;
                        $checkIfEpsNoSame->aged                  = $content['data']['ageD'] != '' ? $content['data']['ageD'] : null;
                        $checkIfEpsNoSame->epiward               = $content['data']['epiWard'] != '' ? $content['data']['epiWard'] : null;
                        $checkIfEpsNoSame->epiroom               = $content['data']['epiRoom'] != '' ? $content['data']['epiRoom'] : null;
                        $checkIfEpsNoSame->epistat               = $content['data']['epiStat'] != '' ? $content['data']['epiStat'] : null;
                        $checkIfEpsNoSame->bloodtype             = $content['data']['bgDesc'] != '' ? $content['data']['bgDesc'] : null;
                        $checkIfEpsNoSame->unfit                 = $content['data']['epiunfit'] == 1 ? 1 : null;
                        $checkIfEpsNoSame->pchcflag              = $content['data']['pchcFlag'] != '' ? $content['data']['pchcFlag'] : null;
                        $checkIfEpsNoSame->phosp                 = $content['data']['pHosp'] != '' ? $content['data']['pHosp'] : null;
                        $checkIfEpsNoSame->height                = $holdheight;
                        $checkIfEpsNoSame->weight                = $holdweight;
                        $checkIfEpsNoSame->bmi                   = $holdbmi;
                        $checkIfEpsNoSame->sysbp                 = $holdsystolic;
                        $checkIfEpsNoSame->diasbp                = $holddiastolic;
                        $checkIfEpsNoSame->heartrate             = $holdheartrate;
                        $checkIfEpsNoSame->spo2                  = $holdspo2;
                        $checkIfEpsNoSame->resprate              = $holdresprate;
                        $checkIfEpsNoSame->heartrate_datetime    = $holdheartratedate;
                        $checkIfEpsNoSame->pulse                 = $holdpulse;
                        $checkIfEpsNoSame->pulse_datetime        = $holdpulsedate;
                        $checkIfEpsNoSame->bsa                   = $holdbsa;
                        $checkIfEpsNoSame->temperature           = $content['data']['temp'] != '' ? $content['data']['temp'] : null;
                        $checkIfEpsNoSame->epiinterv             = $content['data']['epiInterv'] != '' ? $content['data']['epiInterv'] : null;
                        $checkIfEpsNoSame->vs_datetime           = $holdlastupdate;
                        $checkIfEpsNoSame->payor                 = $holdPayor;
                        $checkIfEpsNoSame->allergy               = $holdAllergy;
                        $checkIfEpsNoSame->currentmedication     = $holdMedication;
                        $checkIfEpsNoSame->medicationepisodeno   = $holdMedEpiNo;
                        $checkIfEpsNoSame->medicationepisodedate = $holdMedEpiDate != null ? Carbon::createFromFormat('d/m/Y', $holdMedEpiDate)->format('Y-m-d') : null;
                        $checkIfEpsNoSame->ef                    = $content['data']['ef'] != '' ? $content['data']['ef'] : null;
                        $checkIfEpsNoSame->efc                   = $content['data']['efc'] != '' ? $content['data']['efc'] : null;
                        $checkIfEpsNoSame->painscore             = null;
                        $checkIfEpsNoSame->painsite              = null;
                        $checkIfEpsNoSame->status_id             = 2;
                        $checkIfEpsNoSame->updated_by            = Auth::user()->id;
                        $checkIfEpsNoSame->updated_at            = Carbon::now();
                        $checkIfEpsNoSame->save();
                    }
                    else
                    {
                        $storeInfo = new PatientInformation();
                        $storeInfo->epid                    = $getEpid;
                        $storeInfo->episodenumber           = $getEpsdNo;
                        $storeInfo->epsiodedate             = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $storeInfo->admissiondate           = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $storeInfo->dischargedate           = $content['data']['epiDiscDate'] != '' && $content['data']['epiDiscTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d').' '.$content['data']['epiDiscTime'] : null;
                        $storeInfo->episodedept             = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : null;
                        $storeInfo->episodedeptname         = $content['data']['epiDeptDesc'] != '' ? $content['data']['epiDeptDesc'] : null;
                        $storeInfo->consultantname          = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : null;
                        $storeInfo->patient_id              = $updatePatient->id;
                        $storeInfo->age                     = $content['data']['age'] != '' ? $content['data']['age'] : null;
                        $storeInfo->agem                    = $content['data']['ageM'] != '' ? $content['data']['ageM'] : null;
                        $storeInfo->aged                    = $content['data']['ageD'] != '' ? $content['data']['ageD'] : null;
                        $storeInfo->epiward                 = $content['data']['epiWard'] != '' ? $content['data']['epiWard'] : null;
                        $storeInfo->epiroom                 = $content['data']['epiRoom'] != '' ? $content['data']['epiRoom'] : null;
                        $storeInfo->epistat                 = $content['data']['epiStat'] != '' ? $content['data']['epiStat'] : null;
                        $storeInfo->bloodtype               = $content['data']['bgDesc'] != '' ? $content['data']['bgDesc'] : null;
                        $storeInfo->unfit                   = $content['data']['epiunfit'] == 1 ? 1 : null;
                        $storeInfo->pchcflag                = $content['data']['pchcFlag'] != '' ? $content['data']['pchcFlag'] : null;
                        $storeInfo->phosp                   = $content['data']['pHosp'] != '' ? $content['data']['pHosp'] : null;
                        $storeInfo->height                  = $holdheight;
                        $storeInfo->weight                  = $holdweight;
                        $storeInfo->bmi                     = $holdbmi;
                        $storeInfo->sysbp                   = $holdsystolic;
                        $storeInfo->diasbp                  = $holddiastolic;
                        $storeInfo->heartrate               = $holdheartrate;
                        $storeInfo->heartrate_datetime      = $holdheartratedate;
                        $storeInfo->pulse                   = $holdpulse;
                        $storeInfo->pulse_datetime          = $holdpulsedate;
                        $storeInfo->spo2                    = $holdspo2;
                        $storeInfo->resprate                = $holdresprate;
                        $storeInfo->bsa                     = $holdbsa;
                        $storeInfo->temperature             = $content['data']['temp'] != '' ? $content['data']['temp'] : null;
                        $storeInfo->epiinterv               = $content['data']['epiInterv'] != '' ? $content['data']['epiInterv'] : null;
                        $storeInfo->vs_datetime             = $holdlastupdate;
                        $storeInfo->payor                   = $holdPayor;
                        $storeInfo->allergy                 = $holdAllergy;
                        $storeInfo->currentmedication       = $holdMedication;
                        $storeInfo->medicationepisodeno     = $holdMedEpiNo;
                        $storeInfo->medicationepisodedate   = $holdMedEpiDate != null ? Carbon::createFromFormat('d/m/Y', $holdMedEpiDate)->format('Y-m-d') : null;
                        $storeInfo->ef                      = $content['data']['ef'] != '' ? $content['data']['ef'] : null;
                        $storeInfo->efc                     = $content['data']['efc'] != '' ? $content['data']['efc'] : null;
                        $storeInfo->painscore               = null;
                        $storeInfo->painsite                = null;
                        $storeInfo->status_id               = 2;
                        $storeInfo->created_by              = Auth::user()->id;
                        $storeInfo->created_at              = Carbon::now();
                        $storeInfo->save();
                    }

                    if(isset($content['data']['allergyList']))
                    {
                        if(count($content['data']['allergyList']) > 0)
                        {
                            $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                            ->where('patient_id', $updatePatient->id)
                                            ->delete();

                            foreach($content['data']['allergyList'] as $allergy)
                            {
                                $storeAllergy = new PatientAllergy();
                                $storeAllergy->patient_id      = $updatePatient->id;
                                $storeAllergy->episodenumber   = $getEpsdNo;
                                $storeAllergy->epid            = $getEpid;
                                $storeAllergy->substance       = $allergy['substance'];
                                $storeAllergy->freetxtall      = $allergy['freetxtall'];
                                $storeAllergy->nature          = $allergy['nature'];
                                $storeAllergy->severity        = $allergy['severity'];
                                $storeAllergy->comment         = '-';
                                if($allergy['upDate'] != '')
                                {
                                    $storeAllergy->date = Carbon::createFromFormat('d/m/Y', $allergy['upDate']);
                                    $storeAllergy->time = $allergy['upTime'];
                                }
                                $storeAllergy->algid           = $allergy['ALGID'];
                                $storeAllergy->status_id       = $allergy['status'] == 'inactive' ? 1 : 2;
                                $storeAllergy->created_by      = Auth::user()->id;
                                $storeAllergy->created_at      = Carbon::now();
                                $storeAllergy->save();
                            }
                        }
                        else
                        {
                            $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                            ->where('patient_id', $updatePatient->id)
                                            ->delete();
                        }
                    }
                    else
                    {
                        $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                        ->where('patient_id', $updatePatient->id)
                                        ->delete();
                    }
                } 
            }
            else
            {
                $holdmrnpatient = null;

                DB::rollBack();

                $response = response()->json(
                    [
                      'status'  => 'failed',
                      'message' => 'API Error'
                    ], 200
                );

                return $response;
            }

            if($holdmrnpatient != null)
            {
                $urlSurgical = env('SUR_INVEN').$holdmrnpatient.'/'.$getEpsdNo;

                //local
                $clientSurgical = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

                //production
                //$client = new \GuzzleHttp\Client();
                
                try
                {
                    $responseSurgical = $clientSurgical->request('GET', $urlSurgical);

                    $statusCodeMed      = $responseSurgical->getStatusCode();
                    $contentSurgical    = $responseSurgical->getBody();
                    $contentSurgical    = json_decode($responseSurgical->getBody(), true);

                    if($contentSurgical != null)
                    {
                        if($contentSurgical['status'] == "success")
                        {
                            if(isset($contentSurgical['data']))
                            {
                                if(count($contentSurgical['data']) > 0)
                                {
                                    $deleteSurgical = PatientSurgical::where('episodenumber', $getEpsdNo)
                                                        ->where('patient_id', $holpatientid)
                                                        ->delete();

                                    foreach($contentSurgical['data'] as $surgical)
                                    {
                                        $storeSurgical = new PatientSurgical();
                                        $storeSurgical->patient_id     = $holpatientid;
                                        $storeSurgical->episodenumber  = $getEpsdNo;
                                        $storeSurgical->emrsurdesc     = $surgical['emrsurdesc'];
                                        $storeSurgical->emrsuropdate   = Carbon::createFromFormat('d/m/Y', $surgical['emrsuropdate'])->format('Y-m-d');
                                        $storeSurgical->emrsurepi      = $surgical['emrsurepi'];
                                        $storeSurgical->status_id      = 2;
                                        $storeSurgical->created_by     = Auth::user()->id;
                                        $storeSurgical->created_at     = Carbon::now();
                                        $storeSurgical->save();
                                    }
                                }
                                else
                                {
                                    $deleteSurgical = PatientSurgical::where('episodenumber', $getEpsdNo)
                                                        ->where('patient_id', $holpatientid)
                                                        ->delete();
                                }
                            }
                            else
                            {
                                $deleteSurgical = PatientSurgical::where('episodenumber', $getEpsdNo)
                                                    ->where('patient_id', $holpatientid)
                                                    ->delete();
                            }
                        }
                        else
                        {
                            $deleteSurgical = PatientSurgical::where('episodenumber', $getEpsdNo)
                                                ->where('patient_id', $holpatientid)
                                                ->delete();
                        }
                    }
                }
                catch (\Exception $e)
                {
                    $deleteSurgical = PatientSurgical::where('episodenumber', $getEpsdNo)
                                        ->where('patient_id', $holpatientid)
                                        ->delete();
                                                
                    DB::rollBack();

                    $response = response()->json(
                        [
                        'status'  => 'failed',
                        'message' => 'API Error'
                        ], 200
                    );

                    return $response;
                }
            }

            //commit the transaction
            DB::commit();

            return $next($request);
        }
        else
        {
            $ipharmacyArr = [
                'ipharmacy',
                'ipharmacy/getcheckdata',
                'ipharmacy/updatecheckdata', 
                'ipharmacy/getcollectdata', 
                'ipharmacy/updatecollectdata', 
                'ireporting/imilk', 
                'ireporting/imilk/getimilkinventory',
                'ireporting/iblood', 
                'ireporting/iblood/getibloodinventory',
                'ireporting/iblood/getlocationdetails',
                'ireporting/iblood/atr', 
                'ireporting/iblood/atr/getworklist',
                'ireporting/iblood/atr/getworklistconfirm',
                'ireporting/iblood/atr/getworklistfalse',
                'ireporting/iblood/atr/generateconfirm',
                'blood/reaction/report/generate',
                'ireporting/ida/preadmission',
                'ireporting/ida/preadmission/getpreadmissioninventory',
                'ireporting/discharge-summary',
                'ireporting/discharge-summary/list',
                'ireporting/adr',
                'ireporting/adr/getworklistsuspect',
                'ireporting/adr/getworklistconfirm',
                'ireporting/adr/getworklistfalse',
                'ireporting/adr/generateconfirm',
                'ireporting/adr/generatesuspect',
                'ireporting/adr/getpatientinfo',
            ];
            if(in_array($request->path(), $ipharmacyArr)){
                try
                {
                    if($getStaffId == null){
                        $getStaffId = $request->userId;
                    }

                    $urlAccess = env('STAFF_ACCESS').$getStaffId;

                    //local
                    $clientAccess = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

                    //production
                    //$clientAccess = new \GuzzleHttp\Client();

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
                return $next($request);
            }
            else{
                $response = response()->json(
                    [
                      'status'  => 'failed',
                      'message' => "Please login via TrakCare. Thank you."
                    ], 200
                );
    
                return $response;
            }
            
        }
    }
}
