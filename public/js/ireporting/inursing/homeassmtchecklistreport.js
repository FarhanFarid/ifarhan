var table_homeassmtchecklist = $('#report-homeassmtchecklist-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Home Assessment Checklist',
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
            "width": "11%"
        },
        {
            "targets": 6,
            "width": "5%"
        },
        {
            "targets": 7,
            "width": "4%"
        },
        {
            "targets": 8,
            "width": "10%"
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
            "data": 'date',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.date_personperform != null)
                    html += row.date_personperform;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'personperformassmt',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.careprovider != null)
                    html += row.careprovider.cpName;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'typeassmt',
            "className": "text-center",
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.type_assessment != null) {
                    if(row.type_assessment == 1)
                        html += '<span class="badge badge-primary text-white p-3 fs-7">Assessment</span>';
                    else
                        html += '<span class="badge badge-warning text-white p-3 fs-7">Reassessment</span>';
                }
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'dateassessed',
            "className": "text-center",
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.inurhomechecklistassmt != null) 
                    html += row.inurhomechecklistassmt.date_assessed;
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "render": function (data, type, row) {
                var html = '';
                if(row != null && row.updated_by != null) 
                    html += row.updatedby.name + '<br>' + '@ &nbsp;' +
                            moment(row.updated_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.updated_at).format('hh:mm A');
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'status',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';
                
                if(row != null) {
                    if(row.inurhomechecklistassmt != null && row.inurhomechecklistassmt.status_reassessment != null) {
                        if(row.inurhomechecklistassmt.status_reassessment == 1 || row.inurhomechecklistassmt.status_reassessment == 2)
                            html += '<span class="badge badge-danger text-white p-3 fs-7">Not meets <br> all required criteria</span>';
                        else if(row.inurhomechecklistassmt.status_reassessment == 3)
                            html += '<span class="badge badge-success text-white p-3 fs-7">Meets <br> all required criteria</span>';
                    }
                }
                else
                    html += '-';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.homeassmtchecklist.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatehomeassmtchecklist').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatehomeassmtchecklist').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_homeassmtchecklist.ajax.reload(); 
    });
});