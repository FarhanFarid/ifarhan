@extends('layouts.iblood.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/bloodpack.png') }}" class="w-50px" style="position: absolute; top: -13px; left: -15px; transform: rotate(20deg);">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">BLOOD TRANSFUSION</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PATIENT DETAILS</h4>
            </div>
            <div class="card-body">
                @include('layouts.iblood.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;"> BLOOD TRANSFUSION BARCODE</h4>
            </div>
            <div class="card-body">
                <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                    <form id="#">
                        @csrf
                        <div class="row m-5">
                            <div class="col-md-4">
                                <div class="row p-1">
                                    <b>Lab Number</b>
                                </div>
                                <div class="row p-1">
                                    <input type="text" class="form-control" id="labno" name="labno" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row p-1">
                                    <b>Bag Number</b>
                                </div>
                                <div class="row p-1">
                                    <input type="text" class="form-control" id="bagsno" name="bagsno" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row p-1">
                                    <b>Patient Barcode</b>
                                </div>
                                <div class="row p-1">
                                    <input type="number" class="form-control" id="mrn" name="mrn" required/>
                                </div>
                                <div class="row p-1">
                                    <input type="hidden" class="form-control" id="bagno" name="bagno" value="{{$bagno}}" readonly/>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="button" id="checkmatch" class="btn btn-primary btn-sm font-weight-bold mx-5 mb-5">{{__('MATCH')}}</button>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">BLOOD TRANSFUSION DETAILS</h4>
            </div>
            <br/>
            <div class="card-body">
                <div class="table-responsive" id="ebmAdministerReceive">

                </div>
            </div>
        </div>
    </div>

    @include('iblood.transfuse.subviews.verify')

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
    <script>
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var epsdno = urlParams.get(paramEpsdNo);
        // global app configuration object
        var config = {
                routes: {
                    blood :{
                        inventory : {
                            index: "{{ route('blood.inventory.index') }}?{!! $url !!}",
                        },
                        transfusion : {
                            check: "{{ route('blood.transfusion.detail') }}?{!! $url !!}",
                            submit: "{{ route('blood.transfusion.submit') }}?{!! $url !!}",
                        },
                    },         
                }
            };
    </script>
    <script src="{{ asset('js/iblood/transfusion.js') }}"></script>
@endpush