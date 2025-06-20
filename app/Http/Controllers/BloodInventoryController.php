<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\BloodInventory;
use App\Models\BloodReaction;
use App\Models\BloodLocation;
use App\Models\BloodWardLocation;
use App\Models\Patient;
use App\Models\PatientInformation;

use Auth;

use App\Helpers\UpdatePatient;



class BloodInventoryController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $epno = $request->epsdno;
        $epid = $request->epid;
        $patid = $request->patid;
        $patdemo     = new UpdatePatient();
        $datapatdemo = $patdemo->updatepatient($epno, $epid, $patid);

        $ward = BloodWardLocation::all();

        return view('iblood.inventory.index', compact('url', 'ward'));

    }

    public function transfusion(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $bagno = $request->bagno;

        return view('iblood.transfuse.index', compact('url', 'bagno'));

    }

    public function verifyLab(Request $request) {
        try {
            $labno = $request->labno;

            $getPatient = PatientInformation::where('episodenumber', $request->epsdno)
                        ->with('patient')
                        ->first();

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

            if ($contentLab['mrn'] == $getPatient->patient->mrn) {
                $labExists = true;

                foreach ($contentLab['orderItem'] as $item) {
                    if (isset($item['itmCODE']) && in_array($item['itmCODE'], $itemcode)) {
                        $containsBloodPack = true;
                        break;
                    }
                }
            }

            if ($labExists) {
                if ($containsBloodPack) {

                    // dd($request->all());
                    
                    $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('labno', $request->input('labno'))->where('episodeno', $request->input('epsdno'))->first();

                    $response = response()->json(
                        [
                        'status'      => 'success',
                        'data'        => $inventory,

                        ], 200
                    );

                } else{
                    $response = response()->json(
                        [
                            'status' => 'failed',
                            'response' => 'Lab number did not contain correct product',
                        ], 200
                    );
                }
            } else {
                $response = response()->json(
                    [
                        'status' => 'failed',
                        'response' => 'Lab number did not belong to this patient.',
                    ], 200
                );
            }
    
            return $response;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
    
            $response = response()->json(
                [
                    'status' => 'failed',
                    'message' => 'Internal error happened. Try again'
                ], 500 // Changed to 500 for internal server error
            );
    
            return $response;
        }
    }

    public function store(Request $request){

        try
        {  

            // dd($request->all());
            foreach ($request->input('details') as $data) {

                $inventory = BloodInventory::where('episodeno', $request->input('epsdno'))->where('labno', $data['labno'])->where('bagno', $data['bagno'])->where('transfuse_status_id', '!=' , 6)->first();

                if( $inventory != null){

                    if($data['location'] === "Laboratory and Blood Services" || $request->input('usrLocID') == "23"){
                        $location = BloodLocation::where('inventory_bagno', $data['bagno'])->where('status_id', 2)->first();
                        $location->status_id                    = 3;
                        $location->transfer_by                  = Auth::user()->id;
                        $location->transfer_at                  = Carbon::now();
                        $location->save();
    
                        $storelocation                          = new BloodLocation();
                        $storelocation->episodeno               = $request->input('epsdno');
                        $storelocation->inventory_bagno         = $data['bagno'];
                        $storelocation->location                = $data['location'];
                        $storelocation->received_by             = Auth::user()->id;

                        if($data['receivedate'] != null){
                            $storelocation->received_at         = $data['receivedate'];
                        }else{
                            $storelocation->received_at         = Carbon::now();
                        }
                        $storelocation->receive_reason          = $data['receivecdreason'] ?? '';
                        $storelocation->status_id               = '1';
                        $storelocation->created_at              = Carbon::now();
                        $storelocation->save(); 

                        $inventory->transfuse_status_id = 7;
                        $inventory->save();
                    }else{

                        $location = BloodLocation::where('inventory_bagno', $data['bagno'])->where('status_id', 2)->where('episodeno', $request->input('epsdno'))->first();

                        if($location != null){

                            $location->status_id                    = 3;
                            $location->transfer_by                  = Auth::user()->id;
                            $location->transfer_at                  = Carbon::now();
                            $location->save();

                        }else{

                            $labloc = BloodLocation::where('inventory_bagno', $data['bagno'])
                            ->where('location', "Laboratory and Blood Services")
                            ->where('status_id', 1)
                            ->where('episodeno', $request->input('epsdno'))->first();
                            
                            $labloc->status_id                    = 3;
                            $labloc->transfer_by                  = Auth::user()->id;
                            $labloc->transfer_at                  = Carbon::now();
                            $labloc->save();        

                        }
                  
                        $storelocation                          = new BloodLocation();
                        $storelocation->episodeno               = $request->input('epsdno');
                        $storelocation->inventory_bagno         = $data['bagno'];
                        $storelocation->location                = $data['location'];
                        $storelocation->received_by             = Auth::user()->id;

                        if($data['receivedate'] != null){
                            $storelocation->received_at         = $data['receivedate'];
                        }else{
                            $storelocation->received_at         = Carbon::now();
                        }

                        $storelocation->receive_reason          = $data['receivecdreason'] ?? '';
                        $storelocation->status_id               = '1';
                        $storelocation->created_at              = Carbon::now();
                        $storelocation->save();

                        if($inventory->transfuse_status_id == 2){

                            $inventory->transfuse_status_id = 1;
                            $inventory->save();
                            
                        }elseif($inventory->transfuse_status_id == 3 && $inventory->transfuse_completion_id == 1){

                            $inventory->transfuse_status_id     = 3;
                            $inventory->transfuse_completion_id = 1;
                            $inventory->save();

                        }elseif($inventory->transfuse_status_id == 7 && $inventory->transfuse_completion_id == null){

                            $inventory->transfuse_status_id = 1;
                            $inventory->save();
                            
                        }

                        
                    }       

                }else{

                    $store                          = new BloodInventory();
                    $store->episodeno               = $request->input('epsdno');
                    $store->product                 = $data['product'];
                    $store->bagno                   = $data['bagno'];
                    $store->labno                   = $data['labno'];
                    $store->transfuse_status_id     = '1';
                    $store->created_at              = Carbon::now();
                    $store->save();

                    $storelocation                          = new BloodLocation();
                    $storelocation->episodeno               = $request->input('epsdno');
                    $storelocation->inventory_bagno         = $data['bagno'];
                    $storelocation->location                = $data['location'];
                    $storelocation->received_by             = Auth::user()->id;
                    if($data['receivedate'] != null){
                        $storelocation->received_at         = $data['receivedate'];
                    }else{
                        $storelocation->received_at         = Carbon::now();
                    }
                    $storelocation->receive_reason = $data['receivecdreason'] ?? '';
                    $storelocation->status_id               = '1';
                    $storelocation->created_at              = Carbon::now();
                    $storelocation->save();
                }         
            }

            $response = response()->json(
                [
                  'status'      => 'success',
                  'response'    => 'Successfully saved',

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

    public function reactionList (Request $request){

        try
        {  

            $suspendReact = BloodInventory::where('episodeno', $request->input('epsdno'))->where('bagno', $request->input('bagno'))->with('user')->first();
            $reactionList = BloodReaction::where('episodenumber', $request->input('epsdno'))->where('inventory_bagno', $request->input('bagno'))->with('user')->get();


            $response = response()->json(
                [
                  'status'      => 'success',
                  'suspend'     => $suspendReact,
                  'list'        => $reactionList,

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

    public function bloodList (Request $request){

        try
        {  

            $episodeno = $request->input('epsdno');

            $inventory = BloodInventory::where('episodeno', $episodeno)
            ->with(['reactions' => function ($query) use ($episodeno) {
                $query->where('episodenumber', $episodeno);
            }])
            ->with(['locations' => function ($query) use ($episodeno) {
                $query->where('episodeno', $episodeno)
                      ->with('user')
                      ->orderBy('id', 'desc');
                }])
            ->orderBy('id', 'desc') // Order by latest record
            ->get();

            // dd($inventory);
            
            $response = response()->json(
                [
                  'status'      => 'success',
                  'data'        => $inventory,

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

    public function updateLocation (Request $request){
        
        try
        { 

            $location = BloodLocation::where('inventory_bagno', $request->input('bagno'))->where('episodeno', $request->input('episodeno'))->where('status_id', 1)->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->where('transfuse_status_id', '!=' , 7)->first();

        
            if($location != null && $inventory != null) 
            {
                if($inventory->transfuse_status_id == 3 && $inventory->transfuse_completion_id == 1){
                    if($request->location === "Laboratory and Blood Services"){
                        return $response = response()->json(
                            [
                            'status'     => 'fail',
                            'message'    => 'Cannot transfer blood to lab during transfusion.' ,
                            ], 200
                        );
                    }else{

                        if($request->location === "Others"){

                            $inventory->transfuse_status_id  = 5;
                            $inventory->transfer_to          = $request->input('others');
                            $inventory->save();
            
                            $location->status_id                    = 3;
                            $location->transfer_by                  = Auth::user()->id;
                            $location->transfer_at                  = $request->input('transferdate');
                            $location->transfer_reason              = $request->input('transfercdreason');
                            $location->save();
        
                            $storelocation                          = new BloodLocation();
                            $storelocation->episodeno               = $request->input('epsdno');
                            $storelocation->inventory_bagno         = $request->input('bagno');
                            $storelocation->location                = $request->input('others');
                            $storelocation->received_by             = Auth::user()->id;
                            $storelocation->received_at             = Carbon::now();
                            $storelocation->status_id               = '1';
                            $storelocation->created_at              = Carbon::now();
                            $storelocation->save(); 
        
                            return $response = response()->json(
                                [
                                'status'     => 'success',
                                'message'    => 'Blood pack successfully transferred' ,
                                ], 200
                            );
                        }else{

                            $inventory->transfer_to     = $request->input('location');
                            $inventory->save();
            
                            $location->status_id        = 2;
                            $location->transfer_by      = Auth::user()->id;
                            $location->transfer_at      = $request->input('transferdate');
                            $location->transfer_reason  = $request->input('transfercdreason');

                            $location->save();
                        
                            return $response = response()->json(
                                [
                                'status'     => 'success',
                                'message'    => 'Blood pack successfully transferred' ,
                                ], 200
                            );
                        }
                    }
                }

                if($request->location === "Laboratory and Blood Services"){

                    $inventory->transfuse_status_id  = 7;
                    $inventory->save();
    
                    $location->status_id                    = 3;
                    $location->transfer_by                  = Auth::user()->id;
                    $location->transfer_at                  = $request->input('transferdate');
                    $location->transfer_reason              = $request->input('transfercdreason');
                    $location->save();

                    $storelocation                          = new BloodLocation();
                    $storelocation->episodeno               = $request->input('epsdno');
                    $storelocation->inventory_bagno         = $request->input('bagno');
                    $storelocation->location                = $request->input('location');
                    $storelocation->reasonreturn            = $request->input('reason');
                    $storelocation->received_by             = Auth::user()->id;
                    $storelocation->received_at             = Carbon::now();
                    $storelocation->status_id               = '1';
                    $storelocation->created_at              = Carbon::now();
                    $storelocation->save(); 

                    return $response = response()->json(
                        [
                        'status'     => 'success',
                        'message'    => 'Blood pack successfully transferred' ,
                        ], 200
                    );

                }elseif($request->location === "Others"){

                    $inventory->transfuse_status_id  = 5;
                    $inventory->transfer_to          = $request->input('others');
                    $inventory->save();
    
                    $location->status_id                    = 3;
                    $location->transfer_by                  = Auth::user()->id;
                    $location->transfer_at                  = $request->input('transferdate');
                    $location->transfer_reason              = $request->input('transfercdreason');
                    $location->save();

                    $storelocation                          = new BloodLocation();
                    $storelocation->episodeno               = $request->input('epsdno');
                    $storelocation->inventory_bagno         = $request->input('bagno');
                    $storelocation->location                = $request->input('others');
                    $storelocation->received_by             = Auth::user()->id;
                    $storelocation->received_at             = Carbon::now();
                    $storelocation->status_id               = '1';
                    $storelocation->created_at              = Carbon::now();
                    $storelocation->save(); 

                    return $response = response()->json(
                        [
                        'status'     => 'success',
                        'message'    => 'Blood pack successfully transferred' ,
                        ], 200
                    );

                }else {

                    $inventory->transfer_to     = $request->input('location');
                    $inventory->save();
    
                    $location->status_id        = 2;
                    $location->transfer_by      = Auth::user()->id;
                    $location->transfer_at      = $request->input('transferdate');
                    $location->transfer_reason  = $request->input('transfercdreason');
                    $location->save();
                
                    return $response = response()->json(
                        [
                        'status'     => 'success',
                        'message'    => 'Blood pack successfully transferred' ,
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

    public function storeBlood (Request $request){
        
        try
        { 
            $matchDate = Carbon::createFromFormat('Y-m-d', $request->matchDate);
            $inventory = BloodInventory::where('bagno', $request->input('bgNO'))->where('episodeno', $request->input('epsdno'))->where('transfuse_status_id', '!=' , 7)->first();
        
            if($inventory != null)
            {

                if($inventory->transfuse_status_id == 2){

                    return $response = response()->json(
                        [
                        'status'     => 'failed',
                        'message'    => 'Bloodpack is already in storage area.' ,
                        ], 200
                    );

                }else{

                    $inventory->transfuse_status_id    = 2;
                    $inventory->expiry_date            = $matchDate->addDays(3);
                    $inventory->stored_by              = Auth::user()->id;;
                    $inventory->stored_at              = Carbon::now();
                    $inventory->save();
                
                    return $response = response()->json(
                        [
                        'status'     => 'success',
                        'message'    => 'Blood pack successfully stored' ,
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

    public function receiveTransferred (Request $request){


        try
        { 
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->where('transfuse_status_id', 5)->first();
            $location = BloodLocation::where('inventory_bagno', $request->input('bagno'))->where('episodeno', $request->input('epsdno'))->where('status_id', 1)->first();

            if($inventory != null)
            {

                $inventory->reaction                   = $request->input('reaction');
                $inventory->volume                     = $request->input('volume');
                $inventory->transfuse_completion_id    = 2;
                $inventory->transfuse_stop_by          = Auth::user()->id;
                $inventory->transfuse_stop_at          = Carbon::now();
                $inventory->save();

                $location->stop_transfusion             = "Yes";
                $location->save();
  
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

    public function suspend (Request $request){


        try
        { 
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->where('transfuse_status_id', '!=' , 7)->first();
            $location = BloodLocation::where('inventory_bagno', $request->input('bagno'))->where('episodeno', $request->input('epsdno'))->where('status_id', 1)->first();

        
            if($inventory != null)
            {

                $inventory->reaction                   = $request->input('reaction');
                if($inventory->reaction == "Yes" ){

                    $inventory->atr_status_id          = 1;
                     
                }
                $inventory->reaction_detail            = $request->input('details');
                $inventory->volume                     = $request->input('volume');
                $inventory->transfuse_completion_id    = 2;
                $inventory->transfuse_status_id        = 7;
                $inventory->transfuse_stop_by          = Auth::user()->id;
                $inventory->transfuse_stop_at          = $request->input('suspenddate');
                $inventory->suspendcd_reason           = $request->input('suspendcdreason');
                $inventory->save();
    
                $location->status_id                    = 3;
                $location->stop_transfusion             = "Yes";
                $location->transfer_by                  = Auth::user()->id;
                $location->transfer_at                  = $request->input('suspenddate');
                $location->save();

                $storelocation                          = new BloodLocation();
                $storelocation->episodeno               = $request->input('epsdno');
                $storelocation->inventory_bagno         = $request->input('bagno');
                $storelocation->location                = "Laboratory and Blood Services";
                $storelocation->received_by             = Auth::user()->id;
                $storelocation->received_at             = $request->input('suspenddate');
                $storelocation->status_id               = '1';
                $storelocation->created_at              = Carbon::now();
                $storelocation->save(); 
            
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

    public function addReaction (Request $request){

        try
        { 
            
            $inventory = BloodInventory::where('bagno', $request->input('bgnumber'))->where('episodeno', $request->input('epsdNumber'))->first();
        
            if($inventory != null)
            {

                $addreaction                          = new BloodReaction();
                $addreaction->episodenumber           = $request->epsdNumber;
                $addreaction->inventory_bagno         = $request->bgnumber;
                $addreaction->reaction                = $request->reactiondetails;
                $addreaction->created_by              = Auth::user()->id;
                $addreaction->created_at              = Carbon::now();
                $addreaction->save();

                return $response = response()->json(
                    [
                    'status'  => 'success',
                    'message'    => 'Successfully added!' ,
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

    public function wardLocationList (Request $request){

        try
        {  

            $ward = BloodWardLocation::all();
            $inventory = BloodInventory::where('bagno', $request->bagno )->where('episodeno', $request->epsdno)->where('transfuse_status_id', '!=' , 7)->first();

            $response = response()->json(
                [
                  'status'      => 'success',
                  'data'        => $ward,
                  'inv'         => $inventory

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

    public function getTransferTo (Request $request){

        try
        {  

            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('labno', $request->input('labno'))->where('episodeno', $request->input('epsdno'))->first();

            $response = response()->json(
                [
                  'status'      => 'success',
                  'data'        => $inventory,

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

    public function apiGetSuspendedTransfusionList (Request $request){

        try
        {  

            // $inventory = BloodInventory::with('patinfo.patient')->where('episodeno', $request->input('epsdno'))->where('transfuse_completion_id', 2)->select(
            //     'patinfo.patient.mrn',
            //     'patinfo.episodenumber',
            //     'patinfo.patient.name',
            //     'product',
            //     'labno',
            //     'bagno',
            //     'volume',
            //      )->get();

            $inventory = BloodInventory::join('patient_information', 'iblood_inventories.episodeno', '=', 'patient_information.episodenumber')
            ->join('patients', 'patient_information.patient_id', '=', 'patients.id')
            ->where('iblood_inventories.episodeno', $request->input('epsdno'))
            ->where('iblood_inventories.transfuse_completion_id', 2)
            ->select(
                'patients.mrn',
                'patient_information.episodenumber',
                'patients.name',
                'iblood_inventories.product',
                'iblood_inventories.labno',
                'iblood_inventories.bagno',
                'iblood_inventories.volume',
                'iblood_inventories.transfuse_start_at',
                'iblood_inventories.transfuse_stop_at',
            )
            ->get();

            $response = response()->json(
                [
                  'status'      => 'success',
                  'data'        => $inventory,

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

    public function testgetpatientcitizen(Request $request)
    {
        try {
            $uniqueEpisodes = BloodInventory::select('episodeno')->distinct()->get();

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $results = [];

            foreach ($uniqueEpisodes as $episode) {
                $episodeno = $episode->episodeno;
                $uri = env('PAT_DEMO') . $episodeno;

                try {
                    $response = $client->request('GET', $uri);
                    $content = json_decode($response->getBody(), true);

                    $pcitizen = $content['data']['pcitizen'] ?? null;

                    // Only include if citizenship is not "Malaysia"
                    if ($pcitizen !== 'Malaysia') {
                        $results[] = [
                            'episodeno' => $episodeno,
                            'pcitizen'  => $pcitizen
                        ];
                    }

                } catch (\Exception $e) {
                    // Optional: log or skip errors for individual API calls
                    Log::warning("API error for episodeno {$episodeno}: " . $e->getMessage());
                }
            }

            return response()->json([
                'status' => 'success',
                'data'   => $results,
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

    public function apiSuspendICCA(Request $request)
    {
        try {
            $hl7 = 'MSH|^~\\&|Philips.CIS.PatientResult.BL^ICCA-TEST01^DNS|Philips.CIS.CVC|||20250613102706||ORU^R01|20250613103107815-1|P|2.4\r
            PID|||MRN20250613^^^Philips.CIS.ADT^MR~EP20250613^^^Philips.CIS.ADT^VN||^TEST20250613||19640613000000|M\r
            PV1||I|AICU||||||||||||||||EP20250613\r
            OBR|1|||116859006^Packed Cells^SNM|||20250613080000||||||0.5 Units 7 ml; MRN: MRN2025; Blood Group: A positive; LAB No: hhh; Bag No.: 123; Collection Date: 13/06/2025; Expiry Date: 17/10/2025; Verifier: testverifier2; Reaction: Yes; If Yes, nature of reaction: testnature||||||||||||F\r
            OBX|1|NM|251851008^Volume Infused^SNM||7|258773002^ml^SNM^mL^ml^ISO+||N|||F|||20250613080000||^User^First\r
            OBX|2|NM|260965001^Units Adm^SNM||0.5|258997004^Units^SNM^iu^Units^ISO+||N|||F|||20250613080000||^User^First\r
            OBX|3|CE|273248003^Action^SNM||385655000^Suspend^SNM|||N|||F|||20250613080000||^User^First\r
            OBX|4|ST|116859006^MRN^SNM||MRN2025|||N|||F|||20250613080000||^User^First\r
            OBX|5|CE|116859006^Blood Group^SNM||278149003^A positive^SNM|||N|||F|||20250613080000||^User^First\r
            OBX|6|ST|116859006^LAB No^SNM||hhh|||N|||F|||20250613080000||^User^First\r
            OBX|7|ST|396278008^Bag No.^SNM||123|||N|||F|||20250613080000||^User^First\r
            OBX|8|DT|116859006^Collection Date^SNM||20250613|||N|||F|||20250613080000||^User^First\r
            OBX|9|DT|116859006^Expiry Date^SNM||20251017|||N|||F|||20250613080000||^User^First\r
            OBX|10|ST|116859006^Verifier^SNM||testverifier2|||N|||F|||20250613080000||^User^First\r
            OBX|11|CE|116859006^Reaction^SNM||373066001^Yes^SNM^Y^Yes^HL70136|||N|||F|||20250613080000||^User^First\r
            OBX|12|ST|116859006^If Yes, nature of reaction^SNM||testnature|||N|||F|||20250613080000||^User^First\r';
    
            // Step 1: Get the OBR line
            $lines = preg_split("/\r\n|\n|\r/", $hl7);
            $obrLine = '';
            foreach ($lines as $line) {
                if (strpos(ltrim($line), 'OBR|') === 0) {
                    $obrLine = trim($line);
                    break;
                }
            }
    
            // Step 2: Extract the comment part (15th field in OBR)
            $fields = explode('|', $obrLine);
            $comment = $fields[13] ?? '';
    
            // Step 3: Parse comment to key-value pairs
            $result = [];
            $items = explode(';', $comment);
            foreach ($items as $item) {
                if (strpos($item, ':') !== false) {
                    [$key, $value] = explode(':', $item, 2);
                    $result[trim($key)] = trim($value);
                }
            }
    
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
    
            return response()->json([
                'status' => 'failed',
                'message' => 'Internal error happened. Try again'
            ], 500);
        }
    }
    
}
