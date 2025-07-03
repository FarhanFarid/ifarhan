@extends('layouts.ireporting.master')

@section('content')
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">iNursing: Miscellaneous</h4>
        </div>
        <div class="card-body">
            <div class="card card-custom gutter-b" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important; border-top: solid 5px #1d69e3 !important;">
                <div class="card-body" style="padding: 0.75rem !important;">
                    <div class="row mt-4">
                        <div class="hover-scroll-x">
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 active tab-inurmiscellaneous me-1" id="navmiscellaneousspiro" data-bs-toggle="tab" href="#tabmiscellaneousspiro">SPIROMETRY CHART</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneousvomit" data-bs-toggle="tab" href="#tabmiscellaneousvomit">VOMIT CHART</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneousseizure" data-bs-toggle="tab" href="#tabmiscellaneousseizure">SEIZURE CHART</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneousabdominal" data-bs-toggle="tab" href="#tabmiscellaneousabdominal">ABDOMINAL GIRTH</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneousothers" data-bs-toggle="tab" href="#tabmiscellaneousothers">OTHERS</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneoushyperspell" data-bs-toggle="tab" href="#tabmiscellaneoushyperspell">HYPERCYANOTIC SPELL</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn rounded-bottom-0 tab-inurmiscellaneous me-1" id="navmiscellaneousapnoea" data-bs-toggle="tab" href="#tabmiscellaneousapnoea">APNOEA</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tabmiscellaneousspiro" role="tabpanel">
                                {{-- Section Spirometry Chart --}}
                                <div class="card">
                                    <div class="card-body">         
                                        @include('ireporting.inursing.miscellaneous.subviews.spirometry')     
                                    </div>
                                </div>
                                {{-- Section Spirometry Chart --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneousvomit" role="tabpanel">
                                {{-- Section Vomit Chart --}}
                                <div class="card">
                                    <div class="card-body">           
                                        @include('ireporting.inursing.miscellaneous.subviews.vomit')
                                    </div>
                                </div>
                                {{-- Section Vomit Chart --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneousseizure" role="tabpanel">
                                {{-- Section Seizure Chart --}}
                                <div class="card">
                                    <div class="card-body">            
                                        @include('ireporting.inursing.miscellaneous.subviews.seizure')
                                    </div>
                                </div>
                                {{-- Section Seizure Chart --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneousabdominal" role="tabpanel">
                                {{-- Section Abdominal Girth --}}
                                <div class="card">
                                    <div class="card-body">   
                                        @include('ireporting.inursing.miscellaneous.subviews.abdominal')
                                    </div>
                                </div>
                                {{-- Section Abdominal Girth --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneousothers" role="tabpanel">
                                {{-- Section Others --}}
                                <div class="card">
                                    <div class="card-body">   
                                        @include('ireporting.inursing.miscellaneous.subviews.others')
                                    </div>
                                </div>
                                {{-- Section Others --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneoushyperspell" role="tabpanel">
                                {{-- Section Hypercyanotic Spell --}}
                                <div class="card">
                                    <div class="card-body">     
                                        @include('ireporting.inursing.miscellaneous.subviews.hypercyanoticspell')
                                    </div>
                                </div>
                                {{-- Section Hypercyanotic Spell --}}    
                            </div>
                            <div class="tab-pane fade" id="tabmiscellaneousapnoea" role="tabpanel">
                                {{-- Section Apnoea --}}
                                <div class="card">
                                    <div class="card-body">    
                                        @include('ireporting.inursing.miscellaneous.subviews.apnoea')
                                    </div>
                                </div>
                                {{-- Section Apnoea --}}    
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
    .tab-inurmiscellaneous{
        background-color: #e9f2ff;
        color: #0070c0;
    }
    .tab-inurmiscellaneous.active{
        background-color: #0070c0 !important;
        color: #ffffff !important;
    }
    .tab-inurmiscellaneous:hover{
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
                miscellaneous : {
                    data: "{{ route('report.inursing.miscellaneous.getdatamiscellaneous') }}?{!! $url !!}",
                }
            }
        }
    }
</script>

<script src="{{ asset('js/ireporting/inursing/miscellaneous/main.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/spirometryreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/vomitreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/seizurereport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/abdominalreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/othersreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/hyperreport.js') }}"></script>
<script src="{{ asset('js/ireporting/inursing/miscellaneous/apnoeareport.js') }}"></script>
@endpush