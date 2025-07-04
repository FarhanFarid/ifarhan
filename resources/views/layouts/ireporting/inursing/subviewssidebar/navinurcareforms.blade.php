@php
    $careformRoutes = [
		'report.inursing.bedsidemobilityassmnt.index',
		'report.inursing.safetychecklist.index',
        'report.inursing.dysphagia.index',
		'report.inursing.peritonealchart.index',
        'report.inursing.limbrestraint.index',
	];
@endphp

<div class="row" style="padding: 0.1rem; padding-left: 15px;">
	<div class="col-2 mt-2">
		<a class="text-hover-success collapse" href="#" data-bs-toggle="collapse" data-bs-target="#iNurSubmenuNCF" aria-expanded="{{ in_array(request()->route()->getName(), $inursingRoutes) ? 'true' : 'false' }}" aria-controls="iNurSubmenuNCF">
			<i id="iNurArrowNCF" class="fas fa-angle-right fs-3 dropdown-toggle-icon {{ in_array(request()->route()->getName(), $inursingRoutes) ? 'rotate-90' : '' }}" 
				style="float: right; margin-bottom: 10px; color: {{ in_array(request()->route()->getName(), $inursingRoutes) ? '#99a1b7' : '#14787c' }}; transition: transform 0.3s;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success" style="color: {{ in_array(request()->route()->getName(), $careformRoutes) ? '#14787c;' : '#1e2129;' }} 
			font-weight: bold; margin-bottom: 10px;" 
			href="#">Nursing Care Forms</a>
	</div>
</div>

<div class="{{ in_array(request()->route()->getName(), $inursingRoutes)  ? 'show' : '' }}" id="iNurSubmenuNCF">
	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.bedsidemobilityassmnt.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.bedsidemobilityassmnt.index') }}?{{$url}}" style="margin-bottom: 10px;">Bedside Mobility Assessment Tool (BMAT)</a>
	</div>

	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.safetychecklist.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.safetychecklist.index') }}?{{$url}}" style="margin-bottom: 10px;">Safety Checklist</a>
	</div>

	<div class="col-12 mt-2" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.dysphagia.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.dysphagia.index') }}?{{$url}}" style="margin-bottom: 10px;">Dysphagia Screening</a>
	</div>

	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.peritonealchart.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.peritonealchart.index') }}?{{$url}}" style="margin-bottom: 10px;">Peritoneal Dialysis Chart</a>
	</div>

	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.limbrestraint.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.limbrestraint.index') }}?{{$url}}" style="margin-bottom: 10px;">Limb Restraint</a>
	</div>

	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.miscellaneous.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.miscellaneous.index') }}?{{$url}}" style="margin-bottom: 10px;">Miscellaneous</a>
	</div>
</div>