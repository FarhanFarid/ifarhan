$(document).ready(function () {

    $('.gen-report').on('click', function() {
        var url = config.routes.adr.report.generate;
        $('#report-iframe').attr('src', url); 
        $('#adverse-drug-report').modal('show');
    });

    $('.save-finalization').on('click', function() {
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = config.routes.adr.report.finalize;

        $('#adverse-drug-report').modal('hide');

        Swal.fire({
            title: 'Confirm ADR',
            text: 'Are you sure you want to finalize this report?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#37e31d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Finalize'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {},
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#adverse-drug-report').modal('hide');
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
                        }else{
                            $('#adverse-drug-report').modal('hide');
                            Swal.fire({
                                title: "Failed!",
                                text: data.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-light"
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error: ' + error, {timeOut: 5000});
                    }
                });
            }else{
                $('#adverse-drug-report').modal('show');

            }
        });

    });

    $('.save-false').on('click', function() {
        $.ajaxSetup({
            headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = config.routes.adr.report.false;

        $('#adverse-drug-report').modal('hide');

        Swal.fire({
            title: 'False Report ADR',
            text: 'Are you sure you want to finalize this report?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#37e31d',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Finalize'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {},
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#adverse-drug-report').modal('hide');
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
                        }else{
                            $('#adverse-drug-report').modal('hide');
                            Swal.fire({
                                title: "Failed!",
                                text: data.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-light"
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error: ' + error, {timeOut: 5000});
                    }
                });
            }else{
                $('#adverse-drug-report').modal('show');

            }
        });
    });


});