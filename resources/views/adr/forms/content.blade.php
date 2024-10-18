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
                                <label for="indication" class="form-check-label" style="color: black;">Weight (kg)</label>
                                <input type="text" class="form-control form-control-sm" id="indication" name="indication" value=""/>
                            </div>
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
                                <input class="form-control" type="datetime-local" name="matchdate" id="matchdate">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date start of reaction</label>
                                <input class="form-control" type="date" name="matchdate" id="matchdate">
                            </div>
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label" style="color: black;">Date end of reaction</label>
                                <input class="form-control" type="date" name="matchdate" id="matchdate">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Reaction subsided after stopping drug / reducing dose :</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (drug continued)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Reaction reappeared after reintroducing drug :</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (drug continued)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Extent of reaction :</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Mild
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Moderate
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Severe
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Seriousness of reaction :</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Life threatening
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused or prolonged hospitalisation
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused disability or incapacity
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Caused birth defect
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                N/A (not serious)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label for="indication" class="form-check-label" style="color: black;">Treatment of adverse reaction & action taken :</label>
                                <textarea class="form-control" name="desc" id="desc"></textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Outcome :</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="fullyrecovered" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovered fully
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="notrecovered" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Not recovered
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="recovering" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Recovering 
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="unknown" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unknown
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="fatal" id="outcome" name="outcome"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Fatal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="indication" class="form-check-label mb-2" style="color: black;">Drug-Reaction Relationship :</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Certain
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Probable
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Possible 
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unlikely
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="yes" id="preghistory" name="preghistory"/>
                                            <label class="form-check-label" for="bloodpatient">
                                                Unclassifiable
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5" id="fataldetails">
                            <div class="col-md-6">
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
                    <div class="row mb-5">
                        <div class="row mb-2">
                            <div class="d-flex justify-content-center">
                                <h5 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #797979;"><u>Blood Component</u></h5>
                            </div>
                        </div>
                    </div>
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