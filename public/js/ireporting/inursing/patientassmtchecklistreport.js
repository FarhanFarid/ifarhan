var table_patientassmtchecklist = $('#report-patientassmtchecklist-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Patient Assessment Checklist for Home Inotropes',
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
            "width": "4%"
        },
        {
            "targets": 5,
            "width": "10%"
        },
        {
            "targets": 6,
            "width": "10%"
        },
        {
            "targets": 7,
            "width": "5%"
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
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.date != null)
                    html += row.date;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'guardiancaretaker',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.guardian_caretaker != null)
                    html += row.guardian_caretaker;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.lastmodified_by != null) 
                    html += row.lastmodifiedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.lastmodified_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.lastmodified_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'status',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';
                
                if(row != null && row.status_patcheck != null) {
                    if(row.status_patcheck == 1)
                        html += '<span class="badge badge-warning text-white p-3 fs-7">In Progress</span>';
                    else if(row.status_patcheck == 2)
                        html += '<span class="badge badge-primary text-white p-3 fs-7">Done</span>';
                    // else if(row.status_patcheck == 3)
                    // 	html += '<span class="badge badge-danger text-white p-3 fs-7">Pending Verifying</span>';
                    else
                        html += '<span class="badge badge-success text-white p-3 fs-7">Approved & Competent</span>';
                }
                else
                    html += '-';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.patientassmtchecklist.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatepatientassmtchecklist').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatepatientassmtchecklist').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_patientassmtchecklist.ajax.reload(); 
    });
});