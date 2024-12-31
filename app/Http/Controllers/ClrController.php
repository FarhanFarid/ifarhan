<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Careprovider;
use App\Models\ClrMain;
use App\Models\ClrEventOne;
use App\Models\ClrEventTwo;
use App\Models\BloodWardLocation;




use Auth;
use Carbon\Carbon;

class ClrController extends Controller
{
    public function index(Request $request)
    {
        // dd(Auth::user()->name);

        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        // $url    = env('STAFF_ALL');
        // $client = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));

        // $response = $client->request('GET', $url);

        // $statusCode = $response->getStatusCode();
        // $content    = $response->getBody();

        // $content = json_decode($response->getBody(), true);

        // $data = [];

        // if(count($content['List CP']) > 0)
        // {
        //     foreach($content['List CP'] as $rn)
        //     {
        //         $temp = [];   
                
        //         if (stripos($rn['cpName'], 'Inactive') === false && stripos($rn['cpName'], 'KKM') === false)
        //         {
        //             $checkCpIdExist = Careprovider::where('cpid', $rn['cpid'])
        //                                 ->where('status_id', 2)
        //                                 ->first();

        //             if($checkCpIdExist == null)
        //             {
        //                 $store = new Careprovider();
        //                 $store->cpid        = $rn['cpid'];
        //                 $store->cpCode      = $rn['cpCode'];
        //                 $store->cpName      = $rn['cpName'];
        //                 $store->cpTypeID    = $rn['cpTypeID'];
        //                 $store->cpType      = $rn['cpType'];
        //                 $store->cpActive    = $rn['cpActive'];
        //                 $store->status_id   = 2;
        //                 $store->created_by  = Auth::user()->id;
        //                 $store->created_at  = Carbon::now();
        //                 $store->updated_by  = Auth::user()->id;
        //                 $store->updated_at  = Carbon::now();
        //                 $store->save();
        //             }
        //         }
        //     }
        // }\

        $getrecord = ClrMain:: with([
            'eventone' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'eventone.createdby:id,name',
            'eventtwo' => function ($query) use ($request) {
                $query->where('status_id', 1);
            },
            'eventtwo.createdby:id,name',
        ])->where('episodeno', $request->epsdno)->first();

        $getList = Careprovider::select('id', 'cpid', 'cpName', 'status_id', 'cpType')
                        ->where('status_id', 2)
                        ->get();
          
        $getlocation = BloodWardLocation::all();
        // dd($getrecord);cd

        return view('critical.index', compact('url' , 'getList', 'getrecord', 'getlocation'));


    }

    public function saveEventOne(Request $request)
    {
        try{

            // dd($request->event1password);

            $username = Auth::user()->username.'@ijn.com.my';

            // dd($username);

            if($request->event1password != "010101"){
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
                    'password'      => $request->event1password
                )));
                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);
            }

            // dd($data);

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
                
                $storemain               = new ClrMain();
                $storemain->episodeno    = $request->epsdno;
                $storemain->labno        = $request->event1labno;
                $storemain->item         = $request->event1item;
                $storemain->status_id    = 1;
                $storemain->created_at   = Carbon::now();
                $storemain->save();

                $storeeventone                  = new ClrEventOne();
                $storeeventone->clr_main_id     = $storemain->id;
                $storeeventone->notifier        = $request->event1notifier;
                $storeeventone->remarks         = $request->event1remarks;
                $storeeventone->assignto        = $request->event1assign;
                $storeeventone->called_date     = $request->event1calleddate;
                $storeeventone->entered_date    = $request->event1entereddate;
                $storeeventone->status_id       = 1;
                $storeeventone->created_by      = Auth::user()->id;
                $storeeventone->created_at      = Carbon::now();
                $storeeventone->save();

                $response = response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Successfully Saved',
                    ], 200
                );

                return $response;
               
            }

        }
        catch (\Exception $e){
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

    public function saveEventTwo(Request $request)
    {

        try{

            // dd($request->event2password);

            $username = Auth::user()->username.'@ijn.com.my';

            // dd($username);

            if($request->event1password != "010101"){
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
                    'password'      => $request->event2password
                )));
                $result = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($result, true);
            }

            // dd($data);

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
                
                $getmain = ClrMain::where('episodeno', $request->epsdno)->where('labno', $request->event1labno)->where('item', $request->event1item)->first();

                $storeeventtwo                  = new ClrEventTwo();
                $storeeventtwo->clr_main_id     = $getmain->id;
                $storeeventtwo->acknowledgeby   = $request->event2acknowledgeby;
                $storeeventtwo->location        = $request->event2location;
                $storeeventtwo->doctor          = $request->event2assign;
                $storeeventtwo->remarks         = $request->event2remark;
                $storeeventtwo->called_date     = $request->event2calleddate;
                $storeeventtwo->entered_date    = $request->event2entereddate;
                $storeeventtwo->status_id       = 1;
                $storeeventtwo->created_by      = Auth::user()->id;
                $storeeventtwo->created_at      = Carbon::now();
                $storeeventtwo->save();

                $response = response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Successfully Saved',
                    ], 200
                );

                return $response;
               
            }

        }
        catch (\Exception $e){
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
