const getAllInput = function (form) {
    // Find disabled inputs, and remove the "disabled" attribute
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    // serialize the form
    var formData = form.serializeArray();
    // re-disabled the set of inputs that you previously enabled
    disabled.attr('disabled','disabled');

    return formData;
}

const processSerialize = function (data) {
    var fData = {};
    $.each(data, function (index, value) {
        if( fData.hasOwnProperty(value.name) ){
            let oriData = fData[value.name];
            if( $.isArray(oriData) ){
                oriData.push(value.value);
                fData[value.name] = oriData;
            }
            else {
                let oriDataN = [oriData];
                oriDataN.push(value.value);
                fData[value.name] = oriDataN;
            }
        }
        else{
            fData[value.name] = value.value;
        }
    });

    return fData;
};

let newWindow;

function openNewWindowAndCheckStatus(url) {
	newWindow = window.open(url,'newwindow', 'width=600,height=550');

	const checkInterval = setInterval(function() {
	if (newWindow && newWindow.closed) {
		callPatientInfo();
		reloadallergic();
		clearInterval(checkInterval);
		// Perform any actions you need when the new window is closed
	} else {
		//console.log("New window is still open.");
		// Optionally, you can perform actions while the window is still open
	}
	}, 1000); // Check every second (adjust interval as needed)
}

function reloadallergic(){
    
	$.ajax({
        url: config.routes.point.subjective.medicationhistory.getdata,
        type: "GET",
        dataType: "json",
        data: {
			epsdnocurrent: urlParams.get(paramEpsdNo),
		},
        success: function(data) {

        	var medication 	= data.medication;
            var patient 	= data.patient;
            var data 		= data.data;
            var html 		= '';
            var html2   	= '';

            if(patient.length > 0 && data != null)
            {
            	html += '<div style="border: 1px solid #aeaeae; margin-top: 5px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px;">';
            	$.each(patient, function(index, value){
            		var holdlinkupdate = allergyLink+value.algid;
            		html += '<div class="row"><div class="col-md-12" style="padding: 5px;">';

            		var holdalrgy = '';

					if(value.substance != '' && value.substance != null)
					{
						holdalrgy = value.substance;
					}
					else
					{
						holdalrgy = value.freetxtall;
					}

        			html += '<b>'+holdalrgy+' - '+value.severity+'</b> ('+moment(value.date).format('DD/MM/YYYY')+')';
        			if(islock == 0 && securitygroup == "EMYDoctors" && idatype == "OE")
					{
	        			if(islock == 0)
	        			{
	        				html += '<a href="#" class="text-hover-warning" style="display: block-inline; float: right;" onclick="openNewWindowAndCheckStatus(\''+holdlinkupdate+'\');return false;"><i class="far fa-edit fs-3" style="color: #000000;"></i></a>';
	        			}
	        		}
	        		else if(islock == 0 && securitygroup == "Doctors" && idatype == "CD")
	        		{
	        			if(islock == 0)
	        			{
	        				html += '<a href="#" class="text-hover-warning" style="display: block-inline; float: right;" onclick="openNewWindowAndCheckStatus(\''+holdlinkupdate+'\');return false;"><i class="far fa-edit fs-3" style="color: #000000;"></i></a>';
	        			}
	        		}
        			html += '<br />';
        			if(value.nature != null && value.nature != '')
        			{
        				html += 'Reaction: '+value.nature+'<br />';
        			}
        			if(value.comment != null && value.comment != '' && value.comment != '-')
        			{
        				html += 'Comments: '+value.comment;
        			}
            		html += '</div></div>';
        			html += '<div class="fv-row" style="margin: auto; border-bottom: solid 1px #cccccc;">';
                    html += '</div>';
            	});
            	html += '</div>';

	            $('#getMhAllergy').html(html);

	            if(medication != null)
	            {
	            	if(medication.currentmedication != null)
					{
		            	var holdsplitmedtc = medication.currentmedication.split('; ');

			        	$.each(holdsplitmedtc, function(index, value){
			        		html2 += (index+1)+') '+value+'<br />';
			        	});
			        }

		            $('#getMhCurrentMedicationTc').html(html2);
	            }
	            else
	            {
	            	$('#getMhCurrentMedicationTc').html('');
	            }

	            if(data.medication_history != null)
	            	$('#getMhCurrentMedication').html(data.medication_history);
	            else
	            	$('#getMhCurrentMedication').html('');
	        }
	        else if(patient.length > 0)
	        {
	        	html += '<div style="border: 1px solid #aeaeae; margin-top: 5px; padding-left: 10px; padding-right: 10px; padding-top: 5px; padding-bottom: 5px;">';
            	$.each(patient, function(index, value){
            		var holdlinkupdate = allergyLink+value.algid;
            		html += '<div class="row"><div class="col-md-12" style="padding: 5px;">';

            		var holdalrgy = '';

					if(value.substance != '')
					{
						holdalrgy = value.substance;
					}
					else if(islock == 0 && securitygroup == "Doctors" && idatype == "CD")
					{
						holdalrgy = value.freetxtall;
					}

        			html += '<b>'+holdalrgy+' - '+value.severity+'</b> ('+moment(value.date).format('DD/MM/YYYY')+')';
        			if(islock == 0 && securitygroup == "EMYDoctors" && idatype == "OE")
					{
	        			if(islock == 0)
	        			{
	        				html += '<a href="#" class="text-hover-warning" style="display: block-inline; float: right;" onclick="openNewWindowAndCheckStatus(\''+holdlinkupdate+'\');return false;"><i class="far fa-edit fs-3" style="color: #000000;"></i></a>';
	        			}
	        		}
	        		else
	        		{
	        			if(islock == 0)
	        			{
	        				html += '<a href="#" class="text-hover-warning" style="display: block-inline; float: right;" onclick="openNewWindowAndCheckStatus(\''+holdlinkupdate+'\');return false;"><i class="far fa-edit fs-3" style="color: #000000;"></i></a>';
	        			}
	        		}
        			html += '<br />';
        			if(value.nature != null && value.nature != '')
        			{
        				html += 'Reaction: '+value.nature+'<br />';
        			}
        			if(value.comment != null && value.comment != '' && value.comment != '-')
        			{
        				html += 'Comments: '+value.comment;
        			}
            		html += '</div></div>';
        			html += '<div class="fv-row" style="margin: auto; border-bottom: solid 1px #cccccc;">';
                    html += '</div>';
            	});
            	html += '</div>';

	            $('#getMhAllergy').html(html);

	            if(medication != null)
	            {
	            	if(medication.currentmedication != null)
					{
		            	var holdsplitmedtc = medication.currentmedication.split('; ');

			        	$.each(holdsplitmedtc, function(index, value){
			        		html2 += (index+1)+') '+value+'<br />';
			        	});
			        }

		            $('#getMhCurrentMedicationTc').html(html2);
	            }
	            else
	            {
	            	$('#getMhCurrentMedicationTc').html('');
	            }

	            $('#getMhCurrentMedication').html('');
	        }
	        else if(medication != null && data == null)
	        {
	        	if(medication.currentmedication != null)
				{
		        	var holdsplitmedtc = medication.currentmedication.split('; ');

		        	$.each(holdsplitmedtc, function(index, value){
		        		html2 += (index+1)+') '+value+'<br />';
		        	});
		        }

	        	$('#getMhAllergy').html('');
	            $('#getMhCurrentMedicationTc').html(html2);
	        }
	        else if(data != null)
	        {
	        	$('#getMhAllergy').html('');

	        	if(medication != null)
	            {
	            	var holdsplitmedtc = medication.currentmedication.split('; ');

		        	$.each(holdsplitmedtc, function(index, value){
		        		html2 += (index+1)+') '+value+'<br />';
		        	});

		            $('#getMhCurrentMedicationTc').html(html2);
	            }
	            else
	            {
	            	$('#getMhCurrentMedicationTc').html('');
	            }

	            if(data.medication_history != null)
	            	$('#getMhCurrentMedication').html(data.medication_history);
	            else
	            	$('#getMhCurrentMedication').html('');
	        }
	        else
	        {
	        	$('#smedicationhistorydata').show();

				$('#eyesmedicationhistory').hide();
				$('#eyeslashsmedicationhistory').show();

				$('#getMhAllergy').html('-');
				$('#getMhCurrentMedicationTc').html('');
				$('#getMhCurrentMedication').html('');
	        }
        }
    });
}