<!DOCTYPE html>
<html>
    <head>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>   
        <style>

            @media print {
            /*@page {
                margin: 0.3in 1in 0.3in 1in !important
            }*/
            @page { margin-top: 0.5in; margin-bottom: 0.5in; margin-left: 0.75in; margin-right: 0.75in; }
            }

            body {
                font-family: "Times New Roman", Times, serif !important;
            }

            .contain {
                width: 100%;
                height: 297mm;
                padding: 4mm;
                padding-left: 18mm;
                padding-right: 18mm;  /* Adjust padding as needed */
                margin: 0px auto;
                box-sizing: border-box;
            }

            .important-information {
                border: 2px solid black;
                padding: 10px;
                margin-top: 20px;
            }
            .important-information b {
                display: block;
                text-align: center;
                margin-bottom: 10px;
            }

            .reported table {
                width: 100%;
                border-collapse: collapse;
            }

            .reported table td {
                border: 1px solid #000000;
                text-align: left;
                padding: 0px;
                padding-left: 5px;
            }

            .sectiona table {
                width: 100%;
                border-collapse: collapse;
            }

            .sectiona table td {
                border: 1px solid #000000;
                text-align: left;
                padding: 0px;
                padding-left: 5px;
                vertical-align: top;
                text-align: left; 
            }

        </style>
    </head>
    <body>
        <div class="contain">
            <div class="investigation">
                <div class="header">
                    <div class="row">
                        <div class="col-6">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <img src="{{ asset('media/logo/ijn-logo.png') }}" style="max-height: 300px; max-width: 120px; float: left;" />
                                </div>
                                <div class="col-8">
                                    <b style="display: block; text-align: center;">TRANSFUSION REACTION LABORATORY INVESTIGATION FORM</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    Location: {{ $patdemo['epiWard']  ?? '' }}
                                </div>
                                <div class="col-6">
                                    Date: {{ isset($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('d/m/Y') : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="border: 2px solid black; padding: 25px; border-radius: 15px; font-size: 15px;">
                                <div class="row" >
                                    <div class="col-md-8">
                                        {{ $patdemo['pName']  ?? '' }}
                                    </div>
                                    <div class="col-md-4">
                                       <b>MRN : {{ $patdemo['prn']  ?? '' }}</b> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        Reg : {{ $patdemo['epiDate']  ?? '' }} {{ $patdemo['epiTime']  ?? '' }}
                                    </div>
                                    <div class="col-md-5">
                                        I/C : {{ $patdemo['pnric']  ?? '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        Age : {{ $patdemo['ageY']  ?? '' }} years, {{ $patdemo['ageM']  ?? '' }} months, {{ $patdemo['ageD']  ?? '' }} days
                                    </div> 
                                    <div class="col-md-5">
                                        Episode : {{ $episode  ?? '' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        Sex : {{ $patdemo['pgender']  ?? '' }}
                                    </div> 
                                    <div class="col-md-5">
                                        Res : {{ $patdemo['pcountry']  ?? '' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="management">
                    <div style="border: 2px solid black; padding: 0;">
                        <div style="background-color: #f2f2f2; padding: 10px; border-bottom: 2px solid black;">
                            <b>Management of Transfusion Reaction</b>
                        </div>
                        <div style="padding: 10px;">
                            <ol>
                                <li><b>STOP</b> transfusion <b>IMMEDIATELY</b>.</li>
                                <li><b>Inform</b> Doctor in charge when patient develops any reaction to blood or plasma.</li>
                                <li><b>Report</b> all reactions to Blood Bank and <b>lodge</b> Adverse Transfusion Reaction incident on ERMS.</li>
                                <li><b>Order</b> Transfusion Reaction Investigation in HIS and generate lab episode number for sample labeling.</li>
                                <li><b>Collect</b> blood in 6 ml EDTA & urine samples and <b>label</b> as <b>“Post transfusion 1”.</b></li>
                                <li><b>Collect</b> another set of blood in EDTA & urine samples 24 hours after and <b>label</b> as <b>“Post transfusion 2”</b>.</li>
                            </ol>
                            <span>For febrile or suspected haemolytic reactions:</span>
                            <ol style="list-style-type: lower-alpha;">
                                <li><b>Preserve</b> blood bag and transfusion set with attached labels.</li>
                                <li><b>Close</b> the outlet port securely to avoid contamination.</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="procedure">
                    <div style="border: 2px solid black; padding: 0;">
                        <div style="background-color: #f2f2f2; padding: 10px; border-bottom: 2px solid black;">
                            <b>Details of Procedure / Surgery and Transfusion</b>
                        </div>
                        <div style="padding: 10px;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Name of procedure / surgery</td>
                                    <td style="width:70%; padding: 5px;">: {{ $procedure->surgery  ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">On bypass machine</td>
                                    <td style="width:70%; padding: 5px;">
                                        <div class="row">
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->bypass == 'no' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;" >
                                                 No
                                               </label>
                                            </div>
                                            <div class="col-9">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->bypass == 'yes' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Yes. Duration on Bypass machine: {{ $procedure->durationbypass  ?? ''}}
                                               </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Use of blood warmer</td>
                                    <td style="width:70%; padding: 5px;">
                                        <div class="row">
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->warmer == 'no' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                 No
                                               </label>
                                            </div>
                                            <div class="col-9">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->warmer == 'yes' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Yes
                                               </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Initiation of transfusion</td>
                                    <td style="width:70%; padding: 5px;">: <b>{{ isset($inventory->transfuse_start_at) ? \Carbon\Carbon::parse($inventory->transfuse_start_at)->format('d/m/Y H:i') : '' }}</b></td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Onset of reaction</td>
                                    <td style="width:70%; padding: 5px;">: {{ isset($onset) && $onset == "immediate" ? 'IMMEDIATE' : 'DELAYED' }}</td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black; border-bottom: 1px solid black;">Type of blood and blood products <br>(Enter no. of units transfused)</td>
                                    <td style="width:70%; padding: 5px; border-bottom: 1px solid black;">
                                        <div class="row">
                                            <div class="col-3">
                                                <input class="form-check-input form-check-input-lg" type="checkbox" value="" id="flexCheckDefault" {{ isset($inventory) && $inventory->product == "PACKED CELL" ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Packed Cell
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <input class="form-check-input form-check-lg" type="checkbox" value="" id="flexCheckDefault" {{ isset($inventory) && $inventory->product == "WHOLE BLOOD" ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Whole Blood
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-lg" type="checkbox" value="" id="flexCheckDefault" {{ isset($inventory) && $inventory->product == "FFP." ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    FFP
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-lg" type="checkbox" value="" id="flexCheckDefault" {{ isset($inventory) && $inventory->product == "PLATELET CONC." ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Platelet
                                                </label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input form-check-lg" type="checkbox" value="" id="flexCheckDefault" {{ isset($inventory) && $inventory->product == "CRYOPPT" ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Cryoppt
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                Product ID No: <b>{{ $bagno  ?? ''}}</b>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Starting drip solution used</td>
                                    <td style="width:70%; padding: 5px;">
                                        <div class="row">
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->drip == 'normal' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Normal Saline
                                               </label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->drip == 'dextrose' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    5% Dextrose
                                               </label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($procedure) && $procedure->drip == 'others' ? 'checked' : '' }} onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Others: {{ $procedure->dripother  ?? ''}}
                                               </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">History of previous transfusion</td>
                                    <td style="width:70%; padding: 5px;">
                                        <div class="row">
                                            <div class="col-2">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked onclick="return false;">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    No
                                               </label>
                                            </div>
                                            <div class="col-10">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    Yes. Enter date and history of previous transfusion reaction:
                                               </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">Date of last transfusion</td>
                                    <td style="width:70%; padding: 5px;">:</td>
                                </tr>
                                <tr>
                                    <td style="width:30%; padding: 5px; border-right: 1px solid black;">History of previous reaction</td>
                                    <td style="width:70%; padding: 5px;">:</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <br/><br/><br/>
                <div class="signature">
                    <div class="row">
                        <div class="col-6">
                            Doctor's Signature & Name: <u>{{ $relevantinvestigation->user->name  ?? ''}}</u>
                        </div>
                        <div class="col-6">
                            Date & Time: <u>{{ isset($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('d/m/Y H:i') : '' }}</u>
                    </div>
                </div>
            </div>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
            <div class="header" style="text-align: center">        
                <b>FORM FOR TRANSFUSION-RELATED ADVERSE EVENT</b><br>
                <b>TRANSFUSION MEDICINE SERVICE</b><br>      
                <b>KEMENTERIAN KESIHATAN MALAYSIA</b><br>
            </div>
            <div class="important-information">
                <b><u>Important Information</u></b>
                <ol>
                    <li>Every adverse event related to transfusion of blood or blood component shall be managed, investigated and documented accordingly.</li>
                    <li>The form must be completed and returned to the blood bank within 2 weeks of the incident.</li>
                    <li>The blood bank shall retain the completed form and send a copy to the State Transfusion Committee and the National Haemovigilance Coordinating Centre (NHCC), Pusat Darah Negara within a month.</li>
                </ol>
            </div>
            <br/>
            <div class="reported">
                <b style="display: block; margin-bottom: 5px">Reported by:</b>
                <table>
                    <tr style="border-bottom: 1px solid">
                        <td style="width: 60%;">Name: <b>{{ $relevantinvestigation->user->name  ?? ''}}</b></td>
                        <td style="width: 40%;">Designation: {{ $relevantinvestigation->user->usergrp  ?? ''}}</td>
                    </tr>
                    <tr style="border-bottom: 1px solid">
                        <td>Email: - </td>
                        <td>Tel No: 03-2617 8200</td>
                    </tr>
                    <tr>
                        <td>Date: <b>{{ isset($relevantinvestigation->created_at) ? \Carbon\Carbon::parse($relevantinvestigation->created_at)->format('d/m/Y') : '' }}</b> </td>
                        <td>Fax No: 03-2617 8200</td>
                    </tr>
                </table>
            </div>
            <br/>
            <div class="sectiona">
                <b style="display: block; margin-bottom: 5px">SECTION A: PATIENT DETAILS</b>
                <table>
                    <tr>
                        <td colspan="3"><b>Name of Patient: {{ $patdemo['pName']  ?? '' }}</b></td>
                    </tr>
                    <tr>
                        <td>NRIC/ Passport No: {{ $patdemo['pnric']  ?? '' }}</td>
                        <td>Age: {{ $patdemo['ageY']  ?? '' }} years, {{ $patdemo['ageM']  ?? '' }} months, {{ $patdemo['ageD']  ?? '' }} days</td>
                        <td>Hospital: {{ $patdemo['pHosp']  ?? '' }}</td>
                    </tr>
                    <tr>
                        <td rowspan="2">Barcode: {{ $patdemo['prn']  ?? '' }}</td>
                        <td rowspan="2">Gender: {{ $patdemo['pgender']  ?? '' }}</td>
                        <td>Ward: {{ $patdemo['epiWard']  ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Department: {{ $patdemo['epiRoom']  ?? '' }}</td>
                    </tr>
                </table>
            </div>
            <br/>
            <div class="sectionb">
                <b style="display: block; margin-bottom: 5px">SECTION B: TYPE OF ADVERSE EVENTS</b>
                <div class="row">
                    <div class="col-6">
                        B1. TRANSFUSION REACTION
                    </div>
                    <div class="col-6">
                       &nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked onclick="return false;">
                       <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                        (Fill up section C-J)
                      </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                       B2. ERROR IN TRANSFUSION PROCESS
                    </div>
                </div>
                <div class="row" style="margin-left: 5px">
                    <ol style="list-style-type: lower-alpha;">
                        <li>
                            <div class="row">
                                <div class="col-6">
                                    INCORRECT BLOOD COMPONENT TRANSFUSED
                                </div>
                                <div class="col-6">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="return false;">
                                    <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                     (Fill up section C-k)
                                   </label>
                                 </div>
                            </div>     
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-6">
                                    NEAR MISS
                                </div>
                                <div class="col-6">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="return false;">
                                    <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                     (Proceed to SECTION K1 for 'NEAR MISS' on page 4)
                                   </label>
                                 </div>
                            </div>
                        </li>
                        <li>
                            <div class="row">
                                <div class="col-6">
                                    INCIDENT
                                </div>
                                <div class="col-6">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="return false;">
                                    <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                        (Proceed to SECTION K2 for 'INCIDENT' on page 4)
                                   </label>
                                 </div>
                            </div>    
                        </li>
                    </ol>  
                </div>
                <div class="row">
                    <div class="row">
                        <div style="border: 2px solid black; padding: 10px;">
                            <b>Near Miss:</b> Any error that has occurred but did not cause any adverse event as it was detected prior to blood transfusion.
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="sectionc">
                <b style="display: block; margin-bottom: 5px">SECTION C: ONSET OF ADVERSE EVENTS</b>
                <div class="row">
                    <div class="col-6">
                        C1. IMMEDIATE (within 24 hours of transfusion)
                    </div>
                    <div class="col-6">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($onset) && $onset == "immediate" ? 'checked' : '' }} onclick="return false;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        C2. DELAYED (after 24 hours of transfusion)
                    </div>
                    <div class="col-6">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($onset) && $onset == "delayed" ? 'checked' : '' }} onclick="return false;">
                    </div>
                </div>
            </div>
            <br/>
            <div class="sectiond">
                <b style="display: block; margin-bottom: 5px">SECTION D:BLOOD COMPONENTS IMPLICATED IN THE ADVERSE EVENT </b>
                <div class="row">
                    <div class="col-4">
                        D1. Whole blood
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('wholeblood', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">Irradiated:</div>
                            <div class="col-6"> {{  in_array('wholeblood', $component->product ?? []) ? isset($component) && $component->irridiated == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="row">
                            <div class="col-8">Filtered:</div>
                            <div class="col-4">{{  in_array('wholeblood', $component->product ?? []) ? isset($component) && $component->filtered == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D2. Packed Cells
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('packcell', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">Irradiated:</div>
                            <div class="col-6">{{  in_array('wholeblood', $component->product ?? []) ? isset($component) && $component->irridiated == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="row">
                            <div class="col-8">Filtered:</div>
                            <div class="col-4">{{  in_array('wholeblood', $component->product ?? []) ? isset($component) && $component->filtered == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D3. Apheresis Platelet
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('apheresis', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">Irradiated:</div>
                            <div class="col-6">{{ in_array('apheresis', $component->product ?? []) ? isset($component) && $component->irridiated == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="row">
                            <div class="col-8">Pathogen Inactivated:</div>
                            <div class="col-4">{{ in_array('apheresis', $component->product ?? []) ? isset($component) && $component->pathogen == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D4. Random Platelet
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('random', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6">Irradiated:</div>
                            <div class="col-6">{{ in_array('random', $component->product ?? []) ? isset($component) && $component->irridiated == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D5. Fresh Frozen Plasma
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('ffp', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D6. Cryoprecipitate
                    </div>
                    <div class="col-4">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('cryoppt', $component->product ?? [])  ? 'checked' : '' }} onclick="return false;">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-8">Pathogen Inactivated:</div>
                            <div class="col-4">{{ in_array('cryoppt', $component->product ?? []) ? isset($component) && $component->pathogen == "yes" ? 'YES' : 'NO' : '' }}</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        D7. Cryosupernatant/Liver Plasma
                    </div>
                    <div class="col-1">
                       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('cryosuper', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4" {{ in_array('others', $component->product ?? []) ? 'checked' : '' }} onclick="return false;">
                        D8. Others (please specify) <b><u>{{ in_array('others', $component->product ?? []) ? $inventory->product  ?? '' : '' }}</u></b>
                    </div>
                </div>
            </div>
            <br/>
            <div class="sectione">
                <b style="display: block; margin-bottom: 5px">SECTION E:DETAILS OF ADVERSE EVENTS </b>
                <div class="row">
                    <div class="col-6">
                        E1. Date of transfusion: (DD/MM/YY): <b>{{ isset($inventory->transfuse_start_at) ? \Carbon\Carbon::parse($inventory->transfuse_start_at)->format('d/m/Y') : '' }}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        E2. Time transfusion started: <b>{{ isset($inventory->transfuse_start_at) ? \Carbon\Carbon::parse($inventory->transfuse_start_at)->format('H:i') : '' }}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        E3. Time reaction occurred: <b>{{ isset($record->created_at) ? \Carbon\Carbon::parse($record->created_at)->format('H:i') : '' }}</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        E4. Volume transfused: <b>{{ $inventory->volume  ?? '' }}</b>
                    </div>
                </div>
            </div>
            <br>
            <div class="sectionf">
                <b style="display: block; margin-bottom: 5px">SECTION F: RELEVANT CLINICAL HISTORY </b>
                <div class="row">
                    <div class="col-6">
                        F1. Patient’s primary / provisional diagnosis: <u>{{ $relevanthistory->diagnosis  ?? ''}}</u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        F2. Indication for transfusion: <u>{{ $relevanthistory->indication  ?? ''}}</u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        F3. History of pregnancy / miscarriage (if applicable):
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->preghistory == 'yes' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    YES
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->preghistory == 'no' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    NO
                               </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        F4.
                    </div>
                    <div class="col-11">
                        <ol style="list-style-type: lower-alpha;">
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        History of previous transfusion:
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                                    YES <3 mths
                                               </label>
                                            </div>
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                                    YES >3 mths
                                               </label>
                                            </div>
                                            <div class="col-2">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked onclick="return false;>
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                                    NO
                                               </label>
                                            </div>
                                            <div class="col-4">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                                    UNKNOWN
                                               </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        If YES, component transfused:
                                    </div>
                                    <div class="col-8">
                                        
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        Reaction towards transfusion:
                                    </div>
                                    <div class="col-8">
                                        <div class="row">
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    YES
                                               </label>
                                            </div>
                                            <div class="col-3">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked onclick="return false;>
                                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                                    NO
                                               </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-4">
                                        If YES, please describe:
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        F5. Other relevant medical and/or surgical history: <u>{{ $relevanthistory->relevanthistory  ?? ''}}</u>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        F6. Emergency crossmatch (immediate spin)
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->emergencycross == 'yes' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    YES
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->emergencycross == 'no' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    NO
                               </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        F7. Transfusion with safe “O” or uncrossmatched group specific blood
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->safeo == 'yes' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    YES
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ isset($relevanthistory) && $relevanthistory->safeo == 'no' ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                    NO
                               </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="sectiong">
                <b style="display: block; margin-bottom: 5px">SECTION G: SIGNS AND SYMPTOMS</b>
                <div class="row">
                    <div class="col-4">
                        G1. General:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="genchill" {{ in_array('genchill', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genchill" style="font-size: 15px;">
                                    Chill
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="genrigors" {{ in_array('genrigors', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genrigors" style="font-size: 15px;">
                                    Rigors
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="genfever" {{ in_array('genfever', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genfever" style="font-size: 15px;">
                                    Fever
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="gennausea" {{ in_array('gennausea', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="gennausea" style="font-size: 15px;">
                                    Nausea
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="genhemor" {{ in_array('genhemor', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genhemor" style="font-size: 15px;">
                                    Haemorrhage
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <input class="form-check-input" type="checkbox" value="" id="genanxiety" {{ in_array('genanxiety', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genanxiety" style="font-size: 15px;">
                                    Restlessness / Anxiety
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="genvomit" {{ in_array('genvomit', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="genvomit" style="font-size: 15px;">
                                    Vomiting
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="gencyano" {{ in_array('gencyano', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="gencyano" style="font-size: 15px;">
                                    Cyanosis
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="" id="signsymptomsgeneralother" {{ in_array('signsymptomsgeneralother', $record->general ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="signsymptomsgeneralother" style="font-size: 15px;">
                                    Others (specify) <u>{{ $record->others_general  ?? '' }}</u>
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-4">
                        G2. Cardiovascular:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="cardiochestpain" {{ in_array('cardiochestpain', $record->cardio  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="cardiochestpain" style="font-size: 15px;">
                                    Chest pain
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="cardiopalpi" {{ in_array('cardiopalpi', $record->cardio  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="cardiopalpi" style="font-size: 15px;">
                                    Palpitation
                               </label>
                            </div>
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="" id="signsymptomscardioother" {{ in_array('signsymptomscardioother', $record->cardio  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="signsymptomscardioother" style="font-size: 15px;">
                                    Others (specify) <u>{{ $record->others_cardio  ?? ''}}</u>
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-4">
                        G3. Skin:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="skinoed" {{ in_array('skinoed', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinoed" style="font-size: 15px;">
                                    Oedema
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="skinflush" {{ in_array('skinflush', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinflush" style="font-size: 15px;">
                                    Flushing
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="skinhives" {{ in_array('skinhives', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinhives" style="font-size: 15px;">
                                    Hives
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="skinitch" {{ in_array('skinitch', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinitch" style="font-size: 15px;">
                                    Itching
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="skinpallor" {{ in_array('skinpallor', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinpallor" style="font-size: 15px;">
                                    Pallor
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="skinjaun" {{ in_array('skinjaun', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinjaun" style="font-size: 15px;">
                                    Jaundice
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="skinurti" {{ in_array('skinurti', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinurti" style="font-size: 15px;">
                                    Urticaria
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="skinpete" {{ in_array('skinpete', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinpete" style="font-size: 15px;">
                                    Petechiae
                               </label>
                            </div>
                            <div class="col-2">
                                <input class="form-check-input" type="checkbox" value="" id="skinrash" {{ in_array('skinrash', $record->skin ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="skinrash" style="font-size: 15px;">
                                    Rash
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-4">
                        G4. Pain:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="paininfuse" {{ in_array('paininfuse', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="paininfuse" style="font-size: 15px;">
                                    Infusion site pain
                               </label>
                            </div>
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="painabdo" {{ in_array('painabdo', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="painabdo" style="font-size: 15px;">
                                    Abdominal pain
                               </label>
                            </div>
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="painchest" {{ in_array('painchest', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="painchest" style="font-size: 15px;">
                                    Chest pain
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="painflank" {{ in_array('painflank', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="painflank" style="font-size: 15px;">
                                    Flank pain
                               </label>
                            </div>
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="painhead" {{ in_array('painhead', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="painhead" style="font-size: 15px;">
                                    Headache
                               </label>
                            </div>
                            <div class="col-4">
                                <input class="form-check-input" type="checkbox" value="" id="painback" {{ in_array('painback', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="painback" style="font-size: 15px;">
                                    Back pain
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input class="form-check-input" type="checkbox" value="" id="signsymptomspainother" {{ in_array('signsymptomspainother', $record->pain  ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="signsymptomspainother" style="font-size: 15px;">
                                    Others (specify) <u>{{ $record->others_pain  ?? ''}}</u>
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-4">
                        G5. Renal:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="renaloli" {{ in_array('renaloli', $record->renal ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="renaloli" style="font-size: 15px;">
                                    Oliguria
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="renalanu" {{ in_array('renalanu', $record->renal ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="renalanu" style="font-size: 15px;">
                                    Anuria
                               </label>
                            </div>
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="" id="renalurine" {{ in_array('renalurine', $record->renal ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="renalurine" style="font-size: 15px;">
                                    Dark coloured urine
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row">
                    <div class="col-4">
                        G6. Respiratory:
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="respicough" {{ in_array('respicough', $record->respiratory ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="respicough" style="font-size: 15px;">
                                    Cough
                               </label>
                            </div>
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="respihypox" {{ in_array('respihypox', $record->respiratory ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="respihypox" style="font-size: 15px;">
                                    Hypoxia
                               </label>
                            </div>
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="" id="respidysp" {{ in_array('respidysp', $record->respiratory ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="respidysp" style="font-size: 15px;">
                                    Dyspnoea
                               </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="respiwheeze" {{ in_array('respiwheeze', $record->respiratory ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="respiwheeze" style="font-size: 15px;">
                                    Wheezing
                               </label>
                            </div>
                            <div class="col-6">
                                <input class="form-check-input" type="checkbox" value="" id="signsymptomsrespiratoryother" {{ in_array('signsymptomsrespiratoryother', $record->respiratory ?? []) ? 'checked' : '' }} onclick="return false;">
                                <label class="form-check-label" for="signsymptomsrespiratoryother" style="font-size: 15px;">
                                    Others (specify) <u>{{ $record->others_respiratory  ?? ''}}</u>
                               </label>
                            </div>
                        </div>
                    </div>       
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        G7. Patient’s baseline observations prior to reaction: Temperature: <u>{{$vitaltemp}}</u>°C, BP: <u>{{$vitalsysto}} / {{$vitaldysto}} </u> Pulse rate: <u>{{$vitalpulse}}</u> RR: <u>{{ $record->respirate  ?? ''}}</u> SPO2: <u>{{$vitalspo}}</u>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-12">
                        G8. Patient’s baseline observations at time of reaction: Temperature: <u>{{ $record->reacttemp  ?? ''}}</u>°C, BP: <u>{{ $record->reactsysto  ?? ''}} / {{ $record->reactdiasto  ?? ''}} </u> Pulse rate: <u>{{ $record->reactpulse  ?? ''}}</u> RR: <u>{{ $record->reactrr  ?? ''}}</u> SPO2: <u>{{ $record->reactspo  ?? ''}}</u>
                    </div>      
                </div>
            </div>
            <br/>
            <div class="sectionh">
                <b style="display: block; margin-bottom: 5px">SECTION H: RELEVANT INVESTIGATIONS </b>
                <div class="row">
                    <div class="col-6">
                        H1. Chest X-ray findings (specify):
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        H2. Relevant <b>pre-transfusion</b> laboratory investigation results:
                    </div>
                    <div class="row">
                        <div class="col-6">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Full blood count: <u>{{ $relevantinvestigation->prefbc  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Liver Function: <u>{{ $relevantinvestigation->prelf  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coagulation Test: <u>{{ $relevantinvestigation->prect  ?? ''}}</u>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        H3. Relevant <b>post-transfusion</b> laboratory investigation results:
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Full blood count including Reticulocyte count: <u>{{ $relevantinvestigation->postfbc  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Liver Function: <u>{{ $relevantinvestigation->postlf  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Coagulation Test: <u>{{ $relevantinvestigation->postct  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Red cells antibodies: <u>{{ $relevantinvestigation->postrca  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Haptoglobin: <u>{{ $relevantinvestigation->posthapto  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blood C&S Patient: <b>{{ isset($relevantinvestigation) && $relevantinvestigation->bloodpatient == 'bloodpatientpos' ? 'POS' : '' }}</b> <b>{{ isset($relevantinvestigation) && $relevantinvestigation->bloodpatient == 'bloodpatientneg' ? 'NEG' : '' }}</b>  Organism: <u>{{ $relevantinvestigation->bloodpatientorg  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Blood C&S Donor: <b>{{ isset($relevantinvestigation) && $relevantinvestigation->blooddonor == 'blooddonorpos' ? 'POS' : '' }}</b> <b>{{ isset($relevantinvestigation) && $relevantinvestigation->blooddonor == 'blooddonorneg' ? 'NEG' : '' }}</b> Organism: <u>{{ $relevantinvestigation->bloodpatientorg  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Urine FEME: <u>{{ $relevantinvestigation->urinefeme  ?? ''}}</u>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input class="form-check-input" type="checkbox" value="" id="haemoglobinuria" {{ isset($relevantinvestigation) && $relevantinvestigation->haemoglobinuria ? 'checked' : '' }} onclick="return false;">
                            <label class="form-check-label" for="haemoglobinuria" style="font-size: 15px;">
                                Haemoglobinuria
                           </label>
                        </div>
                        <div class="col-4">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                            <input class="form-check-input" type="checkbox" value="" id="hematuria" {{ isset($relevantinvestigation) && $relevantinvestigation->hematuria ? 'checked' : '' }} onclick="return false;">
                            <label class="form-check-label" for="hematuria" style="font-size: 15px;">
                                Hematuria
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            H4. State other relevant investigations if any: {{ $relevantinvestigation->otherinves  ?? ''}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="sectioni">
                <b style="display: block; margin-bottom: 5px">SECTION I : PATIENT OUTCOME FROM THE ADVERSE EVENT </b>
                <div class="row">
                    <div class="col-6">
                        I1. Recovered with no ill effects
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="noill" {{ in_array('noill', $outcomeadverseevent->recovered  ?? []) ? 'checked' : '' }}  onclick="return false;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        I2. Recovered with illness (morbidity)
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="adverseoutcomeillness" {{ in_array('adverseoutcomeillness', $outcomeadverseevent->recovered  ?? []) ? 'checked' : '' }}  onclick="return false;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Time frame of recovery
                    </div>
                    <div class="col-6">
                       <u>{{ $outcomeadverseevent->timeframe  ?? ''}}</u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        Specify the morbidity
                    </div>
                    <div class="col-6">
                       <u>{{ $outcomeadverseevent->morbidity  ?? ''}}</u>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        I3. Death
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" {{ in_array('unlikely', $outcomeadverseevent->death  ?? []) || in_array('probable', $outcomeadverseevent->death  ?? []) || in_array('possible', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }} onclick="return false;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        I4.
                    </div>
                    <div class="col-11">
                        <ol style="list-style-type: lower-alpha;">
                            <li>
                                <div class="row">
                                    <div class="col-5">
                                        Unlikely related to transfusion
                                    </div>
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-3">
                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="unlikely" {{ in_array('unlikely', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }} onclick="return false;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-5">
                                        Probable related to transfusion
                                    </div>
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-3">
                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="probable" {{ in_array('probable', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }} onclick="return false;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-5">
                                        Possible related to transfusion
                                    </div>
                                    <div class="col-7">
                                        <div class="row">
                                            <div class="col-3">
                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="possible" {{ in_array('possible', $outcomeadverseevent->death  ?? []) ? 'checked' : '' }} onclick="return false;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <br>
            <div class="sectionj">
                <b style="display: block; margin-bottom: 5px">SECTION J: TYPE OF ADVERSE EVENTS: [Tick where applicable] </b>
                <table class="table table-bordered" id="adverse-event-table">
                    <thead class="thead-light">
                        <tr>
                            <th style="min-width: 10px; text-align: center;  vertical-align: middle;">{{__('Section')}}</th>
                            <th style="min-width: 270px; text-align: center;  vertical-align: middle;">{{__('Events')}}</th>
                            <th style="min-width: 10px; text-align: center;  vertical-align: middle;">{{__('Action')}}</th>
                            <th style="min-width: 20px; text-align: center;  vertical-align: middle;">*</th>
                        </tr>
                    </thead>
                    <tbody> 
                        {{-- J1 --}}
                        <tr>
                            <td rowspan="8" style="text-align: center; vertical-align: middle;">J1</td>
                            <td><b>Incorrect Blood Component / Product Transfused (Proceed to Error and Incident tab for "IBCT". )</b></td>
                            <td></td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.1. Accute Immune Haemolytic Anaemia</td>
                            <td style="text-align: center; vertical-align: middle;">                    
                                {{ in_array('section1_1', $typeadverseevent->section1  ?? []) ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.1a. ABO incompatible</td>
                            <td style="text-align: center; vertical-align: middle;">                    
                                {{ in_array('section1_1a', $typeadverseevent->section1  ?? []) ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.1b. Other red cell incompatibility (e.g. Rh positive given to Rh negative)</td>
                            <td style="text-align: center; vertical-align: middle;">                    
                                {{ in_array('section1_1b', $typeadverseevent->section1  ?? []) ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.2. Blood is compatible but is meant for another patient</td>
                            <td style="text-align: center; vertical-align: middle;">                    
                                {{ in_array('section1_2', $typeadverseevent->section1  ?? []) ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.3. Others:</td>
                            <td style="text-align: center; vertical-align: middle;">                    
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>J1.3a. Special requirement not met (e.g. iradiated, filtered, phenotyped)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ in_array('section1_3a', $typeadverseevent->section1  ?? []) ? '✓' : '' }}                
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>J1.3b. Inappropriate transfusion (e.g. wrong component)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ in_array('section1_3b', $typeadverseevent->section1  ?? []) ? '✓' : '' }}                    
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J2 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J2</td>
                            <td>Delayed Haemolytic Transfusion Reaction</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section2 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J3 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J3</td>
                            <td>Non-immune hemolytic reaction (due to mechanical factor, osmotic, heat, cold, etc)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section3 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J4 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J4</td>
                            <td>Febrile Non-Haemolytic Transfusion Reaction (FNHTR)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section4 ? '✓' : '' }}
                            </td>
                            <td></td>
                        </tr>
                        {{-- J5 --}}
                        <tr>
                            <td rowspan="4" style="text-align: center; vertical-align: middle;">J5</td>
                            <td>Allergic Reaction</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Mild (Rash/Urticaria)</td>
                            <td style="text-align: center; vertical-align: middle;">   
                                {{ in_array('section5_a', $typeadverseevent->section5  ?? []) ? '✓' : '' }}                 
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>b. Moderate (Anaphylactoid)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ in_array('section5_b', $typeadverseevent->section5  ?? []) ? '✓' : '' }}                    
                            </td>
                            <td>*</td>
                        </tr>
                        <tr>
                            <td>c. Severe (Anphylactic Transfusion Reaction)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ in_array('section5_c', $typeadverseevent->section5  ?? []) ? '✓' : '' }}                   
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J6 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J6</td>
                            <td>Transfusing-Related Acute Lung Injury (TRALI)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section6 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J7 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J7</td>
                            <td>Transfusing-Associated Circulatory Oveload (TACO)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section7 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J8 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J8</td>
                            <td>Transfusing-Associated Dyspnoea (TAD)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section8 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J9 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J9</td>
                            <td>Transfusing-Associated Graft-versus-Host Disease (TA-GvHD)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section9 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J10 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J10</td>
                            <td>Post-Transfusion Purpura (PTP)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section10 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J11 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J11</td>
                            <td>Post-Transfusion Infection: Virus (please specify) <u>{{ $typeadverseevent->section11_input  ?? ''}}</u></td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section11 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J12 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J12</td>
                            <td>Post-Transfusion Infection: Bacteria (please specify) <u>{{ $typeadverseevent->section12_input  ?? ''}}</u></td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section12 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J13 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J13</td>
                            <td>Post-Transfusion Infection: Parasite (please specify) <u>{{ $typeadverseevent->section13_input  ?? ''}}</u></td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section13 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J14 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J14</td>
                            <td>Handling and storage error</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section14 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J15 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J15</td>
                            <td>Equipment related (e.g. faulty waterbath, transfusion set, etc)</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section15 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                        {{-- J16 --}}
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">J16</td>
                            <td>Others, please specify: {{ $typeadverseevent->section16_input  ?? ''}}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                {{ isset($typeadverseevent) && $typeadverseevent->section16 ? '✓' : '' }}
                            </td>
                            <td>*</td>
                        </tr>
                    </tbody>
                </table>
                <b style="display: block; margin-top: 10px">* Please send detailed report for all transfusion reaction except for FNHTR & mild allergy. </b>
            </div>
            <br>
            <div class="sectionk">
                <b style="display: block; margin-bottom: 5px">SECTION K: ERRORS AND INCIDENTS IN TRANSFUSION PROCESS [Tick all that apply (✓ ) ]</b>
                <br/>
                <b style="display: block; margin-bottom: 5px">K1. IBCT AND NEAR MISSES IN TRANSFUSION PROCESS.</b>
                <table class="table table-bordered" id="adverse-event-table">
                    <thead class="thead-light">
                        <tr>
                            <th style="min-width: 10px; text-align: center;  vertical-align: middle;">{{__('No')}}</th>
                            <th style="min-width: 270px; text-align: center;  vertical-align: middle;">{{__('CLASSIFICATION OF ACTUAL ERRORS / NEAR MISS')}}</th>
                            <th style="min-width: 10px; text-align: center;  vertical-align: middle;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="4" style="text-align: center; vertical-align: middle;">1.</td>
                            <td><b>ERROR IN WARD</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Sampling error at time of blood taking</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>b. Labelling error at time of blood taking</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>c. Cause cannot be determined</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="4" style="text-align: center; vertical-align: middle;">2.</td>
                            <td><b>TESTING (BLOOD BANK)</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Technical error</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>b. Transcription error</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>c. Blood issued meant for another patient</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td rowspan="3" style="text-align: center; vertical-align: middle;">3.</td>
                            <td><b>BLOOD ADMINISTRATION IN THE WARD</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>a. Failure to check the blood against patient’s full identity.</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>b. Others (please specify)</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <br/>
                <b style="display: block; margin-bottom: 5px">K2. OTHER INCIDENTS RELATED TO TRANSFUSION PROCESS. (Tick ✓ where applicable)</b>
                <table class="table table-bordered" id="adverse-event-table">
                    <tbody>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">a.</td>
                            <td>Sharing same ID (IC, UNHCR, Passport)</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">b.</td>
                            <td>Possible blood grouping error in other hospitals / clinics</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">c.</td>
                            <td>Error in previous admission</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">d.</td>
                            <td>Others (please specify)</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <br/>
                <b style="display: block; margin-bottom: 5px">K3. ERROR/ INCIDENT DISCOVERED (Tick ✓ where applicable)</b>
                <div>
                    <div class="row">
                        <div class="col-12">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                Pre-Transfusion
                           </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                During Transfusion
                           </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 15px;">
                                Post-Transfusion
                           </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            Please describe in detail how error was discovered (additional pages to be filled if necessary):
                        </div>
                    </div>
                    <div class="row">
                        <br><br><br><br>
                    </div>
                    <div class="row">
                        <div style="border: 2px solid black; padding: 10px;">
                            <b style="display:block; text-align: center;">Please send root cause analysis (RCA) report for all IBCTs and Near Misses.</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <br><br><br><br>
            </div>
        </div>
    </body>
</html>