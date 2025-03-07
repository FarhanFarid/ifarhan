var table = $('#reportms-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - Med Shelf',
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
            "data": 'drugcode',
            "render": function (data, type, row)  {
                return '<span>'+row.drugcode+'</span>';
            }
        },
        {
            "data": 'drugname',
            "render": function (data, type, row)  {
                return '<span>'+row.drugname+'</span>';
            }
        },
        {
            "data": 'scanby',
            "render": function (data, type, row)  {
                return '<span>'+row.scanby+'</span>';
            }
        },
        {
            "data": 'scandate',
            "render": function (data, type, row)  {
                return '<span>'+moment(row.scandate).format('DD/MM/YYYY')+'</span>';
            }
        },
        {
            "data": 'status',
            "render": function (data, type, row)  {
                return '<span>'+row.status+'</span>';
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