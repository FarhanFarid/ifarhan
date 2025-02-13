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

     var table = $('#bloodinventory-table').DataTable({
        lengthMenu: [10, 20, 50, 100],
        dom       : 'frtipl',
        scrollX   : "300px",
        ordering  : false,
        columns: [
            {
                "data": 'reaction',
                "render": function (data, type, row) {
                    var html = '';
                    if (row.atr_status_id == 1 || row.atr_status_id == 2) {
                        html += '<span aria-hidden="true" style="font-size: 20px; color: red; animation: blink 1s infinite;">ðŸš¨</span>';
                        html += '<style>@keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }</style>';
                    } else {
                        html += '-';
                    }
                    return html;
                }
            },
            {
                "data": 'product',
                "render": function (data, type, row) {
                    var html = row.product;

                    return html;
                }
            },
            {
                "data": 'bagno',
                "render": function (data, type, row)  {
                    var html = '';
                    
                    html += row.bagno;

                    return html;
                }
            },
            {
                "data": 'status',
                "render": function (data, type, row)  {
                    var html = '';

                    var latestLocation = row.locations.sort((a, b) => new Date(b.created_at) - new Date(a.received_at))[0];
                    var today = moment(); // Get today's date

                    if (latestLocation.status_id != 2) {
                        if (row.transfuse_status_id == 1) {
                            html += '<span class="badge badge-info">Received</span>';
                        }
                        else if (row.transfuse_status_id == 2) {
                            if (moment(row.expiry_date).isBefore(today)) {
                                html += '<span class="badge badge-danger">Expired<br/>';
                                html += 'Expired Date: ' + moment(row.expiry_date).format('DD/MM/YYYY');       
                            } else {
                                html += '<span class="badge badge-info">Stored<br/>';
                                html += 'Expiry Date: ' + moment(row.expiry_date).format('DD/MM/YYYY');
                            }
                            html += '</span>';
                        }
                        else if (row.transfuse_status_id == 3) {
                            html += '<span class="badge badge-warning mr-5">Transfusion in progress</span><br/><br/>';
                            if (row.transfuse_start_at != null || row.transfuse_stop_at != null) {
                                html += '<div class="border p-2 mb-2" style="border: 1px solid #848484 !important; border-radius: 3px; display: inline-block;">'; 
                                if (row.transfuse_start_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:green !important;">Transfusion start at: ' + moment(row.transfuse_start_at).format('DD/MM/YYYY HH:mm') + '</b><br/>';
                                }
                                if (row.transfuse_stop_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:red !important;">Transfusion stop at: ' + moment(row.transfuse_stop_at).format('DD/MM/YYYY HH:mm') + '</b>';
                                }
                                html += '</div>'; // Close border wrapper
                            }
                        }
                        else if (row.transfuse_status_id == 4) {
                            if (row.reaction == "Yes") {
                                html += '<span class="badge badge-warning">Transfused with Reaction </span><br/><br/>';
                            } else {
                                html += '<span class="badge badge-success mr-5">Transfused</span><br/><br/>';
                            }

                            if (row.transfuse_start_at != null || row.transfuse_stop_at != null) {
                                html += '<div class="border p-2 mb-2" style="border: 1px solid #848484 !important; border-radius: 3px; display: inline-block;">'; 
                                if (row.transfuse_start_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:green !important;">Transfusion start at: ' + moment(row.transfuse_start_at).format('DD/MM/YYYY HH:mm') + '</b><br/>';
                                }
                                if (row.transfuse_stop_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:red !important;">Transfusion stop at: ' + moment(row.transfuse_stop_at).format('DD/MM/YYYY HH:mm') + '</b>';
                                }
                                html += '</div>'; // Close border wrapper
                            }
                        }else if (row.transfuse_status_id == 5) {
                            html += '<span class="badge badge-light">Transferred to ' + row.transfer_to + '</span><br/><br/>';

                            if (row.transfuse_stop_at != null) {
                                html += '<div class="border p-2 mb-2" style="border: 1px solid #848484 !important; border-radius: 3px; display: inline-block;">'; 
                                if (row.transfuse_stop_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important">Receive blood bag at: ' + moment(row.transfuse_stop_at).format('DD/MM/YYYY HH:mm') + '</b>';
                                }
                                html += '</div>'; // Close border wrapper
                            }

                        }else if (row.transfuse_status_id == 7) {
                            html += '<span class="badge badge-light">Return to Lab</span><br/><br/>';

                            if (row.transfuse_start_at != null || row.transfuse_stop_at != null) {
                                html += '<div class="border p-2 mb-2" style="border: 1px solid #848484 !important; border-radius: 3px; display: inline-block;">'; 
                                if (row.transfuse_start_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:green !important;">Transfusion start at: ' + moment(row.transfuse_start_at).format('DD/MM/YYYY HH:mm') + '</b><br/>';
                                }
                                if (row.transfuse_stop_at != null) {
                                    html += '<b class="mr-3 mb-2" style="font-size: 10px !important; color:red !important;">Transfusion stop at: ' + moment(row.transfuse_stop_at).format('DD/MM/YYYY HH:mm') + '</b>';
                                }
                                html += '</div>'; // Close border wrapper
                            }
                        }
                    } else {
                        html += '<span class="badge badge-warning mr-5">Location transfer in progress <br/>';
                        html += 'To : ' + row.transfer_to + ' </span>';
                    }

                    return html;
                }

            },
            {
                "data": 'receivedby',
                "render": function (data, type, row) {
                    var html = '';
            
                    // if (row.transfuse_status_id === 7) {

                    //     var latestLocation = row.locations.sort((a, b) => new Date(b.created_at) - new Date(a.created_at))[0];
                        
                    //     html += '<span class="badge badge-light mb-3 py-2">' + 
                    //         latestLocation.user.username + ' (' + moment(latestLocation.received_at).format('DD/MM/YYYY HH:mm') + ')<br/>' + 
                    //         'Location: ' + latestLocation.location  
                    //         if(latestLocation.reasonreturn == null){
                    //             + '</span>';
                    //         }else{
                    //             + 'Reason: ' + latestLocation.reasonreturn + '</span>';
                    //         }
                            
                    // } else {

                        html += row.locations.map(loc => {
                            var badgeClass;
                            if (loc.location === "Laboratory and Blood Services"){
                                if(loc.status_id == 3){
                                    badgeClass = 'badge-danger';
                                }else{
                                    badgeClass = 'badge-light';
                                }
                            }else if (loc.status_id === 3) {
                                badgeClass = 'badge-danger';
                            } else if (loc.status_id === 2) {
                                badgeClass = 'badge-warning';
                            } else {
                                badgeClass = 'badge-success';
                            }
                            return '<span class="badge ' + badgeClass + ' mb-3 py-2">' + 
                                loc.user.username + ' (' + moment(loc.received_at).format('DD/MM/YYYY HH:mm') + ')<br/>' + 
                                'Location: ' + loc.location +
                                '</span>';  
                        }).join('');
                    // }
            
                    return html;
                },
            },
            {
                "data": 'volume',
                "render": function (data, type, row)  {
                    var html = '';
                    
                    if(row.volume == null){
                        html += '-';
                    }else{
                        html += row.volume + ' ml';
                    }

                    return html;
                }
            },
            {
                "data": 'action',
                "render": function (data, type, row)  {
                    var html = '';
                    var latestLocation = row.locations.sort((a, b) => new Date(b.created_at) - new Date(a.received_at))[0];
                    var today = moment(); // Get today's date
                    

                    
                    html += '<div class="row">';
                    // Check if transfuse_status_id is 1 or 2 and if expiry date has passed
                    if ((row.transfuse_status_id == 1 || row.transfuse_status_id == 2) && moment(row.expiry_date).isBefore(today)) {
                        // Only allow 'Transfer Location'
                        html += '<div class="col-md-3"><button class="badge btn-sm badge-light-primary transfer-location" data-bs-toggle="tooltip" data-bs-placement="top" title="Transfer Location" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fas fa-exchange-alt"></i></button></div>';
                    } else {
                        if (row.transfuse_status_id != 7) {
                            if (row.transfuse_status_id == 5 || latestLocation.status_id == 2 ) {
                                if (row.transfuse_status_id == 5 && row.transfuse_completion_id != 2) {
                                    html += '<div class="col-md-3"><button class="badge btn-sm badge-light-warning receive-transferred" data-bs-toggle="tooltip" data-bs-placement="top" title="Received Blood Bag" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-right-to-bracket"></i></button></div>';
                                }else{
                                    html += '';
                                }
                            } else {
                                if (row.transfuse_status_id == 3) {
                                    html += '<div class="col-md-3"><button class="badge btn-sm badge-light-danger suspend-transfuse" data-bs-toggle="tooltip" data-bs-placement="top" title="Finish Transfusion" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-regular fa-hand"></i></button></div>';
                                }
            
                                if (row.transfuse_completion_id == null) {
                                    html += '<div class="col-md-3"><button class="badge btn-sm badge-light-success transfuse-blood" data-bs-toggle="tooltip" data-bs-placement="top" title="Transfuse Blood" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-droplet"></i></button></div>';
                                }
            
                                html += '<div class="col-md-3"><button class="badge btn-sm badge-light-primary transfer-location" data-bs-toggle="tooltip" data-bs-placement="top" title="Transfer Location" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '" data-expirydate="' + row.expiry_date + '"><i class="fas fa-exchange-alt"></i></button></div>';
                                // html += '<div class="col-md-3"><button class="badge btn-sm badge-light-info add-vital" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Vital Sign" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-heart-pulse"></i></button></div>';

                                if (row.transfuse_status_id == 1 || row.transfuse_status_id == 7) {
                                    html += '<div class="col-md-3"><button class="badge btn-sm badge-light-info store-blood" data-bs-toggle="tooltip" data-bs-placement="top" title="Store Blood" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-boxes-packing"></i></button></div>';
                                }

                                if (row.transfuse_status_id == 5) {
                                    html += '<div class="col-md-3"><button class="badge btn-sm badge-light-warning received-transfered" data-bs-toggle="tooltip" data-bs-placement="top" title="Received Blood Bag" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-right-to-bracket"></i></button></div>';
                                }

                            }
                        }
            
                        if (row.transfuse_completion_id != null && row.transfuse_status_id != 5 ) {
                            html += '<div class="col-md-3"><button class="badge btn-sm badge-light-warning add-reaction" data-bs-toggle="tooltip" data-bs-placement="top" title="Add Reaction" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-solid fa-plus"></i></button></div>';
                        }
                    }
            
                    html += '</div>';
                    
                    return html;
                }
            }
                 
        ],

        ajax: {
            method : 'get',
            url: config.routes.blood.inventory.list,
            dataSrc:"data",
            dataType : "json",
        }
    });

    function getFormattedLocalDateTime(date) {
        const offsetDate = new Date(date.getTime() - date.getTimezoneOffset() * 60000);
        return offsetDate.toISOString().slice(0, 16);
    }

    function updateTransferDate() {
        const dateTimeInput = document.getElementById('actualtransferdate');
        const formattedDateTime = getFormattedLocalDateTime(new Date());

        dateTimeInput.value = formattedDateTime;
    }

    function updateReceiveDate() {
        const dateTimeInput = document.getElementById('actualreceivedate');
        const formattedDateTime = getFormattedLocalDateTime(new Date());

        dateTimeInput.value = formattedDateTime;
    }

    function updateSuspendDate() {
        const dateTimeInput = document.getElementById('actualsuspenddate');
        const formattedDateTime = getFormattedLocalDateTime(new Date());

        dateTimeInput.value = formattedDateTime;
    }

    function updateAllDates() {
        updateTransferDate();
        updateReceiveDate();
        updateSuspendDate();
    }

    updateAllDates();
    
    setInterval(updateAllDates, 60000);

    $('#bloodinventory-table tbody').on('click', '.reaction-list', function(e) {
        e.preventDefault();
    
        var bagno = $(this).data('bagno');
        var episodeno = $(this).data('episodeno');
    
        var url = config.routes.blood.inventory.viewReaction;
    
        $('#view-reaction').modal('show');
    
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { bagno: bagno, episodeno: episodeno },
            success: function(data) {
                if (data.status === 'success') {
                    console.log(data);
    
                    // Clear existing table body
                    var $tableBody = $('#reaction-table tbody');
                    $tableBody.empty();
    
                    // Populate the list array data
                    if (data.list && data.list.length > 0) {
                        data.list.forEach(function(item) {
                            var row = `
                                <tr>
                                    <td>${moment(item.created_at).format('DD/MM/YYYY HH:mm')}</td>
                                    <td>${item.reaction}</td>
                                    <td>${item.user.username}</td>
                                    <td><span class="badge badge-warning mr-5">In progress</span></td>
                                </tr>
                            `;
                            $tableBody.append(row);
                        });
                    }
    
                    // Check and append the suspend data
                    if (data.suspend && data.suspend.reaction) {
                        var suspendRow = `
                            <tr>
                                <td>${moment(data.suspend.transfuse_stop_at).format('DD/MM/YYYY HH:mm')}</td>
                                <td>${data.suspend.reaction_detail}</td>
                                <td>${data.suspend.user.username}</td>
                                <td><span class="badge badge-danger mr-5">Transfused</span></td>
                            </tr>
                        `;
                        $tableBody.append(suspendRow);
                    }
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error: ' + error, {timeOut: 5000});
            }
        });
    });
    

    //Transfuse Status
    //1 - received
    //2 - stored
    //3 - inprogress
    //4 - tranfused
    //5 - Transfer to Other Location
    //7 - return to lab

     $('.receive-blood').on('click', function() {

        $('#receive-blood').modal('show');

    });

    var isSubmitting = false;

    // function submitbagno() {
    //     var bagno = $('#bagno').val();
        
    //     if (bagno !== '' ) {
    //         $('#add-blood').click();
    //     }
    // }

    $('#bagno').on('change', function() {
        let scannedData = $(this).val();

        processbagno(scannedData);
        if (bagno !== '' ) {
            $('#add-blood').click();
        }
    });

    function processbagno(scannedData) {
        const lines = scannedData.split(':');

        bagNumber = lines[11].trim();
        product   = lines[6].trim();  

        $('#bagno').val(bagNumber);
        $('#product').val(product).trigger('change.select2');    
        // $('#product').val(product);    
    }

    $('#add-blood').on('click', function() {
        if (isSubmitting) return;
    
        var bagno = $('#bagno').val(); 
        var location = $('#location').val();
        var labno = $('#labnumber').val();
        var product = $('#product').val();
        var receivedate = $('#actualreceivedate').val();
        var receivecdreason = $('#receivecdreason').val();

        const formattedDate = moment(receivedate).format("YYYY-MM-DD H:mm");
    
        var url = config.routes.blood.inventory.transferTo;

        if (!location) {
            toastr.error('Please select location to received', {timeOut: 5000});
            return;
        }
    
        if (!bagno) {
            toastr.error('Please scan or fill the bag number.', {timeOut: 5000});
            return;
        }

        if (!product) {
            toastr.error('Please select product to be received', {timeOut: 5000});
            return;
        }
        if (!receivedate) {
            toastr.error('Received date cannot be empty.', {timeOut: 5000});
            return;
        }

        if ($('#receivereason').is(':visible') && receivecdreason == '') {
            toastr.error('Please select reason to change date', { timeOut: 5000 });
            return;
        }
    
        var bagNumbers = bagno.split('/').filter(function(bag) {
            return bag.trim() !== '';
        });
    
        var bagnoExists = false;
        $('#blood-batch tr').each(function() {
            var existingBagno = $(this).find('td:nth-child(2)').text();
            bagNumbers.forEach(function(bag) {
                if (existingBagno === bag.trim()) {
                    bagnoExists = true;
                }
            });
            if (bagnoExists) {
                return false; 
            }
        });
    
        if (bagnoExists) {
            toastr.error('This bag number is already added.', {timeOut: 5000});
            return;
        }
    
        isSubmitting = true;
        $('#add-blood').prop('disabled', true);
    
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { bagno: bagno, labno: labno },
            success: function(data) {
                if (data.status === 'success') {

                    // console.log(data);
                    // console.log(data.data.transfuse_status_id);
                    // console.log(data.data.transfuse_completion_id );

                    // if(data.data.transfuse_status_id == 7 && data.data.transfuse_completion_id == null){
                    //     console.log("hello");
                    // }

                    if(product === "PLATELET CONC."){
                        bagNumbers.forEach(function(bag) {
                            var trimmedBag = bag.trim(); 
        
                            if (data.data == null) {
                                $('#gen-batch').show();
                                $('#blood-batch').append(
                                    '<tr>' +
                                        '<td>' + product + '</td>' +
                                        '<td>' + trimmedBag + '</td>' + 
                                        '<td>' + labno + '</td>' +
                                        '<td>' + location + '</td>' +
                                        '<td>' + formattedDate + '</td>' +
                                        '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                    '</tr>'
                                );
                            } else {
                                if(data.data.transfuse_status_id == 7 && data.data.transfuse_completion_id == null){
                                    $('#gen-batch').show();
                                    $('#blood-batch').append(
                                        '<tr>' +
                                            '<td>' + product + '</td>' +
                                            '<td>' + trimmedBag + '</td>' + 
                                            '<td>' + labno + '</td>' +
                                            '<td>' + location + '</td>' +
                                            '<td>' + formattedDate + '</td>' +
                                            '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                        '</tr>'
                                    );
                                }else{
                                    if (data.data.transfer_to == location) {
                                        $('#gen-batch').show();
                                        $('#blood-batch').append(
                                            '<tr>' +
                                                '<td>' + product + '</td>' +
                                                '<td>' + trimmedBag + '</td>' + 
                                                '<td>' + labno + '</td>' +
                                                '<td>' + location + '</td>' +
                                                '<td>' + formattedDate + '</td>' +
                                                '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                            '</tr>'
                                        );
                                    } else {
                                        toastr.error('This bag should not be received by this location!', {timeOut: 5000});
                                        return;
                                    }
                                }   
                            }
                        });
                    }else{
                        if (data.data == null) {
                            $('#gen-batch').show();
                            $('#blood-batch').append(
                                '<tr>' +
                                    '<td>' + product + '</td>' +
                                    '<td>' + bagno + '</td>' +
                                    '<td>' + labno + '</td>' +
                                    '<td>' + location + '</td>' +
                                    '<td>' + formattedDate + '</td>' +
                                    '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                '</tr>'
                            );
                        }else {
                            if(data.data.transfuse_status_id == 7 && data.data.transfuse_completion_id == null){
                                $('#gen-batch').show();
                                $('#blood-batch').append(
                                    '<tr>' +
                                        '<td>' + product + '</td>' +
                                        '<td>' + bagno + '</td>' +
                                        '<td>' + labno + '</td>' +
                                        '<td>' + location + '</td>' +
                                        '<td>' + formattedDate + '</td>' +
                                        '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                    '</tr>'
                                );
                            }else{
                                if (data.data.transfer_to == location) {
                                    $('#gen-batch').show();
                                    $('#blood-batch').append(
                                        '<tr>' +
                                            '<td>' + product + '</td>' +
                                            '<td>' + bagno + '</td>' +
                                            '<td>' + labno + '</td>' +
                                            '<td>' + location + '</td>' +
                                            '<td>' + formattedDate + '</td>' +
                                            '<td style="text-align: center;"><button class="btn btn-danger btn-sm remove-row"><i class="fa fa-trash"></i></button></td>' +
                                        '</tr>'
                                    );
                                } else {
                                    toastr.error('This bag should not be received by this location!', {timeOut: 5000});
                                    return;
                                }
                            }
                        }
                    } 
                    $('#product').val("").trigger('change.select2');       
                    $('#bagno').val('').focus(); 
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error: ' + error, {timeOut: 5000});
            },
            complete: function() {
                isSubmitting = false;
                $('#add-blood').prop('disabled', false);
            }
        });
    });
    
    

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });


    function processScannedData(scannedData) {
        const lines = scannedData.split(':');

        labNumber = lines[4].trim(); 

        $('#labno').val(labNumber);

    }

    $('#labno').on('change', function() {
        let scannedData = $(this).val();

        processScannedData(scannedData);
        checkAndSubmit();
    });

    

    $('#verify-labno').on('click', function() {
        var labno = $('#labno').val().toUpperCase();
        var url = config.routes.blood.inventory.verifylab;
        var url2 = config.routes.blood.inventory.wardList;
    
        if (!labno) {
            toastr.error('Please scan or enter the lab number.', { timeOut: 5000 });
            return;
        }
    
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { labno: labno },
            beforeSend: function(){
                // $("#loading-overlay").show();
            },
            success: function(data) {
                // $("#loading-overlay").hide();
                if (data.status === 'success') {

                    $.ajax({
                        url: url2,
                        method: 'GET',
                        dataType: 'json',
                        success: function(response) {

                            $('#labnumber').val(labno);
                            $('.bloodbag-section').show();
                            $('.labno-section').hide();
                            $('#location').empty();
                            $('#location').append('<option></option>');
    
                            $.each(response.data, function(index, location) {
                                $('#location').append(
                                    $('<option>', {
                                        value: location.location_name,
                                        text: location.location_name + ' (' + location.location_code + ')',
                                    })
                                );
                            });
    
                            $('#location').select2({
                                dropdownParent: $('#receive-blood')
                            });
    
                            if (data.location) {
                                var locationFound = false;

                                $('#location option').each(function() {
                                    var optionText = $(this).text();
                                    
                                    var locationName = optionText.split(' (')[0];
                                    
                                    if (locationName === data.location) {
                                        $(this).prop('selected', true).trigger('change');
                                        locationFound = true;
                                        return false; 
                                    }
                                });
                            
                                if (!locationFound) {
                                    $('#location').val('').trigger('change');
                                }
                            }

                            $('#actualreceivedate').on('change', function() {
                                const selectedDate = new Date($(this).val());
                                const currentDate = new Date();
                                
                                
                                // Normalize dates for comparison (ignore seconds and milliseconds)
                                currentDate.setSeconds(0, 0);
                                selectedDate.setSeconds(0, 0);
                        
                                // Show or hide the reason div
                                if (selectedDate.getTime() !== currentDate.getTime()) {
                                    $('#receivereason').show();
                                } else {
                                    $('#receivereason').hide();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Error occurred while fetching locations: ' + error,
                                'error'
                            );
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Alert!",
                        text: data.response,
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
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
                return;
            }
        });
    });

    function checkAndSubmit() {
        var labno = $('#labno').val();
        
        if (labno !== '' ) {
            $('#verify-labno').click();
        }
    }

    // $('#labno').on('change', function() {
    //     checkAndSubmit();
    // });
    
    
    $('#save-blood').on('click', function() {

        var details = [];
        var receivecdreason = $('#receivecdreason').val();
        var url = config.routes.blood.inventory.store;
        

        $('#blood-batch tr').each(function() {
            var product     = $(this).find('td:eq(0)').text();
            var bagno       = $(this).find('td:eq(1)').text();
            var labno       = $(this).find('td:eq(2)').text();
            var location    = $(this).find('td:eq(3)').text();
            var receivedate = $(this).find('td:eq(4)').text();

            details.push({
                bagno: bagno,
                labno: labno,
                location: location,
                product: product,
                receivedate: receivedate,
                receivecdreason: receivecdreason,
            });
        });

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { details: details },
            beforeSend: function(){
                $("#loading-overlay").show();
            },
            success: function(data) {
                $("#loading-overlay").hide();
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Saved!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $('#labno').val('');
                    $('#bagno').val('');
                    $('#product').val('');
                    
                    setTimeout(function() {
                        location.reload();
                    }, 3000);

                } else {
                    toastr.error('Error saving data', {timeOut: 5000});
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error: ' + error, {timeOut: 5000});
            }
        });
    });

    //TRANSFER LOCATION
    // $('#bloodinventory-table tbody').on('click', '.transfer-location', function(e) {
    //     e.preventDefault();
    
    //     var bagno = $(this).data('bagno');
    //     var episodeno = $(this).data('episodeno');
    //     var expirydate = $(this).data('expirydate');
    //     var url = config.routes.blood.inventory.wardList;
    
    //     $.ajax({
    //         url: url,
    //         method: 'GET',
    //         dataType: 'json',
    //         data: { bagno: bagno },
    //         success: function(response) {
    
    //             $('#transfer-location').modal('show');

    //             $('#eNumber').val(episodeno);
    //             $('#bNumber').val(bagno);
    //             $('#transferLocation').empty();
    
    //             $('#transferLocation').append('<option></option>');
    
    //             $.each(response.data, function(index, location) {
    //                 $('#transferLocation').append(
    //                     $('<option>', {
    //                         value: location.location_name,
    //                         text: location.location_name + ' (' + location.location_code + ')',
    //                     })
    //                 );
    //             });
    
    //             $('#transferLocation').select2({
    //                 dropdownParent: $('#transfer-location')
    //             });

    //             $('#transferLocation').on('change', function() {
    //                 var selectedLocation = $(this).val();
    
    //                 if ((response.inv.product == "CRYOPPT" || 
    //                      response.inv.product == "PLATELET CONC." || 
    //                      response.inv.product == "FFP.") &&
    //                      selectedLocation === "Laboratory and Blood Services") {
    //                     $('#reasonreturn').show();
    //                 } else {
    //                     $('#reasonreturn').hide();
    //                 }

    //                 if (selectedLocation === "Others") {
    //                     $('#otherlocationdiv').show();
    //                 } else {
    //                     $('#otherlocationdiv').hide();
    //                 }
    //             });

    //             $('#actualtransferdate').on('change', function() {
    //                 const selectedDate = new Date($(this).val());
    //                 const currentDate = new Date();
                    
    //                 // Normalize dates for comparison (ignore seconds and milliseconds)
    //                 currentDate.setSeconds(0, 0);
    //                 selectedDate.setSeconds(0, 0);
            
    //                 // Show or hide the reason div
    //                 if (selectedDate.getTime() !== currentDate.getTime()) {
    //                     $('#transferreason').show();
    //                 } else {
    //                     $('#transferreason').hide();
    //                 }
    //             });
    //         },
    //         error: function(xhr, status, error) {
    //             Swal.fire(
    //                 'Error!',
    //                 'Error occurred while fetching locations: ' + error,
    //                 'error'
    //             );
    //         }
    //     });
    // });

    $('#bloodinventory-table tbody').on('click', '.transfer-location', function(e) {
        e.preventDefault();
    
        var bagno = $(this).data('bagno');
        var episodeno = $(this).data('episodeno');
        var expirydate = $(this).data('expirydate');
        var url = config.routes.blood.inventory.wardList;
    
        // Check if expiry date is missing (indicating expired)
        if (!expirydate) {
            Swal.fire({
                title: 'Expired Date!',
                text: 'This blood bag has an expired date. Please return the bag to lab!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        method: 'GET',
                        dataType: 'json',
                        data: { bagno: bagno },
                        success: function(response) {
                
                            $('#transfer-location').modal('show');
            
                            $('#eNumber').val(episodeno);
                            $('#bNumber').val(bagno);
                            $('#transferLocation').empty();
                
                            $('#transferLocation').append('<option></option>');
                
                            $.each(response.data, function(index, location) {
                                $('#transferLocation').append(
                                    $('<option>', {
                                        value: location.location_name,
                                        text: location.location_name + ' (' + location.location_code + ')',
                                    })
                                );
                            });
                
                            $('#transferLocation').select2({
                                dropdownParent: $('#transfer-location')
                            });
            
                            $('#transferLocation').on('change', function() {
                                var selectedLocation = $(this).val();
                
                                if ((response.inv.product == "CRYOPPT" || 
                                     response.inv.product == "PLATELET CONC." || 
                                     response.inv.product == "FFP.") &&
                                     selectedLocation === "Laboratory and Blood Services") {
                                    $('#reasonreturn').show();
                                } else {
                                    $('#reasonreturn').hide();
                                }
            
                                if (selectedLocation === "Others") {
                                    $('#otherlocationdiv').show();
                                } else {
                                    $('#otherlocationdiv').hide();
                                }
                            });
            
                            $('#actualtransferdate').on('change', function() {
                                const selectedDate = new Date($(this).val());
                                const currentDate = new Date();
                                
                                // Normalize dates for comparison (ignore seconds and milliseconds)
                                currentDate.setSeconds(0, 0);
                                selectedDate.setSeconds(0, 0);
                        
                                // Show or hide the reason div
                                if (selectedDate.getTime() !== currentDate.getTime()) {
                                    $('#transferreason').show();
                                } else {
                                    $('#transferreason').hide();
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Error occurred while fetching locations: ' + error,
                                'error'
                            );
                        }
                    });
                } else {
                    console.log('cancel')
                }
            });
        } else {
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                data: { bagno: bagno },
                success: function(response) {
        
                    $('#transfer-location').modal('show');
    
                    $('#eNumber').val(episodeno);
                    $('#bNumber').val(bagno);
                    $('#transferLocation').empty();
        
                    $('#transferLocation').append('<option></option>');
        
                    $.each(response.data, function(index, location) {
                        $('#transferLocation').append(
                            $('<option>', {
                                value: location.location_name,
                                text: location.location_name + ' (' + location.location_code + ')',
                            })
                        );
                    });
        
                    $('#transferLocation').select2({
                        dropdownParent: $('#transfer-location')
                    });
    
                    $('#transferLocation').on('change', function() {
                        var selectedLocation = $(this).val();
        
                        if ((response.inv.product == "CRYOPPT" || 
                             response.inv.product == "PLATELET CONC." || 
                             response.inv.product == "FFP.") &&
                             selectedLocation === "Laboratory and Blood Services") {
                            $('#reasonreturn').show();
                        } else {
                            $('#reasonreturn').hide();
                        }
    
                        if (selectedLocation === "Others") {
                            $('#otherlocationdiv').show();
                        } else {
                            $('#otherlocationdiv').hide();
                        }
                    });
    
                    $('#actualtransferdate').on('change', function() {
                        const selectedDate = new Date($(this).val());
                        const currentDate = new Date();
                        
                        // Normalize dates for comparison (ignore seconds and milliseconds)
                        currentDate.setSeconds(0, 0);
                        selectedDate.setSeconds(0, 0);
                
                        // Show or hide the reason div
                        if (selectedDate.getTime() !== currentDate.getTime()) {
                            $('#transferreason').show();
                        } else {
                            $('#transferreason').hide();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Error occurred while fetching locations: ' + error,
                        'error'
                    );
                }
            });
        }
    });

    $('#transfer-location').on('hidden.bs.modal', function () {
        $('#reasonreturn').hide();
        $('#otherlocationdiv').hide();
        $('#reason').val('');
        $('#otherslocation').val('');
    });

    $('#submitLocation').on('click', function() {
        var episodeno = $('#eNumber').val();
        var bagno = $('#bNumber').val();
        var location = $('#transferLocation').val();
        var reason = $('#reason').val();
        var others = $('#otherslocation').val();
        var transferdate = $('#actualtransferdate').val();
        var transfercdreason = $('#transfercdreason').val();

        const formattedDate = moment(transferdate).format("YYYY-MM-DD H:mm");

        
        var url = config.routes.blood.inventory.updateLocation;
        var url2 = config.routes.blood.inventory.index;

        if (location == '') {
            toastr.error('Please select the location', {timeOut: 5000});
            return;
        }

        if (transferdate == '') {
            toastr.error('Transfer date cannot be empty.', {timeOut: 5000});
            return;
        }

        if ($('#reasonreturn').is(':visible') && reason == '') {
            toastr.error('Please provide a reason for return', { timeOut: 5000 });
            return;
        }

        if ($('#otherslocation').is(':visible') && others == '') {
            toastr.error('Please enter the others locations field', { timeOut: 5000 });
            return;
        }

        if ($('#transferreason').is(':visible') && transfercdreason == '') {
            toastr.error('Please select reason to change date', { timeOut: 5000 });
            return;
        }


        Swal.fire({
            title: 'Transfer Location',
            text: 'Are you sure you want to transfer this blood pack?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { bagno: bagno, episodeno: episodeno, location: location, reason: reason, others: others, transferdate: formattedDate, transfercdreason: transfercdreason },
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading-overlay").show();
                    },
                    success: function(response) {
                        $("#loading-overlay").hide();
                        Swal.fire({
                            title: "Success!",
                            text: "Successfully transfer location!",
                            icon: "success",
                            buttonsStyling: false,
                            showConfirmButton: false,
                            timer: 3000
                        }).then(() => {
                            window.location.href = url2;
                        });
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Error transferring location: ' + error, {timeOut: 5000});
                    }
                });
            }
        });
    });

    $('#bloodinventory-table tbody').on('click', '.store-blood', function(e) {
        e.preventDefault();

        var bagno = $(this).data('bagno');
        var episodeno = $(this).data('episodeno');

        $('#epiNumber').val(episodeno);
        $('#bgNumber').val(bagno);
        $('#store-bloodpack').modal('show');

        
    });

    $('#store-blood2').on('click', function() {

        var labno = $('#labNumber').val().toUpperCase();
        var bgNO = $('#bgNumber').val();
        var matchDate = $('#matchdate').val();
        var url = config.routes.blood.inventory.verifylab;
        var url2 = config.routes.blood.inventory.storeBlood;

        if (!labno) {
            toastr.error('Please scan or enter the lab number.', { timeOut: 5000 });
            return;
        }
    
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: { labno: labno },
            beforeSend: function(){
                $("#loading-overlay").show();
            },
            success: function(data) {
                $("#loading-overlay").hide();
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Store Blood Pack',
                        text: 'Are you sure you want to store this blood pack?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url2,
                                method: 'POST',
                                data: { bgNO: bgNO, matchDate: matchDate},
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
            
                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);
            
                                },
                                error: function(xhr, status, error) {
                                    toastr.error('Error storing blood: ' + error, {timeOut: 5000});
                                }
                            });
                        }
                    });
                } else {
                    $("#loading-overlay").hide();
                    Swal.fire({
                        title: "Alert!",
                        text: data.response,
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }
            },
            error: function(xhr, status, error) {
                $("#loading-overlay").hide();
                Swal.fire({
                    title: "Alert!",
                    text: "Lab number not found!",
                    icon: "error",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }
        });

    });

    //RECEIVE TRANSFERRED
    $('#bloodinventory-table tbody').on('click', '.receive-transferred', function(e) {
        e.preventDefault();
        var bagno = $(this).data('bagno');
        var episodeno = $(this).data('episodeno');

        $('#epno').val(episodeno);
        $('#bNo').val(bagno);
        
        $('#receive-transferred').modal('show');

    });

    $('#receiveTransferred').on('click', function() {
        var episodeNo = $('#epno').val();
        var bagno = $('#bNo').val();
        var reaction = $('#reactions').val();
        var volume = $('#volumes').val();
        var url = config.routes.blood.inventory.receiveTransferred;

        if (reaction == '' || volume == '') {
            toastr.error('Reaction or volume cannot be empty.', {timeOut: 5000});
            return;
        }
    
        Swal.fire({
            title: 'Receive Transferred Blood Product',
            text: "Are you sure you want to receive this blood product?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { episodeNo: episodeNo, bagno: bagno, reaction: reaction, volume: volume },
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading-overlay").show();
                    },
                    success: function(response) {
                        $("#loading-overlay").hide();

                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: "Blood Product Received!",
                                icon: "success",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 3000
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 3000);
                            
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error discarding the item.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#loading-overlay").hide();
                        Swal.fire(
                            'Error!',
                            'Error occur to start transfusion: ' + error,
                            'error'
                        );
                    }
                });
            }
        });
    });

    //SUSPEND TRANSFUSION
    $('#bloodinventory-table tbody').on('click', '.suspend-transfuse', function(e) {
        e.preventDefault();
        var bagno = $(this).data('bagno');
        var episodeno = $(this).data('episodeno');

        $('#epsdno').val(episodeno);
        $('#bagNo').val(bagno);
        
        $('#suspend-transfuse').modal('show');

        $('#actualsuspenddate').on('change', function() {
            const selectedDate = new Date($(this).val());
            const currentDate = new Date();
            
            // Normalize dates for comparison (ignore seconds and milliseconds)
            currentDate.setSeconds(0, 0);
            selectedDate.setSeconds(0, 0);
    
            // Show or hide the reason div
            if (selectedDate.getTime() !== currentDate.getTime()) {
                $('#suspendreason').show();
            } else {
                $('#suspendreason').hide();
            }
        });

    });

    $('#reaction').change(function () {
        if ($(this).val() === 'Yes') {
            $('#reaction-details').show();
        } else {
            $('#reaction-details').hide();
        }
    });

    $('#suspendTranfusion').on('click', function() {
        var episodeNo = $('#epsdno').val();
        var bagno = $('#bagNo').val();
        var reaction = $('#reaction').val();
        var details = $('#details').val();
        var volume = $('#volume').val();
        var suspenddate = $('#actualsuspenddate').val();
        var suspendcdreason = $('#suspendcdreason').val();


        const formattedDate = moment(suspenddate).format("YYYY-MM-DD H:mm");
        
        var url = config.routes.blood.inventory.suspend;

        if (suspenddate == '') {
            toastr.error('Suspend date cannot be empty.', {timeOut: 5000});
            return;
        }

        if (reaction == '' || volume == '') {
            toastr.error('Reaction or volume cannot be empty.', {timeOut: 5000});
            return;
        }

        if ($('#suspendreason').is(':visible') && suspendcdreason == '') {
            toastr.error('Please select reason to change date', { timeOut: 5000 });
            return;
        }
    
        Swal.fire({
            title: 'Suspend Tranfusion',
            text: "Are you sure you want to suspend this blood transfusion?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { episodeNo: episodeNo, bagno: bagno, reaction: reaction, volume: volume, details: details, suspenddate: formattedDate, suspendcdreason:suspendcdreason },
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading-overlay").show();
                    },
                    success: function(response) {
                        $("#loading-overlay").hide();

                        if (response.status === 'success') {
                            Swal.fire({
                                title: "Success!",
                                text: "Transfusion Stop!",
                                icon: "success",
                                buttonsStyling: false,
                                showConfirmButton: false,
                                timer: 3000
                            });

                            if(reaction === 'Yes'){

                                var indexurl = config.routes.blood.reaction.index;

                                // Parse the URL and its query parameters
                                var urlObj = new URL(indexurl, window.location.origin);
                                var params = new URLSearchParams(urlObj.search);

                                // Add or update the bagno parameter
                                params.set('bagno', bagno);

                                // Construct the new URL
                                urlObj.search = params.toString();
                                var newurl = urlObj.toString();

                                // Navigate to the new URL
                                window.location.href = newurl;

                            }else{
                                setTimeout(function() {
                                    location.reload();
                                }, 3000);
                            }
                            

                            } else {
                            Swal.fire(
                                'Error!',
                                'There was an error discarding the item.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#loading-overlay").hide();
                        Swal.fire(
                            'Error!',
                            'Error occur to start transfusion: ' + error,
                            'error'
                        );
                    }
                });
            }
        });
    });

    //START TRANSFUSION
    $('#bloodinventory-table tbody').on('click', '.transfuse-blood', function(e) {
        e.preventDefault();
        var bagno = $(this).data('bagno');
        var url = config.routes.blood.transfusion.index;
    
        $('#bagNo').val(bagno);
    
        // Parse the URL and its query parameters
        var urlObj = new URL(url, window.location.origin);
        var params = new URLSearchParams(urlObj.search);
    
        // Add or update the bagno parameter
        params.set('bagno', bagno);
    
        // Construct the new URL
        urlObj.search = params.toString();
        var newurl = urlObj.toString();
    
        // Navigate to the new URL
        window.location.href = newurl;
    });

    $('#bloodinventory-table tbody').on('click', '.add-reaction', function(e) {
        e.preventDefault();
        var bagno = $(this).data('bagno');
        var url = config.routes.blood.reaction.index;
    
        $('#bagNo').val(bagno);
    
        var urlObj = new URL(url, window.location.origin);
        var params = new URLSearchParams(urlObj.search);
    
        params.set('bagno', bagno);
    
        urlObj.search = params.toString();
        var newurl = urlObj.toString();
    
        window.location.href = newurl;
    });




    // //ADD REACTION (Transfusion in progress) 
    // $('#bloodinventory-table tbody').on('click', '.add-reaction', function(e) {
    //     e.preventDefault();
    //     var bagNumber = $(this).data('bagno');
    //     var episodeNumber = $(this).data('episodeno');

    //     $('#episodeNumber').val(episodeNumber);
    //     $('#bagNumber').val(bagNumber);
        
    //     $('#add-reaction').modal('show');

    // });

    // ADD REACTION
    $('#addReaction').on('click', function() {
        var epsdNumber = $('#episodeNumber').val();
        var bgnumber = $('#bagNumber').val();
        var reactiondetails = $('#reactiondetails').val();
        var url = config.routes.blood.inventory.addReaction;

        if (reactiondetails == '') {
            toastr.error('Reaction details cannot be empty.', {timeOut: 5000});
            return;
        }

        Swal.fire({
            title: 'Add Reaction',
            text: "Are you sure you want to add reaction during this blood transfusion?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: { epsdNumber: epsdNumber, bgnumber: bgnumber, reactiondetails: reactiondetails },
                    dataType: 'json',
                    beforeSend: function(){
                        $("#loading-overlay").show();
                    },
                    success: function(response) {
                        $("#loading-overlay").hide();
                        if (response.status === 'success') {
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

                            } else {
                            Swal.fire(
                                'Error!',
                                'There was an error saving the reaction.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        $("#loading-overlay").hide();
                        Swal.fire(
                            'Error!',
                            'Error occur to save reaction: ' + error,
                            'error'
                        );
                    }
                });
            }
        });
    });

});