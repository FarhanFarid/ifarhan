<div class="modal" id="ward-summary" style="z-index: 10000 !important;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" style="max-width: 98% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: 700;">WARD SUMMARY</h5>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="las la-times text-dark fs-2"></i>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #fff0f8;">
                            <div class="row m-3">
                                <div class="col-md-12">
                                    <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: black;">
                                        SUMMARY (
                                        @php
                                            $summaryList = [];
                                            foreach ($results as $label => $value) {
                                                $summaryList[] = "$label: $value";
                                            }
                                            echo implode(', &nbsp', $summaryList);
                                        @endphp
                                        )
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="bedmanagement-table" style="width: 100% !important;">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Ward')}}</th>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Today')}}</th>
                                        <th style="color: #DB7093; min-width: 200px; text-align: center;  vertical-align: middle;">{{__('Tommorow')}}</th>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('3-7 Days')}}</th>
                                        <th style="color: #DB7093; min-width: 200px; text-align: center;  vertical-align: middle;">{{__('Total')}}</th>
                                        <th style="color: #DB7093; min-width: 150px; text-align: center;  vertical-align: middle;">{{__('Occupied')}}</th>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Booked')}}</th>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Unavailable')}}</th>
                                        <th style="color: #DB7093; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Current')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($summary as $row)
                                        <tr>
                                            <td>{{ $row['ward'] }}</td>
                                            <td>{{ $row['today'] }}</td>
                                            <td>{{ $row['tomorrow'] }}</td>
                                            <td>{{ $row['next3to7'] }}</td>
                                            <td>{{ $row['total'] }}</td>
                                            <td>{{ $row['occupied'] }}</td>
                                            <td>{{ $row['booked'] }}</td>
                                            <td>{{ $row['unavailable'] }}</td>
                                            <td>{{ $row['currentpatients'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">{{ __('CLOSE') }}</button>
            </div>
        </div>
    </div>
</div>