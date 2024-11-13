@extends('layouts.iblood.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/bloodpack.png') }}" class="w-50px" style="position: absolute; top: -13px; left: -15px; transform: rotate(20deg);">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">BLOOD INVENTORY</h4>
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
                @include('layouts.iblood.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <div class="row m-3">
                    <div class="col-md-10">
                        <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">BLOOD TRANSACTION</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="add" id="batchlist-table_add">
                            <button class="btn btn-primary btn-sm btn-block receive-blood" type="button" style="width: 80% !important;">RECEIVE BLOOD</button>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card-body">
                <table class="table table-bordered" id="bloodinventory-table" style="width: 100% !important;">
                    <thead class="thead-light">
                        <tr>
                            <th colspan="9" style="color: #14787c; min-width: 25px; text-align: center; vertical-align: middle;">{{__('TRANSFUSION RECORD')}}</th>
                        </tr>
                        <tr>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Reaction')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Product')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Bag No.')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Status')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Blood Movement')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Volume Transfused')}}</th>
                            {{-- <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Created At')}}</th> --}}
                            <th style="color: #14787c; min-width: 200px; text-align: center;  vertical-align: middle;">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>
    @include('iblood.inventory.subviews.receive')
    @include('iblood.inventory.subviews.suspend')
    @include('iblood.inventory.subviews.reaction')
    @include('iblood.inventory.subviews.store')
    @include('iblood.inventory.subviews.transfer')
    @include('iblood.inventory.subviews.view-reaction')
    @include('iblood.inventory.subviews.receive-transferred')

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
                            list: "{{ route('blood.inventory.list') }}?{!! $url !!}",
                            wardList: "{{ route('blood.inventory.wardlocationlist') }}?{!! $url !!}",
                            verifylab: "{{ route('blood.inventory.verifylab') }}?{!! $url !!}",
                            store: "{{ route('blood.inventory.store') }}?{!! $url !!}",
                            updateLocation: "{{ route('blood.inventory.updatelocation') }}?{!! $url !!}",
                            storeBlood: "{{ route('blood.inventory.storeblood') }}?{!! $url !!}",
                            suspend: "{{ route('blood.inventory.suspend') }}?{!! $url !!}",
                            addReaction: "{{ route('blood.inventory.addreaction') }}?{!! $url !!}",
                            transferTo: "{{ route('blood.inventory.gettransferto') }}?{!! $url !!}",
                            viewReaction: "{{ route('blood.inventory.reactionlist') }}?{!! $url !!}",
                            receiveTransferred: "{{ route('blood.inventory.receivetransferred') }}?{!! $url !!}"

                        },
                        reaction : {
                            index: "{{ route('blood.reaction.index') }}?{!! $url !!}",
                        },
                        transfusion : {
                            index: "{{ route('blood.transfusion.index') }}?{!! $url !!}",
                        },
                    },         
                }
            };
    </script>
    <script src="{{ asset('js/iblood/inventory.js') }}"></script>
@endpush