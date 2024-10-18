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
                font-family: "Arimo", sans-serif !important;
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
            <div class="header" style="text-align: center; background-color: black; color: white; padding: 20px;">        
                <b style="font-weight: 900; font-size: 35px">REPORT ON SUSPECTED ADVERSE DRUG REACTIONS</b><br>
                <b style="font-size: 21px">NATIONAL CENTRE FOR ADVERSE DRUG REACTIONS MONITORING</b><br>
                <i>Email: fv@bpfk.gov.my &nbsp&nbsp&nbspWebsite: fv@bpfk.gov.my &nbsp&nbsp&nbspTel: 03-7883 5550 &nbsp&nbsp&nbspFax: 03-7956 7151</i>
            </div>
            <div class="information" style="border: 1px solid black; border-top: none; padding: 15px;">
                <p>
                    (Please report <b>all</b> suspected adverse drug reactions including those for vaccines, cosmetics and traditional products. Do not hesitate to report if some details are not known.
                    <b>Mandatory fields</b> are marked with *, but please give as much other information as you can.
                    Identities of Reporter, Patient and Institution will remain <b>Confidential</b>.)
                </p>
                <p>REPORT No. (for official use only):</p>
            </div>
            <div class="patient">
                <div class="management">
                    <div style="border: 1px solid black; padding: 0;">
                        <div style="background-color: black; padding: 5px; border-bottom: 1px solid black; color: white;">
                            <b>PATIENT INFORMATION</b>
                        </div>
                        <div class="row" style="padding: 5px">
                            <div class="col-md-2" style="font-size: 15px">
                                I.C. No. / R/N / Initials
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Age
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Gender <i>(please tick)</i>
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Wt (kg)
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Ethnic Group
                            </div>
                            <div class="col-md-2">
                                <i style="font-size: 15px">Please tick (if applicable):</i>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 5px 5px 5px">
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="age" name="age">
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="male" id="gender" name="gender"/>
                                            <label class="form-check-label" for="male" style="font-size: 15px">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="female" id="gender" name="gender"/>
                                            <label class="form-check-label" for="female" style="font-size: 15px">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="weight" name="weight">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="ethnic" name="ethnic">
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="initial" id="report" name="report"/>
                                            <label class="form-check-label" for="initial" style="font-size: 15px">
                                                Initial Report
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                                            <label class="form-check-label" for="followup" style="font-size: 15px">
                                                Follow-up Report
                                            </label>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="patient">
                <div class="management">
                    <div class="description" style="border: 1px solid black; padding: 0;">
                        <div style="background-color: black; padding: 5px; border-bottom: 1px solid black; color: white;">
                            <b>ADVERSE REACTION DESCRIPTION</b> (inc. sequence of adverse events, details of rechallenge, interactions)
                        </div>
                        <div class="row" style="padding: 50px">
                            
                        </div>
                    </div>
                    <div class="reactiontime" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-2" style="font-size: 15px">
                                Time to onset of reaction :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber">
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Date start of reaction :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber">
                            </div>
                            <div class="col-md-2" style="font-size: 15px">
                                Date end of reaction :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber">
                            </div>
                        </div>
                    </div>
                    <div class="reducedose" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-5 style="font-size: 15px">
                                Reaction subsided after stopping drug / reducing dose :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    No
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    N/A (not reintroduced)
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                        </div>
                    </div>
                    <div class="reintroducing" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-5 style="font-size: 15px">
                                Reaction reappeared after reintroducing drug :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    No
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    N/A (not reintroduced)
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                        </div>
                    </div>
                    <div class="extent" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-3 style="font-size: 15px">
                                Extent of reaction :
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Mild
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Moderate
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Severe
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                        </div>
                    </div>
                    <div class="seriousness" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-2 style="font-size: 15px">
                                Seriousness of reaction :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Life threatening
                                </label>
                            </div>
                            <div class="col-md-1">
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Caused or prolonged hospitalisation
                                </label>
                            </div>
                            <div class="col-md-1">
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Caused disability or incapacity
                                </label>
                            </div>
                            <div class="col-md-1" >
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Caused birth defect
                                </label>
                            </div>
                            <div class="col-md-1" >
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    N/A(not serious)
                                </label>
                            </div>
                            <div class="col-md-1" >
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                        </div>
                    </div>
                    <div class="actiontaken" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-4 style="font-size: 15px">
                                Treatment of adverse reaction & action taken :
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber">
                            </div>
                        </div>
                    </div>
                    <div class="extent" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-1 style="font-size: 15px">
                                Outcome :
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Recovered fully
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Recovering
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Not recovered
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-1" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Fatal:
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Date & Cause of death :
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="extent" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-3 style="font-size: 15px">
                                Drug-Reaction Relationship :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Certain
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Probable
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Possible
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Unlikely
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 15px">
                                    Unclassifiable:
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="report" name="report"/>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="suspecteddrug">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <b>Suspected Drug :</b>
                            </div>
                        </div>
                        <div class="row">
                            <table class="table table-bordered" id="suspecteddrug-table">
                                <thead style="background-color: black; color: white;">
                                    <tr>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Product / Generic Name')}}</th>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Dose & Frequency Given')}}</th>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('MAL and Batch No.')}}</th>
                                        <th style="min-width: 200px; text-align: center; vertical-align: middle;" colspan="2">{{__('Therapy Dates')}}</th>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Indication')}}</th>
                                    </tr>
                                    <tr>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;">{{__('Start')}}</th>
                                        <th style="min-width: 100px; text-align: center; vertical-align: middle;">{{__('Stop')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>                            
                        </div>
                        <div class="suspecteddrug">
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <b>Concomitant Drug</b> <i>(please state ‘NIL’ if none)</i> :
                                </div>
                            </div>
                            <div class="row">
                                <table class="table table-bordered" id="suspecteddrug-table">
                                    <thead style="background-color: black; color: white;">
                                        <tr>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Product / Generic Name')}}</th>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Dose & Frequency Given')}}</th>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('MAL and Batch No.')}}</th>
                                            <th style="min-width: 200px; text-align: center; vertical-align: middle;" colspan="2">{{__('Therapy Dates')}}</th>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;" rowspan="2">{{__('Indication')}}</th>
                                        </tr>
                                        <tr>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;">{{__('Start')}}</th>
                                            <th style="min-width: 100px; text-align: center; vertical-align: middle;">{{__('Stop')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>                            
                            </div>
                        </div>
                        <div class="relevantinvestigation mb-2">
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <i>(Please attach additional sheets if necessary)</i>
                                </div>
                            </div>
                            <div class="row">

                                <div class="description col-md-12" style="border: 1px solid black; padding: 0;">
                                    <table class="table table-bordered" id="suspecteddrug-table">
                                        <thead style="background-color: black; color: white;">
                                            <tr>
                                                <th style="min-width: 100px; text-align: center; vertical-align: middle;">{{__('Relevant Investigations / Laboratory Data')}}</th>
                                                <th style="min-width: 100px; text-align: center; vertical-align: middle;">
                                                    <p><b>{{__('Relevant Medical History')}} </b></p>
                                                    <p>{{__('(e.g.: hepatic / renal dysfunction, allergies, pregnancy status, etc)')}} </p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="reactiontime" style="border: 1px solid black; padding: 0;">
                                    <div style="background-color: black; padding: 5px; border-bottom: 1px solid black; color: white;">
                                        <b>PATIENT INFORMATION</b>
                                    </div>
                                    <div class="row" style="padding: 5px">
                                        <div class="row">
                                            <div class="col-md-3">
                                                Name :
                                            </div>
                                            <div class="col-md-3">
                                                
                                            </div>
                                            <div class="col-md-3">
                                                Institution Name & Address :
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                Designation :
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                            <div class="col-md-3">
                                                Tel No :
                                            </div>
                                            <div class="col-md-3">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                Email Address :
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-2">
                                                Date of Report :
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-2">
                                                Signature :
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="footer" style="text-align: center">
                            Submission of a report does not constitute an admission that medical personnel or the products caused or contributed to the reaction. Thank you for reporting.
                        </div>
                    </div>
                </div>
            </div>         
        </div>
    </body>
</html>