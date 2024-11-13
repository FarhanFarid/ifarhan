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
                            <div class="card flex-fill" style="background-color: #04D5C7; min-height: 100px;">
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
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$totalebm}}</span>        
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
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #004ee0; min-height: 100px;">
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
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$expiredebm}}</span>        
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
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #e382f4; min-height: 100px;">
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
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$pending}}</span>        
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
                        <div class="col-md-3 d-flex">
                            <div class="card flex-fill" style="background-color: #f6bc50; min-height: 100px;">
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
                                                    <span class="fw-bold text-white me-2 lh-1 ls-n2" style=" font-size: 16px !important;">{{$administered}}</span>        
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
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">IMILK</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row">
                        <div class="row mb-5">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Date&nbsp;:</label>
                                    <div class="fv-row">
                                        <input class="form-control form-control-md" placeholder="Pick date rage" id="filterdate" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Status&nbsp;:</label>
                                    <div class="fv-row">
                                        <select class="form-control form-control-md" id="filterstatus">
                                            <option value="all" selected>All</option>
                                            <option value="1">Stored</option>
                                            <option value="2">Prepared</option>
                                            <option value="3">Administered</option>
                                            <option value="4">Handover</option>
                                            <option value="6">Discarded</option>
                                            <option value="8">Expired</option>
                                            <option value="7">Administered - Partial</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-row-bordered" id="reportimilk-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6">
                                    <th style="max-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                    <th style="min-width: 40px; color: #14787c; background-color:#ecfefe">Episode Date</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Batch ID</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Milk Location</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Received Date</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Expiry Date</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Received By</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Status</th>
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
@endsection
@push('script')
<script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    // global app configuration object
    var config = {
        routes: {
            ireporting : {
                imilk : {
                    getdata : "{{ route('report.imilk.getinventory') }}?{!! $url !!}",
                },
            },
        },
    };
</script>

<script src="{{ asset('js/ireporting/imilk.js') }}"></script>
@endpush