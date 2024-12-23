<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClrController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('critical.index', compact('url'));
    }

}
