<div class="app-navbar flex-shrink-0">
	<!--begin::User menu-->
	<div class="app-navbar-item ms-3 ms-lg-6" id="kt_header_user_menu_toggle">
		<!--begin::Menu wrapper-->
		<div class="cursor-pointer symbol symbol-35px symbol-lg-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
		</div>
		<!--begin::User account menu-->
		<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
			<!--begin::Menu item-->
			<div class="menu-item px-3">
				<div class="menu-content d-flex align-items-center px-3">
					<!--begin::Username-->
					<div class="d-flex flex-column">
						<div class="fw-bold d-flex align-items-center fs-5">{{Auth::user()->access->tcusername}}</div>
					</div>
					<!--end::Username-->
				</div>
			</div>
			<!--end::Menu item-->
			<!--begin::Menu separator-->
			<div class="separator my-2"></div>
			<!--end::Menu separator-->
		</div>
		<!--end::User account menu-->
		<!--end::Menu wrapper-->
	</div>
	<!--end::User menu-->
</div>