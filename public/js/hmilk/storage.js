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

    var table = $('#batchlist-table').DataTable({
        lengthMenu: [10, 20, 50, 100],
        dom       : 'frtipl',
        scrollX   : "300px",
        columnDefs: [
            {
                "targets": 0,
                "width": "25%"
            },
            {
                "targets": 1,
                "width": "25%"
            },
            {
                "targets": 2,
                "width": "40%"
            },
            {
                "targets": 3,
                "width": "10%",
            },
        ],
        columns: [
            {
                "data": 'batchDate',
                "render": function (data, type, row)  {
                    var html = '';
                    html += '<div class="row">';
                    html += '<div class="col-md-9">';
                    html += row.batchDate;
                    html += '</div>';
                    html += '<div class="col-md-3">';
                    html += '<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-docs-datatable-subtable="expand_row">' + 
					            '<span class="svg-icon fs-3 m-0 toggle-off">+</span>' +
					            '<span class="svg-icon fs-3 m-0 toggle-on"> - </span>' +
				            '</button>';
                    html += '</div>';
                    html += '</div>';
                    return html;
                }
            },
            {
                "data": 'episodeNo',
                "render": function (data, type, row)  {
                    var html = '';
                    
                    html += row.episodeNo;

                    return html;
                }
            },
            {
                "data": 'batchNo',
                "render": function (data, type, row)  {
                    var html = '';

                    html +=  row.episodeNo + '/' + row.batchNo;

                    return html;
                }
            },
            {
                "data": 'quantity',
                "render": function (data, type, row)  {
                    var html = '';
                    
                    html += row.quantity;

                    return html;
                }
            },
        ],

        ajax: {
            method : 'get',
            url: config.routes.hmilk.storage.list,
            dataSrc:"data",
            dataType : "json",
        }
    });

    //Milk Status
    // 1 = stored
    // 2 = prepared
    // 3 = administered
    // 4 = handover
    // 5 = expired
    // 6 = discarded
    // 7 = administered - partial

    $('#batchlist-table tbody').on('click', 'button.toggle', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var episodeNo = row.data().episodeNo;
        var batchNo = row.data().batchNo;
        var currentDate = moment();
        var url = config.routes.hmilk.storage.detail;
    
        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            $(this).html('<span class="svg-icon fs-3 m-0 toggle-off">+</span>');
        } else {
            $.ajax({
                url: url,
                method: 'POST',
                data: { episodeNo: episodeNo, batchNo: batchNo },
                dataType: 'json',
                success: function (data) {
                    var responseData = data.data;
                    var subtableContent = '<table class="table subtable">';
                    subtableContent += '<thead>';
                    subtableContent += '<tr><th style="background-color: #e9f2ff; color: #1d69e3;">Batch ID</th><th style="background-color: #e9f2ff; color: #1d69e3;">Location</th><th style="background-color: #e9f2ff; color: #1d69e3;">Storage Area</th><th style="background-color: #e9f2ff; color: #1d69e3;">Expiry Date</th><th style="background-color: #e9f2ff; color: #1d69e3;">Status</th><th style="background-color: #e9f2ff; color: #1d69e3;">Action</th></tr>';
                    subtableContent += '</thead>';
                    subtableContent += '<tbody>';
                    
                    responseData.forEach(function(data) {
                        subtableContent += '<tr>';
                        subtableContent += '<td>' + data.batchId + '</td>';
                        subtableContent += '<td>' + data.location + '</td>';
                        if(data.storeArea == null || data.storeArea == ""){
                            subtableContent += '<td>  -  </td>';
                        }else{
                            subtableContent += '<td>' + data.storeArea + '</td>';
                        }

                        if(currentDate.isAfter(data.expiryDate)){
                            subtableContent += '<td style="color: red;">' + moment(data.expiryDate).format('DD/MM/YYYY HH:mm') + '</td>';
                        }else{
                            subtableContent += '<td>' + moment(data.expiryDate).format('DD/MM/YYYY HH:mm') + '</td>';
                        }
  
                        if(data.status == 1){
                            if(currentDate.isAfter(data.expiryDate)){
                                subtableContent += '<td><span class="badge badge-danger">Expired</span></td>';
                            }else{
                                subtableContent += '<td><span class="badge badge-primary">Stored</span></td>';
                            }
                        }else if (data.status == 2){
                            if(currentDate.isAfter(data.expiryDate)){
                                subtableContent += '<td><span class="badge badge-danger">Expired</span></td>';
                            }else{
                                subtableContent += '<td><span class="badge badge-warning">Prepared</span></td>';
                            }
                        }else if (data.status == 3){
                            subtableContent += '<td><span class="badge badge-success">Administered</span></td>';
                        }else if (data.status == 4){
                            subtableContent += '<td><span class="badge badge-success">Handover</span></td>';
                        }else if (data.status == 5){
                            subtableContent += '<td><span class="badge badge-danger">Expired</span></td>';
                        }else if (data.status == 6){
                            subtableContent += '<td><span class="badge badge-danger">Discarded</span></td>';
                        }else if (data.status == 7){
                            subtableContent += '<td><span class="badge badge-danger">Administered - Partial</span></td>';
                        }                        
                        
                        // Add button for transferring location
                        subtableContent += '<td><div class="row">'
                        if (data.status == 1 || data.status == 2 || data.status == 4 || data.status == 5 || data.status == 7){
                            if(currentDate.isBefore(data.expiryDate)){
                                subtableContent += '<div class="col-md-3"><button class="badge btn-sm badge-light-primary transfer-location" data-bs-toggle="tooltip" data-bs-placement="top" title="Transfer Location" data-store="'+ data.storeArea +'" data-location="' + data.location + '" data-episode="' + data.episodeNo + '" data-batch="' + data.batchId + '"><i class="fas fa-exchange-alt"></i></button></div>'
                                subtableContent += '<div class="col-md-3"><button class="badge btn-sm badge-light-warning prepare-milk" data-bs-toggle="modal" data-bs-target="#warm-milk" data-bs-toggle="tooltip" data-bs-placement="top" title="Prepare or Handover Milk" data-batch="' + data.batchId + '"data-episode="' + data.episodeNo + '"><i class="fa-solid fa-bars-progress"></i></button></div>'  
                                subtableContent += '<div class="col-md-3"><button class="badge btn-sm badge-light-info reprint-label" data-bs-toggle="tooltip" data-bs-placement="top" title="Reprint Label" data-batch="' + data.batchId + '"data-episode="' + data.episodeNo + '" data-store="' + data.storeArea + '"><i class="fa-solid fa-print"></i></button></div>'
                            }
                                subtableContent += '<div class="col-md-3"><button class="badge btn-sm badge-light-danger discard-milk" data-bs-toggle="modal" data-bs-target="#discard-milk" data-bs-toggle="tooltip" data-bs-placement="top" title="Discard Milk" data-location="' + data.location + '" data-episode="' + data.episodeNo + '" data-batch="' + data.batchId + '"><i class="fa-solid fa-trash-can"></i></button></div>'
                        
                        subtableContent += '</div</td>';
                        }
                        subtableContent += '</tr>';
                    });
                    
                    subtableContent += '</tbody>';
                    subtableContent += '</table>';
                    
                    row.child(subtableContent).show();
                    tr.addClass('shown');
                    $(this).html('<span class="svg-icon fs-3 m-0 toggle-on">-</span>');
                },
                
                error: function (xhr, status, error) {
                    toastr.error('Error: ' + error, {timeOut: 5000});
                }
            });
        }
    });

    $('.save-saveloc').on('click', async function() {
        const locations = $('#transferlocation').val();
        const stores = $('#storagearealoc').val();
        const episodeNo = $('#episodeloc').val();
        const batchId = $('#batchidloc').val();
        var url = config.routes.hmilk.storage.transferWard;

        $.ajax({
            url: url,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId, storagearea: stores, transfloc: locations },
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
                toastr.error('Error transferring location: ' + error, {timeOut: 5000});
            }
        });

    });

    $('.save-savestorage').on('click', async function() {
        
        const locations = $('#currentloc').val();
        const stores = $('#storagearea').val();
        const episodeNo = $('#episodestore').val();
        const batchId = $('#batchidstore').val();
        var url = config.routes.hmilk.storage.updateLocation;

        $('#transfer-modal').modal('hide');

        if (stores === 'Chiller') {
            toastr.error('Location transfer not allowed. The milk is already in Chiller.', {timeOut: 5000});
            return; // Stop execution if transfer is not allowed
        }else if (stores === null || stores === "") {
            toastr.error('Location transfer not allowed. The milk is already been taken out of Chiller or Freezer.', {timeOut: 5000});
            return; 
        }else if (locations === 'B5Z2' || locations === 'PCICU' || locations === 'PICU' || locations === 'B5Z2') {
            toastr.error('Location transfer not allowed. The milk is already has been administered.', {timeOut: 5000});
            return; 
        }
    
        Swal.fire({
            title: 'Transfer Location',
            text: 'Are you sure you want to transfer the location from ' + stores + ' to Chiller?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, transfer it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { episodeNo: episodeNo, batchId: batchId, locations: 'Chiller' },
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
                        toastr.error('Error transferring location: ' + error, {timeOut: 5000});
                    }
                });
            }
        });
    });

    $('#batchlist-table tbody').on('click', '.transfer-location', function(e) {
        e.preventDefault();
        var locations = $(this).data('location');
        var stores = $(this).data('store');
        var episodeNo = $(this).data('episode');
        var batchId = $(this).data('batch');

        $('#episodestore').val(episodeNo);
        $('#batchidstore').val(batchId);
        $('#storagearea').val(stores);
        $('#storagearealoc').val(stores);
        $('#currentloc').val(locations);
        $('#episodeloc').val(episodeNo);
        $('#batchidloc').val(batchId);

        $('#transfer-modal').modal('show');
        
    });

    $('#batchlist-table tbody').on('click', '.reprint-label', function(e) {
        e.preventDefault();

        var episodeNo = $(this).data('episode');
        var batchId = $(this).data('batch');
        var stores = $(this).data('store');
        var url = config.routes.hmilk.storage.reprintLabel;
 
        $.ajax({
            url: url,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId, stores: stores },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success'){
                    console.log(response);

                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Reprint Label!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    }); 
                } else{
                    var errors = data;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed')
                        {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Reprint Error: ' + error, {timeOut: 5000});
            }
        });

    });

    $('#savebatch').on('click', function() {
        var quantity = $('#quantity').val();
        var name = $('#mname').val();
        var nric = $('#mnric').val();
        var date = $('#bdate').val();
        var bdate = moment(date).format('DD/MM/YYYY HH:mm');
        var defaultDate = moment(bdate, 'DD/MM/YYYY HH:mm').add(90, 'days').format('DD/MM/YYYY HH:mm');

        if (!quantity || !name || !nric || !date) {
            toastr.error('Please fill in all required fields.', {timeOut: 5000});
            return;
        }
   
        var url = config.routes.hmilk.storage.check;

        $('#milk-batch').empty();

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(data) {
                if(data.status == 'success'){
                    $('#gen-batch').show();
                    for (var i = 1; i <= quantity; i++) {
                        var batchId = data.batchId + '/' + i.toString().padStart(2, '0');
                        $('#milk-batch').append(
                            '<tr>'+
                                '<td style="text-align: center;">' + i + '</td>'+
                                '<td>' + epsdno + '</td>'+
                                '<td>' + batchId + '</td>' +
                                '<td>' +
                                    '<select class="form-select storedLocation" aria-label="Select example">' +
                                        '<option value="Freezer">Freezer</option>' +
                                        '<option value="Chiller">Chiller</option>' +
                                    '</select>' +
                                '</td>' +
                                '<td>' + bdate + '</td>' +
                                '<td>' + defaultDate + '</td>' +
                                '<td>' + name + '</td>' +
                                '<td>' + nric + '</td>' +
                            '</tr>'
                        );
                    }
                } else{
                    var errors = data;
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

    $(document).on('change', '.storedLocation', function() {
        var selectedOption = $(this).val();
        var batchDate = $(this).closest('tr').find('td:eq(4)').text();
        var expiryDate;
        
        if (selectedOption === 'Freezer') {
            expiryDate = moment(batchDate, 'DD/MM/YYYY HH:mm').add(90, 'days').format('DD/MM/YYYY HH:mm');
        } else if (selectedOption === 'Chiller') {
            expiryDate = moment(batchDate, 'DD/MM/YYYY HH:mm').add(7, 'days').format('DD/MM/YYYY HH:mm');
        } else {
            expiryDate = '';
        }
    
        $(this).closest('tr').find('td:eq(5)').text(expiryDate);
    });

    $('#printlabel').on('click', function() {

        var details = [];
        var url = config.routes.hmilk.storage.store;
   
        $('#milk-batch tr').each(function() {
            var episodeNo = $(this).find('td:eq(1)').text();
            var batchId = $(this).find('td:eq(2)').text();
            var location = $(this).find('select').val();
            var batchDate = $(this).find('td:eq(4)').text();
            var expiryDate = $(this).find('td:eq(5)').text();
            var motherName = $(this).find('td:eq(6)').text();
            var motherNRIC = $(this).find('td:eq(7)').text();
    
            details.push({
                episodeNo: episodeNo,
                batchId: batchId,
                location: location,
                batchDate: batchDate,
                expiryDate: expiryDate,
                motherName: motherName,
                motherNRIC: motherNRIC
            });
        });
    
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { details: details },
            success: function(data) {
                if (data.status === 'success') {
                    // console.log(data)
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Saved!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('#bdate').val('');
                    $('#quantity').val('');
                    $('#mname').val('');
                    $('#mnric').val('');
                    $('#milk-batch').empty();
                    $('#gen-batch').hide();
                    location.reload();

                } else {
                    toastr.error('Error saving data', {timeOut: 5000});
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error: ' + error, {timeOut: 5000});
            }
        });
    });

    //PREPARE/HANDOVER MILK
    $('#batchlist-table tbody').on('click', '.prepare-milk', function(e) {
        e.preventDefault();
        var batchId = $(this).data('batch');
        var url = config.routes.hmilk.administer.reheat.detail;

        $('.nurse-handover-section').show();
        $('.caregiver-handover-section').hide();
        $('.handover-to-section').hide();
        $('.form-select').val('');

        $.ajax({
            url: url,
            method: 'POST',
            data: { batchId: batchId },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success'){
                    var data = response.data;
                    $('#episodeNo').val(data.episodeNo);
                    $('#batchNo').val(data.batchNo);
                    $('#batchId').val(data.batchId);
                    $('#expiryDate').val(data.expiryDate);
                    $('#nurseName').val(response.nurse);

                    $('#cgepisodeNo').val(data.episodeNo);
                    $('#cgbatchNo').val(data.batchNo);
                    $('#cgbatchId').val(data.batchId);
                    $('#cgexpiryDate').val(data.expiryDate);
                    $('#mName').val(data.mname);
                    $('#mNric').val(data.mnric);

                    $('#warm-milk').modal('show');
                } else {
                    var errors = response;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed') {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            }
        });
    });

    $('.form-select').on('change', function() {
        var selectedValue = $(this).val();
        if (selectedValue == '1') {
            $('.nurse-handover-section').show();
            $('.caregiver-handover-section').hide();
        } else if (selectedValue == '2') {
            $('.nurse-handover-section').hide();
            $('.caregiver-handover-section').show();
        } else {
            $('.nurse-handover-section').hide();
            $('.caregiver-handover-section').hide();
        }
    });

    $('#isCaregiver').on('change', function() {
        if ($(this).is(':checked')) {
            $('.handover-to-section').show();
            $('.cgPreparebtn').hide();
        } else {
            $('.handover-to-section').hide();
            $('.cgPreparebtn').show();
        }
    });

    //Nurse
    $('#updateStatus').on('click', function() {
        var episodeNo = $('#episodeNo').val();
        var batchId = $('#batchId').val();
        var url = config.routes.hmilk.administer.reheat.update;
        var url2 = config.routes.hmilk.administer.reheat.check;

        $.ajax({
            url: url2,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 'prompt') {
                    
                    var message = 'There are milk packs with expiry date earlier than this pack.';
                    message += '<br>';
                    response.expiredPacks.forEach(function(pack) {
                        message += '<div style="color: red;">';
                        message += '<b>Batch ID:</b> <span style="color: red;">' + pack.batchId + '</span><br>';
                        message += '<b>Expiry Date:</b> <span style="color: red;">' + moment(pack.expiryDate).format('DD/MM/YYYY') + '</span><br>';
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

                            $('#warm-milk').modal('hide');

                            $('#episdno').val(episodeNo);
                            $('#bchId').val(batchId);

                            $('#proceed-milk').modal('show');

                           
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
                toastr.error('Error updating prepare status: ' + error, { timeOut: 5000 });
            }
        });
    });

    $('#updateProceed').on('click', function() {
        var episodeNo = $('#episdno').val();
        var batchId = $('#bchId').val();
        var remarks = $('#remarks').val();
        var url = config.routes.hmilk.administer.reheat.update;

        if (remarks == null) {
            toastr.error('Remark cannot be empty.', {timeOut: 5000});
            return; // Stop execution if transfer is not allowed
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId, remarks: remarks },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
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
                    Swal.fire(
                        'Error!',
                        'There was an error to prepare the item.',
                        'error'
                    );
                }
                
            },
            error: function(xhr, status, error) {
                toastr.error('Error updating prepare status: ' + error, { timeOut: 5000 });
            }
        });
    });

    //Caregiver
    $('#cgupdateStatus').on('click', function() {
        var episodeNo = $('#episodeNo').val();
        var batchId = $('#batchId').val();
        var name = $('#cgName').val();
        var nric = $('#cgNric').val();
        var relation = $('#cgRelationship').val();
        var isCaregiver = $('#isCaregiver').val();
        var url = config.routes.hmilk.administer.reheat.caregiver.update;
        var url2 = config.routes.hmilk.administer.reheat.caregiver.check;

        if ($('input.checkbox_check').is(':checked')) {
            if (name == '' || nric == '' || relation == '') {
                toastr.error('Please fill all the handover to details.', {timeOut: 5000});
                return; // Stop execution if transfer is not allowed
            }  
        }

        $.ajax({
            url: url2,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId, name: name, nric: nric, relation: relation, isCaregiver: isCaregiver },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'prompt') {
                    
                    var message = 'There are milk packs with expiry date earlier than this pack.';
                    message += '<br>';
                    response.expiredPacks.forEach(function(pack) {
                        message += '<div style="color: red;">';
                        message += '<b>Batch ID:</b> <span style="color: red;">' + pack.batchId + '</span><br>';
                        message += '<b>Expiry Date:</b> <span style="color: red;">' + moment(pack.expiryDate).format('DD/MM/YYYY') + '</span><br>';
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
                            
                            $('#warm-milk').modal('hide');
                            $('#cgepisdno').val(episodeNo);
                            $('#cgbchId').val(batchId);
                            $('#cgproceed-milk').modal('show');

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
                toastr.error('Error updating handover status: ' + error, { timeOut: 5000 });
            }
        });
    });

    $('#cgupdateProceed').on('click', function() {
        var episodeNo = $('#cgepisdno').val();
        var batchId = $('#cgbchId').val();
        var remarks = $('#cgremarks').val();
        var name = $('#cgName').val();
        var nric = $('#cgNric').val();
        var relation = $('#cgRelationship').val();
        var url = config.routes.hmilk.administer.reheat.caregiver.update;

        if (remarks == null) {
            toastr.error('Remark cannot be empty.', {timeOut: 5000});
            return; // Stop execution if transfer is not allowed
        }

        $.ajax({
            url: url,
            method: 'POST',
            data: { episodeNo: episodeNo, batchId: batchId, name: name, nric: nric, relation: relation, remarks: remarks },
            dataType: 'json',
            success: function(res) {
                console.log(res);
                if (res.status === 'success') {
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
                    Swal.fire(
                        'Error!',
                        'There was an error to prepare the item.',
                        'error'
                    );
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error updating handover status: ' + error, { timeOut: 5000 });
            }
        });
    });

    //DISCARD MILK
    $('#batchlist-table tbody').on('click', '.discard-milk', function(e) {
        e.preventDefault();
        var batchId = $(this).data('batch');
        var episodeNo = $(this).data('episode');
        var url = config.routes.hmilk.storage.discardDetail;
        $.ajax({
            url: url,
            method: 'POST',
            data: { batchId: batchId, episodeNo: episodeNo },
            dataType: 'json',
            success: function(response) {
                if(response.status == 'success'){
                    console.log(response);
                    var data = response.data;
                    
                    $('#epsdno').val(data.episodeNo);
                    $('#btchId').val(data.batchId);
                    
                    $('#discard-milk').modal('show');

                } else {
                    var errors = response;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed') {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            }
        });
    });


    $('#updateDiscard').on('click', function() {
        var episodeNo = $('#epsdno').val();
        var batchId = $('#btchId').val();
        var remark = $('#remark').val();
        var url = config.routes.hmilk.storage.discard;

        if (remark == null) {
            toastr.error('Remark cannot be empty.', {timeOut: 5000});
            return; // Stop execution if transfer is not allowed
        }
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, discard it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { episodeNo: episodeNo, batchId: batchId, remark: remark },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: "Item Discarded!",
                                icon: "success",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error discarding the item.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Error updating handover status: ' + error,
                            'error'
                        );
                    }
                });
            }
        });
    });


    $('.add-milk').on('click', function() {
        var url = config.routes.hmilk.storage.storeDetail;

        function getParameterByName(name, url) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
            var results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }
    
        // Extract epsdno from the URL
        var epsdno = getParameterByName('epsdno', url);

        $.ajax({
            url: url,
            type: "POST",
            data: { epsdno: epsdno },
            dataType: "json",
            success: function(data) {
                if(data.status == 'success'){

                    if(data.data != null){
                        $('#mname').val(data.data.mname); 
                    }else{
                        $('#mname').val(''); 
                    }
                    if(data.data != null){
                        $('#mnric').val(data.data.mnric);
                    }else{
                        $('#mnric').val('');
                    }

                    $('#add-milk').modal('show');

                } else{
                    var errors = data;
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
    
});