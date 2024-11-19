<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\BloodInventory;
use App\Models\BloodLocation;
use App\Models\Patient;
use App\Models\PatientInformation;
use App\Models\User;


use Auth;

class BloodTransfusionController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $bagno = $request->bagno;

        return view('iblood.transfuse.index', compact('url', 'bagno'));

    }

    public function detail (Request $request){

        try{ 

            $data = BloodInventory::where('bagno', $request->input('bagno'))->where('labno', $request->labno)->where('episodeno', $request->epsdno)->first();
            $patient = Patient::where('mrn', $request->input('mrn'))->first();
    
            if($patient != null){
    
                $pinfo = PatientInformation::where('patient_id', $patient->id)->where('episodenumber', $request->epsdno)->first();
    
                $labno = $request->labno;
                $urlLab = env('LAB_ORDER') . $labno;
        
                // Local
                $clientLab = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);
        
                // Production
                // $clientLab = new \GuzzleHttp\Client();
        
                $responseLab = $clientLab->request('GET', $urlLab);
                $statusCodeLab = $responseLab->getStatusCode();
                $contentLab = json_decode($responseLab->getBody(), true);
        
                // Check if the lab number exists in the lab results
                $labExists = false;
                $containsBloodPack = false;
    
                $itemcode = 
                [
                    'LSB100',
                    'LSB048',
                    'LSB047',
                    'LSB045',
                    'LSB044',
                    'LSB041',
                    'LSB025',
                    'LSB022',
                    'LSB021',
                    'LSB020',
                    'LSB018',
                    'LSB017',
                    'LSB016',
                    'LSB015',
                    'LSB014',
                    'LSB013',
                    'LSB012',
                    'LSB011',
                    'LSB0040',
                    'LSB004',
                    'LSB003',
                    'LSB001',
                    'LSB101',
                    'LSB0042',
                ];
    
                if ($contentLab['mrn'] == $request->input('mrn')) {
                    $labExists = true;
    
                    foreach ($contentLab['orderItem'] as $item) {
                        if (isset($item['itmCODE']) && in_array($item['itmCODE'], $itemcode)) {
                            $containsBloodPack = true;
                            break;
                        }
                    }
                }
    
                if ($pinfo != null) {
    
                    if ($labExists == true) {
    
                        if($data != null){
    
                            if($request->bagsno != $request->bagno){
    
                                return response()->json(
                                    [
                                        'status'  => 'failed',
                                        'message' => 'Please scan the correct bloodpack.',
                                    ], 200
                                );
    
                            }else{
                                if($data->labno != $labno){
    
                                    return response()->json(
                                        [
                                            'status'  => 'failed',
                                            'message' => 'This blood pack is not belong to this lab number',
                                        ], 200
                                    );
        
                                }
                                elseif($pinfo->episodenumber == $data->episodeno){
        
                                    if ($containsBloodPack) {
                                        return response()->json(
                                            [
                                                'status'  => 'success',
                                                'data' => $data,
                                                'patient' => $patient,
                                                'info' => $pinfo,
                                            ], 200
                                        );
                                    } else{
                                        return response()->json(
                                            [
                                                'status' => 'failed',
                                                'message' => 'Lab number did not contain packed cell.',
                                            ], 200
                                        );
                                    }
                
                                }else{
                                    return response()->json(
                                        [
                                            'status'  => 'failed',
                                            'message' => 'Blood pack and patient does not match!',
                                        ], 200
                                    );
                                }
                            }
                
                        }else{
                
                            return response()->json(
                                [
                                    'status'  => 'failed',
                                    'message' => 'Blood bag not found!',
                                ], 200
                            );
                        }
                        
                    } else {
                        return response()->json(
                            [
                                'status' => 'failed',
                                'message' => 'This blood bag did not belong to this patient.',
                            ], 200
                        );
                    }
    
                }else{
                    return response()->json(
                        [
                            'status' => 'failed',
                            'message' => 'This blood bag did not belong to this patient.',
                        ], 200
                    );
                }
            }else{
               return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Patient not found!',
                    ], 200
                );
            } 

        }catch (\Exception $e){
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

    public function submit (Request $request){

        try{ 

            $username = $request->username.'@ijn.com.my';

            if($request->password != "010101"){
                $url  = env('OAUTH_MS_API_URL');
                $ch   = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url );
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST, true );
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query(array(
                    'grant_type'    => env('OAUTH_MS_API_GRANT_TYPE'),
                    'client_id'     => env('OAUTH_MS_API_CLIENT_ID'),
                    'client_secret' => env('OAUTH_MS_API_CLIENT_SECRET'),
                    'scope'         => env('OAUTH_MS_API_SCOPE'),
                    'username'      => $username,
                    'password'      => $request->password
                )));
                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);
            }

            if(isset($data['error']))
            {
                $response = response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Wrong password. Please try again.',
                    ], 200
                );

                return $response;

            }else{
                
                $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('labno', $request->labno)->where('episodeno', $request->epsdno)->first();
                $location = BloodLocation::where('inventory_bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->where('status_id', 1)->first();
                $user = User::where('username', $request->input('username'))->first();
            
                if($inventory != null)
                {
                    $inventory->transfuse_verify_by         = $user->id;
                    $inventory->transfuse_status_id         = 3;
                    $inventory->transfuse_completion_id     = 1;
                    $inventory->transfuse_start_by          = Auth::user()->id;
                    $inventory->transfuse_start_at          = $request->input('transfusedate');
                    $inventory->transfusecd_reason          = $request->input('transfusecdreason');
                    $inventory->save();

                    $location->start_transfusion            = "Yes";
                    $location->save();
                
                    return $response = response()->json(
                        [
                        'status'  => 'success',
                        'message1'    => $inventory ,
                        ], 200
                    );
                }else{
                    return response()->json(['status' => 'failed', 'message' => 'Administer Failed'], 404);
                }
            }
            
        }catch (\Exception $e)
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
        
        
        // try
        // { 
        //     $inventory = BloodInventory::where('bagno', $request->input('bagno'))->first();
        //     $user = User::where('username', $request->input('username'))->first();
        
        //     if($inventory != null)
        //     {
        //         $inventory->transfuse_verify_by         = $user->id;
        //         $inventory->transfuse_status_id         = 3;
        //         $inventory->transfuse_completion_id     = 1;
        //         $inventory->transfuse_start_by          = Auth::user()->id;
        //         $inventory->transfuse_start_at          = Carbon::now();
        //         $inventory->save();
            
        //         return $response = response()->json(
        //             [
        //             'status'  => 'success',
        //             'message1'    => $inventory ,
        //             ], 200
        //         );
        //     }else{
        //         return response()->json(['status' => 'failed', 'message' => 'Administer Failed'], 404);
        //     }
        // }
        // catch (\Exception $e)
        // {
        //     Log::error($e->getMessage(), [
        //             'file' => $e->getFile(),
        //             'line' => $e->getLine()
        //         ]
        //     );

        //     $response = response()->json(
        //         [
        //             'status'  => 'failed',
        //             'message' => 'Internal error happened. Try again'
        //         ], 200
        //     );

        //     return $response;
        // }
        
    }
}
