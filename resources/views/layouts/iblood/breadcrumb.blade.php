<!--begin::Title-->
@if(($title ?? '') != null)
<h1 class="d-flex flex-column text-white fw-bold fs-3 mb-0">{{$title ?? ''}}</h1>
<!--end::Title-->
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
	<!--begin::Item-->
	@if(($first ?? '') != null)
	<li class="breadcrumb-item" style="color: #fff;">{{$first ?? ''}}</li>
	@endif
	<!--end::Item-->
</ul>
@endif