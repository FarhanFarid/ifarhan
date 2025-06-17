var table_limbrestraint_asmt = $('#report-limbrestraint-assessment-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report : Limb Restraint - Assessment',
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
            "data": 'ward',
            "render": function (data, type, row)  {
                return '<span>'+row.drugcode+'</span>';
            }
        },
        {
            "data": 'reasonsforrestraint',
            "render": function (data, type, row)  {
                return '<span>'+row.drugcode+'</span>';
            }
        },
        {
            "data": 'orderingdoctor',
            "render": function (data, type, row)  {
                return '<span>'+row.drugname+'</span>';
            }
        },
        {
            "data": 'datetime',
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
        url: config.routes.ireporting.limbrestraint.data,
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