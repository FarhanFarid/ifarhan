$(document).ready(function() {

    const $bypassRadio = $('input[name="bypass"]');
    const $bypassInput = $('#durationbypass');

    // Show/hide the input based on the current selection
    if ($bypassRadio.filter(':checked').val() === 'yes') {
        $bypassInput.show();
    } else {
        $bypassInput.hide();
    }

    // Listen for changes to the radio buttons
    $bypassRadio.change(function () {
        if ($(this).val() === 'yes') {
            $bypassInput.show();
        } else {
            $bypassInput.hide().val(''); // Clear the input if "no" is selected
        }
    });

    const $dripRadio = $('input[name="drip"]');
    const $dripInput = $('#dripothers');

    // Show/hide the input based on the current selection
    if ($dripRadio.filter(':checked').val() === 'others') {
        $dripInput.show();
    } else {
        $dripInput.hide();
    }

    // Listen for changes to the radio buttons
    $dripRadio.change(function () {
        if ($(this).val() === 'others') {
            $dripInput.show();
        } else {
            $dripInput.hide().val(''); // Clear the input if "no" is selected
        }
    });

    $('.save-detailprocedure').on('click', async function() {

        var form        = $(this).parent().parent().find('form#detailprocedureform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.detailprocedure.store;

        if ($dripRadio.filter(':checked').val() === 'others' && $dripInput.val().trim() === '') {
            toastr.error('Please specify for others drip input!', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($bypassRadio.filter(':checked').val() === 'yes' && $bypassInput.val().trim() === '') {
            toastr.error('Please specify duration on bypass machine ', {timeOut: 5000});
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

    $('.clear-detailprocedure').on('click', function(e){
        e.preventDefault();
    
        $('form#detailprocedureform').trigger('reset');
        $('form#detailprocedureform').find(':checkbox, :radio').prop('checked', false);
        $('form#detailprocedureform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
    });
   
});