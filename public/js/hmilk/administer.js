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
        var batchId = $('#batchId').val();
        var mrn = $('#mrn').val();
        
        if (batchId !== '' && mrn !== '') {
            $('#checkmatch').click();
        }
    }

    $('#batchId, #mrn').on('change', function() {
        checkAndSubmit();
    });

    $('#checkmatch').on('click', function() {
        var batchId = $('#batchId').val();
        var mrn = $('#mrn').val();
        var url = config.routes.hmilk.administer.check;

        if (batchId == '' || mrn == '') {
            toastr.error('Please fill all the fields', {timeOut: 5000});
            return;
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: { batchId: batchId, mrn: mrn },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    var milkData = response.milk;
                    var patientData = response.patient;
                    var info = response.info;
                    var html = '<table class="table table-bordered">';
                    html += '<thead>';
                    html += '<tr><th style="color: #000000; min-width: 100px;">MRN</th><th style="color: #000000; min-width: 100px;">Name</th><th style="color: #000000; min-width: 100px;">Episode No.</th><th style="color: #000000; min-width: 100px;">Episode Date</th><th style="color: #000000; min-width: 100px;">BatchID</th><th style="color: #000000; min-width: 100px;">Expiry Date</th><th style="color: #000000; min-width: 100px;">Location</th><th style="color: #000000; min-width: 100px;">Amount</th><th style="color: #000000; min-width: 100px;">Intake</th><th style="color: #000000; min-width: 100px;">Action</th></tr>';
                    html += '</thead>';
                    html += '<tbody>';
                    html += '<tr>';
                    html += '<td>' + patientData.mrn + '</td>';
                    html += '<td>' + patientData.name + '</td>';
                    html += '<td>' + info.episodenumber + '</td>';
                    html += '<td>' + moment(info.epsiodedate).format('DD/MM/YYYY') + '</td>';
                    html += '<td>' + milkData.batchId + '</td>';
                    html += '<td>' + moment(milkData.expiryDate).format('DD/MM/YYYY') + '</td>';
                    html += '<td><select class="form-select location-select"><option value="PCICU">PCICU</option><option value="PICU">PICU</option><option value="B5Z2">B5Z2</option><option value="B5Z1">B5Z1</option></select></td>';
                    html += '<td><select class="form-select amount-select"><option value="FULL">FULL</option><option value="PARTIAL">PARTIAL</option></select></td>';   
                    html += '<td><div class="input-group"><input type="number" class="form-control input-sm intake"/><span class="input-group-text">ml</span></div></td>';                     
                    html += '<td><button class="btn btn-sm btn-info administer-btn">Administer</button></td>';
                    html += '</tr>';
                    html += '</tbody>';
                    html += '</table>';

                    $('#ebmAdministerReceive').html(html);

                    $('.administer-btn').click(function() {
                        var $row = $(this).closest('tr');
                        var selectedLocation = $row.find('.location-select').val();
                        var selectedAmount = $row.find('.amount-select').val();
                        var intake = $row.find('.intake').val();
                        var url = config.routes.hmilk.administer.submit;

                        if(intake == ''){
                            toastr.error('Please fill all the fields', {timeOut: 5000});
                            return;
                        }

                        $.ajax({
                            url: url, 
                            method: 'POST',
                            data: {
                                batchId: batchId,
                                mrn: mrn,
                                location: selectedLocation,
                                amount: selectedAmount,
                                intake: intake
                            },
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Successfully Saved!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                                toastr.error('Error: ' + error, { timeOut: 5000 });
                            }
                        });
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
                toastr.error('Error: ' + error, { timeOut: 5000 });
            }
        });
    });

});