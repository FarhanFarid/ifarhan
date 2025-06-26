var table_woorientation = $('#report-woorientation-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Patient Transfer Ward Orientation (New Admission)',
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
            "width": "10%"
        },
        {
            "targets": 5,
            "width": "4%"
        },
        {
            "targets": 6,
            "width": "4%"
        },
        {
            "targets": 7,
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

                if(row != null && row.inurwardorientation != null)
                    html += row.inurwardorientation.patientinformation.patient.mrn;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.inurwardorientation != null)
                    html += row.inurwardorientation.patientinformation.patient.name;
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

                if(row != null && row.inurwardorientation != null)
                    html += row.inurwardorientation.episodeno;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'ward',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.inurwoorientation != null)
                    html += row.inurwoorientation.lookupward.ctloc_desc;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'date',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.inurwoorientation != null)
                    html += moment(row.inurwoorientation.created_at).format('DD/MM/YYYY');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'time',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.inurwoorientation != null)
                    html += moment(row.inurwoorientation.created_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.inurwoorientation != null)
                    html += row.inurwoorientation.updatedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.inurwoorientation.updated_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.inurwoorientation.updated_at).format('hh:mm A');		
                else
                    html += '';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.wardorientation.orientation.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatewoorientation').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatewoorientation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_woorientation.ajax.reload(); 
    });
});