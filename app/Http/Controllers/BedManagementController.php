<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

        // dd($content["WardList"]);

        return view('bedmanagement.index', compact(
            'url', 
         ));

    }

    public function wardList(Request $request)
    {
        try{

            //BED_SEARCH
            $uri = env('BED_SEARCH');
            $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

            $response = $client->request('GET', $uri);

            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            $list = $content["WardList"];

            $response = response()->json(
                [
                'status'      => 'success',
                'data'        => $list,
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
}
