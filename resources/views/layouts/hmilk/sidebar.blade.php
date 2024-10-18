{{-- <!-- start nav ida -->
	@include('layouts.subviewssidebar.navida')
<!-- end nav ida --> --}}
<div class="row {{ request()->routeIs('hmilk.storage.index') ? 'bg-teal' : '' }}" style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
	<div class="col-2 mt-2">
		<a class="text-hover-success {{ request()->routeIs('hmilk.storage.index') ? 'display-none' : 'display-block' }}" href="#" id="expandhr" style="margin-bottom: 10px; display: block;">
			<i class="fas fa-angle-right fs-3 {{ request()->routeIs('hmilk.storage.index') ? 'color-white' : 'color-teal' }}" style="float: right; margin-bottom: 10px; color: #14787c;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success {{ request()->routeIs('hmilk.storage.index') ? 'text-white' : 'text-dark' }}" href="{{ route('hmilk.storage.index') }}?{{$url}}" style="margin-bottom: 10px;">Milk Storage</a>
	</div>
</div>
<div class="row {{ request()->routeIs('hmilk.administer.index') ? 'bg-teal' : '' }}" style="padding: 0.5rem; margin: auto; border-bottom: solid 1px #cccccc;">
	<div class="col-2 mt-2">
		<a class="text-hover-success {{ request()->routeIs('hmilk.administer.index') ? 'display-none' : 'display-block' }}" href="#" id="expandregistry" style="margin-bottom: 10px;">
			<i class="fas fa-angle-right fs-3 {{ request()->routeIs('hmilk.administer.index') ? 'color-white' : 'color-teal' }}" style="float: right; margin-bottom: 10px;"></i>
		</a>
	</div>
	<div class="col-10 mt-2" style="padding-left: 0px;">
		<a class="text-hover-success {{ request()->routeIs('hmilk.administer.index') ? 'text-white' : 'text-dark' }}" href="{{ route('hmilk.administer.index') }}?{{$url}}" style="margin-bottom: 10px;">Administer</a>
	</div>
</div>

