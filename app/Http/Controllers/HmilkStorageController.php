<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\Inventory;
use App\Models\Patient;
use App\Models\PatientInformation;

use Auth;
use DB;

use App\Helpers\UpdatePatient;


class HmilkStorageController extends Controller
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

        return view('hmilk.storage.index', compact('url', 'totalebm', 'totalebmChiller','totalebmFreezer', 'expiredebm', 'expiredebmChiller','expiredebmFreezer', 'pending', 'handover','prepare', 'administered'));

    }

    public function check(Request $request){

        try
        {  
            $checkbatch = Inventory::where('episodeNo', $request->epsdno)->orderBy('id', 'desc')->first();

            if($checkbatch == null){ 

                $batchId = $request->epsdno.'/BATCH001';

            }else{

                preg_match('/\d+$/', $checkbatch->batchNo, $matches);
                $getnumber = (int)$matches[0]; 
                $increment = $getnumber + 1;
                $batchId = $request->epsdno.'/BATCH' . str_pad($increment, 3, '0', STR_PAD_LEFT);

            }

            $response = response()->json(
                [
                  'status'  => 'success',
                  'batchId'    => $batchId,
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

    public function store(Request $request){

        try
        {  

            $patientInfo =  PatientInformation::where('episodenumber', $request->input('epsdno'))->first();
            $patient = Patient::where('id', $patientInfo->patient_id)->first();

            $mrn = $patient->mrn;
            $name = $patient->name;

            foreach ($request->input('details') as $data) {

                $address = env('PRINTER_IMILK');
                // $address = '172.17.13.248';
                $port = 9100;
                $count = 0;
               
                $batch = explode('/', $data['batchId']);
                $dateFormat = Carbon::createFromFormat('d/m/Y H:i', $data['expiryDate']);
                $expDate = $dateFormat->format('d/m/Y H:i');
                // $dateFormat = Carbon::parse($data['expiryDate'])->format('d/m/Y H:i');

                $batchNo = $batch[1];
                $packNo = $batch[2];

                $parms = ["1000.00 kg", "200.00 m", "250 mic"];

                $imp = "^XA
                ^FX
                
                field for the element 'MRN'
                
                ^FO110,16,2
                ^FWN
                ^A0,38,38^FDMRN:^FS
                ^FX
                
                field for the element 'MRN Value'
                
                ^FO192,16,2
                ^FWN
                ^A0,38,38^FD <MRN> ^FS^FX
                ^FO192,17,2
                ^FWN
                ^A0,38,38^FD <MRN> ^FS^FX
                
                field for the element 'Barcode'
                
                ^FO400,8,2
                ^FWN
                ^BY1.3,1,10
                ^BCN,48,N,N^FD <BATCH_ID> ^FS^FX
                
                field for the element 'Patient Name'
                
                ^FO100,72,2
                ^FWN
                ^A0,26,26^FD <NAME> ^FS^FX
                ^FO100,74,4
                ^FWN
                ^A0,26,26^FD <NAME> ^FS^FX
                
                field for the element 'Batch Title'
                
                ^FO110,120,2
                ^FWN
                ^A0,30,30^FDBATCH ID:^FS^FX
                ^FO110,121,2
                ^FWN
                ^A0,30,30^FDBATCH ID:^FS^FX
                
                field for the element 'Batch Value'
                
                ^FO250,120,2
                ^FWN
                ^A0,30,30^FD <BATCH_ID> ^FS^FX
                
                
                field for the element 'Location Title'
                
                ^FO110,168,2
                ^FWN
                ^A0,30,30^FDLOCATION:^FS^FX
                ^FO110,169,2
                ^FWN
                ^A0,30,30^FDLOCATION:^FS^FX
                
                field for the element 'Location Value'
                
                ^FO240,168,2
                ^FWN
                ^A0,30,30^FD <LOCATION> ^FS^FX
                
                field for the element 'Exp Title'
                
                ^FO370,168,2
                ^FWN
                ^A0,30,30^FDEXP:^FS^FX
                ^FO370,169,2
                ^FWN
                ^A0,30,30^FDEXP:^FS^FX
                
                field for the element 'Exp Value'
                
                ^FO430,168,2
                ^FWN
                ^A0,30,30^FD <EXPIRY_DATE> ^FS
                ^XZ
                ";

                $imp = str_replace("<MRN>", $mrn, $imp);
                $imp = str_replace("<NAME>", $name, $imp);
                $imp = str_replace("<BATCH_ID>", $data['batchId'], $imp);
                $imp = str_replace("<LOCATION>", $data['location'], $imp);
                $imp = str_replace("<EXPIRY_DATE>", $expDate, $imp);

                foreach ($parms as $value) {
                    $imp = str_replace("<##" . $count . ">", $value, $imp);
                    $count++;
                }

                $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                $sockconnect = socket_connect($sock, $address, $port);
                socket_write($sock, $imp, strlen($imp));
                socket_close($sock);


                $store = new Inventory();
                $store->episodeNo   = $data['episodeNo'];
                $store->batchId     = $data['batchId'];
                $store->batchNo     = $batchNo;
                $store->packNo      = $packNo;
                $store->location    = "EBM Room";
                $store->storeArea   = $data['location'];
                $store->batchDate   = $data['batchDate'];
                $store->expiryDate  = $dateFormat;
                $store->mname       = $data['motherName'];
                $store->mnric       = $data['motherNRIC'];
                $store->status      = '1';
                $store->created_by  = Auth::user()->id;
                $store->save();
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

    public function batchList (Request $request){
        // $list = Inventory::groupBy('batchNo')->get();


        $data = Inventory::selectRaw('episodeNo, batchNo, count(*) as quantity, batchDate')
        ->where('episodeNo', $request->epsdno)
        ->groupBy('episodeNo', 'batchNo', 'batchDate')
        ->orderBy('batchDate')
        ->get();

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data,
            ], 200
        );

        return $response;
    }

    public function batchDetail (Request $request){

        $data = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchNo', $request->input('batchNo'))->get();

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data
            ], 200
        );

        return $response;
    }

    public function updateLocation (Request $request){
        
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $date = Carbon::now()->addDays(1);
        
            if($inventory != null)
            {

                $inventory->location                    = "EBM Room";
                $inventory->storeArea                   = $request->input('locations');
                $inventory->expiryDate                  = $date;
                $inventory->updated_by                  = Auth::user()->id;
                $inventory->updated_at                  = Carbon::now();
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

    public function discardDetail (Request $request){


        $data = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data,
            ], 200
        );

        return $response;
    }

    public function discard (Request $request){


        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();
        
            if($inventory != null)
            {

                $inventory->discardRemark                   = $request->input('remark');
                $inventory->status                          = 6;
                $inventory->updated_by                      = Auth::user()->id;
                $inventory->updated_at                      = Carbon::now();
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

    public function storeDetail (Request $request){


        $data = Inventory::where('episodeNo', $request->input('epsdno'))->orderBy('id', 'desc')->first();

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data,
            ], 200
        );

        return $response;
    } 

    public function reprintLabel (Request $request){
        
        try
        { 
            $inventory = Inventory::where('episodeNo', $request->input('episodeNo'))->where('batchId', $request->input('batchId'))->first();

            $patientInfo =  PatientInformation::where('episodenumber', $request->input('episodeNo'))->first();
            $patient = Patient::where('id', $patientInfo->patient_id)->first();

            $mrn = $patient->mrn;
            $name = $patient->name;
        
            if($inventory != null)
            {

                $address = env('PRINTER_IMILK');
                // $address = '172.17.13.248';
                $port = 9100;
                $count = 0;
               
                $dateFormat = Carbon::parse($inventory->expiryDate)->format('d/m/Y H:i');


                $parms = ["1000.00 kg", "200.00 m", "250 mic"];

                $imp = "^XA
                ^FX
                
                field for the element 'MRN'
                
                ^FO110,16,2
                ^FWN
                ^A0,38,38^FDMRN:^FS
                ^FX
                
                field for the element 'MRN Value'
                
                ^FO192,16,2
                ^FWN
                ^A0,38,38^FD <MRN> ^FS^FX
                ^FO192,17,2
                ^FWN
                ^A0,38,38^FD <MRN> ^FS^FX
                
                field for the element 'Barcode'
                
                ^FO400,8,2
                ^FWN
                ^BY1.3,1,10
                ^BCN,48,N,N^FD <BATCH_ID> ^FS^FX
                
                field for the element 'Patient Name'
                
                ^FO100,72,2
                ^FWN
                ^A0,26,26^FD <NAME> ^FS^FX
                ^FO100,74,4
                ^FWN
                ^A0,26,26^FD <NAME> ^FS^FX
                
                field for the element 'Batch Title'
                
                ^FO110,120,2
                ^FWN
                ^A0,30,30^FDBATCH ID:^FS^FX
                ^FO110,121,2
                ^FWN
                ^A0,30,30^FDBATCH ID:^FS^FX
                
                field for the element 'Batch Value'
                
                ^FO250,120,2
                ^FWN
                ^A0,30,30^FD <BATCH_ID> ^FS^FX
                
                
                field for the element 'Location Title'
                
                ^FO110,168,2
                ^FWN
                ^A0,30,30^FDLOCATION:^FS^FX
                ^FO110,169,2
                ^FWN
                ^A0,30,30^FDLOCATION:^FS^FX
                
                field for the element 'Location Value'
                
                ^FO240,168,2
                ^FWN
                ^A0,30,30^FD <LOCATION> ^FS^FX
                
                field for the element 'Exp Title'
                
                ^FO370,168,2
                ^FWN
                ^A0,30,30^FDEXP:^FS^FX
                ^FO370,169,2
                ^FWN
                ^A0,30,30^FDEXP:^FS^FX
                
                field for the element 'Exp Value'
                
                ^FO430,168,2
                ^FWN
                ^A0,30,30^FD <EXPIRY_DATE> ^FS
                ^XZ
                ";

                // Replace placeholders with actual values
                $imp = str_replace("<MRN>", $mrn, $imp);
                $imp = str_replace("<NAME>", $name, $imp);
                $imp = str_replace("<BATCH_ID>", $request->input('batchId'), $imp);
                $imp = str_replace("<LOCATION>", $request->input('stores'), $imp);
                $imp = str_replace("<EXPIRY_DATE>", $dateFormat, $imp);

                foreach ($parms as $value) {
                    $imp = str_replace("<##" . $count . ">", $value, $imp);
                    $count++;
                }

                $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                $sockconnect = socket_connect($sock, $address, $port);
                socket_write($sock, $imp, strlen($imp));
                socket_close($sock);

                $response = response()->json(
                    [
                        'status'  => 'success',
                        'data' => $patient,
                        'data2' => $inventory,
                    ], 200
                );
        
                return $response;

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
}
