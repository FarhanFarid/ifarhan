<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

//models
use App\Models\Patient;
use App\Models\IdagPlanentercpw;
use App\Models\PatientInformation;

use DB;
use Auth;
use Carbon\Carbon;

class MainController extends Controller
{
    public function apiGetPatientInfo(Request $request)
    {
        try
        {
            $url    = env('PAT_DEMO').$request['epsdno'];
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $url);

            $statusCode = $response->getStatusCode();
            $content    = $response->getBody();

            $content = json_decode($response->getBody(), true);
            
            if($content['status'] == "success")
            {
                $temp           = [];
                $holdAllergy    = '-';
                $arrAllergy     = [];
                $holdPayor      = '-';
                $arrPayor       = [];
                $holdMedication = '-';
                $arrMedication  = [];

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
                        $holdAllergy = '-';
                    }
                }
                else
                {
                    $holdAllergy = '-';
                }

                if(isset($content['data']['medHistory']))
                {
                    if(count($content['data']['medHistory']) > 0)
                    {
                        foreach($content['data']['medHistory'] as $medication)
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

                if(isset($content['data']['allergyList']))
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
                        $holdPayor = '-';
                    }
                }
                else
                {
                    $holdPayor = '-';
                }

                if(isset($content['data']['vitalSign']))
                {
                    if(isset($content['data']['vitalSign'][1]))
                    {
                        $holdsystolic   = $content['data']['vitalSign'][1]['systolic'] != '' ? str_replace('(mmHg)', '', $content['data']['vitalSign'][1]['systolic']) : null;
                        $holddiastolic  = $content['data']['vitalSign'][1]['diastolic'] != '' ? str_replace('(mmHg)', '', $content['data']['vitalSign'][1]['diastolic']) : null;
                        $holdheartrate  = $content['data']['vitalSign'][1]['pulse'] != '' ? str_replace('(bpm)', '', $content['data']['vitalSign'][1]['pulse']) : null;
                        $holdweight     = $content['data']['vitalSign'][1]['weight'] != '' && $content['data']['vitalSign'][1]['weight'] != 'unfit' ? str_replace('kg', '', $content['data']['vitalSign'][1]['weight']) : null;
                        $holdheight     = $content['data']['vitalSign'][1]['height'] != '' && $content['data']['vitalSign'][1]['height'] != 'unfit' ? str_replace('cm', '', $content['data']['vitalSign'][1]['height']) : null;
                        $holdspo2       = $content['data']['vitalSign'][1]['spo2'] != '' ? str_replace('%', '', $content['data']['vitalSign'][1]['spo2']) : null;
                        $holdheight     = ($holdheight == '' || $holdheight == 0) ? null : $holdheight;
                        $holdweight     = ($holdweight == '' || $holdweight == 0) ? null : $holdweight;
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
                        $holdlastupdate = null;
                        $holdresprate   = $content['data']['resprate'] != '' ? $content['data']['resprate'] : null;
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

                // $getCpw = IdagPlanentercpw::where('episodeno', $request['epsdno'])
                //             ->where('cpw', '!=', null)
                //             ->where('status_id', 2)
                //             ->get()
                //             ->pluck('cpw')
                //             ->toArray();

                // if(count($getCpw) > 0) {
                //     $holdcpw = implode('; ', $getCpw);
                // }
                // else {
                //     $holdcpw = null;
                // }

                $temp['name']               = $content['data']['pName'];
                $temp['mrn']                = $content['data']['prn'];
                $temp['nric']               = $content['data']['pnric'];
                $temp['dob']                = $content['data']['pdob'] != '' ? $content['data']['pdob'] : '-';

                if($content['data']['age'] != '')
                {
                    $holdage = $content['data']['age'].' Years';
                }
                else
                {
                    $holdage = '0 Year';
                }

                if($content['data']['ageM'] != '')
                {
                    $holdage = $holdage.' '.$content['data']['ageM'].' Months';
                }
                else
                {
                    $holdage = $holdage.' 0 Month';
                }

                if($content['data']['ageD'] != '')
                {
                    $holdage = $holdage.' '.$content['data']['ageD'].' Days';
                }
                else
                {
                    $holdage = $holdage.' 0 Day';
                }

                if($content['data']['age'] != '')
                {
                    $holdageyear = $content['data']['age'];
                }
                else
                {
                    $holdageyear = '0';
                }

                $temp['ageyear']            = $holdageyear;
                $temp['age']                = $holdage;
                $temp['sex']                = $content['data']['pgender'] != '' ? $content['data']['pgender'] : '-';
                $temp['race']               = $content['data']['prace'] != '' ? $content['data']['prace'] : '-';
                $temp['religion']           = $content['data']['prel'] != '' ? $content['data']['prel'] : '-';
                $temp['admissiondate']      = $content['data']['epiDate'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDate'])->format('Y-m-d') : '-';
                $temp['dischargedate']      = $content['data']['epiDiscDate'] != '' ? Carbon::createFromFormat('d/m/Y', $content['data']['epiDiscDate'])->format('Y-m-d') : '-';
                $temp['consultantname']     = $content['data']['epiDoc'] != '' ? $content['data']['epiDoc'] : '-';
                $temp['episodedept']        = $content['data']['epiDept'] != '' ? $content['data']['epiDept'] : '-';
                $temp['epsdno']             = $request['epsdno'];
                $temp['epsddate']           = $content['data']['epiDate'];
                $temp['bloodtype']          = $content['data']['bgDesc'] != '' ? $content['data']['bgDesc'] : '-';
                $temp['allergy']            = $holdAllergy;
                $temp['currentmedication']  = $holdMedication;
                $temp['payor']              = $holdPayor;
                $temp['unfit']              = $content['data']['epiunfit'] == 1 ? 1 : '-';
                $temp['weight']             = $holdweight != null ? $holdweight : '-';
                $temp['height']             = $holdheight != null ? $holdheight : '-';
                $temp['bmi']                = $holdbmi != null ? $holdbmi : '-';
                $temp['bsa']                = $holdbsa != null ? $holdbsa : '-';
                $temp['resprate']           = $holdresprate != null ? $holdresprate : '-';
                $temp['temperature']        = $content['data']['temp'] != '' ? $content['data']['temp'] : '-';
                $temp['epiinterv']          = $content['data']['epiInterv'] != '' ? $content['data']['epiInterv'] : '-';
                $temp['vslastupdate']       = $holdlastupdate != null ? $holdlastupdate : '-';
                $temp['ef']                 = $content['data']['ef'] != '' ? $content['data']['ef'] : '-';
                $temp['efc']                = $content['data']['efc'] != '' ? $content['data']['efc'] : '-';
                $temp['sysbp']              = $holdsystolic != null ? $holdsystolic : '-';
                $temp['diasbp']             = $holddiastolic != null ? $holddiastolic : '-';
                $temp['heartrate']          = $holdheartrate != null ? $holdheartrate : '-';
                $temp['heartratedate']      = $holdheartratedate != null ? $holdheartratedate : '-';
                $temp['pulse']              = $holdpulse != null ? $holdpulse : '-';
                $temp['pulsedate']          = $holdpulsedate != null ? $holdpulsedate : '-';
                $temp['spo2']               = $holdspo2 != null ? $holdspo2 : '-';
                $temp['painscore']          = '-';
                $temp['painsite']           = '-';
                // $temp['cpw']                = $holdcpw;

                $response = response()->json(
                    [
                      'status'  => 'success',
                      'data'    => $temp
                    ], 200
                );

                return $response;
            }
            else
            {
                $response = response()->json(
                    [
                      'status'  => 'failed',
                      'message' => 'API Error'
                    ], 200
                );

                return $response;
            }
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
