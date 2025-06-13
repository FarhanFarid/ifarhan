@extends('layouts.iblood.master')

@section('content')
<div class="row">
    <div class="col-md-12 mb-5">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
            <img src="{{ asset('media/logo/bloodpack.png') }}" class="w-50px" style="position: absolute; top: -13px; left: -15px; transform: rotate(20deg);">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">REACTION REPORT</h4>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">PATIENT DETAILS</h4>
        </div>
        <div class="card-body">
            @include('layouts.iblood.patientinfo')
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="col-md-12 mb-2">
        <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #e9f2ff;">
            <div class="row m-3">
                <div class="col-md-10">
                    <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #1d69e3;">REACTION ASSESSMENT</h4>
                </div>
                <div class="col-md-2">
                    <div class="add" id="batchlist-table_add">
                        <button class="btn btn-primary btn-sm btn-block gen-report" type="button" style="width: 80% !important;">GENERATE PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="card-body">
            <div class="mb-5 hover-scroll-x">
                <div class="d-grid">
                    <ul class="nav nav-tabs flex-nowrap text-nowrap">
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usrGrp == "EMY" || Auth::user()->usrGrp == "EMYDoctors" || Auth::user()->usrGrp == "ICLNurse" || Auth::user()->usrGrp == "OTNurse" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link active btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#procedure"> DETAIL OF PROCEDURE</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usrGrp == "EMY" || Auth::user()->usrGrp == "ICLNurse" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectiond"><b>SECTION D:</b> BLOOD COMPONENT</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usrGrp == "EMYDoctors"  || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectionf"><b>SECTION F:</b> RELEVANT CLINICAL HISTORY</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usrGrp == "EMY" || Auth::user()->usrGrp == "EMYDoctors" || Auth::user()->usrGrp == "ICLNurse" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectiong"><b>SECTION G:</b> SIGN AND SYMPTOMS</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usrGrp == "EMYDoctors" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectionh"><b>SECTION H:</b> RELEVANT INVESTIGATION</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usrGrp == "EMYDoctors" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectioni"><b>SECTION I:</b> ADVERSE EVENT OUTCOME</a>
                            </li>
                        @endif
                        @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                            <li class="nav-item" style="margin-right: 10px;">
                                <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#sectionj"><b>SECTION J:</b> TYPE OF ADVERSE EVENT</a>
                            </li>
                        @endif
                        {{-- <li class="nav-item" style="margin-right: 10px;">
                            <a class="nav-link btn btn-light-primary btn-active-primary btn-color-light-primary btn-active-color-light rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_3">ERROR AND INCIDENT</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade show active" id="procedure" role="tabpanel">
                        @include('iblood.reaction.detailprocedure.content')
                    </div>
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectiond" role="tabpanel">
                        @include('iblood.reaction.bloodcomponent.content')
                    </div>
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectionf" role="tabpanel">
                        @include('iblood.reaction.relevantclinical.content')
                    </div>
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usergrp == "WardNurse" || Auth::user()->usergrp == "WardNursePrivate" || Auth::user()->usergrp == "WardClerk" || Auth::user()->usergrp == "WardManagerOrMentor" || Auth::user()->usergrp == "OPDNurse" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectiong" role="tabpanel">
                        @include('iblood.reaction.signandsymptoms.content')
                    </div>
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectionh" role="tabpanel">
                        @include('iblood.reaction.relevantinvestigation.content')
                    </div>
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "Doctors" || Auth::user()->usergrp == "LABManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectioni" role="tabpanel">
                        @include('iblood.reaction.outcomeadverseevent.content')
                    </div> 
                @endif
                @if(Auth::user()->usergrp == "Administrator" || Auth::user()->usergrp == "LabManager" || Auth::user()->usergrp == "LABMLT" || Auth::user()->usergrp == "LabTemp" || Auth::user()->usergrp == "LabClerk")
                    <div class="tab-pane fade" id="sectionj" role="tabpanel">
                        @include('iblood.reaction.typeadverseevent.content')
                    </div>
                @endif
                {{-- <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                    @include('iblood.reaction.errorandincident.content')
                </div> --}}                   
            </div>
        </div>
    </div>
</div>

@include('iblood.reaction.report.modal')


@endsection

@push('script')
    <script src="{{asset('theme/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript">
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
    
        function callPatientInfo()
        {
            $.ajax({
                url: "{{route('main.patientinfo')}}?{!! $url !!}",
                type: "GET",
                dataType: "json",
                data: {
                    epsdno: urlParams.get(paramEpsdNo)
                },
                success: function(data) {
                    var data = data.data;
                    var html = '';
                    
                    $('#patientinfoname').html(data.name);
                    $('#patientinfomrn').html(data.mrn);
                    $('#patientinfodob').html(data.dob);
                    $('#patientinfoage').html(data.age);
                    $('#patientinfosex').html(data.sex);
                    $('#patientinfoepsnum').html(data.epsdno);
                    $('#patientinfoepsnumdate').html(data.epsddate);
                    $('#patientinfobloodtype').html(data.bloodtype);
                    $('#patientinfoallergy').html(data.allergy);
                    $('#patientinfopayor').html(data.payor);
                    $('#patientinfoweight').html(data.weight);
                    $('#patientinfoheight').html(data.height);
                    $('#patientinfobmi').html(data.bmi);
                    $('#patientinfobsa').html(data.bsa);
                }
            });
        }
    
        callPatientInfo()
    
        setInterval(callPatientInfo, 60*1000)
    </script>
    <script>
        var urlParams 	= new URLSearchParams(window.location.search);
        var paramEpsdNo = 'epsdno';
        var epsdno = urlParams.get(paramEpsdNo);
        var config = {
                routes: {
                    blood :{
                        reaction : {
                            report: "{{ route('blood.reaction.report.generate') }}?{!! $url !!}",
                            finalize: "{{ route('blood.reaction.report.finalize') }}?{!! $url !!}",
                            falsereport: "{{ route('blood.reaction.report.false') }}?{!! $url !!}",

                            signsymptoms : {
                                store : "{{ route('blood.reaction.signandsymptoms.store') }}?{!! $url !!}",
                            },

                            typeadverseevent : {
                                store : "{{ route('blood.reaction.typeadverseevent.store') }}?{!! $url !!}",
                            },

                            outcomeadverseevent : {
                                store : "{{ route('blood.reaction.outcomeadverseevent.store') }}?{!! $url !!}",
                            },

                            relevantinvestigation : {
                                store : "{{ route('blood.reaction.relevantinvestigation.store') }}?{!! $url !!}",
                            },

                            relevanthistory : {
                                store : "{{ route('blood.reaction.relevanthistory.store') }}?{!! $url !!}",
                            },

                            detailprocedure : {
                                store : "{{ route('blood.reaction.detailprocedure.store') }}?{!! $url !!}",
                            },

                            bloodcomponent : {
                                store : "{{ route('blood.reaction.bloodcomponent.store') }}?{!! $url !!}",
                            },
                        }, 
                    }       
                }
            };
    </script>
    <script src="{{ asset('js/iblood/reaction.js') }}"></script>
@endpush
