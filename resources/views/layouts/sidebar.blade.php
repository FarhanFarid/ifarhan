@php
    $inursingRoutes = config('dynamicroutes.inursing_routes');
@endphp


<!-- start inursing -->
@if (Auth::user()->usergrp != "SocialWorker" && Auth::user()->usergrp != "Pharmacist")
	{{-- @if(in_array(Auth::user()->usergrp, ["Administrator","WardNurse","WardNursePrivate","WardManagerOrMentor"])) --}}
	<div class="row bg-teal" style="padding: 0.1rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-1 mt-2">
			<a class="text-hover-success {{ in_array(request()->route()->getName(), $inursingRoutes) ? 'displaynone' : 'displayblock' }}" href="#" id="expandinursing">
				<i class="fas fa-angle-right fs-3 color-white" style=" margin-bottom: 5px; color: #14787c;"></i>
			</a>
			<a class="text-hover-success {{ in_array(request()->route()->getName(), $inursingRoutes) ? 'displayblock' : 'displaynone' }}" href="#" id="dropinursing">
				<i class="fas fa-angle-down fs-3 color-white" style=" margin-bottom: 5px;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 8px;">
			<a class="text-white" href="#" style="margin-bottom: 5px;" id="expandinursingtitle"><b>iNursing</b></a>
			<a class="text-white" href="#" style="margin-bottom: 5px; display: none;" id="dropinursingtitle"><b>iNursing</b></a>
		</div>
	</div>
	<div class="{{ in_array(request()->route()->getName(), $inursingRoutes) ? 'mainnavshow' : 'mainnavhide' }}" id="inursingcontent">
		<!-- start nav ina assessment -->
			{{-- @include('layouts.inursing.subviewssidebar.navinaassmt') --}}
		<!-- end nav ina assessment -->
		<!-- start nav inur -->
		@include('layouts.inursing.subviewssidebar.navinurwardorientation')			
		@include('layouts.inursing.subviewssidebar.navinurallforms')
		<!-- end nav inur -->
	</div>
	{{-- @endif --}}
	<!-- end inursing -->
@endif
<!-- end inursing -->

<!-- start iallied -->
@if (	Auth::user()->usergrp == "Physiotherapist" || 
		Auth::user()->usergrp == "Radiology" || 
		Auth::user()->usergrp == "SocialWorker" || 
		Auth::user()->usergrp == "Pharmacist" || 
		Auth::user()->usergrp == "Nurse" || 
		Auth::user()->usergrp == "OPDNurse" || 
		Auth::user()->usergrp == "Doctors" || 
		Auth::user()->usergrp == "WardNurse" || 
		Auth::user()->usergrp == "WardNursePrivate" || 
		Auth::user()->usergrp == "WardManagerOrMentor" 
	)
	<div class="row bg-teal" style="padding: 0.1rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-1 mt-2">
			<a class="text-hover-success 
					{{ 	request()->routeIs('iali.physiotherapist') || 
						request()->routeIs('iali.physiotherapist.assessment') || 
						request()->routeIs('iali.imaging') || 
						request()->routeIs('iali.counsellor') || 
						request()->routeIs('iali.counsellor.spiritualcare') || request()->routeIs('iali.counsellor.counsellingservice') ? 'displaynone' : 'displayblock' }}" href="#" id="expandiallied">
				<i class="fas fa-angle-right fs-3 color-white" style=" margin-bottom: 5px; color: #14787c;"></i>
			</a>
			<a class="text-hover-success 
					{{ 	request()->routeIs('iali.physiotherapist') || 
						request()->routeIs('iali.physiotherapist.assessment') || 
						request()->routeIs('iali.imaging') || 
						request()->routeIs('iali.counsellor') || 
						request()->routeIs('iali.counsellor.spiritualcare') || 
						request()->routeIs('iali.counsellor.counsellingservice') ? 'displayblock' : 'displaynone' }}" href="#" id="dropiallied">
				<i class="fas fa-angle-down fs-3 color-white" style=" margin-bottom: 5px;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 8px;">
			<a class="text-white" href="#" style="margin-bottom: 5px;" id="expandialliedtitle"><b>iAllied</b></a>
			<a class="text-white" href="#" style="margin-bottom: 5px; display: none;" id="dropialliedtitle"><b>iAllied</b></a>
		</div>
	</div>
	<div class="{{ 
		request()->routeIs('iali.assessment') || 
		request()->routeIs('iali.physiotherapist') || 
		request()->routeIs('iali.physiotherapist.assessment') || 
		request()->routeIs('iali.six_minute_walk_test') || 
		request()->routeIs('iali.berg_test') || 
		request()->routeIs('iali.pharmacist') || 
		request()->routeIs('iali.imaging') || 
		request()->routeIs('iali.counsellor') || 
		request()->routeIs('iali.counsellor.spiritualcare') || 
		request()->routeIs('iali.counsellor.counsellingservice')|| 
		request()->routeIs('iali.counsellor.summaryreview') ? 'mainnavshow' : 'mainnavhide' }}" id="ialliedcontent">
		@include('layouts.subviewssidebar.naviali')
	</div>
@endif
<!-- end iallied -->