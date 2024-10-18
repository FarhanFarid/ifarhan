<script src="{{ asset('theme/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('theme/assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('theme/assets/js/custom/widgets.js') }}"></script>
@if(
	request()->routeIs('iali.pharmacist') || 
	request()->routeIs('iali.physiotherapist') || 
	request()->routeIs('iali.physiotherapist.assessment') || 
	request()->routeIs('iali.assessment') || 
	request()->routeIs('iali.physiotherapist.assessment-previous-encounter-entry') || 
	request()->routeIs('iali.six_minute_walk_test') ||
	request()->routeIs('iali.berg_test')
)	
@else	
	<script src="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
@endif
<!--end::Custom Javascript-->
<script type="text/javascript">

</script>
<script src="{{ asset('js/sidebar/sidebar.js') }}"></script>
<script src="{{ asset('js/custm.js') }}"></script>

<script type="text/javascript">
	var getUrl = new URLSearchParams(window.location.search);

	if(getUrl.has('temp')) {

		var navdt = getUrl.get('temp');

		$('#'+navdt.replace('shared:','')).attr('href', 'javascript:');
  	}

	$(document).on('dblclick','input[type=radio]',function(){
	    if(this.checked){
	        $(this).prop('checked', false);
	    }
	});
	
	$.ajaxSetup({
    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	var pathname = window.location.pathname;

	var oe 	 = "/ida/general/oe";
	var oedp = "/discharge-plan";
	var cd 	 = "/ida/general/cd";

	var urlParams 		= new URLSearchParams(window.location.search);
  	var paramUsername 	= 'username';
  	var paramEpsdNoMain = 'epsdno';
  	var paramEpsdNo;

  	if(pathname.indexOf(oe) != -1 || pathname.indexOf(oedp) != -1)
  	{
  		if(urlParams.get('epsdno').indexOf('EP') != -1)
  		{
  			paramEpsdNo = 'epsdno';
  		}
  		else
  		{
  			paramEpsdNo = 'epsdno2';
  		}
  	}
  	else
  	{
  		if(urlParams.get('epsdno').indexOf('IP') != -1 || urlParams.get('epsdno').indexOf('OP') != -1)
  		{
  			paramEpsdNo = 'epsdno';
  		}
  		else
  		{
  			paramEpsdNo = 'epsdno2';
  		}
  	}

	function callPatientInfo()
	{
		$.ajax({
	        url: "{{route('main.patientinfo')}}?{!! $url !!}",
	        type: "GET",
	        dataType: "json",
	        data: {
	        	epsdno: urlParams.get(paramEpsdNoMain)
	        },
	        success: function(data) {
	            var data = data.data;
	            var html = '';
	            
	            $('#patientinfoname').html('<b>'+data.name+'</b>');
	            $('#patientinfomrn').html(data.mrn);
	            $('#patientinfodob').html(data.dob);
	            $('#patientinfoage').html(data.age);
	            $('#patientinfosex').html(data.sex);
	            $('#patientinforace').html(data.race);
	            $('#patientinforeligion').html(data.religion);
	            $('#patientinfoepsnum').html(data.epsdno);
	            $('#patientinfoepsnumdate').html(data.epsddate);
	            $('#patientinfobloodtype').html(data.bloodtype);
	            $('#patientinfoallergy').html(data.allergy);
	            $('#patientinfopayor').html(data.payor);
	            $('#patientinfoweight').html(data.weight);
	            $('#patientinfoheight').html(data.height);
	            $('#patientinfobmi').html(data.bmi);
	            $('#patientinfobsa').html(data.bsa);
	            $('#ciweightdisplay').html(data.weight);
	            $('#ciheightdisplay').html(data.height);
	            $('#cibmidisplay').html(data.bmi);
	            $('#cibsadisplay').html(data.bsa);
	            $('#ciefdisplay').html(data.ef);
	            $('#ciefcdisplay').html(data.efc);
	            $('#showopeintervention').html(data.epiinterv);
	            $('#getOInterventionDisplay').html(data.epiinterv);

				if(data.cpw != null) {
					$('#ifcpwnotnone').show();
					$('#patientinfocpw').html(data.cpw);
				}
				else {
					$('#ifcpwnotnone').hide();
					$('#patientinfocpw').html('-');
				}
	        }
	    });
	}

	callPatientInfo();

	setInterval(callPatientInfo, 1800*1000);
</script>
@stack('script')
<!--end::Javascript-->