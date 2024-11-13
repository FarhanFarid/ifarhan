{{-- <!-- start nav ida -->
	@include('layouts.subviewssidebar.navida')
<!-- end nav ida --> --}}

@php
    $usrGrp = request()->get('usrGrp');
@endphp

<!-- iMilk -->
@if(in_array($usrGrp, ["Administrator", "Doctors", "WardNurse", "WardNursePrivate", "WardClerk", "WardManagerOrMentor", "OPDNurse"]))
	<div class="row {{ request()->routeIs('report.imilk.index') ? 'bg-teal text-white' : '' }}" 
		style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-2 mt-2">
			<a class="text-hover-success {{ request()->routeIs('report.imilk.index') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
				<i class="fas fa-angle-right fs-3 {{ request()->routeIs('report.imilk.index') ? 'color-white' : 'color-teal' }}" 
					style="float: right; margin-bottom: 10px;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 0px;">
			<a class="text-hover-success {{ request()->routeIs('report.imilk.index') ? 'text-white' : 'text-dark' }}" 
				href="{{ route('report.imilk.index') }}?{{$url}}" style="margin-bottom: 10px;">iMilk</a>
		</div>
	</div>
@endif

<!-- iBlood Dropdown -->
@if(in_array($usrGrp, ["Administrator", "Doctors", "WardNurse", "WardNursePrivate", "WardClerk", "WardManagerOrMentor", "OPDNurse", "LABManager", "LABMLT", "LABTemp", "LABClerk","EMY","EMYDoctors","ICLNurse","OTNurse", "QualityManagement"]))
	<div class="row {{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? 'bg-teal text-white' : '' }}" 
		style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-2 mt-2">
			<a class="text-hover-success" href="#" data-bs-toggle="collapse" data-bs-target="#ibloodSubmenu" aria-expanded="{{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? 'true' : 'false' }}" aria-controls="ibloodSubmenu">
				<i id="ibloodArrow" class="fas fa-angle-right fs-3 dropdown-toggle-icon {{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? 'rotate-90' : '' }}" 
					style="float: right; margin-bottom: 10px; color: {{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? '#fff' : '#14787c' }}; transition: transform 0.3s;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 0px;">
			<a class="text-hover-success {{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? 'text-white' : 'text-dark' }}" 
				data-bs-toggle="collapse" data-bs-target="#ibloodSubmenu" href="#" style="margin-bottom: 10px;">iBlood</a>
		</div>
	</div>
@endif
<!-- Submenu for iBlood -->
<div class="collapse {{ request()->routeIs('report.iblood.index') || request()->routeIs('report.iblood.atr.index') ? 'show' : '' }}" id="ibloodSubmenu">
	<div class="row" style="padding-left: 30px; margin-top: 10px;">
		@if(in_array($usrGrp, ["Administrator", "Doctors", "WardNurse", "WardNursePrivate", "WardClerk", "WardManagerOrMentor", "OPDNurse", "LABManager", "LABMLT", "LABTemp", "LABClerk","EMY","EMYDoctors","ICLNurse","OTNurse"]))
			<div class="col-12" style="padding-bottom: 8px;">
				<a class="text-hover-success {{ request()->routeIs('report.iblood.index') ? 'text-teal' : 'text-dark' }}" 
				href="{{ route('report.iblood.index') }}?{{$url}}" style="margin-bottom: 10px;">History</a>
			</div>
		@endif
		@if(in_array($usrGrp, ["Administrator", "LABManager", "LABMLT", "LABTemp", "LABClerk", "QualityManagement"]))
			<div class="col-12">
				<a class="text-hover-success {{ request()->routeIs('report.iblood.atr.index') ? 'text-teal' : 'text-dark' }}" 
				href="{{ route('report.iblood.atr.index') }}?{{$url}}" style="margin-bottom: 10px;">Worklist</a>
			</div>
		@endif
	</div>
</div>

<!-- IDA Dropdown -->
@if(in_array($usrGrp, ["Administrator"]))
	<div class="row {{ request()->routeIs('report.ida.preadmission.index') ? 'bg-teal text-white' : '' }}" 
		style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-2 mt-2">
			<a class="text-hover-success" href="#" data-bs-toggle="collapse" data-bs-target="#idaSubmenu" aria-expanded="{{ request()->routeIs('report.ida.preadmission.index') ? 'true' : 'false' }}" aria-controls="idaSubmenu">
				<i id="idaArrow" class="fas fa-angle-right fs-3 dropdown-toggle-icon {{ request()->routeIs('report.ida.preadmission.index') ? 'rotate-90' : '' }}" 
					style="float: right; margin-bottom: 10px; color: {{ request()->routeIs('report.ida.preadmission.index') ? '#fff' : '#14787c' }}; transition: transform 0.3s;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 0px;">
			<a class="text-hover-success {{ request()->routeIs('report.ida.preadmission.index') ? 'text-white' : 'text-dark' }}" 
				data-bs-toggle="collapse" data-bs-target="#idaSubmenu" href="#" style="margin-bottom: 10px;">IDA</a>
		</div>
	</div>
@endif
<!-- Submenu for IDA -->
<div class="collapse {{ request()->routeIs('report.ida.preadmission.index') ? 'show' : '' }}" id="idaSubmenu">
   <div class="row" style="padding-left: 30px; margin-top: 10px;">
	   @if(in_array($usrGrp, ["Administrator"]))
		   <div class="col-12" style="padding-bottom: 8px;">
			   <a class="text-hover-success {{ request()->routeIs('report.ida.preadmission.index') ? 'text-teal' : 'text-dark' }}" 
			   href="{{ route('report.ida.preadmission.index') }}?{{$url}}" style="margin-bottom: 10px;">Pre-Admission</a>
		   </div>
	   @endif
	   {{-- @if(in_array($usrGrp, ["Administrator", "LABManager", "LABMLT", "LABTemp", "LABClerk", "QualityManagement"]))
		   <div class="col-12">
			   <a class="text-hover-success {{ request()->routeIs('report.iblood.atr.index') ? 'text-teal' : 'text-dark' }}" 
			   href="{{ route('report.iblood.atr.index') }}?{{$url}}" style="margin-bottom: 10px;">Worklist</a>
		   </div>
	   @endif --}}
   </div>
</div>
@if(in_array($usrGrp, ["Administrator" , "MROffice"]))
	<div class="row {{ request()->routeIs('report.dischargesummary') ? 'bg-teal text-white' : '' }}" 
		style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
		<div class="col-2 mt-2">
			<a class="text-hover-success {{ request()->routeIs('report.dischargesummary') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
				<i class="fas fa-angle-right fs-3 {{ request()->routeIs('report.dischargesummary') ? 'color-white' : 'color-teal' }}" 
					style="float: right; margin-bottom: 10px;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 0px;">
			<a class="text-hover-success {{ request()->routeIs('report.dischargesummary') ? 'text-white' : 'text-dark' }}" 
				href="{{ route('report.dischargesummary') }}?{{$url}}" style="margin-bottom: 10px;">Discharge Summary</a>
		</div>
	</div>
@endif