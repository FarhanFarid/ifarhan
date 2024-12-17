<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('theme/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js') }}"></script>
<!--end::Custom Javascript-->
<script type="text/javascript">

</script>
<script src="{{ asset('js/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('js/custm.js') }}"></script>
<script type="text/javascript">
	var urlParams 	= new URLSearchParams(window.location.search);
  	var paramEpsdNo = 'epsdno';

	function callPatientInfo()
	{
		$.ajax({
	        url: "{{route('main.patientinfo')}}?{!! $url !!}",
	        type: "GET",
	        dataType: "json",
	        data: {
	        	epsdno: urlParams.get(paramEpsdNo)
	        },
	        success: function(data) {
	            var data = data.data;
	            var html = '';
	            
	            $('#patientinfoname').html(data.name);
	            $('#patientinfomrn').html(data.mrn);
	            $('#patientinfodob').html(data.dob);
	            $('#patientinfoage').html(data.age);
	            $('#patientinfosex').html(data.sex);
	            $('#patientinfoepsnum').html(data.epsdno);
	            $('#patientinfoepsnumdate').html(data.epsddate);
	            $('#patientinfobloodtype').html(data.bloodtype);
	            $('#patientinfoallergy').html(data.allergy);
	            $('#patientinfopayor').html(data.payor);
	            $('#patientinfoweight').html(data.weight);
	            $('#patientinfoheight').html(data.height);
	            $('#patientinfobmi').html(data.bmi);
	            $('#patientinfobsa').html(data.bsa);
	        }
	    });
	}

	callPatientInfo()

	setInterval(callPatientInfo, 60*1000)
</script>
@stack('script')
<!--end::Javascript-->