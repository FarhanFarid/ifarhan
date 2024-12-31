@extends('layouts.clr.master')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #1d69e3;">
                <img src="{{ asset('media/logo/clr-logo.png') }}" class="w-55px" style="position: absolute; top: -20px; left: -20px;">
                <h4 style="padding: 0.5rem !important; margin-bottom: 0px !important; color: #fff; margin-left: 35px;">CRITICAL LAB RESULT</h4>
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
                @include('layouts.adr.patientinfo')
            </div>
        </div>
    </div>
    <br/>
    <form id="clreventone">
        @csrf
        <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 1</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Notifier Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="event1notifier" name="event1notifier" value="{{ $getrecord && $getrecord->eventone ? $getrecord->eventone->notifier : Auth::user()->name }}" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Action Taken/Remarks :</b> 
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="event1remarks" id="event1remarks" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}>{{ $getrecord && $getrecord->eventone ? $getrecord->eventone->remarks : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Lab Result No :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="event1labno" name="event1labno" value="{{ $getrecord && $getrecord->eventone ? $getrecord->labno : '' }}" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Staff Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select" data-control="select2" data-placeholder="Select an option" id="event1assign" name="event1assign" {{ $getrecord && $getrecord->eventone ? 'disabled' : '' }}>
                                        @foreach ($getList as $staffs)
                                            <option value="{{ $staffs->cpName }}" {{ $getrecord && $getrecord->eventone && $getrecord->eventone->assignto == $staffs->cpName ? 'selected' : '' }}>
                                                {{ $staffs->cpName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Tests Item :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="event1item" name="event1item" value="{{ $getrecord && $getrecord->eventone ? $getrecord->item : '' }}" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Called Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="event1calleddate" name="event1calleddate" value="{{ $getrecord && $getrecord->eventone ? \Carbon\Carbon::parse($getrecord->eventone->called_date)->format('Y-m-d\TH:i') : '' }}" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Entered Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="event1entereddate" name="event1entereddate" value="{{ $getrecord && $getrecord->eventone ? \Carbon\Carbon::parse($getrecord->eventone->entered_date)->format('Y-m-d\TH:i') : \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" {{ $getrecord && $getrecord->eventone ? 'readonly' : '' }}/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <br/>
        <div class="row mb-3 d-flex align-items-stretch">
            <div class="col-md-12 d-flex flex-column">
                <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                    <div class="d-flex justify-content-center">
                        <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 2</h4>
                    </div>
                </div>
                <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                    <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                        <!-- Notifier Name -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <b>Notifier Name :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control form-control-sm" type="text" id="event2notifier" name="event2notifier" 
                                            value="{{ $getrecord->eventtwo->notifier ?? ($getrecord->eventone->notifier ?? '') }}" 
                                            @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) readonly @elseif(empty($getrecord->eventone)) readonly @endif />
                                    </div>
                                </div>
                            </div>

                            <!-- Doctor -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <b>Doctor :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select" data-control="select2" data-placeholder="Select an option" id="event2assign" name="event2assign" 
                                            @if( isset($getrecord->eventtwo) && $getrecord->eventtwo) disabled @elseif(empty($getrecord->eventone)) disabled @endif>
                                            <option></option>
                                            @foreach ($getList as $staffs)
                                                <option value="{{ $staffs->cpName }}" 
                                                    {{isset($getrecord->eventtwo) && $getrecord->eventtwo && $getrecord->eventtwo->doctor == $staffs->cpName ? 'selected' : '' }}>
                                                    {{ $staffs->cpName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Acknowledged By -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <b>Acknowledged By :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control form-control-sm" type="text" id="event2acknowledgeby" name="event2acknowledgeby" 
                                                value="{{ isset($getrecord->eventtwo) && !empty($getrecord->eventtwo->acknowledgeby) ? $getrecord->eventtwo->acknowledgeby : (empty($getrecord->eventone) ? '' : Auth::user()->name) }}" 
                                                @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) readonly @elseif(empty($getrecord->eventone)) disabled @endif />

                                    </div>
                                </div>
                            </div>

                            <!-- Action Taken/Remarks -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <b>Action Taken/Remarks :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="event2remark" id="event2remark" 
                                            @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) readonly @elseif(empty($getrecord->eventone)) disabled @endif>{{ $getrecord->eventtwo->remarks ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <b>Location :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-select" data-control="select2" data-placeholder="Select an option" id="event2location" name="event2location" 
                                            @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) disabled @elseif(empty($getrecord->eventone)) disabled @endif>
                                            <option></option>
                                            @foreach ($getlocation as $loc)
                                                <option value="{{ $loc->location_name }}" 
                                                    {{isset($getrecord->eventtwo) && $getrecord->eventtwo && $getrecord->eventtwo->location == $loc->location_name ? 'selected' : '' }}>
                                                    {{ $loc->location_name }} ({{ $loc->location_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Called Date / Time -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <b>Called Date / Time :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control form-control-sm" type="datetime-local" id="event2calleddate" name="event2calleddate" 
                                            value="{{ $getrecord->eventtwo->called_date ?? '' }}" 
                                            @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) readonly @elseif(empty($getrecord->eventone)) disabled @endif />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Entered Date / Time -->
                        <div class="row mb-2">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <b>Entered Date / Time :</b>
                                    </div>
                                    <div class="col-md-8">
                                        <input class="form-control form-control-sm" type="datetime-local" id="event2entereddate" name="event2entereddate" 
                                            value="{{ $getrecord->eventtwo->entered_date ?? \Carbon\Carbon::now()->format('Y-m-d\TH:i') }}" 
                                            @if(isset($getrecord->eventtwo) && $getrecord->eventtwo) readonly @elseif(empty($getrecord->eventone)) disabled @endif />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        @if(empty($getrecord->eventone))
        <div class="savedivevent1" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
            <input class="form-control" placeholder="Password" type="password" id="event1password" name="event1password" style="width: 200px;"/>
            <button type="button" class="btn btn-primary font-weight-bold save-event1">{{__('SAVE')}}</button>
            <button type="button" class="btn btn-dark font-weight-bold clear-event1">{{__('CLEAR')}}</button>
        </div>
        @endif
        @if(empty($getrecord->eventtwo) && !empty($getrecord->eventone) )
            <div class="savedivevent2" style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <input class="form-control" placeholder="Password" type="password" id="event2password" name="event2password" style="width: 200px;"/>
                <button type="button" class="btn btn-primary font-weight-bold save-event2">{{__('SAVE')}}</button>
                <button type="button" class="btn btn-dark font-weight-bold clear-event2">{{__('CLEAR')}}</button>
            </div>
        @endif
    </form>
    
    {{-- <div class="row mb-3 d-flex align-items-stretch">
        <div class="col-md-12 d-flex flex-column">
            <div class="card card-custom gutter-b" style="border-radius: 0px !important; background-color: #eaeaea; margin: 0 !important; padding: 0 !important;">
                <div class="d-flex justify-content-center">
                    <h4 class="text-center" style="padding: 0.5rem !important; margin: 0 !important; color: #1d69e3;">EVENT 3</h4>
                </div>
            </div>
            <div class="card card-custom gutter-b flex-grow-1 d-flex flex-column" style="box-shadow: 0px 2px 6px 2px #dcdcdc !important; border-radius: 0px !important;">
                <div class="card-body flex-grow-1" style="padding: 0.75rem !important;">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Acknowledged By :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Action Taken/Remarks :</b> 
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" name="desc" id="desc"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-3 mt-2">
                                    <b>Notifier Name :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="text" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <b>Acknowledged Date / Time :</b> 
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control form-control-sm" type="datetime-local" id="report" name="report"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
                    clr :{
                        save : {
                            eventone    : "{{ route('clr.save.eventone') }}?{!! $url !!}",
                            eventtwo    : "{{ route('clr.save.eventtwo') }}?{!! $url !!}",
                        }, 
                    }       
                }
            };
    </script>
    <script src="{{ asset('js/clr/form.js') }}"></script>

@endpush