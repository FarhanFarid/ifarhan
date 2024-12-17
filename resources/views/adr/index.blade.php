@extends('layouts.adr.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/adr-logo.png') }}" class="w-45px" style="position: absolute; top: -13px; left: -10px;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">ADVERSE DRUG REACTION</h4>
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
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <div class="row m-3">
                    <div class="col-md-10">
                        <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">REACTION ASSESSMENT</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="add" id="batchlist-table_add">
                            <button class="btn btn-primary btn-sm btn-block gen-report" type="button" style="width: 80% !important;">GENERATE PDF</button>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
        </div>
    </div>
    <br/>
    <div class="card-body">
        <div class="mb-5 hover-scroll-x">
            <div class="d-grid">
                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                    <li class="nav-item" style="margin-right: 10px;">
                        <a class="nav-link active btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#adr">Adverse Drug Reactions</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="adr" role="tabpanel">
            @include('adr.forms.content')
        </div>
    </div>

    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>

    @include('adr.report.modal')
    @include('adr.forms.subviews.adddrug')



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
        var config = {
                routes: {
                    adr :{
                        report : {
                            generate: "{{ route('adr.report.generate') }}?{!! $url !!}",
                            finalize: "{{ route('adr.report.savefinalize') }}?{!! $url !!}",
                            false   : "{{ route('adr.report.savefalse') }}?{!! $url !!}",
                            save    : "{{ route('adr.report.saverecord') }}?{!! $url !!}",
                        }, 
                    }       
                }
            };
    </script>

    

    <script src="{{ asset('js/adr/report.js') }}"></script>
@endpush