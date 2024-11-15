<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use App\Models\BloodInventory;
use App\Models\BloodSignSymptom;
use App\Models\BloodTypeAdverseEvent;
use App\Models\BloodOutcomeAdverseEvent;
use App\Models\BloodRelevantInvestigation;
use App\Models\BloodRelevantHistory;
use App\Models\BloodDetailProcedure;
use App\Models\BloodBloodComponent;
use App\Models\BloodLocation;
use App\Models\Patient;
use App\Models\PatientInformation;
use App\Models\User;



use Auth;


class BloodReactionController extends Controller
{
    public function index(Request $request)
    {

        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $bagno = $request->bagno;

        $record = BloodSignSymptom::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        if ($record) {
            $record->general = explode(', ', $record->general);
            $record->pain = explode(', ', $record->pain);
            $record->renal = explode(', ', $record->renal);
            $record->respiratory = explode(', ', $record->respiratory);
            $record->skin = explode(', ', $record->skin);
            $record->cardio = explode(', ', $record->cardio);
        }

        $typeadverseevent = BloodTypeAdverseEvent::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        if ($typeadverseevent) {
            $typeadverseevent->section1 = explode(', ', $typeadverseevent->section1);
            $typeadverseevent->section5 = explode(', ', $typeadverseevent->section5);
        }

        $outcomeadverseevent = BloodOutcomeAdverseEvent::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        if ($outcomeadverseevent) {
            $outcomeadverseevent->recovered = explode(', ', $outcomeadverseevent->recovered);
            $outcomeadverseevent->death     = explode(', ', $outcomeadverseevent->death);
        }

        $relevantinvestigation = BloodRelevantInvestigation::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'user:id,name',
            'updatedby:id,name',
        ])->first();
        $relevanthistory = BloodRelevantHistory::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        $procedure = BloodDetailProcedure::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        // dd($procedure->updatedby->name);

        $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

        $component = BloodBloodComponent::where('inventory_bagno', $bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->with([
            'createdby:id,name',
            'updatedby:id,name',
        ])->first();

        if ($component) {
            $component->product = explode(', ', $component->product);
        }

        $uri = env('PAT_DEMO'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $patdemo = $content['data'];

        $vitaltemp = !empty($record->temperature) ? $record->temperature : ($patdemo['temp'] ?? '');
        $vitalsysto = !empty($record->systo) ? $record->systo : ($patdemo['sysBP'] ?? '');
        $vitaldysto = !empty($record->diasto) ? $record->diasto : ($patdemo['diasBP'] ?? '');
        $vitalpulse = !empty($record->pulserate) ? $record->pulserate : ($patdemo['pulRate'] ?? '');
        $vitalspo = !empty($record->spo) ? $record->spo : ($patdemo['spO'] ?? '');

        return view('iblood.reaction.index', compact(
            'url', 
            'record', 
            'bagno', 
            'typeadverseevent', 
            'outcomeadverseevent', 
            'relevantinvestigation', 
            'vitaltemp', 
            'vitalsysto', 
            'vitaldysto', 
            'vitalpulse', 
            'vitalspo',
            'relevanthistory',
            'procedure' ,
            'inventory',
            'component',
        ));

    }

    public function storeSignSymptoms(Request $request)
    {

        try{ 

            $record = BloodSignSymptom::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();


            // dd($request->all());

            if($record == null){
                $generalarr = [
                    "genanxiety"    => $request->genanxiety ?? '',
                    "genchill"      => $request->genchill ?? '',
                    "gencyano"      => $request->gencyano ?? '',
                    "genfever"      => $request->genfever ?? '',
                    "genhemor"      => $request->genhemor ?? '',
                    "gennausea"     => $request->gennausea ?? '',
                    "genrigors"     => $request->genrigors ?? '',
                    "genvomit"      => $request->genvomit ?? '',
                    "other"         => $request->signsymptomsgeneralother ?? ''
                ];
    
                $painarr = [
                    "painabdo"      => $request->painabdo ?? '',
                    "painback"      => $request->painback ?? '',
                    "painchest"     => $request->painchest ?? '',
                    "painflank"     => $request->painflank ?? '',
                    "painhead"      => $request->painhead ?? '',
                    "paininfuse"    => $request->paininfuse ?? '',
                    "other"         => $request->signsymptomspainother ?? ''
                ];
    
                $renalarr = [
                    "renalanu"      => $request->renalanu ?? '',
                    "renaloli"      => $request->renaloli ?? '',
                    "renalurine"    => $request->renalurine ?? '',
                ];
    
                $respiarr = [
                    "respicough"    => $request->respicough ?? '',
                    "respidysp"     => $request->respidysp ?? '',
                    "respihypox"    => $request->respihypox ?? '',
                    "respiwheeze"   => $request->respiwheeze ?? '',
                    'other'         => $request->signsymptomsrespiratoryother ?? ''     
                ];
    
                $skinarr = [
                    "skinflush"     => $request->skinflush ?? '',
                    "skinhives"     => $request->skinhives ?? '',
                    "skinitch"      => $request->skinitch ?? '',
                    "skinjaun"      => $request->skinjaun ?? '',
                    "skinoed"       => $request->skinoed ?? '',
                    "skinpallor"    => $request->skinpallor ?? '',
                    "skinpete"      => $request->skinpete ?? '',
                    "skinrash"      => $request->skinrash ?? '',
                    "skinurti"      => $request->skinurti ?? '',
                ];
    
                $cardioarr = [
                    "cardiochestpain"   => $request->cardiochestpain ?? '',
                    "cardiopalpi"       => $request->cardiopalpi ?? '',
                    "other"             => $request->signsymptomscardioother ?? ''
                ];
    
                $gen    = implode(", ", array_values($generalarr));
                $pain   = implode(", ", array_values($painarr));
                $renal  = implode(", ", array_values($renalarr));
                $skin   = implode(", ", array_values($skinarr));
                $cardio = implode(", ", array_values($cardioarr));
                $respi = implode(", ", array_values($respiarr));
    
                $storereaction                      = new BloodSignSymptom();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->temperature         = $request->vitaltemp;
                $storereaction->systo               = $request->vitalsysto;
                $storereaction->diasto              = $request->vitaldysto;
                $storereaction->pulserate           = $request->vitalpulse;
                $storereaction->spo                 = $request->vitalspo;
                $storereaction->respirate           = $request->vitalrr;
                $storereaction->reacttemp           = $request->reactvitaltemp;
                $storereaction->reactsysto          = $request->reactvitalsysto;
                $storereaction->reactdiasto         = $request->reactvitaldysto;
                $storereaction->reactpulse          = $request->reactvitalpulse;
                $storereaction->reactspo            = $request->reactvitalspo;
                $storereaction->reactrr             = $request->reactvitalrr;
                $storereaction->general             = $gen;
                $storereaction->others_general      = $request->signsymptomsgeneralotherinput;
                $storereaction->cardio              = $cardio;
                $storereaction->others_cardio       = $request->signsymptomscardiootherinput;
                $storereaction->skin                = $skin;
                $storereaction->pain                = $pain;
                $storereaction->others_pain         = $request->signsymptomspainotherinput;
                $storereaction->renal               = $renal;
                $storereaction->respiratory         = $respi;
                $storereaction->others_respiratory  = $request->signsymptomsrespiratoryotherinput;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }
    
                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );
            }else{
                $generalarr = [
                    "genanxiety"    => $request->genanxiety ?? '',
                    "genchill"      => $request->genchill ?? '',
                    "gencyano"      => $request->gencyano ?? '',
                    "genfever"      => $request->genfever ?? '',
                    "genhemor"      => $request->genhemor ?? '',
                    "gennausea"     => $request->gennausea ?? '',
                    "genrigors"     => $request->genrigors ?? '',
                    "genvomit"      => $request->genvomit ?? '',
                    "other"         => $request->signsymptomsgeneralother ?? ''
                ];
    
                $painarr = [
                    "painabdo"      => $request->painabdo ?? '',
                    "painback"      => $request->painback ?? '',
                    "painchest"     => $request->painchest ?? '',
                    "painflank"     => $request->painflank ?? '',
                    "painhead"      => $request->painhead ?? '',
                    "paininfuse"    => $request->paininfuse ?? '',
                    "other"         => $request->signsymptomspainother ?? ''
                ];
    
                $renalarr = [
                    "renalanu"      => $request->renalanu ?? '',
                    "renaloli"      => $request->renaloli ?? '',
                    "renalurine"    => $request->renalurine ?? '',
                    "other"         => $request->signsymptomsrenalother ?? '' 
                ];
    
                $respiarr = [
                    "respicough"    => $request->respicough ?? '',
                    "respidysp"     => $request->respidysp ?? '',
                    "respihypox"    => $request->respihypox ?? '',
                    "respiwheeze"   => $request->respiwheeze ?? '', 
                    'other'         => $request->signsymptomsrespiratoryother ?? ''     

                ];
    
                $skinarr = [
                    "skinflush"     => $request->skinflush ?? '',
                    "skinhives"     => $request->skinhives ?? '',
                    "skinitch"      => $request->skinitch ?? '',
                    "skinjaun"      => $request->skinjaun ?? '',
                    "skinoed"       => $request->skinoed ?? '',
                    "skinpallor"    => $request->skinpallor ?? '',
                    "skinpete"      => $request->skinpete ?? '',
                    "skinrash"      => $request->skinrash ?? '',
                    "skinurti"      => $request->skinurti ?? '',
                    "other"         => $request->signsymptomsskinother ?? ''
                ];
    
                $cardioarr = [
                    "cardiochestpain"   => $request->cardiochestpain ?? '',
                    "cardiopalpi"       => $request->cardiopalpi ?? '',
                    "other"             => $request->signsymptomscardioother ?? ''
                ];
    
                $gen    = implode(", ", array_values($generalarr));
                $pain   = implode(", ", array_values($painarr));
                $renal  = implode(", ", array_values($renalarr));
                $skin   = implode(", ", array_values($skinarr));
                $cardio = implode(", ", array_values($cardioarr));
                $respi = implode(", ", array_values($respiarr));

                $updatereaction = BloodSignSymptom::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();

                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->temperature         = $request->vitaltemp;
                $updatereaction->systo               = $request->vitalsysto;
                $updatereaction->diasto              = $request->vitaldysto;
                $updatereaction->pulserate           = $request->vitalpulse;
                $updatereaction->spo                 = $request->vitalspo;
                $updatereaction->respirate           = $request->vitalrr;
                $updatereaction->reacttemp           = $request->reactvitaltemp;
                $updatereaction->reactsysto          = $request->reactvitalsysto;
                $updatereaction->reactdiasto         = $request->reactvitaldysto;
                $updatereaction->reactpulse          = $request->reactvitalpulse;
                $updatereaction->reactspo            = $request->reactvitalspo;
                $updatereaction->reactrr             = $request->reactvitalrr;
                $updatereaction->general             = $gen;
                $updatereaction->others_general      = $request->signsymptomsgeneralotherinput;
                $updatereaction->cardio              = $cardio;
                $updatereaction->others_cardio       = $request->signsymptomscardiootherinput;
                $updatereaction->skin                = $skin;
                $updatereaction->pain                = $pain;
                $updatereaction->others_pain         = $request->signsymptomspainotherinput;
                $updatereaction->renal               = $renal;
                $updatereaction->respiratory         = $respi;
                $updatereaction->others_respiratory  = $request->signsymptomsrespiratoryotherinput;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();
    
                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );
            }

            

        }catch (\Exception $e)
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
   
    public function getSignSymptoms(Request $request){
        try{
            $record = BloodSignSymptom::where('inventory_bagno', '31231231')->where('status_id', '1')->first();

            if ($record) {
                $record->general = explode(', ', $record->general);
                $record->pain = explode(', ', $record->pain);
                $record->renal = explode(', ', $record->renal);
                $record->respiratory = explode(', ', $record->respiratory);
                $record->skin = explode(', ', $record->skin);
                $record->cardio = explode(', ', $record->cardio);
            }

            return response()->json(
                [
                    'status'  => 'success',
                    'message' => $record,
                ], 200
            );
        }catch (\Exception $e){
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

    public function storeTypeAdverseEvent(Request $request)
    {
        try{ 

            $record = BloodTypeAdverseEvent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){
                
                $section1arr = [
                    "section1_1"       => $request->section1_1 ?? '',
                    "section1_1a"      => $request->section1_1a ?? '',
                    "section1_1b"      => $request->section1_1b ?? '',
                    "section1_2"       => $request->section1_2 ?? '',
                    "section1_3a"      => $request->section1_3a ?? '',
                    "section1_3b"      => $request->section1_3b ?? '',
                ];

                $section5arr = [
                    "section5_a"    => $request->section5_a ?? '',
                    "section5_b"    => $request->section5_b ?? '',
                    "section5_c"    => $request->section5_c ?? '',
                ];

                $sec1    = implode(", ", array_values($section1arr));
                $sec5    = implode(", ", array_values($section5arr));


                $storereaction                      = new BloodTypeAdverseEvent();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->section1            = $sec1;
                $storereaction->section2            = $request->section2;
                $storereaction->section3            = $request->section3;
                $storereaction->section4            = $request->section4;
                $storereaction->section5            = $sec5;
                $storereaction->section6            = $request->section6;
                $storereaction->section7            = $request->section7;
                $storereaction->section8            = $request->section8;
                $storereaction->section9            = $request->section9;
                $storereaction->section10           = $request->section10;
                $storereaction->section11           = $request->section11;
                $storereaction->section12           = $request->section12;
                $storereaction->section13           = $request->section13;
                $storereaction->section14           = $request->section14;
                $storereaction->section15           = $request->section15;
                $storereaction->section16           = $request->section16;
                $storereaction->section11_input     = $request->section11_input;
                $storereaction->section12_input     = $request->section12_input;
                $storereaction->section13_input     = $request->section13_input;
                $storereaction->section16_input     = $request->section16_input;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $section1arr = [
                    "section1_1"       => $request->section1_1 ?? '',
                    "section1_1a"      => $request->section1_1a ?? '',
                    "section1_1b"      => $request->section1_1b ?? '',
                    "section1_2"       => $request->section1_2 ?? '',
                    "section1_3a"      => $request->section1_3a ?? '',
                    "section1_3b"      => $request->section1_3b ?? '',
                ];

                $section5arr = [
                    "section5_a"    => $request->section5_a ?? '',
                    "section5_b"    => $request->section5_b ?? '',
                    "section5_c"    => $request->section5_c ?? '',
                ];

                $sec1    = implode(", ", array_values($section1arr));
                $sec5    = implode(", ", array_values($section5arr));


                $updatereaction = BloodTypeAdverseEvent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->section1            = $sec1;
                $updatereaction->section2            = $request->section2;
                $updatereaction->section3            = $request->section3;
                $updatereaction->section4            = $request->section4;
                $updatereaction->section5            = $sec5;
                $updatereaction->section6            = $request->section6;
                $updatereaction->section7            = $request->section7;
                $updatereaction->section8            = $request->section8;
                $updatereaction->section9            = $request->section9;
                $updatereaction->section10           = $request->section10;
                $updatereaction->section11           = $request->section11;
                $updatereaction->section12           = $request->section12;
                $updatereaction->section13           = $request->section13;
                $updatereaction->section14           = $request->section14;
                $updatereaction->section15           = $request->section15;
                $updatereaction->section16           = $request->section16;
                $updatereaction->section11_input     = $request->section11_input;
                $updatereaction->section12_input     = $request->section12_input;
                $updatereaction->section13_input     = $request->section13_input;
                $updatereaction->section16_input     = $request->section16_input;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );
            }

        }catch (\Exception $e){
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

    public function storeOutcomeAdverseEvent(Request $request)
    {
        try{

            $record = BloodOutcomeAdverseEvent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){

                $recoveredarr = [
                    "noill"                     => $request->noill ?? '',
                    "adverseoutcomeillness"     => $request->adverseoutcomeillness ?? '',
                ];

                $deatharr = [
                    "possible"       => $request->possible ?? '',
                    "probable"       => $request->probable ?? '',
                    "unlikely"       => $request->unlikely ?? '',
                ];

                $rec      = implode(", ", array_values($recoveredarr));
                $death    = implode(", ", array_values($deatharr));

                $storereaction                      = new BloodOutcomeAdverseEvent();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->recovered           = $rec;
                $storereaction->death               = $death;
                $storereaction->morbidity           = $request->adverseoutcomeillnessinput;
                $storereaction->timeframe           = $request->timeframerecovery;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $recoveredarr = [
                    "noill"                     => $request->noill ?? '',
                    "adverseoutcomeillness"     => $request->adverseoutcomeillness ?? '',
                ];

                $deatharr = [
                    "possible"       => $request->possible ?? '',
                    "probable"       => $request->probable ?? '',
                    "unlikely"       => $request->unlikely ?? '',
                ];

                $rec      = implode(", ", array_values($recoveredarr));
                $death    = implode(", ", array_values($deatharr));

                $updatereaction                      = BloodOutcomeAdverseEvent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->recovered           = $rec;
                $updatereaction->death               = $death;
                $updatereaction->morbidity           = $request->adverseoutcomeillnessinput;
                $updatereaction->timeframe           = $request->timeframerecovery;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }

        }catch (\Exception $e){
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

    public function storeRelevantInvestigation(Request $request)
    {
        try{

            $record = BloodRelevantInvestigation::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){

                $storereaction                      = new BloodRelevantInvestigation();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->prefbc              = $request->prefbc;
                $storereaction->prelf               = $request->prelf;
                $storereaction->prect               = $request->prect;
                $storereaction->postfbc             = $request->postfbc;
                $storereaction->postlf              = $request->postlf;
                $storereaction->postct              = $request->postct;
                $storereaction->postrca             = $request->postrca;
                $storereaction->posthapto           = $request->posthapto;
                $storereaction->bloodpatient        = $request->bloodpatient;
                $storereaction->bloodpatientorg     = $request->bloodpatientorg;
                $storereaction->blooddonor          = $request->blooddonor;
                $storereaction->blooddonororg       = $request->blooddonororg;
                $storereaction->urinefeme           = $request->urinefeme;
                $storereaction->haemoglobinuria     = $request->haemoglobinuria;
                $storereaction->hematuria           = $request->hematuria;
                $storereaction->otherinves          = $request->otherinves;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $updatereaction                      = BloodRelevantInvestigation::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->prefbc              = $request->prefbc;
                $updatereaction->prelf               = $request->prelf;
                $updatereaction->prect               = $request->prect;
                $updatereaction->postfbc             = $request->postfbc;
                $updatereaction->postlf              = $request->postlf;
                $updatereaction->postct              = $request->postct;
                $updatereaction->postrca             = $request->postrca;
                $updatereaction->posthapto           = $request->posthapto;
                $updatereaction->bloodpatient        = $request->bloodpatient;
                $updatereaction->bloodpatientorg     = $request->bloodpatientorg;
                $updatereaction->blooddonor          = $request->blooddonor;
                $updatereaction->blooddonororg       = $request->blooddonororg;
                $updatereaction->urinefeme           = $request->urinefeme;
                $updatereaction->haemoglobinuria     = $request->haemoglobinuria;
                $updatereaction->hematuria           = $request->hematuria;
                $updatereaction->otherinves          = $request->otherinves;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }

        }catch (\Exception $e){
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

    public function storeRelevantHistory(Request $request)
    {
        try{

            // return response()->json(
            //     [
            //         'status'  => 'success',
            //         'message' => $request->all(),
            //     ], 200
            // );

            $record = BloodRelevantHistory::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){

                $storereaction                      = new BloodRelevantHistory();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->diagnosis           = $request->diagnosis;
                $storereaction->indication          = $request->indication;
                $storereaction->relevanthistory     = $request->relevanthistory;
                $storereaction->preghistory         = $request->preghistory;
                $storereaction->emergencycross      = $request->emergencycross;
                $storereaction->safeo               = $request->safeo;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $updatereaction                      = BloodRelevantHistory::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->diagnosis           = $request->diagnosis;
                $updatereaction->indication          = $request->indication;
                $updatereaction->relevanthistory     = $request->relevanthistory;
                $updatereaction->preghistory         = $request->preghistory;
                $updatereaction->emergencycross      = $request->emergencycross;
                $updatereaction->safeo               = $request->safeo;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }

        }catch (\Exception $e){
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

    public function storeDetailProcedure(Request $request)
    {
        try{

            $record = BloodDetailProcedure::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){

                $storereaction                      = new BloodDetailProcedure();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->surgery             = $request->surgery;
                $storereaction->bypass              = $request->bypass;
                $storereaction->warmer              = $request->warmer;
                $storereaction->drip                = $request->drip;
                $storereaction->durationbypass      = $request->durationbypass;
                $storereaction->dripother           = $request->dripothers;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $updatereaction                      = BloodDetailProcedure::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber       = $request->epsdno;
                $updatereaction->inventory_bagno     = $request->bagno;
                $updatereaction->surgery             = $request->surgery;
                $updatereaction->bypass              = $request->bypass;
                $updatereaction->warmer              = $request->warmer;
                $updatereaction->drip                = $request->drip;
                $updatereaction->durationbypass      = $request->durationbypass;
                $updatereaction->dripother           = $request->dripothers;
                $updatereaction->status_id           = 1;
                $updatereaction->updated_by          = Auth::user()->id;
                $updatereaction->updated_at          = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }

        }catch (\Exception $e){
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

    public function storeBloodComponent(Request $request)
    {
        try{
     
            $record = BloodBloodComponent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();

            if($record == null){

                $componentarr = [
                    "wholeblood"     => $request->wholeblood ?? '',
                    "packcell"       => $request->packcell ?? '',
                    "apheresis"      => $request->apheresis ?? '',
                    "random"         => $request->random ?? '',
                    "ffp"            => $request->ffp ?? '',
                    "cryoppt"        => $request->cryoppt ?? '',
                    "cryosuper"      => $request->cryosuper ?? '',
                    "others"         => $request->others ?? '',
                ];
                $component    = implode(", ", array_values($componentarr));
                
                $storereaction                      = new BloodBloodComponent();
                $storereaction->episodenumber       = $request->epsdno;
                $storereaction->inventory_bagno     = $request->bagno;
                $storereaction->product             = $component;
                $storereaction->irridiated          = $request->irridiated;
                $storereaction->filtered            = $request->filtered;
                $storereaction->pathogen            = $request->pathogen;
                $storereaction->otherproduct        = $request->otherscomponent;
                $storereaction->status_id           = 1;
                $storereaction->created_by          = Auth::user()->id;
                $storereaction->created_at          = Carbon::now();
                $storereaction->save();

                if($inventory->atr_status_id == null){
                    $inventory->atr_status_id = 1;
                    $inventory->save();
                }

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }else{

                $componentarr = [
                    "wholeblood"     => $request->wholeblood ?? '',
                    "packcell"       => $request->packcell ?? '',
                    "apheresis"      => $request->apheresis ?? '',
                    "random"         => $request->random ?? '',
                    "ffp"            => $request->ffp ?? '',
                    "cryoppt"        => $request->cryoppt ?? '',
                    "cryosuper"      => $request->cryosuper ?? '',
                    "others"         => $request->others ?? '',
                ];
                $component    = implode(", ", array_values($componentarr));

                $updatereaction                       = BloodBloodComponent::where('inventory_bagno', $request->bagno)->where('status_id', '1')->first();
                $updatereaction->episodenumber        = $request->epsdno;
                $updatereaction->inventory_bagno      = $request->bagno;
                $updatereaction->product              = $component;
                $updatereaction->irridiated           = $request->irridiated;
                $updatereaction->filtered             = $request->filtered;
                $updatereaction->pathogen             = $request->pathogen;
                $updatereaction->otherproduct         = $request->otherscomponent;
                $updatereaction->status_id             = 1;
                $updatereaction->updated_by           = Auth::user()->id;
                $updatereaction->updated_at           = Carbon::now();
                $updatereaction->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Reaction successfully saved!',
                    ], 200
                );

            }


        }catch (\Exception $e){
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

    public function genReport(Request $request)
    {
        $explode = explode('?', $request->getRequestUri());

        $url = $explode[1];

        $bagno = $request->bagno;
        $episode = $request->epsdno;

        //DETAIL PROCEDURE
        $procedure = BloodDetailProcedure::where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        //SECTION D
        $component = BloodBloodComponent::where('inventory_bagno', $bagno)->where('status_id', '1')->first();
        if ($component) {
            $component->product = explode(', ', $component->product);
        }
        
        //Section F
        $relevanthistory = BloodRelevantHistory::where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        //Section G
        $record = BloodSignSymptom::where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        if ($record) {
            $record->general = explode(', ', $record->general);
            $record->pain = explode(', ', $record->pain);
            $record->renal = explode(', ', $record->renal);
            $record->respiratory = explode(', ', $record->respiratory);
            $record->skin = explode(', ', $record->skin);
            $record->cardio = explode(', ', $record->cardio);
        }

        //Section J
        $typeadverseevent = BloodTypeAdverseEvent::where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        if ($typeadverseevent) {
            $typeadverseevent->section1 = explode(', ', $typeadverseevent->section1);
            $typeadverseevent->section5 = explode(', ', $typeadverseevent->section5);
        }

        //Section I
        $outcomeadverseevent = BloodOutcomeAdverseEvent::where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        if ($outcomeadverseevent) {
            $outcomeadverseevent->recovered = explode(', ', $outcomeadverseevent->recovered);
            $outcomeadverseevent->death     = explode(', ', $outcomeadverseevent->death);
        }

        //Section H
        $relevantinvestigation = BloodRelevantInvestigation::with('user')->where('inventory_bagno', $bagno)->where('status_id', '1')->first();

        //PatDemo
        $uri = env('PAT_DEMO'). $request->epsdno;
        $client = new \GuzzleHttp\Client(['defaults' => ['verify' => false]]);

        $response = $client->request('GET', $uri);

        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);

        $patdemo = $content['data'];

        $vitaltemp  = !empty($record->temperature) ? $record->temperature : ($patdemo['temp'] ?? '__');
        $vitalsysto = !empty($record->systo) ? $record->systo : ($patdemo['sysBP'] ?? '__');
        $vitaldysto = !empty($record->diasto) ? $record->diasto : ($patdemo['diasBP'] ?? '');
        $vitalpulse = !empty($record->pulserate) ? $record->pulserate : ($patdemo['pulRate'] ?? '__');
        $vitalspo   = !empty($record->spo) ? $record->spo : ($patdemo['spO'] ?? '__');

        //Inventory
        $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();


        if($record){
            if($inventory->transfuse_stop_at != null && $record->created_at != null){

                $transfuseStopAt = Carbon::parse($inventory->transfuse_stop_at);
                $createdAt = Carbon::parse($record->created_at);
                
                if ($createdAt->diffInHours($transfuseStopAt) <= 24) {
                    $onset = 'immediate';
                } else {
                    $onset = 'delayed';
                }
    
            }else{
                $onset = "immediate";
            }
        }else{
            $onset = "immediate";
        }
        

        


        return view('iblood.reaction.report.subviews.report', compact(
            'url', 
            'bagno', 
            'record', 
            'patdemo',  
            'typeadverseevent', 
            'outcomeadverseevent', 
            'relevantinvestigation', 
            'vitaltemp', 
            'vitalsysto', 
            'vitaldysto', 
            'vitalpulse', 
            'vitalspo',
            'onset',
            'inventory',
            'relevanthistory',
            'procedure',
            'component',
            'episode',
        ));
    }

    public function finalize(Request $request)
    {

        try{



            $procedure = BloodDetailProcedure::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $relevanthistory = BloodRelevantHistory::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $signsymptom = BloodSignSymptom::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $typeadverseevent = BloodTypeAdverseEvent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $outcomeadverseevent = BloodOutcomeAdverseEvent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $relevantinvestigation = BloodRelevantInvestigation::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $bloodcomponent = BloodBloodComponent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();
            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();


            if ($procedure == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill detail procedure section.'
                    ], 200
                );

            }elseif ($relevanthistory == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill relevant clinical history section.'
                    ], 200
                );
                
            }elseif ($signsymptom == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill sign and symptoms section.'
                    ], 200
                );
                
            }elseif ($typeadverseevent == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill type of adverse event section.'
                    ], 200
                );
                
            }elseif ($outcomeadverseevent == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill adverse event outcome section.'
                    ], 200
                );
                
            }elseif ($relevantinvestigation == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill relevant investigation section.'
                    ], 200
                );
                
            }elseif ($bloodcomponent == null) {
                
                return response()->json(
                    [
                        'status'  => 'failed',
                        'message' => 'Please fill detail procedure section.'
                    ], 200
                );
                
            }else{

                $procedure->status_id       = 2;
                $procedure->finalize_by     = Auth::user()->id;
                $procedure->finalize_at     = Carbon::now();
                $procedure->save();

                $relevanthistory->status_id       = 2;
                $relevanthistory->finalize_by     = Auth::user()->id;
                $relevanthistory->finalize_at     = Carbon::now();
                $relevanthistory->save();

                $signsymptom->status_id       = 2;
                $signsymptom->finalize_by     = Auth::user()->id;
                $signsymptom->finalize_at     = Carbon::now();
                $signsymptom->save();

                $typeadverseevent->status_id       = 2;
                $typeadverseevent->finalize_by     = Auth::user()->id;
                $typeadverseevent->finalize_at     = Carbon::now();
                $typeadverseevent->save();

                $outcomeadverseevent->status_id       = 2;
                $outcomeadverseevent->finalize_by     = Auth::user()->id;
                $outcomeadverseevent->finalize_at     = Carbon::now();
                $outcomeadverseevent->save();

                $relevantinvestigation->status_id       = 2;
                $relevantinvestigation->finalize_by     = Auth::user()->id;
                $relevantinvestigation->finalize_at     = Carbon::now();
                $relevantinvestigation->save();

                $bloodcomponent->status_id       = 2;
                $bloodcomponent->finalize_by     = Auth::user()->id;
                $bloodcomponent->finalize_at     = Carbon::now();
                $bloodcomponent->save();

                $inventory->atr_status_id = 2;
                $inventory->save();

                return response()->json(
                    [
                        'status'  => 'success',
                        'message' => 'Successfully finalize report.'
                    ], 200
                );
            }

        }catch (\Exception $e){
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

    public function falseReport(Request $request)
    {

        try{

            $inventory = BloodInventory::where('bagno', $request->input('bagno'))->where('episodeno', $request->epsdno)->first();
            $procedure = BloodDetailProcedure::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($procedure != null) {
                
                $procedure->status_id       = 3;
                $procedure->finalize_by     = Auth::user()->id;
                $procedure->finalize_at     = Carbon::now();
                $procedure->save();

            }

            $relevanthistory = BloodRelevantHistory::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($relevanthistory != null) {
                
                $relevanthistory->status_id       = 3;
                $relevanthistory->finalize_by     = Auth::user()->id;
                $relevanthistory->finalize_at     = Carbon::now();
                $relevanthistory->save();
                
            }

            $signsymptom = BloodSignSymptom::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($signsymptom != null) {
                
                $signsymptom->status_id       = 3;
                $signsymptom->finalize_by     = Auth::user()->id;
                $signsymptom->finalize_at     = Carbon::now();
                $signsymptom->save();
                
            }

            $typeadverseevent = BloodTypeAdverseEvent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($typeadverseevent != null) {
                
                $typeadverseevent->status_id       = 3;
                $typeadverseevent->finalize_by     = Auth::user()->id;
                $typeadverseevent->finalize_at     = Carbon::now();
                $typeadverseevent->save();
                
            }

            $outcomeadverseevent = BloodOutcomeAdverseEvent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($outcomeadverseevent != null) {
                
                $outcomeadverseevent->status_id       = 3;
                $outcomeadverseevent->finalize_by     = Auth::user()->id;
                $outcomeadverseevent->finalize_at     = Carbon::now();
                $outcomeadverseevent->save();
                
            }

            $relevantinvestigation = BloodRelevantInvestigation::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($relevantinvestigation != null) {
                
                $relevantinvestigation->status_id       = 3;
                $relevantinvestigation->finalize_by     = Auth::user()->id;
                $relevantinvestigation->finalize_at     = Carbon::now();
                $relevantinvestigation->save();
                
            }

            $bloodcomponent = BloodBloodComponent::where('inventory_bagno', $request->bagno)->where('episodenumber', $request->epsdno)->where('status_id', '1')->first();

            if ($bloodcomponent != null) {
                
                $bloodcomponent->status_id       = 3;
                $bloodcomponent->finalize_by     = Auth::user()->id;
                $bloodcomponent->finalize_at     = Carbon::now();
                $bloodcomponent->save();
                
            }

            $inventory->atr_status_id = 3;
            $inventory->save();

            return response()->json(
                [
                    'status'  => 'success',
                    'message' => 'Successfully finalize report.'
                ], 200
            );
            
        }catch (\Exception $e){
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
