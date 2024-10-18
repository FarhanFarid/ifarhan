$(document).ready(function() {

    const $othersRadio = $('input[name="others"][value="others"]'); 
    const $otherscomponent = $('#otherscomponent');

    if ($othersRadio.is(':checked')) {
        $otherscomponent.show();
    } else {
        $otherscomponent.hide();
    }

    $('input[name="others"]').change(function () {
        if ($othersRadio.is(':checked')) {
            $otherscomponent.show();
        } else {
            $otherscomponent.hide(); 
        }
    });

    $('.save-bloodcomponent').on('click', async function() {

        var form        = $(this).parent().parent().find('form#bloodcomponentform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.bloodcomponent.store;

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

    $('.clear-bloodcomponent').on('click', function(e){
        e.preventDefault();
    
        $('form#bloodcomponentform').trigger('reset');
        $('form#bloodcomponentform').find(':checkbox, :radio').prop('checked', false);
        $('form#bloodcomponentform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
    });

});