<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

//models
use App\Models\IdaGeneral;

use DB;
use Auth;
use Carbon\Carbon;

class SchedulerController extends Controller
{
    //auto lock IDA if more than 24 hours
    public function apiGetAutoLockIda()
    {
        try
        {
            $getIdaGeneral = IdaGeneral::where('islock', 0)
                            ->where('status_id', 2)
                            ->get();

            foreach($getIdaGeneral as $ida)
            {
                $getDate24 = Carbon::parse($ida['created_at'])->addDays(1);

                if(Carbon::now() > $getDate24)
                {
                    $updateLock = IdaGeneral::where('id', $ida['id'])
                                    ->where('status_id', 2)
                                    ->first();
                    $updateLock->islock             = 1;
                    $updateLock->auto_lock          = 1;
                    $updateLock->auto_lock_datetime = Carbon::now();
                    $updateLock->save();
                }
            }

            Log::info('update ida auto lock cronjob run');

            $response = response()->json(
                [
                    'status'  => 'success',
                    'message' => 'Successfully updated'
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

    //auto update careprovider
    public function getApiUpdateCareprovider(Request $request)
    {
        try
        {
            $url    = env('STAFF_ALL');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $url);
            // dd($response);

            $statusCode = $response->getStatusCode();
            $content    = $response->getBody();

            $content = json_decode($response->getBody(), true);

            $data = [];

            if(count($content['List CP']) > 0)
            {
                foreach($content['List CP'] as $rn)
                {
                    $temp = [];   
                    
                    if (stripos($rn['cpName'], 'Inactive') === false && stripos($rn['cpName'], 'KKM') === false)
                    {
                        $checkCpIdExist = Careprovider::where('cpid', $rn['cpid'])
                                            ->where('status_id', 2)
                                            ->first();

                        if($checkCpIdExist == null)
                        {
                            $store = new Careprovider();
                            $store->cpid        = $rn['cpid'];
                            $store->cpCode      = $rn['cpCode'];
                            $store->cpName      = $rn['cpName'];
                            $store->cpTypeID    = $rn['cpTypeID'];
                            $store->cpActive    = $rn['cpActive'];
                            $store->status_id   = 2;
                            $store->created_by  = Auth::user()->id;
                            $store->created_at  = Carbon::now();
                            $store->updated_by  = Auth::user()->id;
                            $store->updated_at  = Carbon::now();
                            $store->save();
                        }
                    }
                }
            }

            Log::info('update careprovider cronjob run');

            $response = response()->json(
                [
                  'status'  => 'success',
                  'message' => 'Successfully updated'
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
