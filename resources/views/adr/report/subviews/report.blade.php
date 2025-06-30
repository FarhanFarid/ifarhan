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
                <b style="font-weight: 900; font-size: 28px; letter-spacing: -2px;">REPORT ON SUSPECTED ADVERSE DRUG REACTIONS</b><br>
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
                            <div class="col-md-2" style="font-size: 11px">
                                I.C. No. / R/N / Initials
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Age
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Gender <i>(please tick)</i>
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Wt (kg)
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Ethnic Group
                            </div>
                            <div class="col-md-2">
                                <i style="font-size: 11px">Please tick (if applicable):</i>
                            </div>
                        </div>
                        <div class="row" style="padding: 0px 5px 5px 5px">
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber" value="{{ $patdemo['pnric']  ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="age" name="age" value="{{ $patdemo['ageY']  ?? '' }} Years {{ $patdemo['ageM']  ?? '' }} Months">
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="male" id="gender" name="gender" {{ isset($patdemo) && $patdemo['pgender'] == 'Male' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="male" style="font-size: 11px">
                                                Male
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="female" id="gender" name="gender" {{ isset($patdemo) && $patdemo['pgender'] == 'Female' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="female" style="font-size: 11px">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="weight" name="weight" value="{{ isset($report) ? optional($report->descriptions)->weight : '' }}">
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="ethnic" name="ethnic" value="{{ $patdemo['prace']  ?? '' }}">
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="initial" id="report" name="report" {{ isset($report) && $report->report == 'initial' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="initial" style="font-size: 11px">
                                                Initial Report
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="followup" id="report" name="report" {{ isset($report) && $report->report == 'followup' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="followup" style="font-size: 11px">
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
                    <div class="description" style="border: 1px solid black; padding: 0; width: 100%; height: 150px; display: flex; flex-direction: column;">
                        <div style="background-color: black; padding: 5px; border-bottom: 1px solid black; color: white;">
                            <b>ADVERSE REACTION DESCRIPTION</b> (inc. sequence of adverse events, details of rechallenge, interactions)
                        </div>
                        <div class="content" style="padding: 10px; overflow-y: auto; flex-grow: 1;">
                            {{ $report->descriptions->description ?? '' }}
                        </div>
                    </div>
                    <div class="reactiontime" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-2" style="font-size: 11px">
                                Time to onset of reaction :
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                <b>
                                    {{ $report?->descriptions?->datevalue ?? '' }} &nbsp;
                                    {{ $report?->descriptions?->datetype ?? '' }}
                                </b>
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Date start of reaction :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber" value="{{ isset($report->descriptions) && $report->descriptions->date_start ? \Carbon\Carbon::parse($report->descriptions->date_start)->format('d/m/Y') : '' }}">
                            </div>
                            <div class="col-md-2" style="font-size: 11px">
                                Date end of reaction :
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber" value="{{ isset($report->descriptions) && $report->descriptions->date_end ? \Carbon\Carbon::parse($report->descriptions->date_end)->format('d/m/Y') : '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="reducedose" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-3" style="font-size: 11px">
                                Reaction subsided after stopping drug / reducing dose :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_subside" name="react_subside"  {{ isset($report) && $report->descriptions->react_subside == 'yes' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    No
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_subside" name="react_subside"  {{ isset($report) && $report->descriptions->react_subside == 'no' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_subside" name="react_subside"  {{ isset($report) && $report->descriptions->react_subside == 'unknown' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-5">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    N/A (drug continued)
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_subside" name="react_subside"  {{ isset($report) && $report->descriptions->react_subside == 'na' ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    <div class="reintroducing" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-3" style="font-size: 11px">
                                Reaction reappeared after reintroducing drug :
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Yes
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_reappear" name="react_reappear" {{ isset($report) && $report->descriptions->react_reappear == 'yes' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-1">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    No
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_reappear" name="react_reappear" {{ isset($report) && $report->descriptions->react_reappear == 'no' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_reappear" name="react_reappear" {{ isset($report) && $report->descriptions->react_reappear == 'unknown' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-5">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    N/A (not reintroduced)
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="react_reappear" name="react_reappear" {{ isset($report) && $report->descriptions->react_reappear == 'na' ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    <div class="extent" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-3" style="font-size: 11px">
                                Extent of reaction :
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Mild
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'mild' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Moderate
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'moderate' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Severe
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'severe' ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    <div class="seriousness" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-2" style="font-size: 11px">
                                Seriousness of reaction :
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Life threatening
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'threatening' ? 'checked' : '' }}/>
                            </div>

                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Caused or prolonged hospitalisation
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'hospitalisation' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Caused disability or incapacity
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'disability' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Caused birth defect
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'defect' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    N/A(not serious)
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'na' ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    <div class="actiontaken" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-4" style="font-size: 11px">
                                Treatment of adverse reaction & action taken :
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-sm" type="checkbox" id="icnumber" name="icnumber" value="{{ $report->descriptions->treatment  ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="outcome" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-1" style="font-size: 11px">
                                Outcome:
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Recovered fully
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'fullyrecovered' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Recovering
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'notrecovered' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Not recovered
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'recovering' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Unknown
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'unknown' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-1" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Fatal:
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'fatal' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Date & Cause of death : {{ $report->descriptions->fatal_cause  ?? ''}} ({{ isset($report->descriptions) && $report->descriptions->fatal_date ? \Carbon\Carbon::parse($report->descriptions->fatal_date)->format('d/m/Y') : '' }})
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="relationship" style="border: 1px solid black; padding: 0;">
                        <div class="row" style="padding: 8px">
                            <div class="col-md-2" style="font-size: 11px">
                                Drug-Reaction Relationship :
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Certain
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'certain' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2">
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Probable
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'probable' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Possible
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'possible' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Unlikely
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'unlikely' ? 'checked' : '' }}/>
                            </div>
                            <div class="col-md-2" >
                                <label class="form-check-label" for="followup" style="font-size: 11px">
                                    Unclassifiable:
                                </label>
                                <input class="form-check-input" type="radio" value="followup" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'unclassifiable' ? 'checked' : '' }}/>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="suspecteddrug" style="page-break-before: always;">
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
                                    @if($report != null && $report->susdrugs != null)
                                        <tr>
                                            <td>{{$report->susdrugs->product}}</td>
                                            <td>{{$report->susdrugs->dose}} ({{$report->susdrugs->frequency}})</td>
                                            <td>{{$report->susdrugs->batchno}}</td>
                                            <td>{{ $report->susdrugs->start_date ? \Carbon\Carbon::parse($report->susdrugs->start_date)->format('d/m/Y') : '' }}</td>
                                            <td>{{ $report->susdrugs->stop_date ? \Carbon\Carbon::parse($report->susdrugs->stop_date)->format('d/m/Y') : '' }}</td>
                                            <td>{{$report->susdrugs->indication}}</td>
                                        </tr>
                                    @else
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
                                    @endif
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
                                        @if($report != null && $report->concodrugs != null)
                                            @foreach ( $report->concodrugs as $drug)
                                                <tr>
                                                    <td>{{$drug->product}}</td>
                                                    <td>{{$drug->dose}}</td>
                                                    <td>{{$drug->batchno}}</td>
                                                    <td>{{ $drug->start_date ? \Carbon\Carbon::parse($drug->start_date)->format('d/m/Y') : '' }}</td>
                                                    <td>{{ $drug->stop_date ? \Carbon\Carbon::parse($drug->stop_date)->format('d/m/Y') : '' }}</td>
                                                    <td>{{$drug->indication}}</td>
                                                </tr>
                                            @endforeach
                                        @else
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
                                        @endif
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
                                            <tr>
                                                <td>{!! $report->descriptions->relevantinvest ?? '' !!}</td>
                                                <td>{!! $report->descriptions->medicalhistory ?? '' !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="reactiontime" style="border: 1px solid black; padding: 0;">
                                    <div style="background-color: black; padding: 5px; border-bottom: 1px solid black; color: white;">
                                        <b>REPORTER DETAILS</b>
                                    </div>
                                    <div class="row" style="padding: 5px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                Name : {{ $report->createdBy->name  ?? ''}}
                                            </div>
                                            {{-- <div class="col-md-3">
                                                
                                            </div> --}}
                                            <div class="col-md-8">
                                                Institution Name & Address : Institut Jantung Negara , No 145 Jalan Tun Razak, Kuala Lumpur, 50400, Malaysia.
                                            </div>
                                            {{-- <div class="col-md-3">
                                                
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Designation : {{ $detail->position  ?? ''}}
                                            </div>
                                            {{-- <div class="col-md-3">
                                                
                                            </div> --}}
                                            <div class="col-md-8">
                                                Tel No : +603 2617 8200
                                            </div>
                                            {{-- <div class="col-md-3">
                                                
                                            </div> --}}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Email Address : {{ $detail->mail  ?? ''}}
                                            </div>
                                            {{-- <div class="col-md-2">
                                                
                                            </div> --}}
                                            <div class="col-md-4">
                                                Date of Report : {{ isset($report) && $report->created_at ? \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') : '' }}
                                            </div>
                                            {{-- <div class="col-md-2">
                                               
                                            </div> --}}
                                            <div class="col-md-4">
                                                Signature :
                                            </div>
                                            {{-- <div class="col-md-2">

                                            </div> --}}
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