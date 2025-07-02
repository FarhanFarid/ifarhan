@extends('layouts.ireporting.master')

@section('content')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">iNursing: Patient Transfer Ward Orientation</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row mt-4">
                        <div class="hover-scroll-x">
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 active tab-inurwardorientation me-1" id="navorientation" data-bs-toggle="tab" href="#taborientation">NEW ADMISSION</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurwardorientation me-1" id="navtransfer" data-bs-toggle="tab" href="#tabtransfer">TRANSFER</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="taborientation" role="tabpanel">
                                {{-- Section Orientation Data --}}
                                <div class="card">
                                    <div class="card-body"> 
                                        @include('ireporting.inursing.wardorientation.subviews.orientation')
                                    </div>
                                </div>
                                {{-- Section Orientation Data --}}            
                            </div> 
                            <div class="tab-pane fade" id="tabtransfer" role="tabpanel">                                
                                {{-- Section Transfer Data --}}
                                <div class="card">
                                    <div class="card-body"> 
                                        @include('ireporting.inursing.wardorientation.subviews.transfer')
                                    </div>
                                </div>
                                {{-- Section Transfer Data --}}              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<style type="text/css">
    .tab-inurwardorientation{
        background-color: #e9f2ff;
        color: #0070c0;
    }
    .tab-inurwardorientation.active{
        background-color: #0070c0 !important;
        color: #ffffff !important;
    }
    .tab-inurwardorientation:hover{
        background-color: #0070c0 !important;
        color: #ffffff !important;
    }
</style>
@endpush
@push('script')
<script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script>
    // global app configuration object
    var config = {
        routes: {
            ireporting : {
                wardorientation : {
                    orientation : {
                        data: "{{ route('report.inursing.wardorientation.orientation.getdatawoorientation') }}?{!! $url !!}",
                    },
                    transfer : {
                        data: "{{ route('report.inursing.wardorientation.transfer.getdatawotransfer') }}?{!! $url !!}",
                    }                    
                }
            }
        }
    }
</script>
<script src="{{ asset('js/ireporting/inursing/wardorientation/woorientationreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/wardorientation/wotransferreport.js') }}"></script>
@endpush