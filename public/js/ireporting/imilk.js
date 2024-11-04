
var currentDate = moment();
var table = $('#reportimilk-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IMILK',
            className: 'btn-dark',
        },
    ],
    columnDefs: [
        {
            "targets": 0,
            "width": "10%"
        },
        {
            "targets": 1,
            "width": "10%"
        },
        {
            "targets": 2,
            "width": "10%"
        },
        {
            "targets": 3,
            "width": "10%"
        },
        {
            "targets": 4,
            "width": "10%"
        },
        {
            "targets": 5,
            "width": "10%"
        },
        {
            "targets": 6,
            "width": "20%"
        },
        {
            "targets": 7,
            "width": "20%"
        },
        {
            "targets": 8,
            "width": "10%"
        },
        {
            "targets": 9,
            "width": "10%"
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
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeNo+'</span>';
            }
        },
        {
            "data": 'episodedate',
            "render": function (data, type, row)  {
                if(row.epsiodedate != null)
                    return '<span>'+moment(row.epsiodedate).format('DD/MM/YYYY')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'idatype',
            "render": function (data, type, row)  {
                return '<span>'+row.batchId+'</span>';
            }
        },
        {
            "data": 'patientname',
            "render": function (data, type, row)  {
                return '<span>'+row.location+'</span>';
            }
        },
        {
            "data": 'doctorname',
            "render": function (data, type, row)  {
                return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>';
            }
        },
        {
            "data": 'updateddate',
            "render": function (data, type, row)  {
                return '<span>'+moment(row.expiryDate).format('DD/MM/YYYY HH:mm')+'</span>';
            }
        },
        {
            "data": 'securitygroup',
            "render": function (data, type, row)  {
                return '<span>'+row.username+'</span>';
            }
        },
        {
            "data": 'statuslock',
            "render": function (data, type, row)  {

                if(row.status == 1){
                    if(currentDate.isAfter(row.expiryDate)){
                        return '<span class="badge badge-danger">Expired</span>';
                    }else{
                        return '<span class="badge badge-primary">Stored</span>';
                    }
                }else if (row.status == 2){
                    if(currentDate.isAfter(row.expiryDate)){
                        return '<span class="badge badge-danger">Expired</span>';
                    }else{
                        return '<span class="badge badge-warning">Prepared</span>';
                    }
                }else if (row.status == 3){
                    return '<span class="badge badge-success">Administered</span>';
                }else if (row.status == 4){
                    return '<span class="badge badge-success">Handover</span>';
                }else if (row.status == 5){
                    return '<span class="badge badge-danger">Expired</span>';
                }else if (row.status == 6){
                    return '<span class="badge badge-danger">Discarded</span>';
                }else if (row.status == 7){
                    return '<span class="badge badge-danger">Administered - Partial</span>';
                } 
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.imilk.getdata,
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

            if (status === '1' && data[9] === 'Stored') {
                return true;  // Stored
            } else if (status === '2' && data[9] === 'Prepared') {
                return true;  // Prepared
            } else if (status === '3' && data[9] === 'Administered') {
                return true;  // Administered
            } else if (status === '4' && data[9] === 'Handover') {
                return true;  // Handover
            } else if (status === '6' && data[9] === 'Discarded') {
                return true;  // Expired
            } else if (status === '7' && data[9] === 'Administered - Partial') {
                return true;  // Administered - Partial
            } else if (status === '8' && data[9] === 'Expired') {
                return true;  // Administered - Partial
            }

            return false;
        }
    );
});