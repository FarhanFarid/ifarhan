@extends('layouts.ireporting.master')

@section('content')

<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">IDA (PRE-ADMISSION)</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label fw-semibold fs-6 mt-2">Date&nbsp;:</label>
                                <div class="fv-row">
                                    <input class="form-control form-control-md" placeholder="Pick date rage" id="filterdate" value="{{ \Carbon\Carbon::now()->subDays(7)->format('d/m/Y') }} - {{ \Carbon\Carbon::now()->format('d/m/Y') }}" readonly/>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-4 mb-3">
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
                        </div> --}}
                        <table class="table table-bordered table-row-bordered" id="reportpreadmission-table">
                            <thead class="thead-light">
                                <tr class="fw-semibold fs-6">
                                    <th style="max-width: 50px; color: #14787c; background-color:#ecfefe">No.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">MRN</th>
                                    <th style="min-width: 30px; color: #14787c; background-color:#ecfefe">Episode No.</th>
                                    <th style="min-width: 40px; color: #14787c; background-color:#ecfefe">Episode Dr.</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">Patient Name</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Admission Date</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Procedure Date</th>
                                    <th style="min-width: 100px; color: #14787c; background-color:#ecfefe">Procedure Plan</th>
                                    <th style="min-width: 50px; color: #14787c; background-color:#ecfefe">IP Episode Created</th>
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
                ida : {
                    preadmission : {
                        getdata : "{{ route('report.imilk.getinventory') }}?{!! $url !!}",
                },
                },
            },
        },
    };
</script>

<script src="{{ asset('js/ireporting/preadmission.js') }}"></script>
@endpush