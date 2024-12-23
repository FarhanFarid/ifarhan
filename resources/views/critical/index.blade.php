@extends('layouts.clr.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/clr-logo.png') }}" class="w-55px" style="position: absolute; top: -20px; left: -20px;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">CRITICAL LAB RESULT</h4>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PATIENT DETAILS</h4>
            </div>
            <div class="card-body">
                @include('layouts.adr.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 1</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Notifier Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Action Taken/Remarks :</b> 
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Lab Result No :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Staff Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Tests Item :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Called Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Entered Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 2</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Notifier Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Doctor :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Acknowledged By :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Action Taken/Remarks :</b> 
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Location :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Called Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Entered Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 3</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Acknowledged By :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Action Taken/Remarks :</b> 
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Notifier Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Acknowledged Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
@endpush