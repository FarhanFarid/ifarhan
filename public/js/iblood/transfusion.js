$(document).ready(function () {

    toastr.options = {
        "closeButton": false,
        "debug": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    function checkAndSubmit() {
        var labno = $('#labno').val();
        var mrn = $('#mrn').val();
        var bag = $('#bagsno').val();
        
        if (labno !== '' && mrn !== '' && bag !== '') {
            $('#checkmatch').click();
        }
    }

    function processbagno(scannedData) {
        const lines = scannedData.split(':');

        bagNumber = lines[11].trim();

        $('#bagsno').val(bagNumber);
        $('#mrn').focus();

    }

    function processlabno(scannedData) {
        const lines = scannedData.split(':');

        labNumber = lines[4].trim(); 

        $('#labno').val(labNumber);
        $('#bagsno').focus();
    }

    // Event listener for input field value change
    $('#labno').on('change', function() {
        let scannedData = $(this).val();

        processlabno(scannedData);
        // checkAndSubmit();
    });

    $('#bagsno').on('change', function() {
        let scannedData = $(this).val();

        processbagno(scannedData);
    });

    $('#mrn').on('change', function() {
        checkAndSubmit();
    });

    $('#checkmatch').on('click', function() {
        var labno = $('#labno').val();
        var mrn = $('#mrn').val();
        var bagsno = $('#bagsno').val();
        var url = config.routes.blood.transfusion.check;

        if (mrn == "000") {
            Swal.fire({
                title: "Alert!",
                text: "This blood pack did not belong to this patient!",
                icon: "error",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        if (labno == '' || mrn == '' || bagsno == '') {
            toastr.error('Please fill all the fields', {timeOut: 5000});
            return;
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: { labno: labno, mrn: mrn, bagsno: bagsno  },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {

                    console.log(response);

                    var data = response.data;
                    var patientData = response.patient;
                    var info = response.info;

                    var html = '<table class="table table-bordered">';
                    html += '<thead>';
                    html += '<tr><th style="color: #000000; min-width: 100px;">MRN</th><th style="color: #000000; min-width: 100px;">Product</th><th style="color: #000000; min-width: 100px;">Name</th><th style="color: #000000; min-width: 100px;">Episode No.</th><th style="color: #000000; min-width: 100px;">Episode Date</th><th style="color: #000000; min-width: 100px;">Bag Number</th><th style="color: #000000; min-width: 100px;">Lab Number</th><th style="<th style="color: #000000; min-width: 100px;">Action</th></tr>';
                    html += '</thead>';
                    html += '<tbody>';
                    html += '<tr>';
                    html += '<td>' + patientData.mrn + '</td>';
                    html += '<td>' + data.product + '</td>';
                    html += '<td>' + patientData.name + '</td>';
                    html += '<td>' + info.episodenumber + '</td>';
                    html += '<td>' + moment(info.epsiodedate).format('DD/MM/YYYY') + '</td>';
                    html += '<td>' + data.bagno + '</td>';
                    html += '<td>' + data.labno + '</td>';                    
                    html += '<td><button class="btn btn-sm btn-info transfuse-btn">TRANSFUSE</button></td>';
                    html += '</tr>';
                    html += '</tbody>';
                    html += '</table>';

                    $('#ebmAdministerReceive').html(html);

                    $('.transfuse-btn').click(function() {

                        var bagno = $('#bagnumber').val(data.bagno);
                        var mrn = $('#mrnumber').val(patientData.mrn);
                        var labno = $('#lbNumber').val(data.labno);

                        $('#verify-transfusion').modal('show');

                    });

                } else {
                    Swal.fire({
                        title: "Failed!",
                        text: response.message,
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
                Swal.fire({
                    title: "Alert!",
                    text: "Lab number not found!",
                    icon: "error",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                });
                return;            }
        });
    });

    $('#verifyDetail').on('click', function() {
        var bagno = $('#bagnumber').val();
        var mrn = $('#mrnumber').val();
        var labno = $('#lbNumber').val();
        var username = $('#username').val();
        var password = $('#password').val();

        var url = config.routes.blood.transfusion.submit;
        var url2 = config.routes.blood.inventory.index;

        if (username == '' || password == '') {
            toastr.error('Please fill all the fields', {timeOut: 5000});
            return;
        }

        var urlParams = new URLSearchParams(window.location.search);
        var usernameInURL = urlParams.get('username');

        if (password != "010101") {
            if (username == usernameInURL) {
                toastr.error('Please use different user to verify the transfusion', { timeOut: 5000 });
                return; 
            }
        }

        $.ajax({
            url: url, 
            method: 'POST',
            data: {
                bagno: bagno,
                mrn: mrn,
                labno: labno,
                username: username,
                password: password,

            },
            dataType: 'json',
            success: function(response) {

                if (response.status == 'success') {
                     Swal.fire({
                    title: "Success!",
                    text: "Successfully Saved!",
                    icon: "success",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                    }).then(() => {
                        window.location.href = url2;
                    });
                }else{
                    Swal.fire({
                        title: "Failed!",
                        text: "Please make sure username and password are correct ",
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    })
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                toastr.error('Error: ' + error, { timeOut: 5000 });
            }
        });

    });

});