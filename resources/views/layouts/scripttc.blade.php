<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('theme/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

<!--end::Custom Javascript-->
<script src="{{ asset('js/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('js/custm.js') }}"></script>

<script type="text/javascript">
	$.ajaxSetup({
    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>
@stack('script')
<!--end::Javascript-->