<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Auth;
use Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::user() != null)
        {
            return redirect()->route('ida.general');
        }
        else
        {
            $response = response()->json(
                [
                  'status'  => 'failed',
                  'message' => "You don't have permission to login this system . Thank you."
                ], 200
            );

            return $response;
        }
    }
}
