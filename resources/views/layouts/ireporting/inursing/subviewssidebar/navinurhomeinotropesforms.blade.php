@php
    $homeinotropesformRoutes = [
        'report.inursing.patientassmtchecklist.index',
        'report.inursing.homeassmtchecklist.index',
	];
@endphp

<div class="row" style="padding: 0.1rem; padding-left: 15px;">
	<div class="col-2 mt-2">
		<a class="text-hover-success collapse" href="#" data-bs-toggle="collapse" data-bs-target="#iNurSubmenuHIF" aria-expanded="{{ in_array(request()->route()->getName(), $inursingRoutes) ? 'true' : 'false' }}" aria-controls="iNurSubmenuHIF">
			<i id="iNurArrowHIF" class="fas fa-angle-right fs-3 dropdown-toggle-icon {{ in_array(request()->route()->getName(), $inursingRoutes) ? 'rotate-90' : '' }}" 
				style="float: right; margin-bottom: 10px; color: {{ in_array(request()->route()->getName(), $inursingRoutes) ? '#99a1b7' : '#14787c' }}; transition: transform 0.3s;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success" style="color: {{ in_array(request()->route()->getName(), $homeinotropesformRoutes) ? '#14787c;' : '#1e2129;' }} 
			font-weight: bold; margin-bottom: 10px;" 
			href="#">Home Inotropes</a>
	</div>
</div>

<div class="{{ in_array(request()->route()->getName(), $inursingRoutes)  ? 'show' : '' }}" id="iNurSubmenuHIF">
	{{-- <div class="col-12 mt-2" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.dysphagia.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.dysphagia.index') }}?{{$url}}" style="margin-bottom: 10px;">Bedside Mobility Assessment Tool (BMAT)</a>
	</div> --}}

	<div class="col-12 mt-2" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.patientassmtchecklist.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.patientassmtchecklist.index') }}?{{$url}}" style="margin-bottom: 10px;">Patient Assessment Checklist for Home Inotropes</a>
	</div>

	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.homeassmtchecklist.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.homeassmtchecklist.index') }}?{{$url}}" style="margin-bottom: 10px;">Home Assessment Checklist</a>
	</div>
</div>