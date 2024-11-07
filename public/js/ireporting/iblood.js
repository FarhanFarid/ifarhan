var currentDate = moment();
var table = $('#reportiblood-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
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
            "render": function (data, type, row)  {
                return '<span>'+row.mrn+'</span>';
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                return '<span>'+row.name+'</span>';
            }
        },
        {
            "data": 'episodeNo',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeno+'</span>';
            }
        },
        {
            "data": 'labno',
            "render": function (data, type, row)  {
                return '<span>'+row.labno+'</span>';
            }
        },
        {
            "data": 'bagno',
            "render": function (data, type, row)  {
                return '<span>'+row.bagno+'</span>';
            }
        },
        {
            "data": 'reaction',
            "render": function (data, type, row)  {
                return '<span>'+row.location+'</span>';
            }
        },
        {
            "data": 'location',
            "render": function (data, type, row)  {
                if(row.reaction == null){
                    return '<span>-</span>';

                }else{
                    return '<span>'+row.reaction+'</span>';
                }
            }
        },
        {
            "data": 'receivedate',
            "render": function (data, type, row)  {
                if(row.received_at == null){
                    return '<span>-</span>';

                }else{
                    return '<span>'+moment(row.received_at).format('DD/MM/YYYY HH:mm')+'</span>';
                }
            }
        },
        {
            "data": 'createddate',
            "render": function (data, type, row)  {
                if(row.created_at == null){
                    return '<span>-</span>';

                }else{
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>';
                }
            }
        },
        {
            "data": 'expirydate',
            "render": function (data, type, row) {
                if (row.expiry_date == null) {
                    return '<span>-</span>';
                } else {
                    const expiryDate = moment(row.expiry_date);
                    const currentDate = moment();
        
                    if (expiryDate.isBefore(currentDate)) {
                        return '<span class="text-danger">' + expiryDate.format('DD/MM/YYYY HH:mm') + '</span>';
                    } else {
                        return '<span>' + expiryDate.format('DD/MM/YYYY HH:mm') + '</span>';
                    }
                }
            }
        },
        {
            "data": 'status',
            "render": function (data, type, row)  {

                if(row.transfuse_status_id == 1){
                    return '<span class="badge badge-info">Received</span>';
                }
                else if(row.transfuse_status_id == 2){
                    return '<span class="badge badge-info">Stored</span>';
                }
                else if(row.transfuse_status_id == 3){
                    return '<span class="badge badge-warning mr-5">Transfusion in progress</span>';
                }
                else if(row.transfuse_status_id == 4){
                    if(row.reaction == "Yes"){
                        return'<span class="badge badge-warning">Transfused with reaction </span>';
                    }else{
                        return '<span class="badge badge-success mr-5">Transfused</span>';
                    }
                }else if(row.transfuse_status_id == 5){
                    return '<span class="badge badge-light">Transfered</span>';
                }else if(row.transfuse_status_id == 7){
                    return '<span class="badge badge-light">Return to Lab</span>';
                }
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.iblood.getdata,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
            d.status = $('#filterstatus').val();
        },
        dataType: "json",
    },
});


$(document).ready(function() {

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload(); 
    });

  
    $('#filterstatus').on('change', function() {
        table.draw();  
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var status = $('#filterstatus').val();
            var expiryDate = moment(data[7], 'DD/MM/YYYY HH:mm'); 

            if (status === 'all') {
                return true;
            }

            if (status === '1' && data[9] === 'Received') {
                return true;  // Stored
            } else if (status === '2' && data[9] === 'Stored') {
                return true;  // Prepared
            } else if (status === '3' && data[9] === 'Transfusion in progress') {
                return true;  // Administered
            } else if (status === '4' && data[9] === 'Transfusion with reaction') {
                return true;  // Handover
            } else if (status === '4' && data[9] === 'Transfused') {
                return true;  // Expired
            } else if (status === '7' && data[9] === 'Return to Lab') {
                return true;  // Administered - Partial
            }

            return false;
        }
    );
});