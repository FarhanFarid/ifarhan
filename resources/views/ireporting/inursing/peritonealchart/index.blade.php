@extends('layouts.ireporting.master')

@section('content')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">iNursing: Peritoneal Dialysis Chart</h4>
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
                                        <input class="form-control form-control-md" placeholder="Pick date range" id="filterdateperitonealchart" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-row-bordered" id="report-peritonealchart-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6 text-center">
                                    <th style="max-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">MRN</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">Name</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">Episode No.</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">Date</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;" colspan="3">Total</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe; vertical-align: top;" rowspan="2">Last Updated By</th>
                                </tr>
                                <tr class="fw-semibold fs-6 text-center">
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">In</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Out</th>                                    
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe; vertical-align: top;">Balance <br> (Accumulative)</th>
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
                peritonealchart : {
                    data: "{{ route('report.inursing.peritonealchart.getdataperitonealchart') }}?{!! $url !!}",
                }
            }
        }
    }
</script>
<script src="{{ asset('js/ireporting/inursing/peritonealchartreport.js') }}"></script>
@endpush