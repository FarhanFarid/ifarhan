$(document).ready(function() {

    $('input[type="radio"]').click(function() {
        if ($(this).data('wasChecked')) {
            $(this).prop('checked', false);
            $(this).data('wasChecked', false);
        } else {
            $('input[type="radio"]').data('wasChecked', false);
            $(this).data('wasChecked', true);
        }
    });

    $('.save-relevantinvestigation').on('click', async function() {

        var form        = $(this).parent().parent().find('form#relevantinvestigationform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.relevantinvestigation.store;

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

    $('.clear-relevantinvestigation').on('click', function(e){
        e.preventDefault();
    
        $('form#relevantinvestigationform').trigger('reset');
        $('form#relevantinvestigationform').find(':checkbox, :radio').prop('checked', false);
        $('form#relevantinvestigationform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
    });
   
});