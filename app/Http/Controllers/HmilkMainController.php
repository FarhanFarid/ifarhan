<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inventory;

class HmilkMainController extends Controller
{
    public function index(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('hmilk.index', compact('url'));
    }

    public function mainindex(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        return view('hmilk.list.index', compact('url'));
    }


    public function list (){
        // $list = Inventory::groupBy('batchNo')->get();

        $data = Inventory::selectRaw('episodeNo, batchNo, count(*) as quantity, batchDate')
        ->groupBy('episodeNo', 'batchNo', 'batchDate')
        ->orderBy('batchDate')
        ->get();

        $response = response()->json(
            [
                'status'  => 'success',
                'data' => $data
            ], 200
        );

        return $response;
    }

    public function test(Request $request)
    {
        

        return view('hmilk.test');
    }
  
    public function testPrint()
{
    // $address = '172.17.13.213';
    $address = '192.168.1.4';
    $port = 9100;
    $count = 0;

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
    ^A0,38,38^FD 491076 ^FS^FX
    ^FO192,17,2
    ^FWN
    ^A0,38,38^FD 491076 ^FS^FX
    
    field for the element 'Barcode'
    
    ^FO340,8,2
    ^FWN
    ^BY3.2,2,48
    ^BCN,48,N,N^FD 051085 ^FS^FX
    
    field for the element 'Patient Name'
    
    ^FO100,72,2
    ^FWN
    ^A0,26,26^FD RABIATUL ADAWIYAH BINTI MUHAMMAD RIDWAN ^FS^FX
    ^FO100,74,4
    ^FWN
    ^A0,26,26^FD RABIATUL ADAWIYAH BINTI MUHAMMAD RIDWAN ^FS^FX
    
    field for the element 'Batch Title'
    
    ^FO110,120,2
    ^FWN
    ^A0,30,30^FDBATCH NO:^FS^FX
    ^FO110,121,2
    ^FWN
    ^A0,30,30^FDBATCH NO:^FS^FX
    
    field for the element 'Batch Value'
    
    ^FO250,120,2
    ^FWN
    ^A0,30,30^FD IP0403514/BTCH01/01 ^FS^FX
    
    
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
    ^A0,30,30^FD Chiller ^FS^FX
    
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
    ^A0,30,30^FD 02/08/2024 ^FS
^XZ


";

    foreach ($parms as $value) {
        $imp = str_replace("<##" . $count . ">", $value, $imp);
        $count++;
    }

    try {
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $sockconnect = socket_connect($sock, $address, $port);
        socket_write($sock, $imp, strlen($imp));
        socket_close($sock);
        $response['status'] = "success";
        $response['error'] = "Printing";
        $response['count'] = $count;
    } catch (\Exception $e) {
        $response['status'] = "failed";
        $response['error'] = "Failed to print";
    }

}

    
}
