@extends('layouts.ireporting.master')

@section('content')

<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">SUMMARY</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row">
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #bdbdbd; min-height: 100px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('media/logo/issued.png') }}" class="w-80px" style="position: absolute; top: 15px; left: 1px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <span class="text-dark opacity-75 pt-1 fw-semibold fs-4">Total Blood Received</span>             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$totalissued}}</span>        
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <b class="text-white" style=" font-size: 11px !important;">Active: {{$totalissuedactive}}</b>
                                                    </div>  
                                                    <div class="row">
                                                        <b class="text-white" style=" font-size: 11px !important;">Returned</b>
                                                    </div>
                                                    <div class="row">
                                                        <b class="text-white" style=" font-size: 11px !important;">-Used: {{$totalissuedreturnedused}}</b>
                                                    </div>  
                                                    <div class="row">
                                                        <b class="text-white" style=" font-size: 11px !important;">-Not used: {{$totalissuedreturnednotused}}</b>
                                                    </div>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #bdbdbd; min-height: 100px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('media/logo/transfuse.png') }}" class="w-75px" style="position: absolute; top: 15px; left: 1px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <span class="text-dark opacity-75 pt-1 fw-semibold fs-4">Transfusion Status</span>             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$totaltransfuse}}</span>        
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <b class="text-white">Pending: {{$pending}}</b>
                                                    </div> 
                                                    <div class="row">
                                                        <b class="text-white">Inprogress: {{$inprogress}}</b>
                                                    </div>  
                                                    <div class="row">
                                                        <b class="text-white">Completed: {{$completed}}</b>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #bdbdbd; min-height: 100px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('media/logo/reaction.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -1px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <span class="text-dark opacity-75 pt-1 fw-semibold fs-4">ATR Summary</span>             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$totalatr}}</span>        
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <b class="text-white">Suspected: {{$totalyesreaction}}</b>
                                                    </div>  
                                                    <div class="row">
                                                        <b class="text-white">ConfirmED: {{$confirm}}</b>
                                                    </div>
                                                    <div class="row">
                                                        <b class="text-white">False Report: {{$false}}</b>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #bdbdbd; min-height: 100px;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="{{ asset('media/logo/storage.png') }}" class="w-80px" style="position: absolute; top: 15px; left: -1px;">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <span class="text-dark opacity-75 pt-1 fw-semibold fs-4">Stored</span>             
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$totalstored}}</span>        
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <b class="text-white">Expired: {{$expired}}</b>
                                                    </div>  
                                                    <div class="row">
                                                        <b class="text-white">Usable: {{$notexpired}}</b>
                                                    </div>
                                                    <div class="row">
                                                        <span style="color: #bdbdbd;">-</span>
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
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">IBLOOD</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 3px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row">
                        <div class="row mb-5">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Date&nbsp;:</label>
                                    <div class="fv-row">
                                        <input class="form-control form-control-md" placeholder="Pick date range" id="filterdate" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Status&nbsp;:</label>
                                    <div class="fv-row">
                                        <select class="form-control form-control-md" id="filterstatus">
                                            <option value="all" selected>All</option>
                                            <option value="1">Received</option>
                                            <option value="2">Stored</option>
                                            <option value="3">Transfusion in progress</option>
                                            <option value="5">Transfered</option>
                                            <option value="7">Returned</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-row-bordered" style="width:auto" id="reportiblood-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6">
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                    <th style="min-width: 200px; color: #14787c; background-color:#ecfefe">Name</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">LB No.</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Bag No.</th>
                                    <th style="min-width: 150px; color: #14787c; background-color:#ecfefe">Expiry Date</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Current Status</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Reaction</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Transfuse Start</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Ageing (day)</th>
                                    <th style="min-width: 150px; color: #14787c; background-color:#ecfefe">Bag Location</th>
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
</div>
@include('ireporting.iblood.subviews.edit')
@endsection
@push('script')
<script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    // global app configuration object
    var config = {
        routes: {
            ireporting : {
                iblood : {
                    getdata : "{{ route('report.iblood.getinventory') }}?{!! $url !!}",
                    locationdetails : "{{ route('report.iblood.getlocationdetails') }}?{!! $url !!}",
                    getsingleinventory : "{{ route('report.iblood.getsingleinventory') }}?{!! $url !!}",
                    updateibloodinv : "{{ route('report.iblood.updateibloodinv') }}?{!! $url !!}",
                },
            },
        },
    };
</script>

<script src="{{ asset('js/ireporting/iblood.js') }}"></script>
@endpush