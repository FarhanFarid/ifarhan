var table = $('#reportms-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - Consent Listing',
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
            "data": 'patname',
            "render": function (data, type, row)  {
                return '<span>'+row.patname+'</span>';
            }
        },
        {
            "data": 'mrn',
            "render": function (data, type, row)  {
                return '<span>'+row.mrn+'</span>';
            }
        },
        {
            "data": 'consentname',
            "render": function (data, type, row)  {
                return '<span>'+row.consentname+'</span>';
            }
        },
        {
            "data": 'createdby',
            "render": function (data, type, row)  {
                return '<span>'+row.createdby+'</span>';
            }
        },
        {
            "data": 'createddate',
            "render": function (data, type, row)  {
                return '<span>'+moment(row.createddate).format('DD/MM/YYYY')+'</span>';
            }
        },
        {
            "data": 'createdtime',
            "render": function (data, type, row)  {
                return '<span>'+row.createdtime+'</span>';
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.point.ms.data,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    var currentDate = moment();

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload(); 
    });
});