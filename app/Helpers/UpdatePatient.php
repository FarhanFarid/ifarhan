<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

//models
use App\Models\Patient;
use App\Models\PatientAllergy;
use App\Models\PatientInformation;

use DB;
use Auth;
use Carbon\Carbon;

class UpdatePatient
{
	public function updatepatient($getEpsdNo, $epid, $patid)
    {
        $url = env('PAT_DEMO').$getEpsdNo;

        //local
        $client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

        //production
        //$client = new \GuzzleHttp\Client();

        $data['allergy'] = null;
        $holdAllergy     = null;

        try
        {
            $response = $client->request('GET', $url);

            $statusCode = $response->getStatusCode();
            $content    = $response->getBody();
            $content    = json_decode($response->getBody(), true);

            if($content['status'] == "success")
            {
                $holdAllergy    = null;
                $arrAllergy     = [];

                $updatePatient = PatientInformation::where('episodenumber', $getEpsdNo)
                                    ->where('status_id', 2)
                                    ->first();

                if($updatePatient != null)
                {
                    if(isset($content['data']['allergyList']))
                    {
                        if(count($content['data']['allergyList']) > 0)
                        {
                            $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                            ->where('patient_id', $updatePatient->patient_id)
                                            ->delete();

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

                                $storeAllergy = new PatientAllergy();
                                $storeAllergy->patient_id      = $updatePatient->patient_id;
                                $storeAllergy->episodenumber   = $getEpsdNo;
                                $storeAllergy->epid            = $updatePatient->epid;
                                $storeAllergy->substance       = $allergy['substance'];
                                $storeAllergy->freetxtall      = $allergy['freetxtall'];
                                $storeAllergy->nature          = $allergy['nature'];
                                $storeAllergy->severity        = $allergy['severity'];
                                $storeAllergy->comment         = '-';
                                if($allergy['upDate'] != '')
                                {
                                    $storeAllergy->date = Carbon::createFromFormat('d/m/Y', $allergy['upDate'])->format('Y-m-d');
                                    $storeAllergy->time = $allergy['upTime'];
                                }
                                $storeAllergy->algid           = $allergy['ALGID'];
                                $storeAllergy->status_id       = $allergy['status'] == 'inactive' ? 1 : 2;
                                $storeAllergy->created_by      = Auth::user()->id;
                                $storeAllergy->created_at      = Carbon::now();
                                $storeAllergy->save();
                                
                            }

                            $holdAllergy = implode(', ', $arrAllergy);
                        }
                        else
                        {
                            $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                            ->where('patient_id', $updatePatient->patient_id)
                                            ->delete();

                            $holdAllergy = null;
                        }
                    }
                    else
                    {
                        $deleteAllergy = PatientAllergy::where('episodenumber', $getEpsdNo)
                                        ->where('patient_id', $updatePatient->patient_id)
                                        ->delete();

                        $holdAllergy = null;
                    }
                }

                $holdPayor      = null;
                $arrPayor       = [];

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

                if($holdmrnpatient != null)
                {
                    $checkIfMrnExist = Patient::where('mrn', $holdmrnpatient)
                                        ->where('status_id', 2)
                                        ->first();

                    $updatePatient = Patient::where('id', $checkIfMrnExist->id)
                                        ->where('status_id', 2)
                                        ->first();
                    $updatePatient->patid        = $patid;
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
                                        ->where('patient_id', $holpatientid)
                                        ->where('status_id', 2)
                                        ->first();

                    if($checkIfEpsNoSame != null)
                    {
                        $checkIfEpsNoSame->epid                  = $epid;
                        $checkIfEpsNoSame->epsiodedate           = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $checkIfEpsNoSame->admissiondate         = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $checkIfEpsNoSame->dischargedate         = $content['data']['epiDiscDate'] != '' && $content['data']['epiDiscTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d').' '.$content['data']['epiDiscTime'] : null;
                        $checkIfEpsNoSame->episodedept           = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : null;
                        $checkIfEpsNoSame->episodedeptname       = $content['data']['epiDeptDesc'] != '' ? $content['data']['epiDeptDesc'] : null;
                        $checkIfEpsNoSame->consultantname        = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : null;
                        $checkIfEpsNoSame->padd                  = $content['data']['padd'] != '' ? $content['data']['padd'] : null;
                        $checkIfEpsNoSame->pposcode              = $content['data']['pposcode'] != '' ? $content['data']['pposcode'] : null;
                        $checkIfEpsNoSame->pcity                 = $content['data']['pcity'] != '' ? $content['data']['pcity'] : null;
                        $checkIfEpsNoSame->pstate                = $content['data']['pstate'] != '' ? $content['data']['pstate'] : null;
                        $checkIfEpsNoSame->pcountry              = $content['data']['pcountry'] != '' ? $content['data']['pcountry'] : null;
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
                        $checkIfEpsNoSame->ef                    = $content['data']['ef'] != '' ? $content['data']['ef'] : null;
                        $checkIfEpsNoSame->efc                   = $content['data']['efc'] != '' ? $content['data']['efc'] : null;
                        $checkIfEpsNoSame->painscore             = null;
                        $checkIfEpsNoSame->painsite              = null;
                        $checkIfEpsNoSame->status_id             = 2;
                        $checkIfEpsNoSame->updated_by            = Auth::user()->id;
                        $checkIfEpsNoSame->updated_at            = Carbon::now();
                        $checkIfEpsNoSame->save();

                        Log::info('done update patient PatDemo');
                    }
                    else
                    {
                        $storeInfo = new PatientInformation();
                        $storeInfo->epid                    = $epid;
                        $storeInfo->episodenumber           = $getEpsdNo;
                        $storeInfo->epsiodedate             = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $storeInfo->admissiondate           = $content['data']['epiDate'] != '' && $content['data']['epiTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d').' '.$content['data']['epiTime'] : null;
                        $storeInfo->dischargedate           = $content['data']['epiDiscDate'] != '' && $content['data']['epiDiscTime'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d').' '.$content['data']['epiDiscTime'] : null;
                        $storeInfo->episodedept             = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : null;
                        $storeInfo->episodedeptname         = $content['data']['epiDeptDesc'] != '' ? $content['data']['epiDeptDesc'] : null;
                        $storeInfo->consultantname          = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : null;
                        $storeInfo->padd                    = $content['data']['padd'] != '' ? $content['data']['padd'] : null;
                        $storeInfo->pposcode                = $content['data']['pposcode'] != '' ? $content['data']['pposcode'] : null;
                        $storeInfo->pcity                   = $content['data']['pcity'] != '' ? $content['data']['pcity'] : null;
                        $storeInfo->pstate                  = $content['data']['pstate'] != '' ? $content['data']['pstate'] : null;
                        $storeInfo->pcountry                = $content['data']['pcountry'] != '' ? $content['data']['pcountry'] : null;
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
                        $storeInfo->ef                      = $content['data']['ef'] != '' ? $content['data']['ef'] : null;
                        $storeInfo->efc                     = $content['data']['efc'] != '' ? $content['data']['efc'] : null;
                        $storeInfo->painscore               = null;
                        $storeInfo->painsite                = null;
                        $storeInfo->status_id               = 2;
                        $storeInfo->created_by              = Auth::user()->id;
                        $storeInfo->created_at              = Carbon::now();
                        $storeInfo->save();

                        Log::info('done add patient PatDemo');
                    }
                }
            }

            return $getEpsdNo;
        }
        catch (\Exception $e)
        {
            Log::info('error patient PatDemo');
            
            $response = response()->json(
                [
                  'status'  => 'failed',
                  'message' => "PatDemo Allergy Error"
                ], 200
            );

            return $response;
        }
	}
}