var table_dysphagia = $('#report-dysphagia-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Dysphagia Screening',
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
            "width": "10%"
        },
        {
            "targets": 7,
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
            "data": 'date',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.created_at != null)
                    html += moment(row.created_at).format('DD/MM/YYYY');
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

                if(row != null && row.created_at != null)
                    html += moment(row.created_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.updated_by != null) 
                    html += row.updatedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.updated_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.updated_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'status',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';
					
                if(row != null && row.status_dysphagia != null) {
                    if(row.status_dysphagia == 3)
                        html += '<span class="badge badge-success text-white p-3 fs-7">' + 'Completed' + '</span>';
                    else if(row.status_dysphagia == 2)
                        html += '<span class="badge badge-warning text-white p-3 fs-7">' + 'Patient NBM, Refer to SLP' + '</span>';
                    else if(row.status_dysphagia == 1)
                        html += '<span class="badge badge-danger text-white p-3 fs-7">' + 'Try One More Time' + '</span>';
                    else
                        html += '<span class="badge badge-danger text-white p-3 fs-7">' + 'No Status' + '</span>';
                }
                else
                    html += '-';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.dysphagia.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatedysphagia').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatedysphagia').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_dysphagia.ajax.reload(); 
    });
});