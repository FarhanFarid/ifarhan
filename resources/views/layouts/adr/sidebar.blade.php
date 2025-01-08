{{-- <!-- start nav ida -->
	@include('layouts.subviewssidebar.navida')
<!-- end nav ida --> --}}

{{-- @php
    $usrGrp = request()->get('usrGrp');
@endphp --}}

<div class="row {{ request()->routeIs('adr.report.index') ? 'bg-teal' : '' }}" style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
	<div class="col-2 mt-2">
		<a class="text-hover-success {{ request()->routeIs('adr.report.index') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
			<i class="fas fa-angle-right fs-3 {{ request()->routeIs('adr.report.index') ? 'color-white' : 'color-teal' }}" style="float: right; margin-bottom: 10px; color: #14787c;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success {{ request()->routeIs('adr.report.index') ? 'text-white' : 'text-dark' }}" href="{{ route('adr.report.index') }}?{{$url}}" style="margin-bottom: 10px;">ADR Listing</a>
	</div>
</div>
{{-- @if(in_array($usrGrp, ["Administrator", "Pharmacist", "PharmacyAssistant"])) --}}
	<div class="row {{ request()->routeIs('report.adr.index') ? 'bg-teal text-white' : '' }}" 
		style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #918f8f;">
		<div class="col-2 mt-2">
			<a class="text-hover-success {{ request()->routeIs('report.adr.index') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
				<i class="fas fa-angle-right fs-3 {{ request()->routeIs('report.adr.index') ? 'color-white' : 'color-teal' }}" 
					style="float: right; margin-bottom: 10px;"></i>
			</a>
		</div>
		<div class="col-10 mt-2" style="padding-left: 0px;">
			<a class="text-hover-success {{ request()->routeIs('report.adr.index') ? 'text-white' : 'text-dark' }}" 
				href="{{ route('report.adr.index') }}?{{$url}}" style="margin-bottom: 10px;">ADR Worklist</a>
		</div>
	</div>
{{-- @endif --}}
{{-- <div class="row {{ request()->routeIs('blood.reaction.index') ? 'bg-teal' : '' }}" style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
	<div class="col-2 mt-2">
		<a class="text-hover-success {{ request()->routeIs('blood.reaction.index') ? 'display-none' : 'display-block' }}" href="#" id="expandregistry" style="margin-bottom: 10px;">
			<i class="fas fa-angle-right fs-3 {{ request()->routeIs('blood.reaction.index') ? 'color-white' : 'color-teal' }}" style="float: right; margin-bottom: 10px;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success {{ request()->routeIs('blood.reaction.index') ? 'text-white' : 'text-dark' }}" href="{{ route('blood.reaction.index') }}?{{$url}}" style="margin-bottom: 10px;">Reaction Report</a>
	</div>
</div> --}}

