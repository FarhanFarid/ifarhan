@php
    $dischargeformRoutes = [
        'inursing.dischargechecklist.index',
        // 'inursing.limbrestraint.index',
	];
@endphp

<div class="row" style="padding: 0.1rem; padding-left: 15px;">
	<div class="col-2 mt-2">
		<a class="text-hover-success collapse" href="#" data-bs-toggle="collapse" data-bs-target="#iNurSubmenuDCF" aria-expanded="{{ in_array(request()->route()->getName(), $inursingRoutes) ? 'true' : 'false' }}" aria-controls="iNurSubmenuDCF">
			<i id="iNurArrowDCF" class="fas fa-angle-right fs-3 dropdown-toggle-icon {{ in_array(request()->route()->getName(), $inursingRoutes) ? 'rotate-90' : '' }}" 
				style="float: right; margin-bottom: 10px; color: {{ in_array(request()->route()->getName(), $inursingRoutes) ? '#99a1b7' : '#14787c' }}; transition: transform 0.3s;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success" style="color: {{ in_array(request()->route()->getName(), $dischargeformRoutes) ? '#14787c;' : '#1e2129;' }} font-weight: bold; margin-bottom: 10px;" 
			href="#">Discharge Forms</a>
	</div>
</div>

<div class="{{ in_array(request()->route()->getName(), $inursingRoutes)  ? 'show' : '' }}" id="iNurSubmenuDCF">
	<div class="col-12 mt-2" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('inursing.dischargechecklist.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('inursing.dischargechecklist.index') }}?{{$url}}" style="margin-bottom: 10px;">Discharge Checklist</a>
	</div>

	{{-- <div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('inursing.limbrestraint.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('inursing.limbrestraint.index') }}?{{$url}}" style="margin-bottom: 10px;">Post Discharge Visit</a>
	</div> --}}
</div>