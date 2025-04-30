<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\BedManagementBackup;


class BedManagementController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        //BED_SEARCH
        $uri = env('BED_SEARCH');
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        if (isset($content['WardList']) && is_array($content['WardList']) && count($content['WardList']) > 0) {
            $message = "Live Update from Trakcare";
        }else{

            $backup = BedManagementBackup::latest()->first();
            $createdAt = optional($backup?->created_at)->format('d/m/Y g:ia');

            $message = "Last Update at: {$createdAt}";

        }

        $today = Carbon::today();
        $tomorrow = $today->copy()->addDay();
        $inThreeDays = $today->copy()->addDays(3);
        $inSevenDays = $today->copy()->addDays(7);

        $summary = [];

        foreach ($content["WardList"] as $ward) {
            $wardName = $ward['warddesc'] ?? $ward['wardcode'];
            $bedList = $ward['BedList'] ?? [];
            $nurseStation = $ward['NurseStation'] ?? [];

            if (empty($bedList) && empty($nurseStation)) {
                continue;
            }

            $todayCount = 0;
            $tomorrowCount = 0;
            $next3to7Count = 0;
            $totalBeds = count($bedList);
            $occupied = 0;
            $booked = 0;
            $unavailable = 0;

            foreach ($bedList as $bed) {
                if (!empty($bed['episodeno'])) {
                    $occupied++;
                }

                if (!empty($bed['bedstatus']) && strtolower($bed['bedstatus']) === 'unavailable') {
                    $unavailable++;
                }

                if (!empty($bed['estdisdate'])) {
                    try {
                        $estDate = Carbon::createFromFormat('d/m/Y', trim($bed['estdisdate']));
                        if ($estDate->isToday()) {
                            $todayCount++;
                        } elseif ($estDate->isTomorrow()) {
                            $tomorrowCount++;
                        } elseif ($estDate->between($inThreeDays, $inSevenDays)) {
                            $next3to7Count++;
                        }
                    } catch (\Exception $e) {
                        Log::error("Invalid estdisdate format: " . $bed['estdisdate'], [
                            'ward' => $wardName,
                            'bedno' => $bed['bedno'] ?? null,
                            'error' => $e->getMessage(),
                        ]);
                        continue;
                    }
                }

                if (!empty($bed['BedRequestList']) && is_array($bed['BedRequestList'])) {
                    $booked++;
                }
            }

            foreach ($nurseStation as $nurse) {
                if (!empty($nurse['BedRequestList']) && is_array($nurse['BedRequestList'])) {
                    $booked++;
                }
            }

            $currentPatients = $occupied + count($nurseStation);

            $summary[] = [
                'ward' => $wardName,
                'today' => $todayCount,
                'tomorrow' => $tomorrowCount,
                'next3to7' => $next3to7Count,
                'total' => $totalBeds,
                'occupied' => $occupied,
                'booked' => $booked,
                'unavailable' => $unavailable,
                'currentpatients' => $currentPatients,
            ];
        }

        $summary = collect($summary)->sortBy('ward')->values()->toArray();
        // dd($summary);

        return view('bedmanagement.index', compact(
            'url',
            'message',
            'summary'
         ));

    }

    public function wardList(Request $request)
    {
        try {
            $uri = env('BED_SEARCH');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $uri);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            if (isset($content['WardList']) && is_array($content['WardList']) && count($content['WardList']) > 0) {
                $list = $content['WardList'];

                return response()->json([
                    'status' => 'success',
                    'data' => $list,
                    'source' => 'api',
                ], 200);

            } else {

                Log::warning('API responded but WardList is missing or empty. Using backup.');

                // Get from backup
                $backup = BedManagementBackup::latest()->first();
                $list = json_decode($backup?->backup ?? '[]', true);

                // dd($backup->created_at);

                return response()->json([
                    'status' => 'success',
                    'data' => $list,
                    'createdat' => $backup->created_at,
                    'source' => 'backup',
                ], 200);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            // Fallback to backup if API call fails completely
            $backup = BedManagementBackup::latest()->first();
            $list = json_decode($backup?->backup ?? '[]', true);

            return response()->json([
                'status' => 'success',
                'data' => $list,
                'source' => 'backup',
            ], 200);
        }
    }


    public function patientInfo(Request $request)
    {
        try{
            //PatDemo
            $uri = env('PAT_DEMO'). $request->epsdno;
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $uri);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            $patdemo = $content['data'];

            $response = response()->json(
                [
                'status'      => 'success',
                'data'        => $patdemo,
                ], 200
            );

            return $response;
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

    
    public function scheduleBackup(Request $request) 
    {
        try {
            $uri = env('BED_SEARCH');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $uri);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            $jsonString = json_encode($content['WardList'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            BedManagementBackup::truncate();

            $store             = new BedManagementBackup();
            $store->backup     = $jsonString;
            $store->created_at = Carbon::now();
            $store->save(); 

            return response()->json([
                'status'  => 'success',
                'message' => 'Successfully Updated!'
            ], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'status'  => 'failed',
                'message' => 'Internal error happened. Try again'
            ], 200);
        }
    }
    
}
