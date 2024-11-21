<form id="adrform">
    @csrf
    <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Patient Information</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-3">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Please tick (if applicable)</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Initial Report
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
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
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Adverse Reaction Description</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-3">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label for="indication" class="form-check-label" style="color: black;">Description</label>
                                <textarea class="form-control" name="desc" id="desc"></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Time to onset of reaction</label>
                                <input class="form-control" type="time" name="onsettime" id="onsettime">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date start of reaction</label>
                                <input class="form-control" type="date" name="reactstart" id="reactstart">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date end of reaction</label>
                                <input class="form-control" type="date" name="reactstop" id="reactstop">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Reaction subsided after stopping drug / reducing dose :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="reducedose" name="reducedose"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="no" id="reducedose" name="reducedose"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="reducedose" name="reducedose"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="reducedose" name="reducedose"/>
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
                                            <input class="form-check-input" type="radio" value="yes" id="reintroduce" name="reintroduce"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="no" id="reintroduce" name="reintroduce"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="reintroduce" name="reintroduce"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="reintroduce" name="reintroduce"/>
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
                                            <input class="form-check-input" type="radio" value="threatening" id="seriousness" name="seriousness"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Life threatening
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="hospitalisation" id="seriousness" name="seriousness"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused or prolonged hospitalisation
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="disability" id="seriousness" name="seriousness"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused disability or incapacity
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="defect" id="seriousness" name="seriousness"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused birth defect
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="na" id="seriousness" name="seriousness"/>
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
                                            <input class="form-check-input" type="radio" value="mild" id="extent" name="extent"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Mild
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="moderate" id="extent" name="extent"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Moderate
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="severe" id="extent" name="extent"/>
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
                                <textarea class="form-control" name="treatment" id="treatment" style="min-height: 100px;"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="relationship" class="form-check-label mb-2" style="color: black;">Drug-Reaction Relationship :</label>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="certain" id="relationship" name="relationship"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Certain
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="probable" id="relationship" name="relationship"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Probable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="possible" id="relationship" name="relationship"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Possible 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unlikely" id="relationship" name="relationship"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unlikely
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unclassifiable" id="relationship" name="relationship"/>
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
                                            <input class="form-check-input" type="radio" value="fullyrecovered" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovered fully
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="notrecovered" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Not recovered
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="recovering" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovering 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="fatal" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Fatal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5" id="fataldetails">
                            <div class="col-md-7">
                                
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="indication" class="form-check-label" style="color: black;">Date :</label>
                                        <input class="form-control form-control-sm" type="date" name="matchdate" id="matchdate">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="indication" class="form-check-label" style="color: black;">Cause of death :</label>
                                        <input class="form-control form-control-sm" type="text" name="causeofdeath" id="causeofdeath">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">Suspected Drug</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <table class="table table-bordered" id="suspecteddrug-table">
                        <thead style="background-color: black;">
                            <tr>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2"></th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 200px; text-align: center; vertical-align: middle; color: white !important;" colspan="2">{{__('Therapy Dates')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Indication')}}</th>
                            </tr>
                            <tr>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Stop')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $medhistory as $history)
                                <tr>
                                    <td style="min-width: 100px; text-align: center; vertical-align: middle;"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" /></td>
                                    <td>{{$history['Itemdesc']}}</td>
                                    <td>{{$history['dosageqty']}} ({{$history['freqcode']}})</td>
                                    <td>{{$history['prescNum']}}</td>
                                    <td>{{$history['startdate']}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
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
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Product / Generic Name')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Dose & Frequency Given')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('MAL and Batch No.')}}</th>
                                <th style="min-width: 200px; text-align: center; vertical-align: middle; color: white !important;" colspan="2">{{__('Therapy Dates')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;" rowspan="2">{{__('Indication')}}</th>
                            </tr>
                            <tr>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Start')}}</th>
                                <th style="min-width: 100px; text-align: center; vertical-align: middle; color: white !important;">{{__('Stop')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
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