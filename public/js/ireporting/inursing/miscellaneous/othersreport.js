var table_mscothers = $('#report-mscothers-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Miscellaneous - Others',
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
            "width": "4%"
        },
        {
            "targets": 2,
            "width": "15%"
        },
        {
            "targets": 3,
            "width": "5%"
        },
        {
            "targets": 4,
            "width": "4%"
        },
        {
            "targets": 5,
            "width": "4%"
        },
        {
            "targets": 6,
            "width": "5%"
        },
        {
            "targets": 7,
            "width": "10%"
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

                if(row != null && row.inurgenerals != null)
                    html += row.inurgenerals.patientinformation.patient.mrn;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.inurgenerals != null)
                    html += row.inurgenerals.patientinformation.patient.name;
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
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += moment(row.updated_at).format('DD/MM/YYYY');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'time',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += moment(row.updated_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'othermonitor',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += row.other_monitor;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'remark',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null)
                    html += row.remark;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'recordedby',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null) 
                    html += row.updatedby.name;
                else
                    html += '';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.miscellaneous.data,
        dataSrc: "others",
        data: function (d) {
            d.dateRange = $('#filterdatemscothers').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatemscothers').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_mscothers.ajax.reload(); 
    });
});