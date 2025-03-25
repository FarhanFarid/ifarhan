<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		@include('layouts.bedmanagement.header')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="aside-enabled">
		<!--begin::Main-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="page d-flex flex-row flex-column-fluid">
				<!--begin::Wrapper-->
				<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content" style="background-color: #f4f4f4;">
						<!--begin::Post-->
						<div class="post d-flex flex-column-fluid" id="kt_post">
							<!--begin::Container-->
							<div id="kt_content_container" class="container-xxl" style="margin-bottom: 10px;">
								<div class="row">
									<div class="col-4 col-xl-2 col-xs-3 col-sm-3" style="background-color: #fff; border-radius: 5px; box-shadow: 0px 2px 6px 2px #dcdcdc !important; padding: 0 !important;">
										@include('layouts.bedmanagement.sidebar')
									</div>
									<div class="col-8 col-xl-10 col-xs-9 col-sm-9">
										<div style="padding: 20px; border-radius: 5px; background-color: #fff; box-shadow: 0px 2px 6px 2px #dcdcdc !important;">
											@yield('content')
										</div>
									</div>
								</div>
							</div>
							<!--end::Container-->
						</div>
						<!--end::Post-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					@include('layouts.iblood.footer')
					<!--end::Footer-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Root-->
		<!--end::Main-->
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
			<i class="ki-duotone ki-arrow-up">
				<span class="path1"></span>
				<span class="path2"></span>
			</i>
		</div>
		<!--end::Scrolltop-->
		<!--begin::Javascript-->
		@include('layouts.bedmanagement.script')
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>