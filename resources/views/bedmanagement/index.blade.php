@extends('layouts.bedmanagement.master')

@section('content')

    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #228B22;">
                <img src="{{ asset('media/logo/bedmanage.png') }}" class="w-50px" style="position: absolute; top: -20px; left: -15px; transform: rotate(10deg);">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">BED MANAGEMENT</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #F0FFF0;">
                <div class="row m-3">
                    <div class="col-md-12">
                        <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #25cd25;">BED DETAILS</h4>
                    </div>
                </div>
            </div>
            <br/>
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Search&nbsp;:</label>
                            <div class="fv-row">
                                <input class="form-control form-control-md" type="search" class="form-control" id="searchbed" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Ward&nbsp;:</label>
                            <div class="fv-row">
                                <select class="form-select" name="ward" id="ward" data-control="select2" data-placeholder="Filter Ward" data-allow-clear="true">
                                    <option value="">Please select the ward</option>
                                    <option value="A2ZONE1">A2ZONE1</option>
                                    <option value="A3ZONE1">A3ZONE1</option>
                                    <option value="A3ZONE2">A3ZONE2</option>
                                    <option value="A4ZONE1">A4ZONE1</option>
                                    <option value="A4ZONE2">A4ZONE2</option>
                                    <option value="ACCU">ACCU</option>
                                    <option value="AHDU">AHDU</option>
                                    <option value="AICU">AICU</option>
                                    <option value="B1ZONE2">B1ZONE2</option>
                                    <option value="B2ZONE1">B2ZONE1</option>
                                    <option value="B2ZONE2">B2ZONE2</option>
                                    <option value="B3ZONE1">B3ZONE1</option>
                                    <option value="B3ZONE2">B3ZONE2</option>
                                    <option value="B4ZONE1">B4ZONE1</option>
                                    <option value="B4ZONE2">B4ZONE2</option>
                                    <option value="B5ZONE1">B5ZONE1</option>
                                    <option value="B5ZONE2">B5ZONE2</option>
                                    <option value="EMY">EMY</option>
                                    <option value="HDU">HDU</option>
                                    <option value="HDUCD">HDUCD</option>
                                    <option value="PCICU">PCICU</option>
                                    <option value="PICU">PICU</option>
                                    <option value="PICU2">PICU2</option>
                                    <option value="WE">WE</option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Room Type&nbsp;:</label>
                            <div class="fv-row">
                                <select class="form-select" name="room" id="room" data-control="select2" data-placeholder="Filter Room Type" data-allow-clear="true">
                                    <option value="">Please select the room</option>
                                    <option value="1 Bedded CCU">1 Bedded CCU</option>
                                    <option value="1 Bedded HDU Cardiology">1 Bedded HDU Cardiology</option>
                                    <option value="1 Bedded ICU">1 Bedded ICU</option>
                                    <option value="1 Bedded PCICU Isolation">1 Bedded PCICU Isolation</option>
                                    <option value="1 Bedded Standard">1 Bedded Standard</option>
                                    <option value="1 Bedded Step Down Ward">1 Bedded Step Down Ward</option>
                                    <option value="1 Bedded Suite">1 Bedded Suite</option>
                                    <option value="1 Bedded VIP">1 Bedded VIP</option>
                                    <option value="10 Bedded Paediatric ICU">10 Bedded Paediatric ICU</option>
                                    <option value="2 Bedded Standard">2 Bedded Standard</option>
                                    <option value="4 Bedded CCU">4 Bedded CCU</option>
                                    <option value="4 Bedded HDU Cardiology">4 Bedded HDU Cardiology</option>
                                    <option value="4 Bedded HDU PCICU">4 Bedded HDU PCICU</option>
                                    <option value="4 Bedded ICU">4 Bedded ICU</option>
                                    <option value="4 Bedded PCICU">4 Bedded PCICU</option>
                                    <option value="6 Bedded HDU Adult">6 Bedded HDU Adult</option>
                                    <option value="6 Bedded Observation Emergency">6 Bedded Observation Emergency</option>
                                    <option value="6 Bedded Paediatric HDU">6 Bedded Paediatric HDU</option>
                                    <option value="A2 1 Bedded Standard">A2 1 Bedded Standard</option>
                                    <option value="A2 1 Bedded Suite A2Z1">A2 1 Bedded Suite A2Z1</option>
                                    <option value="A2 2 Bedded Standard">A2 2 Bedded Standard</option>
                                    <option value="A2 4 Bedded Standard">A2 4 Bedded Standard</option>
                                    <option value="A3 1 Bedded Standard">A3 1 Bedded Standard</option>
                                    <option value="A3 1 Bedded Standard Isolation">A3 1 Bedded Standard Isolation</option>
                                    <option value="A3 2 Bedded Standard">A3 2 Bedded Standard</option>
                                    <option value="A4 1 Bedded Deluxe">A4 1 Bedded Deluxe</option>
                                    <option value="A4 1 Bedded Suite Berlian">A4 1 Bedded Suite Berlian</option>
                                    <option value="A4 1 Bedded Suite Delima">A4 1 Bedded Suite Delima</option>
                                    <option value="A4 1 Bedded Suite Firus">A4 1 Bedded Suite Firus</option>
                                    <option value="A4 1 Bedded Suite OPAL">A4 1 Bedded Suite OPAL</option>
                                    <option value="A4 1 Bedded Suite Topaz">A4 1 Bedded Suite Topaz</option>
                                    <option value="A4 1 Bedded Suite Zamrud">A4 1 Bedded Suite Zamrud</option>
                                    <option value="ACCU 1 Bedded Isolation">ACCU 1 Bedded Isolation</option>
                                    <option value="ACCU 1 Bedded Standard">ACCU 1 Bedded Standard</option>
                                    <option value="ACCU 1 Bedded Suite">ACCU 1 Bedded Suite</option>
                                    <option value="ACCU 4 Bedded Standard">ACCU 4 Bedded Standard</option>
                                    <option value="AICU 1 Bedded ICU">AICU 1 Bedded ICU</option>
                                    <option value="AICU 1 Bedded ICU Isolation">AICU 1 Bedded ICU Isolation</option>
                                    <option value="AICU 2 Bedded ICU">AICU 2 Bedded ICU</option>
                                    <option value="AICU 4 Bedded ICU<">AICU 4 Bedded ICU</option>
                                    <option value="B1Z2 1 Bedded Standard">B1Z2 1 Bedded Standard</option>
                                    <option value="B1Z2 4 Bedded Standard">B1Z2 4 Bedded Standard</option>
                                    <option value="B2Z1 1 Bedded Isolation">B2Z1 1 Bedded Isolation</option>
                                    <option value="B2Z1 3 Bedded Standard">B2Z1 3 Bedded Standard</option>
                                    <option value="B2Z1 6 Bedded HDA">B2Z1 6 Bedded HDA</option>
                                    <option value="B2Z1 6 Bedded Standard">B2Z1 6 Bedded Standard</option>
                                    <option value="B2Z2 1 Bedded Deluxe">B2Z2 1 Bedded Deluxe</option>
                                    <option value="B2Z2 1 Bedded Executive Deluxe">B2Z2 1 Bedded Executive Deluxe</option>
                                    <option value="B2Z2 1 Bedded Paediatric/Adult">B2Z2 1 Bedded Paediatric/Adult</option>
                                    <option value="B2Z2 2 Bedded Paediatric/Adult">B2Z2 2 Bedded Paediatric/Adult</option>
                                    <option value="B2Z2 1 Bedded Suite">B2Z2 1 Bedded Suite</option>
                                    <option value="B2Z2 3 Bedded Adult">B2Z2 3 Bedded Adult</option>
                                    <option value="B2Z2 1 Bedded Standard">B2Z2 1 Bedded Standard</option>
                                    <option value="B3Z1 1 Bedded Isolation">B3Z1 1 Bedded Isolation</option>
                                    <option value="B3Z1 3 Bedded Standard">B3Z1 3 Bedded Standard</option>
                                    <option value="B3Z1 6 Bedded HDA">B3Z1 6 Bedded HDA</option>
                                    <option value="B3Z1 6 Bedded Standard">B3Z1 6 Bedded Standard</option>
                                    <option value="B3Z2 1 Bedded Deluxe<">B3Z2 1 Bedded Deluxe</option>
                                    <option value="B3Z2 1 Bedded Standard">B3Z2 1 Bedded Standard</option>
                                    <option value="B3Z2 2 Bedded Standard">B3Z2 2 Bedded Standard</option>
                                    <option value="B4Z1 1 Bedded Isolation">B4Z1 1 Bedded Isolation</option>
                                    <option value="B4Z1 2 Bedded Standard">B4Z1 2 Bedded Standard</option>
                                    <option value="B4Z1 3 Bedded Standard">B4Z1 3 Bedded Standard</option>
                                    <option value="B4Z1 5 Bedded HDA">B4Z1 5 Bedded HDA</option>
                                    <option value="B4Z1 5 Bedded Standard">B4Z1 5 Bedded Standard</option>
                                    <option value="B4Z2 1 Bedded Isolation">B4Z2 1 Bedded Isolation</option>
                                    <option value="B4Z2 2 Bedded Standard">B4Z2 2 Bedded Standard</option>
                                    <option value="B4Z2 3 Bedded Standard">B4Z2 3 Bedded Standard</option>
                                    <option value="B4Z2 5 Bedded HDA">B4Z2 5 Bedded HDA</option>
                                    <option value="B4Z2 5 Bedded Standard">B4Z2 5 Bedded Standard</option>
                                    <option value="B5Z1 1 Bedded Isolation">B5Z1 1 Bedded Isolation</option>
                                    <option value="B5Z1 1 Bedded Standard">B5Z1 1 Bedded Standard</option>
                                    <option value="B5Z1 2 Bedded Standard">B5Z1 2 Bedded Standard</option>
                                    <option value="B5Z1 4 Bedded Standard">B5Z1 4 Bedded Standard</option>
                                    <option value="B5Z1 6 Bedded HDA">B5Z1 6 Bedded HDA</option>
                                    <option value="B5Z2 1 Bedded Isolation">B5Z2 1 Bedded Isolation</option>
                                    <option value="B5Z2 1 Bedded Standard">B5Z2 1 Bedded Standard</option>
                                    <option value="B5Z2 3 Bedded Standard">B5Z2 3 Bedded Standard</option>
                                    <option value="B5Z2 5 Bedded HDU">B5Z2 5 Bedded HDU</option>
                                    <option value="B5Z2 5 Bedded Standard">B5Z2 5 Bedded Standard</option>
                                    <option value="B5Z2 6 Bedded Standard">B5Z2 6 Bedded Standard</option>
                                    <option value="RDU 1 Bedded">RDU 1 Bedded</option>
                                    <option value="RDU 4 Bedded">RDU 4 Bedded</option>
                                </select> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Bed Status&nbsp;:</label>
                            <div class="fv-row">
                                <select class="form-select" name="status" id="status" data-control="select2"  data-close-on-select="false" data-placeholder="Filter Status" data-allow-clear="true" multiple="multiple">
                                    <option value="Occupied">Occupied</option>
                                    <option value="Unoccupied">Unoccupied</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Bed Type&nbsp;:</label>
                            <div class="fv-row">
                                <select class="form-select" name="bedtype" id="bedtype" data-control="select2"  data-close-on-select="false" data-placeholder="Filter Type" data-allow-clear="true" multiple="multiple">
                                    <option value="Monitor">Monitor</option>
                                    <option value="Nearby">Nearby</option>
                                    <option value="General">General</option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <label class="form-label fw-semibold fs-6 mt-2">Bed Upgrade&nbsp;:</label>
                            <div class="fv-row">
                                <select class="form-select" name="bedupgrade" id="bedupgrade" data-control="select2" data-placeholder="Filter Bed" data-allow-clear="true">
                                    <option value="">Please select the bed</option>
                                    <option value="Downgrade">Downgrade Bed</option>
                                    <option value="Forced Upgrade">Forced Upgrade Bed</option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered" id="bedmanagement-table" style="width: 100% !important;">
                    <thead class="thead-light">
                        <tr>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Ward')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Bed')}}</th>
                            <th style="color: #14787c; min-width: 200px; text-align: center;  vertical-align: middle;">{{__('Room Type')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Room')}}</th>
                            <th style="color: #14787c; min-width: 200px; text-align: center;  vertical-align: middle;">{{__('Bed Status')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Bed Type')}}</th>
                            <th style="color: #14787c; min-width: 150px; text-align: center;  vertical-align: middle;">{{__('Upgrade')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('MRN')}}</th>
                            <th style="color: #14787c; min-width: 100px; text-align: center;  vertical-align: middle;">{{__('Episode No.')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@include('bedmanagement.subviews.patientdetails')

@endsection

@push('script')
    <script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script>
        var config = {
                routes: {
                    bed : {
                            getWardList: "{{ route('bm.getwardlist') }}?{!! $url !!}",
                            getPatientInfo: "{{ route('bm.getpatientinfo') }}?{!! $url !!}",
                        },
                    },         
                };
    </script>
    <script src="{{ asset('js/bedmanage/bed.js') }}"></script>
@endpush
