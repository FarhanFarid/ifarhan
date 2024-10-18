@extends('layouts.hmilk.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/hmilk.png') }}" class="w-50px" style="position: absolute; top: -20px; left: -15px;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">EXPRESSED BREAST MILK (EBM)</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PATIENT'S DETAILS</h4>
            </div>
            <div class="card-body">
                @include('layouts.hmilk.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">EBM REHEAT</h4>
            </div>
            <div class="card-body">
                <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                    <form id="#">
                        @csrf
                        <div class="row m-5">
                            <div class="col-md-6">
                                <div class="row p-1">
                                    <b>Batch ID</b>
                                </div>
                                <div class="row p-1">
                                    <input type="text" class="form-control" id="batchId" name="batchId" required/>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <button type="button" id="searchbatch" class="btn btn-primary btn-sm font-weight-bold btn-block">{{__('SEARCH')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <h5>PACK'S DETAIL</h5>
                                        </div>
                                        <div class="row m-1">
                                            <div class="col-md-4">
                                                <b>Episode No.</b>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="episodeNo" id="episodeNo" readonly>
                                            </div>
                                        </div>
                                        <div class="row m-1">
                                            <div class="col-md-4">
                                                <b>Batch No.</b>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="batchNo" id="batchNo" readonly>
                                            </div>
                                        </div>
                                        <div class="row m-1">
                                            <div class="col-md-4">
                                                <b>Expiry Date</b>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" type="text" name="expiryDate" id="expiryDate" readonly>
                                            </div>
                                        </div>
                                        <div class="row m-3 mt-5">
                                            <div class="col-md-4">
                                                <button type="button" id="updateStatus" class="btn btn-warning btn-sm font-weight-bold btn-block">{{__('WARM')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
    <script>
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var epsdno = urlParams.get(paramEpsdNo);
        // global app configuration object
        var config = {
                routes: {
                    hmilk :{
                        administer : {
                            reheat : {
                                detail: "{{ route('hmilk.administer.reheat.detail') }}?{!! $url !!}",
                                update: "{{ route('hmilk.administer.reheat.update') }}?{!! $url !!}",
                                check: "{{ route('hmilk.administer.reheat.check') }}?{!! $url !!}",
                            },
                        },
                    },         
                }
            };
    </script>
    <script src="{{ asset('js/hmilk/reheat.js') }}"></script>
@endpush