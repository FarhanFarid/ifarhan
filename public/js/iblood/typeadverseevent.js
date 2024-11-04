$(document).ready(function() {

    const $section11Checkbox = $('#section11');
    const $section11Input = $('#section11_input');

    if ($section11Checkbox.is(':checked')) {
        $section11Input.show();
    }

    $section11Checkbox.change(function () {
        if ($(this).is(':checked')) {
            $section11Input.show();
        } else {
            $section11Input.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $section12Checkbox = $('#section12');
    const $section12Input = $('#section12_input');

    if ($section12Checkbox.is(':checked')) {
        $section12Input.show();
    }

    $section12Checkbox.change(function () {
        if ($(this).is(':checked')) {
            $section12Input.show();
        } else {
            $section12Input.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $section13Checkbox = $('#section13');
    const $section13Input = $('#section13_input');

    if ($section13Checkbox.is(':checked')) {
        $section13Input.show();
    }

    $section13Checkbox.change(function () {
        if ($(this).is(':checked')) {
            $section13Input.show();
        } else {
            $section13Input.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    const $section16Checkbox = $('#section16');
    const $section16Input = $('#section16_input');

    if ($section16Checkbox.is(':checked')) {
        $section16Input.show();
    }

    $section16Checkbox.change(function () {
        if ($(this).is(':checked')) {
            $section16Input.show();
        } else {
            $section16Input.hide().val(''); // Clear the input if the checkbox is unchecked
        }
    });

    $('.save-typeadverseevent').on('click', async function() {

        var form        = $(this).parent().parent().find('form#typeadverseeventform');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.blood.reaction.typeadverseevent.store;

        if ($section11Checkbox.is(':checked') && $section11Input.val().trim() === '') {
            toastr.error('Please specify the virus for section 11.', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($section12Checkbox.is(':checked') && $section12Input.val().trim() === '') {
            toastr.error('Please specify the bacteria for section 12.', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($section13Checkbox.is(':checked') && $section13Input.val().trim() === '') {
            toastr.error('Please specify the parasite for section 13.', {timeOut: 5000});
            e.preventDefault(); // Prevent form submission
        }

        if ($section16Checkbox.is(':checked') && $section16Checkbox.val().trim() === '') {
            toastr.error('Please specify the other input for section 16.', {timeOut: 5000});
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

    $('.clear-typeadverseevent').on('click', function(e){
        e.preventDefault();
    
        $('form#typeadverseeventform').trigger('reset');
        $('form#typeadverseeventform').find(':checkbox, :radio').prop('checked', false);
        $('form#typeadverseeventform').find('input[type="text"]:not(#bagNo), textarea').val(''); 
        $('#section11_input').hide();
        $('#section12_input').hide();
        $('#section13_input').hide();
        $('#section16_input').hide();
    });
   
});