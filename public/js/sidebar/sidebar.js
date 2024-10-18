$(document).ready(function () {
	//start iclinical
	$('#dropiclinical, #dropiclinicaltitle').on('click', function(e){
		e.preventDefault();

		$('#dropiclinical').hide();
		$('#expandiclinical').show();

		$('#expandiclinicaltitle').show();
		$('#dropiclinicaltitle').hide();

		$('#iclinicalcontent').hide();
	});

	$('#expandiclinical, #expandiclinicaltitle').on('click', function(e){
		e.preventDefault();

		$('#dropiclinical').show();
		$('#expandiclinical').hide();

		$('#expandiclinicaltitle').hide();
		$('#dropiclinicaltitle').show();

		$('#iclinicalcontent').show();
	});
	//end iclinical

	//start inursing
	$('#dropinursing, #dropinursingtitle').on('click', function(e){
		e.preventDefault();

		$('#dropinursing').hide();
		$('#expandinursing').show();

		$('#expandinursingtitle').show();
		$('#dropinursingtitle').hide();

		$('#inursingcontent').hide();
	});

	$('#expandinursing, #expandinursingtitle').on('click', function(e){
		e.preventDefault();

		$('#dropinursing').show();
		$('#expandinursing').hide();

		$('#expandinursingtitle').hide();
		$('#dropinursingtitle').show();

		$('#inursingcontent').show();
	});
	//end inursing

	//start iallied
	//start physio
	$('#dropiallied, #dropialliedtitle').on('click', function(e){
		e.preventDefault();

		$('#dropiallied').hide();
		$('#expandiallied').show();

		$('#expandialliedtitle').show();
		$('#dropialliedtitle').hide();

		$('#ialliedcontent').hide();
	});

	$('#expandiallied, #expandialliedtitle').on('click', function(e){
		e.preventDefault();

		$('#dropiallied').show();
		$('#expandiallied').hide();

		$('#expandialliedtitle').hide();
		$('#dropialliedtitle').show();

		$('#ialliedcontent').show();
	});
	
	///////////////////////////////
	/////// Iallied Imaging ///////
	///////////////////////////////
	$('#dropiallied-imaging_content-title').on('click', function(e){
		e.preventDefault();
		$('#iallied_imaging_content').hide();

		$('#dropiallied-imaging_content-title').hide();
		$('#expendiallied-imaging_content-title').show();
	});
	
	$('#expendiallied-imaging_content-title').on('click', function(e){
		e.preventDefault();
		$('#iallied_imaging_content').show();
		
		$('#expendiallied-imaging_content-title').hide();
		$('#dropiallied-imaging_content-title').show();
	});
	
	/////// nuclear_cardio ///////
	$('#drop_iallied-nuclear_cardio').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-nuclear_cardio').show();
		$('#ialiimage_content-nuclear_cardio').hide();
		$('#drop_iallied-nuclear_cardio').hide();$('#expand_iallied-nuclear_cardio').show();
	});
	$('#expand_iallied-nuclear_cardio').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-nuclear_cardio').show();
		$('#expand_iallied-nuclear_cardio').hide();$('#drop_iallied-nuclear_cardio').show();
	});
	
	/////// computed_tomography ///////
	$('#drop_iallied-computed_tomography').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-computed_tomography').show();
		$('#ialiimage_content-computed_tomography').hide();
		$('#drop_iallied-computed_tomography').hide();$('#expand_iallied-computed_tomography').show();
	});
	$('#expand_iallied-computed_tomography').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-computed_tomography').show();
		$('#expand_iallied-computed_tomography').hide();$('#drop_iallied-computed_tomography').show();
	});
	
	/////// mri ///////
	$('#drop_iallied-mri').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-mri').show();
		$('#ialiimage_content-mri').hide();
		$('#drop_iallied-mri').hide();$('#expand_iallied-mri').show();
	});
	$('#expand_iallied-mri').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-mri').show();
		$('#expand_iallied-mri').hide();$('#drop_iallied-mri').show();
	});
	
	/////// percutBio ///////
	$('#drop_iallied-percutBio').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-percutBio').show();
		$('#ialiimage_content-percutBio').hide();
		$('#drop_iallied-percutBio').hide();$('#expand_iallied-percutBio').show();
	});
	$('#expand_iallied-percutBio').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-percutBio').show();
		$('#expand_iallied-percutBio').hide();$('#drop_iallied-percutBio').show();
	});
	
	/////// petct ///////
	$('#drop_iallied-petct').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-petct').show();
		$('#ialiimage_content-petct').hide();
		$('#drop_iallied-petct').hide();$('#expand_iallied-petct').show();
	});
	$('#expand_iallied-petct').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-petct').show();
		$('#expand_iallied-petct').hide();$('#drop_iallied-petct').show();
	});
	
	/////// rubidium ///////
	$('#drop_iallied-rubidium').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-rubidium').show();
		$('#ialiimage_content-rubidium').hide();
		$('#drop_iallied-rubidium').hide();$('#expand_iallied-rubidium').show();
	});
	$('#expand_iallied-rubidium').on('click', function(e){
		e.preventDefault();$('#ialiimage_content-rubidium').show();
		$('#expand_iallied-rubidium').hide();$('#drop_iallied-rubidium').show();
	});
	
	//////////////////////////////////
	/////// Iallied Pharmacist ///////
	//////////////////////////////////
	$('#dropiallied-pharmacist_content-title').on('click', function(e){
		e.preventDefault();
		$('#iallied_pharmacist_content').hide();

		$('#dropiallied-pharmacist_content-title').hide();
		$('#expendiallied-pharmacist_content-title').show();
	});

	$('#expendiallied-pharmacist_content-title').on('click', function(e){
		e.preventDefault();
		$('#iallied_pharmacist_content').show();
		
		$('#expendiallied-pharmacist_content-title').hide();
		$('#dropiallied-pharmacist_content-title').show();
	});
	
	/////// clinical_pharma_assessment ///////
	$('#drop_iallied-clinical_pharma_assessment').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-clinical_pharma_assessment').show();
		$('#ialipharma_content-clinical_pharma_assessment').hide();
		$('#drop_iallied-clinical_pharma_assessment').hide();$('#expand_iallied-clinical_pharma_assessment').show();
	});
	$('#expand_iallied-clinical_pharma_assessment').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-clinical_pharma_assessment').show();
		$('#expand_iallied-clinical_pharma_assessment').hide();$('#drop_iallied-clinical_pharma_assessment').show();
	});
	
	/////// pom_risk_assessment ///////
	$('#drop_iallied-pom_risk_assessment').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-pom_risk_assessment').show();
		$('#ialipharma_content-pom_risk_assessment').hide();
		$('#drop_iallied-pom_risk_assessment').hide();$('#expand_iallied-pom_risk_assessment').show();
	});
	$('#expand_iallied-pom_risk_assessment').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-pom_risk_assessment').show();
		$('#expand_iallied-pom_risk_assessment').hide();$('#drop_iallied-pom_risk_assessment').show();
	});
	
	/////// pom_passover_note ///////
	$('#drop_iallied-pom_passover_note').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-pom_passover_note').show();
		$('#ialipharma_content-pom_passover_note').hide();
		$('#drop_iallied-pom_passover_note').hide();$('#expand_iallied-pom_passover_note').show();
	});
	$('#expand_iallied-pom_passover_note').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-pom_passover_note').show();
		$('#expand_iallied-pom_passover_note').hide();$('#drop_iallied-pom_passover_note').show();
	});
	
	/////// tdm ///////
	$('#drop_iallied-tdm').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-tdm').show();
		$('#ialipharma_content-tdm').hide();
		$('#drop_iallied-tdm').hide();$('#expand_iallied-tdm').show();
	});
	$('#expand_iallied-tdm').on('click', function(e){
		e.preventDefault();$('#ialipharma_content-tdm').show();
		$('#expand_iallied-tdm').hide();$('#drop_iallied-tdm').show();
	});
	
	
	/////// Iallied Physiotherapy ///////
	$('#dropialliedphysiocontenttitle').on('click', function(e){
		e.preventDefault();
		$('#ialliedphysiocontent').hide();

		$('#dropialliedphysiocontenttitle').hide();
		$('#expendialliedphysiocontenttitle').show();
	});

	$('#expendialliedphysiocontenttitle').on('click', function(e){
		e.preventDefault();
		$('#ialliedphysiocontent').show();
		
		$('#expendialliedphysiocontenttitle').hide();
		$('#dropialliedphysiocontenttitle').show();
	});
	
	/////// adultCrICU ///////
	$('#drop_iallied-adultCrICU').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-adultCrICU').show();
		$('#ialiphysio_content-adultCrICU').hide();
		$('#drop_iallied-adultCrICU').hide();$('#expand_iallied-adultCrICU').show();
	});
	$('#expand_iallied-adultCrICU').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-adultCrICU').show();
		$('#expand_iallied-adultCrICU').hide();$('#drop_iallied-adultCrICU').show();
	});
	
	/////// adultCrICU ///////
	$('#drop_iallied-adultCrWard').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-adultCrWard').show();
		$('#ialiphysio_content-adultCrWard').hide();
		$('#drop_iallied-adultCrWard').hide();$('#expand_iallied-adultCrWard').show();
	});
	$('#expand_iallied-adultCrWard').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-adultCrWard').show();
		$('#expand_iallied-adultCrWard').hide();$('#drop_iallied-adultCrWard').show();
	});
	
	/////// outCRP ///////
	$('#drop_iallied-outCRP').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-outCRP').show();
		$('#ialiphysio_content-outCRP').hide();
		$('#drop_iallied-outCRP').hide();$('#expand_iallied-outCRP').show();
	});
	$('#expand_iallied-outCRP').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-outCRP').show();
		$('#expand_iallied-outCRP').hide();$('#drop_iallied-outCRP').show();
	});
	
	/////// outPainMX ///////
	$('#drop_iallied-outPainMX').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-outPainMX').show();
		$('#ialiphysio_content-outPainMX').hide();
		$('#drop_iallied-outPainMX').hide();$('#expand_iallied-outPainMX').show();
	});
	$('#expand_iallied-outPainMX').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-outPainMX').show();
		$('#expand_iallied-outPainMX').hide();$('#drop_iallied-outPainMX').show();
	});
	
	/////// paedUp ///////
	$('#drop_iallied-paedUp').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-paedUp').show();
		$('#ialiphysio_content-paedUp').hide();
		$('#drop_iallied-paedUp').hide();$('#expand_iallied-paedUp').show();
	});
	$('#expand_iallied-paedUp').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-paedUp').show();
		$('#expand_iallied-paedUp').hide();$('#drop_iallied-paedUp').show();
	});
	
	/////// paedBelow ///////
	$('#drop_iallied-paedBelow').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-paedBelow').show();
		$('#ialiphysio_content-paedBelow').hide();
		$('#drop_iallied-paedBelow').hide();$('#expand_iallied-paedBelow').show();
	});
	$('#expand_iallied-paedBelow').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-paedBelow').show();
		$('#expand_iallied-paedBelow').hide();$('#drop_iallied-paedBelow').show();
	});
	
	/////// spirometryTest ///////
	$('#drop_iallied-spirometryTest').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-spirometryTest').show();
		$('#ialiphysio_content-spirometryTest').hide();
		$('#drop_iallied-spirometryTest').hide();$('#expand_iallied-spirometryTest').show();
	});
	$('#expand_iallied-spirometryTest').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-spirometryTest').show();
		$('#expand_iallied-spirometryTest').hide();$('#drop_iallied-spirometryTest').show();
	});
	
	/////// six_MWT ///////
	$('#drop_iallied-six_MWT').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-six_MWT').show();
		$('#ialiphysio_content-six_MWT').hide();
		$('#drop_iallied-six_MWT').hide();$('#expand_iallied-six_MWT').show();
	});
	$('#expand_iallied-six_MWT').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-six_MWT').show();
		$('#expand_iallied-six_MWT').hide();$('#drop_iallied-six_MWT').show();
	});
	
	/////// berg_Test ///////
	$('#drop_iallied-berg_Test').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-berg_Test').show();
		$('#ialiphysio_content-berg_Test').hide();
		$('#drop_iallied-berg_Test').hide();$('#expand_iallied-berg_Test').show();
	});
	$('#expand_iallied-berg_Test').on('click', function(e){
		e.preventDefault();$('#ialiphysio_content-berg_Test').show();
		$('#expand_iallied-berg_Test').hide();$('#drop_iallied-berg_Test').show();
	});
	
	// end physio

	$('#expandialliedassessmenttitle, #expandialliedsubassessmenttitle').on('click', function(e){
		e.preventDefault();

		$('#expandialliedassessmenttitle').hide();
		$('#dropialliedassessmenttitle').show();

		$('#expandialliedsubassessmenttitle').show();
		$('#dropialliedsubassessmenttitle').hide();

		$('#showassesmentsub').show();
	});

	$('#dropialliedassessmenttitle, #dropialliedsubassessmenttitle').on('click', function(e){
		e.preventDefault();

		$('#dropialliedassessmenttitle').hide();
		$('#expandialliedassessmenttitle').show();

		$('#dropialliedsubassessmenttitle').hide();
		$('#expandialliedsubassessmenttitle').show();

		$('#showassesmentsub').hide();
	});

	$('#expandialliedpreoperativetitle, #expandialliedsubpreoperativetitle').on('click', function(e){
		e.preventDefault();

		$('#dropialliedpreoperativetitle').show();
		$('#expandialliedpreoperativetitle').hide();

		$('#expandialliedsubpreoperativetitle').show();
		$('#dropialliedsubpreoperativetitle').hide();

		$('#showpreoperativesub').show();
	});

	$('#dropialliedpreoperativetitle, #dropialliedsubpreoperativetitle').on('click', function(e){
		e.preventDefault();

		$('#dropialliedpreoperativetitle').hide();
		$('#expandialliedpreoperativetitle').show();

		$('#dropialliedsubpreoperativetitle').hide();
		$('#expandialliedsubpreoperativetitle').show();

		$('#showpreoperativesub').hide();
	});

	$('#expandialliedfollowuptitle, #expandialliedsubfollowuptitle').on('click', function(e){
		e.preventDefault();

		$('#dropialliedprefollowuptitle').show();
		$('#expandialliedfollowuptitle').hide();

		$('#expandialliedsubfollowuptitle').show();
		$('#dropialliedsubprefollowuptitle').hide();

		$('#ialliedcontent').show();
	});

	$('#dropialliedprefollowuptitle, #dropialliedsubprefollowuptitle').on('click', function(e){
		e.preventDefault();

		$('#dropialliedprefollowuptitle').hide();
		$('#expandialliedfollowuptitle').show();

		$('#dropialliedsubprefollowuptitle').hide();
		$('#expandialliedsubfollowuptitle').show();

		$('#ialliedcontent').show();
	});
	//end iallied

	//start report
	$('#dropreport, #dropreporttitle').on('click', function(e){
		e.preventDefault();

		$('#dropreport').hide();
		$('#expandreport').show();

		$('#expandreporttitle').show();
		$('#dropreporttitle').hide();

		$('#reportcontent').hide();
	});

	$('#expandreport, #expandreporttitle').on('click', function(e){
		e.preventDefault();

		$('#dropreport').show();
		$('#expandreport').hide();

		$('#expandreporttitle').hide();
		$('#dropreporttitle').show();

		$('#reportcontent').show();
	});
	//end report

	//start administrator
	$('#dropadmin, #dropadmintitle').on('click', function(e){
		e.preventDefault();

		$('#dropadmin').hide();
		$('#expandadmin').show();

		$('#expandadmintitle').show();
		$('#dropadmintitle').hide();

		$('#admincontent').hide();
	});

	$('#expandadmin, #expandadmintitle').on('click', function(e){
		e.preventDefault();

		$('#dropadmin').show();
		$('#expandadmin').hide();

		$('#expandadmintitle').hide();
		$('#dropadmintitle').show();

		$('#admincontent').show();
	});
	//end administrator

	$('#dropida').on('click', function(e){
		e.preventDefault();

		$('#dropida').hide();
		$('#expandida').show();

		$('#ifida').hide();
	});

	$('#dropds').on('click', function(e){
		e.preventDefault();

		$('#dropds').hide();
		$('#expandds').show();

		$('#ifds').hide();
	});

	$('#dropidacd').on('click', function(e){
		e.preventDefault();

		$('#dropidacd').hide();
		$('#expandidacd').show();

		$('#ifidacd').hide();
	});

	$('#expandida').on('click', function(e){
		e.preventDefault();

		$('#dropida').show();
		$('#expandida').hide();

		$('#ifida').show();
	});

	if($('#usrGrp').val() != 'Doctors'){
		$('#expandds').on('click', function(e){
			e.preventDefault();

			$('#dropds').show();
			$('#expandds').hide();

			$('#ifds').show();
		});
	}

	$('#expandidacd').on('click', function(e){
		e.preventDefault();

		$('#dropidacd').show();
		$('#expandidacd').hide();

		$('#ifidacd').show();
	});

	$('#dropcpw').on('click', function(e){
		e.preventDefault();

		$('#dropcpw').hide();
		$('#expandcpw').show();

		$('#ifcpw').hide();
	});

	$('#expandcpw').on('click', function(e){
		e.preventDefault();

		$('#dropcpw').show();
		$('#expandcpw').hide();

		$('#ifcpw').show();
	});

	if($('#usrGrp').val() == 'Doctors'){
		$('#ifds').hide();
	}

	$('#expandinurallforms, #expandinurallformstitle').on('click', function(e){
		e.preventDefault();

		$('#dropinurallforms').show();
		$('#expandinurallforms').hide();

		$('#expandinurallformstitle').hide();
		$('#dropinurallformstitle').show();

		$('#ifinurallforms').show();
	});

	$('#dropinurallforms, #dropinurallformstitle').on('click', function(e){
		e.preventDefault();

		$('#dropinurallforms').hide();
		$('#expandinurallforms').show();

		$('#expandinurallformstitle').show();
		$('#dropinurallformstitle').hide();

		$('#ifinurallforms').hide();
	});

	$('#expandinurdiabetes, #expandinurdiabetestitle').on('click', function(e){
		e.preventDefault();

		$('#dropinurdiabetes').show();
		$('#expandinurdiabetes').hide();

		$('#expandinurdiabetestitle').hide();
		$('#dropinurdiabetestitle').show();

		$('#ifinurdiabetes').show();
	});

	$('#dropinurdiabetes, #dropinurdiabetestitle').on('click', function(e){
		e.preventDefault();

		$('#dropinurdiabetes').hide();
		$('#expandinurdiabetes').show();

		$('#expandinurdiabetestitle').show();
		$('#dropinurdiabetestitle').hide();

		$('#ifinurdiabetes').hide();
	});

	$('#dropletter').on('click', function(e){
		e.preventDefault();

		$('#dropletter').hide();
		$('#expandletter').show();

		$('#ifletter').hide();
	});

	$('#expandletter').on('click', function(e){
		e.preventDefault();

		$('#dropletter').show();
		$('#expandletter').hide();

		$('#ifletter').show();
	});

	$('#dropdissum').on('click', function(e){
		e.preventDefault();

		$('#dropdissum').hide();
		$('#expanddissum').show();

		$('#ifdissum').hide();
	});

	$('#expanddissum').on('click', function(e){
		e.preventDefault();

		$('#dropdissum').show();
		$('#expanddissum').hide();

		$('#ifdissum').show();
	});

    $('#ibloodSubmenu').on('show.bs.collapse', function () {
        $('#ibloodArrow').addClass('rotate-90').css('color', '#fff');
    });

    $('#ibloodSubmenu').on('hide.bs.collapse', function () {
        $('#ibloodArrow').removeClass('rotate-90').css('color', '#14787c');
    });

	$('#idaSubmenu').on('show.bs.collapse', function () {
        $('#idaArrow').addClass('rotate-90').css('color', '#fff');
    });

    $('#idaSubmenu').on('hide.bs.collapse', function () {
        $('#idaArrow').removeClass('rotate-90').css('color', '#14787c');
    });
});