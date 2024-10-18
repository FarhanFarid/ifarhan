@extends('layouts.auth')

@section('content')
<div id="loading-overlay">
    <div class="loading-icon"></div>
</div>
<div class="d-flex flex-column flex-root" id="kt_app_root">   
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">    
        <!--begin::Body-->
        <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
            <!--begin::Form-->
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <!--begin::Wrapper-->
                <div class="w-lg-500px p-10"> 
                    <!--begin::Form-->
                    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                    	 @csrf
                        <!--begin::Heading-->
                        <div class="text-center mb-11">
                            <!--begin::Title-->
                            <h1 class="text-gray-900 fw-bolder mb-3">
                                IJN iClinical
                            </h1>
                            <!--end::Title-->
                            <!--begin::Subtitle-->
                            <div class="text-gray-500 fw-semibold fs-6">
                                Login with IJN's Credentials
                            </div>
                            <!--end::Subtitle--->
                        </div>
                        <div id="ifmaintenance" style="display: none;">
		                    <div class="alert alert-warning" role="alert">
		                        This system is under maintenance mode. We will be back soon. Please try again later.
		                    </div>
		                </div>
		                 @error('msg')
		                    <span style="color: red;">
		                        <strong>{{$errors->first()}}</strong>
		                    </span>
		                @enderror
                        <!--begin::Heading-->
                        <!--begin::Input group--->
                        <div class="fv-row mb-8">
                            <!--begin::Email-->
                            <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent"/> 
                            <!--end::Email-->
                            @error('email')
	                            @if($message == "auth.failed")
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>These credentials do not match our records</strong>
	                                </span>
	                            @else
	                                <span class="invalid-feedback" role="alert">
	                                    <strong>Username is required</strong>
	                                </span>
	                            @endif
	                        @enderror
                        </div>
                        <!--end::Input group--->
                        <div class="fv-row mb-3">    
                            <!--begin::Password-->
                            <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent"/>
                            <!--end::Password-->
                            @error('password')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>Password is required</strong>
	                            </span>
	                        @enderror
                        </div>
                        <!--end::Input group--->  
                        <!--begin::Submit button-->
                        <div class="d-grid mb-10">
                            <a type="button" class="btn btn-primary submitlogin">       
                                <!--begin::Indicator label-->
                                <span class="indicator-label">
                                    Sign In</span>
                                <!--end::Indicator label-->
                                <!--begin::Indicator progress-->
                                <span class="indicator-progress">
                                    Please wait...    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                                <!--end::Indicator progress-->
                            </a>
                        </div>
                        <!--end::Submit button-->
                    </form>
                    <!--end::Form--> 
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Form-->       

            <!--begin::Footer-->  
            <div class="w-lg-500px d-flex flex-center px-10 mx-auto">
                <!--begin::Languages-->
                <div class="me-10">             
                    <span class="opacity-70 mr-4">{{ now()->year }}&nbsp;©</span>
                    <a href="https://www.ijn.com.my/" target="_blank" class="text-gray-800 text-hover-primary" style="color: #004990; font-weight: 600 !important;">Management Information Systems (MIS)</a>        
                </div>
                <!--end::Languages--> 
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Body-->
        
        <!--begin::Aside-->
        <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-color: #7ad4fa54;">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">          
                <!--begin::Logo-->
                <a href="https://uat-iclinical.awan.info/" class="mb-0 mb-lg-12">
                    <img alt="Logo" src="{{ asset('media/logo/ijnflagship.png') }}" class="h-80px h-lg-95px"/>
                </a>    
                <!--end::Logo-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Aside-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection
@push('script')
<script>
    // global app configuration object
    var config = {
        routes: {
            setting: "{{ route('setting') }}",
            login : "{{ route('sso.login') }}",
            dashboard : "{{ route('dashboard') }}"
        }
    };
</script>
<script src="{{ asset('js/auth/login.js') }}"></script>
@endpush