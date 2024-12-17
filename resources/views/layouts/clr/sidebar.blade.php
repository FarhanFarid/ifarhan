{{-- <!-- start nav ida -->
	@include('layouts.subviewssidebar.navida')
<!-- end nav ida --> --}}
<div class="row {{ request()->routeIs('clr.index') ? 'bg-teal' : '' }}" style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
	<div class="col-2 mt-2">
		<a class="text-hover-success {{ request()->routeIs('clr.index') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
			<i class="fas fa-angle-right fs-3 {{ request()->routeIs('clr.index') ? 'color-white' : 'color-teal' }}" style="float: right; margin-bottom: 10px; color: #14787c;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success {{ request()->routeIs('clr.index') ? 'text-white' : 'text-dark' }}" href="{{ route('clr.index') }}?{{$url}}" style="margin-bottom: 10px;">CLR Listing</a>
	</div>
</div>
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

