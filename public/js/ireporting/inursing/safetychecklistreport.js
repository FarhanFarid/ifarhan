var table_safetychecklist = $('#report-safetychecklist-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Safety Checklist',
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
            "width": "15%"
        },
        {
            "targets": 5,
            "width": "10%"
        },
        {
            "targets": 6,
            "width": "15%"
        },
        {
            "targets": 7,
            "width": "4%"
        },
        {
            "targets": 8,
            "width": "4%"
        },
        {
            "targets": 9,
            "width": "4%"
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
            "data": 'surgeryprocedure',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.surgery_procedure != null)
                    html += row.surgery_procedure;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'location',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.location != null)
                    html += row.location + (row.others_loc ? (' (' + row.lookupward.ctloc_desc + ')') : '');
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.last_modified_by != null) 
                    html += row.lastmodifiedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.last_modified_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.last_modified_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'totaltimeout',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.total_timeout != null) 
                    html += row.total_timeout;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'totalsignout',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.total_signout != null) 
                    html += row.total_signout;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'status',
            "className": "text-center",
            "render": function (data, type, row) {
                var html = '';
                
                if(row != null && row.status_safety != null) {
                    if(row.status_safety == 3)
                        html += '<span class="badge badge-success text-white p-3 fs-7">' + 'Sign Out' + '</span>';
                    else if(row.status_safety == 2)
                        html += '<span class="badge badge-primary text-white p-3 fs-7">' + 'Time Out' + '</span>';
                    else if(row.status_safety == 1)
                        html += '<span class="badge badge-warning text-white p-3 fs-7">' + 'Sign In' + '</span>';
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
        url: config.routes.ireporting.safetychecklist.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatesafetychecklist').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatesafetychecklist').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_safetychecklist.ajax.reload(); 
    });
});