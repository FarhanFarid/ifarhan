@extends('layouts.hmilk.master')

@section('content')

<div>
    <div id="loading-overlay">
        <div class="loading-icon"></div>
    </div>
    <div class="card card-custom gutter-b">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">{{__('Patient List')}}</h3>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered" id="patient-table">
                <thead class="thead-light">
                    <tr>
                        <th style="color: #14787c; min-width: 25px;">{{__('MRN')}}</th>
                        <th style="color: #14787c; min-width: 100px;">{{__('Name')}}</th>
                        <th style="color: #14787c; min-width: 100px;">{{__('Episode')}}</th>
                        <th style="color: #14787c; min-width: 100px;">{{__('Batch No.')}}</th>
                        <th style="color: #14787c; min-width: 100px;">{{__('Details')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>051085</td>
                        <td>Y.BHG DATO' SERI MOHAMAD TOUFIC AL-OZEIR</td>
                        <td>IP0377095</td>
                        <td>BATCH-0001-01</td>
                        <td>EXPIRY DATE: 8 MAY 2024</td>
                    </tr>
                    <tr>
                        <td>051085</td>
                        <td>Y.BHG DATO' SERI MOHAMAD TOUFIC AL-OZEIR</td>
                        <td>IP0377095</td>
                        <td>BATCH-0001-01</td>
                        <td>EXPIRY DATE: 8 MAY 2024</td>
                    </tr>
                    <tr> 
                        <td>051085</td>
                        <td>Y.BHG DATO' SERI MOHAMAD TOUFIC AL-OZEIR</td>
                        <td>IP0377095</td>
                        <td>BATCH-0001-01</td>
                        <td>EXPIRY DATE: 8 MAY 2024</td>
                    </tr>
                    <tr>
                        <td>051085</td>
                        <td>Y.BHG DATO' SERI MOHAMAD TOUFIC AL-OZEIR</td>
                        <td>IP0377095</td>
                        <td>BATCH-0001-01</td>
                        <td>EXPIRY DATE: 8 MAY 2024</td>
                    </tr>
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
</div>
    @endsection
    @push('css')
    <style type="text/css">
        h5 span { 
            background:#fff; 
            padding:0 10px; 
        }
    </style>
    <style type="text/css">
        #loading-overlay{
            position: fixed;
            width: 100%;
            height:100%;
            left: 0;
            top: 0;
            display: none;
            align-items: center;
            background-color: #000;
            z-index: 99999;
            opacity: 0.5;
        }
        .loading-icon{ position:absolute;border-top:2px solid #fff;border-right:2px solid #fff;border-bottom:2px solid #fff;border-left:2px solid #767676;border-radius:25px;width:25px;height:25px;margin:0 auto;position:absolute;left:50%;margin-left:-20px;top:50%;margin-top:-20px;z-index:4;-webkit-animation:spin 1s linear infinite;-moz-animation:spin 1s linear infinite;animation:spin 1s linear infinite;}
        @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
        @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
        @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
    </style>
    @endpush
    @push('script')
        <script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
        <script>
            // global app configuration object
            var config = {
                routes: {
                    safety : {
                        add: "",
                        page: "",
                        list: "",
                    },
                }
            };
        </script>
        <script src="{{ asset('js/hmilk/main.js') }}"></script>
    @endpush
   
