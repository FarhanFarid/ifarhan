var table_peritonealchart = $('#report-peritonealchart-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Peritoneal Dialysis Chart',
            className: 'btn-dark',
        },
    ],
    columnDefs: [
        {
            "targets": 0,
            "width": "4%"
        },
        {
            "targets": 1,
            "width": "3%"
        },
        {
            "targets": 2,
            "width": "15%"
        },
        {
            "targets": 3,
            "width": "4%"
        },
        {
            "targets": 4,
            "width": "4%"
        },
        {
            "targets": 5,
            "width": "5%"
        },
        {
            "targets": 6,
            "width": "5%"
        },
        {
            "targets": 7,
            "width": "5%"
        },
        {
            "targets": 8,
            "width": "15%"
        },
    ],
    columns: [
        {
            "data": 'no',
            "className": 'text-center',
            "render": function (data, type, row, meta) {
                var html = '';

                if(row != null)
                    html += meta.row + 1;

                return html;
            }
        },
        {
            "data": 'mrn',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += row.mrn;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += row.name;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'episodeno',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += row.episodeno;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'date',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null)
                    html += moment(row.date).format('DD/MM/YYYY');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'in',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null)
                    html += row.totin;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'out',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null)
                    html += row.totout;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'balanceacc',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null)
                    html += row.totcycle;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row) {
                var html = '';

                if(row != null)
                    html += row.updatedby + '<br>' + '@ &nbsp;' + row.updatedbydt;		
                else
                    html += '';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.peritonealchart.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdateperitonealchart').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdateperitonealchart').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_peritonealchart.ajax.reload(); 
    });
});