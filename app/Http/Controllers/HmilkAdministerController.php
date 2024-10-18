<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


use App\Models\Inventory;
use App\Models\Caregiver;
use App\Models\Patient;
use App\Models\PatientInformation;

use Auth;

class HmilkAdministerController extends Controller
{
    public function index(Request $request)
    {
        //TotalEBM
        $totalebm = Inventory::where('episodeNo', $request->input('epsdno'))->count();
        $totalebmChiller = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 1)->where('storeArea', "Chiller")->count();
        $totalebmFreezer = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 1)->where('storeArea', "Freezer")->count();

        //ExpiredEBM
        $expiredebm = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 6)->count();
        $expiredebmChiller = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 5)->where('storeArea', "Chiller")->count();
        $expiredebmFreezer = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 5)->where('storeArea', "Freezer")->count();

        //Pending
        $handover = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 4)->count();
        $prepare = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 2)->count();
        $pending = $handover + $prepare;

        //Administered
        $administered = Inventory::where('episodeNo', $request->input('epsdno'))->where('status', 3)->count();


        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('hmilk.administer.index', compact('url', 'totalebm', 'totalebmChiller','totalebmFreezer', 'expiredebm', 'expiredebmChiller','expiredebmFreezer', 'pending', 'handover','prepare','administered'));
    }
    public function reheatIndex(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('hmilk.administer.reheat', compact('url'));
    }

    public function detail (Request $request){

            $data = Inventory::where('batchId', $request->input('batchId'))->first();

            $patient = Patient::where('mrn', $request->input('mrn'))->first();
            
            if($patient != null){

                $pinfo = PatientInformation::where('patient_id', $patient->id)->where('episodenumber', $request->epsdno)->first();

                if($data != null){
                    if($pinfo->episodenumber == $data->episodeNo){

                        if($data->status == 3){
                            $response = response()->json(
                                [
                                    'status'  => 'failed',
                                    'message' => 'Milk administered!',
                                ], 200
                            );
    
                            return $response;
                        }elseif($data->status == 1){
                            $response = response()->json(
                                [
                                    'status'  => 'failed',
                                    'message' => 'Milk is not ready to be administered!',
                                ], 200
                            );
    
                            return $response;
                        }elseif($data->status == 6){
                            $response = response()->json(
                                [
                                    'status'  => 'failed',
                                    'message' => 'Milk discarded',
                                ], 200
                            );
    
                            return $response;
                        }else{
    
                            if($data->expiryDate < Carbon::now()){
                                $response = response()->json(
                                    [
                                        'status'  => 'failed',
                                        'message' => 'Milk Expired!',
                                    ], 200
                                );
        
                                return $response;
                            }else{
                                
                                $response = response()->json(
                                    [
                                        'status'  => 'success',
                                        'milk' => $data,
                                        'patient' => $patient,
                                        'info' => $pinfo,
                                    ], 200
                                );
                                return $response;
                            }    
                        }
                    }else{
                        $response = response()->json(
                            [
                                'status'  => 'failed',
                                'message' => 'Milk and Patient does not match!',
                            ], 200
                        );
                    }
                    return $response;

                }else{

                    $response = response()->json(
                        [
                            'status'  => 'failed',
                            'message' => 'Milk pack not found!',
                        ], 200
                    );
                    return $response;
                }
            }else{

                $response = response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Patient not found!',
                    ], 200
                );
                return $response;
            }
        
    }

    public function reheatDetail (Request $request){


        $data = Inventory::where('batchId', $request->input('batchId'))->first();
        $nurse = Auth::user()->name;

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data,
                'nurse' => $nurse,
            ], 200
        );

        return $response;
    }

    public function reheatUpdate (Request $request){
        
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);
            
            if($inventory != null)
            {

                $inventory->status           = 2;
                $inventory->expiryDate       = $date;
                $inventory->location         = "EBM Room";
                $inventory->storeArea        = "";
                $inventory->proceedRemark    = $request->input('remarks');
                $inventory->prepared_by      = Auth::user()->id;
                $inventory->prepared_at      = Carbon::now();
                $inventory->save();
            
                return $response = response()->json(
                    [
                    'status'  => 'success',
                    'message1'    => $inventory ,
                    ], 200
                );
            }else{
                return response()->json(['status' => 'failed', 'message' => 'Inventory not found'], 404);
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

    public function reheatCheck (Request $request){
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);

            $latestExpiry = Inventory::select('expiryDate')->orderBy('expiryDate', 'asc')->where('episodeNo', $request->input('episodeNo'))->where('status', 1)->first();
            $latestExpiryList = Inventory::select('batchId', 'expiryDate')
                                    ->where('expiryDate', '<' , $inventory->expiryDate)
                                    ->where('status', 1)
                                    ->where('episodeNo', $request->input('episodeNo'))
                                    ->orderBy('expiryDate', 'asc')
                                    ->limit(2)->get();

            $isLatestExpiryCloser = Carbon::parse($latestExpiry->expiryDate)->diffInDays(Carbon::now());
            $isInventoryExpiryCloser = Carbon::parse($inventory->expiryDate)->diffInDays(Carbon::now());



            if ($isLatestExpiryCloser < $isInventoryExpiryCloser) {
        
                return response()->json([
                    'status' => 'prompt',
                    'expiredPacks' => $latestExpiryList,
                    'expiryDate' => $latestExpiry->expiryDate,
                    'expiryDate2' => $inventory->expiryDate,

                ], 200);
            }
        
            if($inventory != null)
            {

                $inventory->status                      = 2;
                $inventory->expiryDate                  = $date;
                $inventory->location                    = "EBM Room";
                $inventory->storeArea                   = ""; 
                $inventory->proceedRemark               = $request->input('remarks');
                $inventory->prepared_by                 = Auth::user()->id;
                $inventory->prepared_at                 = Carbon::now();
                $inventory->save();
            
                return $response = response()->json(
                    [
                    'status'  => 'success',
                    'message1'    => $inventory ,
                    'message2'    => $isInventoryExpiryCloser,
                    ], 200
                );
            }else{
                return response()->json(['status' => 'failed', 'message' => 'Inventory not found'], 404);
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

    public function cgReheatUpdate (Request $request){
        
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);
            
            if($inventory != null)
            {

                if($request->input('name') != null){

                    $caregiver = Caregiver::where('nric', $request->input('nric'))->first();

                    if($caregiver == null){
                        $store = new Caregiver();
                        $store->name            = $request->input('name');
                        $store->nric            = $request->input('nric');
                        $store->relationship    = $request->input('relation');
                        $store->created_at      = Carbon::now();
                        $store->save();
                    }
                    else
                    {
                        $caregiver->name            = $request->input('name');
                        $caregiver->nric            = $request->input('nric');
                        $caregiver->relationship    = $request->input('relation');
                        $caregiver->updated_at      = Carbon::now();
                        $caregiver->save();
                    }
    
                    $cgID = Caregiver::select('id')->where('nric', $request->input('nric'))->first();
    
                    $inventory->status                      = 4;
                    $inventory->expiryDate                  = $date;
                    $inventory->location                    = "B5Z2";
                    $inventory->storeArea                   = "";
                    $inventory->proceedRemark               = $request->input('remarks');
                    $inventory->handover_to                 = $cgID->id;
                    $inventory->handover_at                 = Carbon::now();
                    $inventory->save();
                
                    return $response = response()->json(
                        [
                        'status'  => 'success',
                        'message1'    => $request->all(),
                        ], 200
                    );
                }else{

                    $inventory->status                      = 4;
                    $inventory->expiryDate                  = $date;
                    $inventory->location                    = "B5Z2";
                    $inventory->storeArea                   = "";
                    $inventory->proceedRemark               = $request->input('remarks');
                    $inventory->handover_at                 = Carbon::now();
                    $inventory->save();
                
                    return $response = response()->json(
                        [
                        'status'  => 'success',
                        'message1'    => $request->all(),
                        ], 200
                    );
                }
            }else{
                return response()->json(['status' => 'failed', 'message' => 'Inventory not found'], 404);
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

    public function cgReheatCheck (Request $request){
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);

            $latestExpiry = Inventory::select('expiryDate')->orderBy('expiryDate', 'asc')->where('episodeNo', $request->input('episodeNo'))->where('status', 1)->first();
            $latestExpiryList = Inventory::select('batchId', 'expiryDate')
                                    ->where('expiryDate', '<' , $inventory->expiryDate)
                                    ->where('status', 1)
                                    ->where('episodeNo', $request->input('episodeNo'))
                                    ->orderBy('expiryDate', 'asc')
                                    ->limit(2)->get();

            $isLatestExpiryCloser = Carbon::parse($latestExpiry->expiryDate)->diffInDays(Carbon::now());
            $isInventoryExpiryCloser = Carbon::parse($inventory->expiryDate)->diffInDays(Carbon::now());

            if ($isLatestExpiryCloser < $isInventoryExpiryCloser) {
        
                return response()->json([
                    'status' => 'prompt',
                    'expiredPacks' => $latestExpiryList,
                    'expiryDate' => $latestExpiry->expiryDate,
                ], 200);
            }
        
            if($inventory != null)
            {

                if($request->input('name') != null){

                    $caregiver = Caregiver::where('nric', $request->input('nric'))->first();

                    if($caregiver == null){
                        $store = new Caregiver();
                        $store->name            = $request->input('name');
                        $store->nric            = $request->input('nric');
                        $store->relationship    = $request->input('relation');
                        $store->created_at      = Carbon::now();
                        $store->save();
                    }
                    else
                    {
                        $caregiver->name            = $request->input('name');
                        $caregiver->nric            = $request->input('nric');
                        $caregiver->relationship    = $request->input('relation');
                        $caregiver->updated_at      = Carbon::now();
                        $caregiver->save();
                    }
    
                    $cgID = Caregiver::select('id')->where('nric', $request->input('nric'))->first();
    
                    $inventory->status                      = 4;
                    $inventory->expiryDate                  = $date;
                    $inventory->location                    = "B5Z2";
                    $inventory->storeArea                   = "";
                    $inventory->proceedRemark               = $request->input('remarks');
                    $inventory->handover_to                 = $cgID->id;
                    $inventory->handover_at                 = Carbon::now();
                    $inventory->save();
                
                    return $response = response()->json(
                        [
                        'status'  => 'success',
                        'message1'    => $request->all(),
                        'message2'    => $isInventoryExpiryCloser,
                        ], 200
                    );
                }else{

                    $inventory->status                      = 4;
                    $inventory->expiryDate                  = $date;
                    $inventory->location                    = "B5Z2";
                    $inventory->storeArea                   = "";
                    $inventory->proceedRemark               = $request->input('remarks');
                    $inventory->handover_at                 = Carbon::now();
                    $inventory->save();
                
                    return $response = response()->json(
                        [
                        'status'  => 'success',
                        'message1'    => $request->all(),
                        'message2'    => $isInventoryExpiryCloser,
                        ], 200
                    );
                }
                
            }else{
                return response()->json(['status' => 'failed', 'message' => 'Inventory not found'], 404);
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

    public function submit (Request $request){
        
        try
        { 
            $inventory = Inventory::where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);
        
            if($inventory != null)
            {

                if($request->input('amount') == "FULL"){
                    $inventory->status                      = 3;
                }else{
                    $inventory->status                      = 7;
                }                
                $inventory->location                    = $request->input('location');
                $inventory->storeArea                   = "";
                $inventory->adminAmount                 = $request->input('amount');
                $inventory->intake                      = $request->input('intake');
                $inventory->expiryDate                  = $date;
                $inventory->admin_by                    = Auth::user()->id;
                $inventory->admin_at                    = Carbon::now();
                $inventory->save();
            
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
