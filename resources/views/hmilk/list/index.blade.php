@extends('layouts.hmilk.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/hmilk.png') }}" class="w-50px" style="position: absolute; top: -20px; left: -15px;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">EBM LIST</h4>
            </div>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
                <div class="row m-3">
                    <div class="col-md-10">
                        <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">MILK LIST</h4>
                    </div>
                    <div class="col-md-2">
                        <div class="add mb-2" id="batchlist-table_add">
                            <button class="btn btn-primary btn-sm btn-block" type="button" style="width: 80% !important;" data-bs-toggle="modal" data-bs-target="#add-milk">Add Milk</button>
                        </div>
                        <div class="add" id="batchlist-table_add">
                            <button class="btn btn-warning btn-sm btn-block" type="button" style="width: 80% !important;" data-bs-toggle="modal" data-bs-target="#warm-milk">Warm Milk</button>
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
                                    <th style="color: #000000; min-width: 100px;">{{__('EPISODE')}}</th>
                                    <th style="color: #000000; min-width: 100px;">{{__('BATCH DATE')}}</th>
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

@endsection
@push('script')
    <script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var epsdno = urlParams.get(paramEpsdNo);
        // global app configuration object
        var config = {
                routes: {
                    hmilk :{
                        main : {
                            list: "{{ route('hmilk.storage.list') }}?{!! $url !!}",
                        },
                    },         
                }
            };
    </script>
    <script src="{{ asset('js/hmilk/list.js') }}"></script>
@endpush