<div class="row" style="padding: 0.1rem; padding-left: 15px;">
	<div class="col-12 mt-4" style="padding-left: 40px;">
		<a class="text-hover-success {{ request()->routeIs('report.inursing.wardorientation.index') ? 'text-teal' : 'text-dark' }}" 
		href="{{ route('report.inursing.wardorientation.index') }}?{{$url}}" style="margin-bottom: 10px;">Ward Orientation</a>
	</div>
</div>