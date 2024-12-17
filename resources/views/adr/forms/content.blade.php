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
                                <textarea class="form-control" name="desc" id="desc">{{ $report->descriptions->description  ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Time to onset of reaction</label>
                                <input class="form-control" type="time" name="onsettime" id="onsettime" value="{{ isset($report->descriptions) && $report->descriptions->onsettime ? \Carbon\Carbon::parse($report->descriptions->onsettime)->format('H:i') : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date start of reaction</label>
                                <input class="form-control" type="date" name="reactstart" id="reactstart" value="{{ isset($report->descriptions) && $report->descriptions->date_start ? \Carbon\Carbon::parse($report->descriptions->date_start)->format('Y-m-d') : '' }}">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date end of reaction</label>
                                <input class="form-control" type="date" name="reactstop" id="reactstop" value="{{ isset($report->descriptions) && $report->descriptions->date_stop ? \Carbon\Carbon::parse($report->descriptions->date_stop)->format('Y-m-d') : '' }}">
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
                    </div>
                </div>
            </div>
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 8px !important;">
                <div class="d-flex align-items-center justify-content-between px-3">
                    <h4 class="text-center w-100" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Suspected Drug</h4>
                    <button class="btn btn-light-success btn-sm add-drug" type="button" style="position: absolute; right: 2rem;">+</button>
                </div>
            </div>
            
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <table class="table table-bordered" id="suspecteddrug-table">
                        <thead style="background-color: black;">
                            <tr>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;"></th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Stop')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Indication')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($report != null && $report->susdrugs != null)
                                @foreach ( $report->susdrugs as $drug)
                                    <tr>
                                        <td style="min-width: 100px; text-align: center; vertical-align: middle;">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-md-3 d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                                </div>
                                                <div class="col-md-3 d-flex justify-content-center">
                                                    <button class="badge btn-sm badge-light-danger remove-row">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$drug->product}}</td>
                                        <td>{{$drug->dose}}</td>
                                        <td>{{$drug->batchno}}</td>
                                        <td>{{ $drug->start_date ? \Carbon\Carbon::parse($drug->start_date)->format('d/m/Y') : '' }}</td>
                                        <td>{{ $drug->stop_date ? \Carbon\Carbon::parse($drug->stop_date)->format('d/m/Y') : '' }}</td>
                                        <td>{{$drug->indication}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Concomitant Drug</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <table class="table table-bordered" id="concodrug-table">
                        <thead style="background-color: black;">
                            <tr>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Therapy Stop')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Indication')}}</th>
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
                            @endif
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