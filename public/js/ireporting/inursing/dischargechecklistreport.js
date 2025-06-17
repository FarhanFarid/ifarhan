var table_discharge = $('#report-dischargechecklist-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Patient Discharge Checklist',
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
            "width": "4%"
        },
        {
            "targets": 4,
            "width": "5%"
        },
        {
            "targets": 5,
            "width": "10%"
        },
        {
            "targets": 6,
            "width": "10%"
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
            "data": 'dischargesummary',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.inurdcdocumentgiven != null)
                    html += row.inurdcdocumentgiven.discharge_summary;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'remarks',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.inurdcdocumentgiven != null)
                    html += (row.inurdcdocumentgiven.ds_no_desc ?? '-');
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.lastmodified_by != null) 
                    html += row.lastmodifiedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.lastmodified_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.lastmodified_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.dischargechecklist.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatedischargechecklist').val();
            d.dischargeSumm = $('#filterdischargesummary').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatedischargechecklist').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_discharge.ajax.reload(); 
    });

    $('#filterdischargesummary').select2({
        placeholder: "Please select...",
        width: "100%",
    });

    $('#filterdischargesummary').on('change', function(e) {
        e.preventDefault();

        table_discharge.ajax.reload();
    });
});