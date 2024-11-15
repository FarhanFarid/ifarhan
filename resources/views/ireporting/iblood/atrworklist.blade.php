@extends('layouts.ireporting.master')

@section('content')

<div class="row mb-5">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">IBLOOD (ATR WORKLIST - SUSPECTED)</h4>
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
                                        <input class="form-control form-control-md" placeholder="Pick date range" id="filterdate" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Search&nbsp;:</label>
                                    <div class="fv-row">
                                        <input class="form-control form-control-md" type="search" class="form-control" id="searchsuspect" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 align-self-end">
                                <button id="exportsuspect" class="btn btn-dark">Excel</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-row-bordered" id="reportibloodatr-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6">
                                    <th style="max-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Bag No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Date/Time</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Location</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Reported By</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Report Date/Time</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">ATR Ageing</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Report</th>
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

<div class="row mb-5">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #37e31d;">IBLOOD (ATR WORKLIST - CONFIRM)</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row mb-5">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label fw-semibold fs-6 mt-2">Date&nbsp;:</label>
                                <div class="fv-row">
                                    <input class="form-control form-control-md" placeholder="Pick date range" id="filterdateconfirm" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label fw-semibold fs-6 mt-2">Search&nbsp;:</label>
                                <div class="fv-row">
                                    <input class="form-control form-control-md" type="search" class="form-control" id="tableSearchInput" placeholder="Search...">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3 align-self-end">
                            <button id="exportExcelBtn" class="btn btn-dark">Excel</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-row-bordered" id="reportibloodatrconfirm-table">
                        <thead class="thead-light">
                            <tr class="fw-semibold fs-6">
                                <th style="max-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Bag No.</th>
                                <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Date/Time</th>
                                <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Location</th>
                                <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Reported By</th>
                                <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Report Date/Time</th>
                                <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">ATR Ageing</th>
                                <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Report</th>
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


<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #e31d1d;">IBLOOD (ATR WORKLIST - FALSE REPORT)</h4>
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
                                        <input class="form-control form-control-md" placeholder="Pick date range" id="filterdatefalse" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-6 mt-2">Search&nbsp;:</label>
                                    <div class="fv-row">
                                        <input class="form-control form-control-md" type="search" class="form-control" id="searchfalse" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3 align-self-end">
                                <button id="exportfalse" class="btn btn-dark">Excel</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-row-bordered" id="reportibloodatrfalse-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6">
                                    <th style="max-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Bag No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Date/Time</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Onset Location</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Reported By</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Report Date/Time</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">ATR Ageing</th>
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

@include('iblood.reaction.report.modal')


@endsection
@push('script')
<script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    // global app configuration object
    var config = {
        routes: {
            ireporting : {
                iblood : {
                    atr : {
                        report: "{{ route('blood.reaction.report.generate') }}?{!! $url !!}",
                        reportconfirm: "{{ route('report.iblood.atr.generateconfirm') }}?{!! $url !!}",
                        worklist : "{{ route('report.iblood.atr.getworklist') }}?{!! $url !!}",
                        worklistconfirm : "{{ route('report.iblood.atr.getworklistconfirm') }}?{!! $url !!}",
                        worklistfalse : "{{ route('report.iblood.atr.getworklistfalse') }}?{!! $url !!}",

                    },
                },
            },
        },
    };
</script>

<script src="{{ asset('js/ireporting/ibloodatr.js') }}"></script>
@endpush