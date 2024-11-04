$(document).ready(function () {

    $('.gen-report').on('click', function() {
        var url = config.routes.blood.reaction.report;
        $('#report-iframe').attr('src', url); 
        $('#adverse-event-report').modal('show');
    });

    $('.btn-print').on('click', function() {
        var iframe = document.getElementById('report-iframe');
        iframe.contentWindow.print(); // Trigger the print function of the iframe
    });


    $('.save-finalization').on('click', function() {

        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = config.routes.blood.reaction.finalize;

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: {},
            success: function(data) {
                if (data.status === 'success') {
                    $('#adverse-event-report').modal('hide');
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
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error: ' + error, {timeOut: 5000});
            }
        });

    });


});

