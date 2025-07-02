@extends('layouts.hmilk.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/milk-bottle.png') }}" class="w-50px" style="position: absolute; top: -20px; left: -15px; transform: rotate(20deg);">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">MILK STORAGE</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">SUMMARY</h4>
            </div>
            <div class="card-body">
                <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                    <div class="card-body" style="padding: 0.75rem !important;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card" style="background-color: #04D5C7;">
                                    <div class="card-header" style="padding: 0px !important">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('media/logo/bottle.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -10px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-4">Total EBM</span>             
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$totalebm}}</span>        
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <b class="text-white" style=" font-size: 11px !important;">Chiller: {{$totalebmChiller}}</b>
                                                            </div>  
                                                            <div class="row">
                                                                <b class="text-white" style=" font-size: 11px !important;">Freezer: {{$totalebmFreezer}}</b>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="background-color: #004ee0;">
                                    <div class="card-header" style="padding: 0px !important">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('media/logo/expired.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -10px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-4">Expired EBM</span>             
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$expiredebm}}</span>        
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <b class="text-white">Chiller: {{$expiredebmChiller}}</b>
                                                            </div>  
                                                            <div class="row">
                                                                <b class="text-white">Freezer: {{$expiredebmFreezer}}</b>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="background-color: #e382f4;">
                                    <div class="card-header" style="padding: 0px !important">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('media/logo/pack.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -10px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-4">Pending Administer</span>             
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$pending}}</span>        
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <b class="text-white">Prepare: {{$prepare}}</b>
                                                            </div>  
                                                            <div class="row">
                                                                <b class="text-white">Handover: {{$handover}}</b>
                                                            </div>  
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card" style="background-color: #f6bc50;">
                                    <div class="card-header" style="padding: 0px !important">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <img src="{{ asset('media/logo/baby.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -10px;">
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <span class="text-white opacity-75 pt-1 fw-semibold fs-4">Administered</span>             
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$administered}}</span>        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                @include('layouts.hmilk.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <div class="row m-3">
                    <div class="col-md-10">
                        <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">STORED LIST</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="add" id="batchlist-table_add">
                            <button class="btn btn-primary btn-sm btn-block add-milk" type="button" style="width: 80% !important;">Add Milk</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                    <div class="row m-3">
                        <table class="table table-bordered" id="batchlist-table">
                            <thead class="thead-light">
                                <tr>
                                    <th style="color: #000000; min-width: 100px;">{{__('EXPRESSED DATE')}}</th>
                                    <th style="color: #000000; min-width: 100px;">{{__('EPISODE')}}</th>
                                    <th style="color: #000000; min-width: 100px;">{{__('BATCH NO.')}}</th>
                                    <th style="color: #000000; min-width: 100px;">{{__('QUANTITY')}}</th>
                                </tr>
                            </thead>
                            <tbody>      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('hmilk.storage.subviews.store')
    @include('hmilk.storage.subviews.reheat')
    @include('hmilk.storage.subviews.discard')
    @include('hmilk.storage.subviews.proceed')
    @include('hmilk.storage.subviews.cgproceed')
    @include('hmilk.storage.subviews.transferloc')


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
                        storage : {
                            check: "{{ route('hmilk.storage.check') }}?{!! $url !!}",
                            store: "{{ route('hmilk.storage.store') }}?{!! $url !!}",
                            storeDetail: "{{ route('hmilk.storage.store.detail') }}?{!! $url !!}",
                            list: "{{ route('hmilk.storage.list') }}?{!! $url !!}",
                            detail: "{{ route('hmilk.storage.detail') }}?{!! $url !!}",
                            discardDetail: "{{ route('hmilk.storage.discard.detail') }}?{!! $url !!}",
                            discard: "{{ route('hmilk.storage.discard') }}?{!! $url !!}",
                            updateLocation: "{{ route('hmilk.storage.updatelocation') }}?{!! $url !!}",
                            reprintLabel: "{{ route('hmilk.storage.reprintLabel') }}?{!! $url !!}",
                            transferWard: "{{ route('hmilk.storage.transferward') }}?{!! $url !!}",
                        },
                        administer : {
                            reheat : {
                                detail: "{{ route('hmilk.administer.reheat.detail') }}?{!! $url !!}",
                                update: "{{ route('hmilk.administer.reheat.update') }}?{!! $url !!}",
                                check: "{{ route('hmilk.administer.reheat.check') }}?{!! $url !!}",

                                caregiver : {
                                    update: "{{ route('hmilk.administer.reheat.caregiver.update') }}?{!! $url !!}",
                                    check: "{{ route('hmilk.administer.reheat.caregiver.check') }}?{!! $url !!}",
                            },
                            },
                        },
                    },         
                }
            };
    </script>
    <script src="{{ asset('js/hmilk/storage.js') }}"></script>
@endpush