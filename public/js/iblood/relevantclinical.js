$(document).ready(function() {

    $('.save-relevantclinical').on('click', async function() {

        var form        = $(this).parent().parent().find('form#relevantclinicalform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.relevanthistory.store;

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

    $('.clear-relevantclinical').on('click', function(e){
        e.preventDefault();
    
        $('form#relevantclinicalform').trigger('reset');
        $('form#relevantclinicalform').find(':checkbox, :radio').prop('checked', false);
        $('form#relevantclinicalform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
    });
   
});