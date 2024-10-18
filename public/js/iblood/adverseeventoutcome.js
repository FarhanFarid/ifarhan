$(document).ready(function() {

    const $illnessCheckbox = $('#adverseoutcomeillness');
    const $ilnessInput = $('#adverseoutcomeillnessinput');

    if ($illnessCheckbox.is(':checked')) {
        $ilnessInput.show();
    }

    $illnessCheckbox.change(function () {
        if ($(this).is(':checked')) {
            $ilnessInput.show();
        } else {
            $ilnessInput.hide().val('');
        }
    });

    $('#noill').on('change', function() {
        if ($(this).is(':checked')) {
            $('#adverseoutcomeillness').prop('checked', false);
            $('#adverseoutcomeillnessinput').hide();
        }
    });
    
    $('#adverseoutcomeillness').on('change', function() {
        if ($(this).is(':checked')) {
            $('#noill').prop('checked', false);
            $('#adverseoutcomeillnessinput').show();
        } else {
            $('#adverseoutcomeillnessinput').hide();
        }
    });

    $('input[name="unlikely"], input[name="probable"], input[name="possible"]').on('change', function() {
        $('input[name="unlikely"], input[name="probable"], input[name="possible"]').not(this).prop('checked', false);
    });

    $('.save-outcomeadverse').on('click', async function() {

        var form        = $(this).parent().parent().find('form#outcomeadverseform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.outcomeadverseevent.store;

        if ($illnessCheckbox.is(':checked') && $ilnessInput.val().trim() === '') {
            toastr.error('Please specify the morbidity.', {timeOut: 5000});
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

    $('.clear-outcomeadverse').on('click', function(e){
        e.preventDefault();
    
        $('form#outcomeadverseform').trigger('reset');
        $('form#outcomeadverseform').find(':checkbox, :radio').prop('checked', false);
        $('form#outcomeadverseform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
        $('#adverseoutcomeillnessinput').hide();
    });
   
});