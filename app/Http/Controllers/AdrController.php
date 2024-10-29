<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdrController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $urlLab = env('PAT_PREVIOUS') . $request->epsdno;
    
            // Local
            $clientLab = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);
    
            // Production
            // $clientLab = new \GuzzleHttp\Client();
    
            $responseprev = $clientLab->request('GET', $urlLab);
            $statusCodeLab = $responseprev->getStatusCode();
            $contentprev = json_decode($responseprev->getBody(), true);

            $medhistory = $contentprev['data']['medHistory'];

            // dd($medhistory);

        return view('adr.index', compact('url', 'medhistory'));
    }

    public function genReport(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('adr.report.subviews.report', compact(
            'url', 
        ));
    }
}
