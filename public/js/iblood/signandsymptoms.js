$(document).ready(function() {

    const $othergeneralCheckbox = $('#signsymptomsgeneralother');
    const $othergeneralInput = $('#signsymptomsgeneralotherinput');

    if ($othergeneralCheckbox.is(':checked')) {
        $othergeneralInput.show();
    }

    $othergeneralCheckbox.change(function () {
        if ($(this).is(':checked')) {
            $othergeneralInput.show();
        } else {
            $othergeneralInput.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $otherpainCheckbox = $('#signsymptomspainother');
    const $otherpainInput = $('#signsymptomspainotherinput');

    if ($otherpainCheckbox.is(':checked')) {
        $otherpainInput.show();
    }

    $otherpainCheckbox.change(function () {
        if ($(this).is(':checked')) {
            $otherpainInput.show();
        } else {
            $otherpainInput.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $othercardioCheckbox = $('#signsymptomscardioother');
    const $othercardioInput = $('#signsymptomscardiootherinput');

    if ($othercardioCheckbox.is(':checked')) {
        $othercardioInput.show();
    }

    $othercardioCheckbox.change(function () {
        if ($(this).is(':checked')) {
            $othercardioInput.show();
        } else {
            $othercardioInput.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $otherrespiCheckbox = $('#signsymptomsrespiratoryother');
    const $otherrespiInput = $('#signsymptomsrespiratoryotherinput');

    if ($otherrespiCheckbox.is(':checked')) {
        $otherrespiInput.show();
    }

    $otherrespiCheckbox.change(function () {
        if ($(this).is(':checked')) {
            $otherrespiInput.show();
        } else {
            $otherrespiInput.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

 
    $('.save-signsymptoms').on('click', async function() {

        var form        = $(this).parent().parent().find('form#signandsymptomsform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.signsymptoms.store;

        if ($othergeneralCheckbox.is(':checked') && $othergeneralInput.val().trim() === '') {
            toastr.error('Please specify for others general input!', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($otherpainCheckbox.is(':checked') && $otherpainInput.val().trim() === '') {
            toastr.error('Please specify for others pain input!', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($othercardioCheckbox.is(':checked') && $othercardioInput.val().trim() === '') {
            toastr.error('Please specify for others cardiovascular input!', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($otherrespiCheckbox.is(':checked') && $otherrespiInput.val().trim() === '') {
            toastr.error('Please specify for others respiratory input!', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }


        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            // beforeSend: function(){
            //     $("#loading-overlay").show();
            // },
            success: function(data) {
                console.log(data)
                Swal.fire({
                    title: "Success!",
                    text: "Successfully Saved!",
                    icon: "success",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                });

                setTimeout(function() {
                    location.reload();
                }, 3000);
            },
            error: function(xhr, status, error) {
                toastr.error('Error saving reaction: ' + error, {timeOut: 5000});
            }
        });
    });

    $('.clear-signsymptoms').on('click', function(e){
        e.preventDefault();
    
        $('form#signandsymptomsform').trigger('reset');
        $('form#signandsymptomsform').find(':checkbox, :radio').prop('checked', false);
        $('form#signandsymptomsform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
        $('#signsymptomsgeneralotherinput').hide();
    });
    
});