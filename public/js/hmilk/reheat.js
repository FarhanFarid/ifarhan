$(document).ready(function () {

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

    $('#searchbatch').on('click', function() {
        //IP0377095/BATCH001/01
        var batchId = $('#batchId').val();
        var url = config.routes.hmilk.administer.reheat.detail;

        $.ajax({
            url: url,
            method: 'POST',
            data: { batchId: batchId},
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success'){

                    var data = response.data;
                    $('#episodeNo').val(data.episodeNo);
                    $('#batchNo').val(data.batchId);
                    $('#expiryDate').val(data.expiryDate);

                } else{
                    var errors = response;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed')
                        {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            }
        });
    });

    $('#updateStatus').on('click', function() {
        var episodeNo = $('#episodeNo').val();
        var batchId = $('#batchNo').val();
        var url = config.routes.hmilk.administer.reheat.update;
        var url2 = config.routes.hmilk.administer.reheat.check;
    
        $.ajax({
            url: url2,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'prompt') {
                    var message = 'The following milk pack has expiry date earlier than this pack:';
                    message += '<br>';
                    response.expiredPacks.forEach(function(pack) {
                        message += '<div style="color: red;">';
                        message += '<b>Batch ID:</b> <span style="color: red;">' + pack.batchId + '</span><br>';
                        message += '<b>Expiry Date:</b> <span style="color: red;">' + moment(pack.expiryDate).format('DD/MM/YYYY') + '</span>';
                        message += '</div><br>';
                    });
                    message += 'Are you sure you want to proceed?';
                    Swal.fire({
                        title: 'Confirmation',
                        html: message,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, proceed',
                        cancelButtonText: 'No, cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                method: 'POST',
                                data: { episodeNo: episodeNo, batchId: batchId },
                                dataType: 'json',
                                success: function(res) {
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
                                    toastr.error('Error updating reheat status: ' + error, { timeOut: 5000 });
                                }
                            });
                        } else {
                        }
                    });
                } else if (response.status === 'success') {
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Saved!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    location.reload();
                } else {
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error updating reheat status: ' + error, { timeOut: 5000 });
            }
        });
    });
    


});