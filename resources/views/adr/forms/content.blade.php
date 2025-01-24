<form id="adrform">
    @csrf
    <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Adverse Reaction Description</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-3">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label for="extent" class="form-check-label mb-2" style="color: black;">Please tick (if applicable)</label>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="initial" id="report" name="report" {{ isset($report) && $report->report == 'initial' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Initial Report
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="followup" id="report" name="report" {{ isset($report) && $report->report == 'followup' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Follow-up Report
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <label for="desc" class="form-check-label" style="color: black;">Description</label>
                                <textarea class="form-control" name="desc" id="desc">{{ $details->description  ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Time to onset of reaction</label>
                                <input class="form-control" type="time" name="onsettime" id="onsettime" value="{{ isset($details) && $details->onset_at ? \Carbon\Carbon::parse($details->onset_at)->format('H:i') : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date start of reaction</label>
                                <input class="form-control" type="date" name="reactstart" id="reactstart" value="{{ isset($details) && $details->onset_at ? \Carbon\Carbon::parse($details->onset_at)->format('Y-m-d') : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date end of reaction</label>
                                <input class="form-control" type="date" name="reactstop" id="reactstop" value="{{ isset($report->descriptions) && $report->descriptions->date_end ? \Carbon\Carbon::parse($report->descriptions->date_end)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Reaction subsided after stopping drug / reducing dose :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="reducedose" name="reducedose" {{ isset($report) && $report->descriptions->react_subside == 'yes' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="no" id="reducedose" name="reducedose" {{ isset($report) && $report->descriptions->react_subside == 'no' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="reducedose" name="reducedose" {{ isset($report) && $report->descriptions->react_subside == 'unknown' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="reducedose" name="reducedose" {{ isset($report) && $report->descriptions->react_subside == 'na' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (drug continued)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Reaction reappeared after reintroducing drug :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="reintroduce" name="reintroduce" {{ isset($report) && $report->descriptions->react_reappear == 'yes' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="no" id="reintroduce" name="reintroduce" {{ isset($report) && $report->descriptions->react_reappear == 'no' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="reintroduce" name="reintroduce" {{ isset($report) && $report->descriptions->react_reappear == 'unknown' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="reintroduce" name="reintroduce" {{ isset($report) && $report->descriptions->react_reappear == 'na' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (drug continued)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="seriousness" class="form-check-label mb-2" style="color: black;">Seriousness of reaction :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="threatening" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'threatening' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Life threatening
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="hospitalisation" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'hospitalisation' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused or prolonged hospitalisation
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="disability" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'disability' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused disability or incapacity
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="defect" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'defect' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused birth defect
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="seriousness" name="seriousness" {{ isset($report) && $report->descriptions->seriousness == 'na' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (not serious)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="extent" class="form-check-label mb-2" style="color: black;">Extent of reaction :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="mild" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'mild' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Mild
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="moderate" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'moderate' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Moderate
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="severe" id="extent" name="extent" {{ isset($report) && $report->descriptions->extent == 'severe' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Severe
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="treatment" class="form-check-label mb-1" style="color: black;">Treatment of adverse reaction & action taken :</label>
                                <textarea class="form-control" name="treatment" id="treatment" style="min-height: 100px;">{{ $report->descriptions->treatment  ?? ''}}</textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="relationship" class="form-check-label mb-2" style="color: black;">Drug-Reaction Relationship :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="certain" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'certain' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Certain
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="probable" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'probable' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Probable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="possible" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'possible' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Possible 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unlikely" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'unlikely' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unlikely
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unclassifiable" id="relationship" name="relationship" {{ isset($report) && $report->descriptions->relationship == 'unclassifiable' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unclassifiable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="outcome" class="form-check-label mb-2" style="color: black;">Outcome :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="fullyrecovered" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'fullyrecovered' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovered fully
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="notrecovered" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'notrecovered' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Not recovered
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="recovering" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'recovering' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovering 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'unknown' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="fatal" id="outcome" name="outcome" {{ isset($report) && $report->descriptions->outcome == 'fatal' ? 'checked' : '' }}/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Fatal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5" id="fataldetails" style="{{ isset($report) && $report->descriptions->outcome == 'fatal'  ? '' : 'display: none;' }}">
                            <div class="col-md-7">
                                
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="indication" class="form-check-label" style="color: black;">Date :</label>
                                        <input class="form-control form-control-sm" type="date" name="fataldate" id="fataldate" value="{{ isset($report->descriptions) && $report->descriptions->fatal_date ? \Carbon\Carbon::parse($report->descriptions->fatal_date)->format('Y-m-d') : '' }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="indication" class="form-check-label" style="color: black;">Cause of death :</label>
                                        <input class="form-control form-control-sm" type="text" name="causeofdeath" id="causeofdeath" value="{{ $report->descriptions->fatal_cause  ?? ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="treatment" class="form-check-label mb-1" style="color: black;">Relevant Investigation / Lab Data :</label>
                                {{-- <textarea class="form-control" name="relevantinvestigation" id="relevantinvestigation" style="min-height: 100px;">{{ $report->descriptions->relevantinvest  ?? ''}}</textarea> --}}
                                <textarea name="relevantinvestigation" id="relevantinvestigation">
                                    @if ($report == null)

                                        @if(!empty($renal))
                                            <p>
                                                <strong>Renal profile</strong><br>
                                                
                                                @if(isset($renal["Hemolytic Index (Hi)"])) 
                                                    Hi - {{$renal["Hemolytic Index (Hi)"]}} 
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Icteric Index (I)"])) 
                                                    I - {{$renal["Icteric Index (I)"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Creatinine"])) 
                                                    Creatinine - {{$renal["Creatinine"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["eGFR MDRD"])) 
                                                    eGFR MDRD - {{$renal["eGFR MDRD"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Potassium"])) 
                                                    Potassium - {{$renal["Potassium"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Sodium"])) 
                                                    Sodium - {{$renal["Sodium"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Urates ( Uric acid )"])) 
                                                    Urates - {{$renal["Urates ( Uric acid )"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($renal["Urea"])) 
                                                    Urea - {{$renal["Urea"]}}
                                                @endif
                                            </p>
                                        @endif
                                        @if(!empty($fbc))
                                            <p>
                                                <strong>Full Blood Count</strong><br>

                                                @if(isset($fbc["White Blood Count"])) 
                                                    WBC - {{$fbc["White Blood Count"]}} 
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Red Blood Cell Count"])) 
                                                    RBC - {{$fbc["Red Blood Cell Count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Haemoglobin"])) 
                                                    Haemoglobin - {{$fbc["Haemoglobin"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["P.C. V. ( Haematocrit)"])) 
                                                    Haematocrit - {{$fbc["P.C. V. ( Haematocrit)"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["M. C.H."])) 
                                                    M. C.H - {{$fbc["M. C.H."]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Mean Cell Volume"])) 
                                                    Mean Cell - {{$fbc["Mean Cell Volume"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["M.C. H. C"])) 
                                                    M.C.H.C  - {{$fbc["M.C. H. C"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Neutrophil  count"])) 
                                                    Neutrophil - {{$fbc["Neutrophil  count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Neutrophil absolute count"])) 
                                                    Neutrophil absolute - {{$fbc["Neutrophil absolute count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Lymphocyte count"])) 
                                                    Lymphocyte - {{$fbc["Lymphocyte count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Lymphocyte absolute count"])) 
                                                    Lymphocyte absolute - {{$fbc["Lymphocyte absolute count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Monocyte count"])) 
                                                    Monocyte - {{$fbc["Monocyte count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Eosinophil Count"])) 
                                                    Eosinophil - {{$fbc["Eosinophil Count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Basophil count"])) 
                                                    Basophil - {{$fbc["Basophil count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Platelet Count"])) 
                                                    Platelet - {{$fbc["Platelet Count"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Nucleated RBC"])) 
                                                    Nucleated RBC - {{$fbc["Nucleated RBC"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($fbc["Neutrophil-lymphocyte ratio"])) 
                                                    Neutrophil-lymphocyte ratio - {{$fbc["Neutrophil-lymphocyte ratio"]}}
                                                @endif
                                            </p>
                                        @endif
                                        @if(!empty($lft))
                                            <p>
                                                <strong>Liver Function</strong><br>

                                                @if(isset($lft["Lipemic Index (L)"])) 
                                                    L - {{$lft["Lipemic Index (L)"]}} 
                                                @endif
                                                , &nbsp;
                                                @if(isset($lft["Hemolytic Index (Hi)"])) 
                                                    Hi - {{$lft["Hemolytic Index (Hi)"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($lft["Albumin"])) 
                                                    Albumin - {{$lft["Albumin"]}}
                                                @endif
                                                , &nbsp;
                                                @if(isset($lft["Alkaline Phosphatase ( ALP )"])) 
                                                    ALP - {{$lft["Alkaline Phosphatase ( ALP )"]}}
                                                @endif
                                                @if(isset($lft["Alanine Aminotransferase ( ALT )"])) 
                                                    ALT - {{$lft["Alanine Aminotransferase ( ALT )"]}}
                                                @endif
                                                @if(isset($lft["A/G Ratio"])) 
                                                    A/G Ratio - {{$lft["A/G Ratio"]}}
                                                @endif
                                                @if(isset($lft["Bilirubin, total"])) 
                                                    Bilirubin - {{$lft["Bilirubin, total"]}}
                                                @endif
                                                @if(isset($lft["Protein"])) 
                                                    Protein - {{$lft["Protein"]}}
                                                @endif
                                                @if(isset($lft["Globulin"])) 
                                                    Globulin - {{$lft["Globulin"]}}
                                                @endif
                                            </p>
                                        @endif
                                        @if(!empty($inr))
                                            <p>
                                                <strong>INR</strong><br>

                                                @if(isset($inr["I. N. R. "])) 
                                                    I.N.R - {{$inr["I. N. R. "]}} 
                                                @endif
                                                , &nbsp;
                                                @if(isset($inr["Prothrombin Time "])) 
                                                    Prothrombin Time - {{$inr["Prothrombin Time "]}}
                                                @endif
                                            </p>
                                        @endif

                                    @else
                                        {{ $report->descriptions->relevantinvest }}
                                    @endif
                                </textarea>
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="treatment" class="form-check-label mb-1" style="color: black;">Relevant Medical History :</label>
                                <textarea class="form-control" name="relevantmh" id="relevantmh" style="min-height: 100px;">{{ $report->descriptions->medicalhistory  ?? ''}}</textarea>
                            </div> --}}
                            <div class="col-md-4">
                                <label for="treatment" class="form-check-label mb-1" style="color: black;">Relevant Medical History :</label>
                                <textarea name="relevantmh" id="relevantmh">
                                    @if ($report == null)
                                        <p>
                                            <strong>Allergy</strong><br>
                                            @foreach ($allergy as $all )
                                                @if ($all["substance"] == "")
                                                    -&nbsp;{{$all["freetxtall"]}} @if ($all["commment"] != "") ({{$all["commment"]}}) @endif               
                                                @else
                                                    -&nbsp;{{$all["substance"]}} @if ($all["commment"] != "") ({{$all["commment"]}}) @endif               
                                                @endif
                                            @endforeach
                                            <br>
                                        </p>
                                    @else
                                        {{ $report->descriptions->medicalhistory}}
                                    @endif
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 8px !important;">
                <div class="d-flex align-items-center justify-content-between px-3">
                    <h4 class="text-center w-100" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Suspected Drug</h4>
                    {{-- <button class="btn btn-light-success btn-sm add-drug" type="button" style="position: absolute; right: 2rem;">+</button> --}}
                </div>
            </div>
            
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <table class="table table-bordered" id="suspecteddrug-table">
                        <thead style="background-color: black;">
                            <tr>
                                {{-- <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;"></th> --}}
                                <th style="min-width: 150px; text-align: center; vertical-align: middle; color: white !important;">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 150px; text-align: center; vertical-align: middle; color: white !important;">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Stop')}}</th>
                                <th style="min-width: 200px; text-align: center; vertical-align: middle; color: white !important;">{{__('Indication')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-control form-control-sm" type="text" name="susdrugname" id="susdrugname" value="{{ $details->drugname ?? $latestDrug['Itemdesc'] ?? '' }}" readonly>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input class="form-control form-control-sm" type="text" name="susdose" id="susdose" value="{{ $report->susdrugs->dose ?? $latestDrug['dosageqty'] ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control form-control-sm" type="text" name="susfreq" id="susfreq" value="{{ $report->susdrugs->frequency ?? $latestDrug['freqcode'] ?? '' }}">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="text" name="susbatchno" id="susbatchno" value="{{ $report->susdrugs->batchno ?? $latestDrug['prescNum'] ?? '' }}">
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="date" name="susstartdate" id="susstartdate" value="{{ isset($report->susdrugs) && $report->susdrugs->start_date ? \Carbon\Carbon::parse($report->susdrugs->start_date)->format('Y-m-d') : (isset($latestDrug['startdate']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $latestDrug['startdate'])->format('Y-m-d') : '') }}">
                                </td>
                                <td>
                                    <input class="form-control form-control-sm" type="date" name="susstopdate" id="susstopdate" value="{{ isset($report->susdrugs) && $report->susdrugs->stop_date ? \Carbon\Carbon::parse($report->susdrugs->stop_date)->format('Y-m-d') : '' }}">
                                </td>
                                <td>
                                    <textarea class="form-control" name="susindication" id="susindication">{{ $report->susdrugs->indication ?? '' }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 8px !important;">
                    <div class="d-flex align-items-center justify-content-between px-3">
                        <h4 class="text-center w-100" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Concomitant Drug</h4>
                    {{-- <button class="btn btn-light-success btn-sm add-drug" type="button" style="position: absolute; right: 2rem;">+</button> --}}
                </div>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <table class="table table-bordered" id="concodrug-table">
                        <thead style="background-color: black;">
                            <tr>
                                <th style="min-width: 50px; text-align: center; vertical-align: middle; color: white !important;"></th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Stop')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Indication')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $medhistory as $drug)
                                <tr>
                                    <td style="min-width: 50px; text-align: center; vertical-align: middle;">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-md-3 d-flex justify-content-center">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$drug['Itemdesc']}}</td>
                                    <td>{{$drug['dosageqty']}} ({{$drug['freqcode']}})</td>
                                    <td>{{$drug['prescNum']}}</td>
                                    <td>{{$drug['startdate']}}</td>
                                    <td>{{$drug['startdate']}}</td>
                                    <td>N/A</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
<div style="text-align: center;">
    <button type="button" class="btn btn-primary font-weight-bold save-adr mt-2">{{__('SAVE')}}</button>
    <button type="button" class="btn btn-dark font-weight-bold clear-adr mt-2">{{__('CLEAR')}}</button>
</div>

@push('script')
    <script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('theme/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script type="text/javascript">
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var concoDrugs = @json($report->concodrugs ?? []);
        
        function callPatientInfo()
        {
            $.ajax({
                url: "{{route('main.patientinfo')}}?{!! $url !!}",
                type: "GET",
                dataType: "json",
                data: {
                    epsdno: urlParams.get(paramEpsdNo)
                },
                success: function(data) {
                    var data = data.data;
                    var html = '';
                    
                    $('#patientinfoname').html(data.name);
                    $('#patientinfomrn').html(data.mrn);
                    $('#patientinfodob').html(data.dob);
                    $('#patientinfoage').html(data.age);
                    $('#patientinfosex').html(data.sex);
                    $('#patientinfoepsnum').html(data.epsdno);
                    $('#patientinfoepsnumdate').html(data.epsddate);
                    $('#patientinfobloodtype').html(data.bloodtype);
                    $('#patientinfoallergy').html(data.allergy);
                    $('#patientinfopayor').html(data.payor);
                    $('#patientinfoweight').html(data.weight);
                    $('#patientinfoheight').html(data.height);
                    $('#patientinfobmi').html(data.bmi);
                    $('#patientinfobsa').html(data.bsa);
                }
            });
        }
    
        callPatientInfo()
    
        setInterval(callPatientInfo, 60*1000)
    </script>
    <script>
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var epsdno = urlParams.get(paramEpsdNo);
        
    </script>
    <script src="{{ asset('js/adr/form.js') }}"></script>
@endpush