var currentDate = moment();
var table = $('#reportiblood-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom: 'Bfrtipl',
    scrollX: "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IBLOOD',
            className: 'btn-dark',
        },
    ],
    columns: [
        {
            "data": null,
            "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": 'mrn',
            "render": function (data, type, row) {
                return '<span>' + row.patinfo.patient.mrn + '</span>';
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row) {
                return '<span>' + row.patinfo.patient.name + '</span>';
            }
        },
        {
            "data": 'episodeNo',
            "render": function (data, type, row) {
                return '<span>' + row.episodeno + '</span>';
            }
        },
        {
            "data": 'labno',
            "render": function (data, type, row) {
                return '<span>' + row.labno + '</span>';
            }
        },
        {
            "data": 'bagno',
            "render": function (data, type, row) {
                return '<span>' + row.bagno + '</span>';
            }
        },
        //Transfuse Status
        //1 - received
        //2 - stored
        //3 - inprogress
        //4 - tranfused
        //5 - Transfer to Other Location
        //7 - return to lab
        // {
        //     "data": 'status',
        //     "render": function (data, type, row) {
        //         if(row.transfuse_status_id == 1){
        //             return '<span class="badge badge-primary">Received</span>';
        //         }else if (row.transfuse_status_id == 2){
        //             return '<span class="badge badge-info">Stored</span>';
        //         }else if (row.transfuse_status_id == 3){
        //             return '<span class="badge badge-warning">Transfusion in progress</span>';
        //         }else if (row.transfuse_status_id == 4){
        //             return '<span class="badge badge-success">Transfused</span>';
        //         }else if (row.transfuse_status_id == 5){
        //             return '<span class="badge badge-light">Transfered to '+ row.transfer_to +'</span>';
        //         }else if (row.transfuse_status_id == 7){
        //             return '<span class="badge badge-light">Returned to lab</span>';
        //         }
        //     }
        // },
        {
            "data": 'expirydate',
            "render": function (data, type, row) {
                if (row.expiry_date == null) {
                    return '<span>-</span>';
                } else {
                    return '<span>' + moment(row.expiry_date).format('DD/MM/YYYY HH:mm') + '</span>';
                }
            }
        },
        {
            "data": 'reaction',
            "render": function (data, type, row) {
                if (row.reaction == null) {
                    return '<span>-</span>';
                } else {
                    return '<span>' + row.reaction + '</span>';
                }
            }
        },
        {
            "data": 'location',
            "render": function (data, type, row) {
                return '<button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px" data-kt-docs-datatable-subtable="expand_row" data-toggle="collapse" data-target="#locations-' + row.id + '" aria-expanded="false" aria-controls="locations-' + row.id + '" style="display: block; margin-left: auto; margin-right: auto;">' +
                    '<span class="svg-icon fs-3 m-0 toggle-off">+</span>' +
                    '<span class="svg-icon fs-3 m-0 toggle-on"> - </span>' +
                '</button>';
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.iblood.getdata,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {

$.ajaxSetup({
    headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
 });

$('#reportiblood-table tbody').on('click', 'button.toggle', function () {
    var tr = $(this).closest('tr');
    var row = table.row(tr);
    var episodeNo = row.data().episodeno;
    var bagNo = row.data().bagno;
    var labNo = row.data().labno;
    var url = config.routes.ireporting.iblood.locationdetails;

    if (row.child.isShown()) {
        // Row is already open, so close it
        row.child.hide();
        tr.removeClass('shown');
        $(this).html('<span class="svg-icon fs-3 m-0 toggle-off">+</span>');
    } else {
        // Fetch the data with AJAX
        $.ajax({
            url: url,
            method: 'POST',
            data: { episodeNo: episodeNo, bagNo: bagNo, labNo: labNo},
            dataType: 'json',
            success: function (data) {

                var responseData = data.data.locations;

                console.log(responseData);

                var subtableContent = '<table class="table subtable table-bordered table-row-bordered">';
                subtableContent += '<thead">';
                subtableContent += '<tr><th style="background-color: #e9f2ff; color: #1d69e3;">Location</th><th style="background-color: #e9f2ff; color: #1d69e3;">Status</th><th style="background-color: #e9f2ff; color: #1d69e3;">Transfusion Start</th><th style="background-color: #e9f2ff; color: #1d69e3;">Transfusion Stop</th><th style="background-color: #e9f2ff; color: #1d69e3;">Received By</th><th style="background-color: #e9f2ff; color: #1d69e3;">Received At</th><th style="background-color: #e9f2ff; color: #1d69e3;">Created At</th></tr>';
                subtableContent += '</thead>';
                subtableContent += '<tbody>';
                
                responseData.forEach(function(response) {
                    subtableContent += '<tr>';
                    subtableContent += '<td>' + response.location + '</td>';

                    //Status 
                    subtableContent += '<td>' 
                                        if(response.location != "Laboratory and Blood Services" && response.status_id == 1){
                                            if(data.data.transfuse_status_id == 1){
                    subtableContent +=          '<span class="badge badge-primary">Received</span>'             
                                            }else if(data.data.transfuse_status_id == 2){
                    subtableContent +=          '<span class="badge badge-primary">Stored</span>' 
                                            }else if(data.data.transfuse_status_id == 3){
                    subtableContent +=          '<span class="badge badge-warning">Transfusion in progress</span>' 
                                            }else if(data.data.transfuse_status_id == 5){
                    subtableContent +=          '<span class="badge badge-light">Transfered</span>' 
                                            }   
                                        }else if(response.location == "Laboratory and Blood Services"){
                    subtableContent +=      '<span class="badge badge-light">Returned</span>' 
                                        }else if(response.status_id == 3){
                    subtableContent +=      '<span class="badge badge-primary">Received</span>' 
                                        }else if(response.location != "Laboratory and Blood Services" && response.status_id == 2){
                    subtableContent +=      '<span class="badge badge-warning">'
                    subtableContent +=      'Transfer in progress to: <br/>' + data.data.transfer_to + '</span>'   
                                        }                               
                    subtableContent += '</td>';

                    //Transfusion Start
                    
                    subtableContent += '<td>' 
                                        if(response.start_transfusion == "Yes"){
                    subtableContent +=      '<div>'
                    subtableContent +=          '<strong>Start Time:</strong> ' + moment(data.data.transfuse_start_at).format('DD/MM/YYYY HH:mm')
                    subtableContent +=      '</div>'
                    subtableContent +=      '<div>'
                    subtableContent +=          '<strong>Start By:</strong> ' + data.data.transfuse_start_by.name
                    subtableContent +=      '</div>'
                    subtableContent +=      '<div>'
                    subtableContent +=          '<strong>Verify By:</strong> ' + data.data.transfuse_verify_by.name
                    subtableContent +=      '</div>'
                                        }else{
                    subtableContent +=      '<span>-</span>'                        
                                        }                               
                    subtableContent += '</td>';

                    //Transfusion Stop
                    subtableContent += '<td>' 
                    if(response.stop_transfusion == "Yes"){
                        subtableContent +=      '<div>'
                        subtableContent +=          '<strong>Stop Time:</strong> ' + moment(data.data.transfuse_stop_at).format('DD/MM/YYYY HH:mm')
                        subtableContent +=      '</div>'
                        subtableContent +=      '<div>'
                        subtableContent +=          '<strong>Stop By:</strong> ' + data.data.user.name
                        subtableContent +=      '</div>'
                                            }else{
                        subtableContent +=      '<span>-</span>'                        
                    }                               
                    subtableContent += '</td>';
                    
                    subtableContent += '<td>' + response.user.name + '</td>';
                    subtableContent += '<td>' + moment(response.received_at).format('DD/MM/YYYY HH:mm') + '</td>'; 
                    subtableContent += '<td>' + moment(response.created_at).format('DD/MM/YYYY HH:mm') + '</td>';       
                    subtableContent += '</tr>';
                });
                
                subtableContent += '</tbody>';
                subtableContent += '</table>';
                
                row.child(subtableContent).show();
                tr.addClass('shown');
                $(this).html('<span class="svg-icon fs-3 m-0 toggle-on">-</span>');
        
            },
            error: function (xhr, status, error) {
                toastr.error('Error: ' + error, { timeOut: 5000 });
            }
        });
    }
});

$('#filterdate').daterangepicker({
    locale: {
        format: 'DD/MM/YYYY'
    },
}).on('apply.daterangepicker', function(ev, picker) {
    table.ajax.reload(); 
});

});


// $(document).ready(function() {

//     $('#filterdate').daterangepicker({
//         locale: {
//             format: 'DD/MM/YYYY'
//         },
//     }).on('apply.daterangepicker', function(ev, picker) {
//         table.ajax.reload(); 
//     });

  
//     $('#filterstatus').on('change', function() {
//         table.draw();  
//     });

//     $.fn.dataTable.ext.search.push(
//         function(settings, data, dataIndex) {
//             var status = $('#filterstatus').val();
//             var expiryDate = moment(data[7], 'DD/MM/YYYY HH:mm'); 

//             if (status === 'all') {
//                 return true;
//             }

//             if (status === '1' && data[9] === 'Received') {
//                 return true;  // Stored
//             } else if (status === '2' && data[9] === 'Stored') {
//                 return true;  // Prepared
//             } else if (status === '3' && data[9] === 'Transfusion in progress') {
//                 return true;  // Administered
//             } else if (status === '4' && data[9] === 'Transfusion with reaction') {
//                 return true;  // Handover
//             } else if (status === '4' && data[9] === 'Transfused') {
//                 return true;  // Expired
//             } else if (status === '7' && data[9] === 'Return to Lab') {
//                 return true;  // Administered - Partial
//             }

//             return false;
//         }
//     );
// });