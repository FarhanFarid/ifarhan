var table_postdischarge = $('#report-postdischarge-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Post Discharge Visit - Initial Assessment',
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
            "data": 'datevisit',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.date_visit != null)
                    html += moment(row.date_visit).format('DD/MM/YYYY');
                else
                    html += '-';

                return html;
            }
        },
        {
            "data": 'timevisit',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.time_visit != null)
                    html += moment(row.time_visit, 'HH:mm:ss').format('hh:mm A');
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
            "data": 'typeassmt',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';
                
                if(row != null && row.type_assessment != null) {
                    if(row.type_assessment == 2)
                        html += '<span class="badge badge-warning text-white p-3 fs-7">' + 'Reassessment' + '</span>';
                    else if(row.type_assessment == 1)
                        html += '<span class="badge badge-primary text-white p-3 fs-7">' + 'Initial Assessment' + '</span>';
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
        url: config.routes.ireporting.postdischarge.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatepostdischarge').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatepostdischarge').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_postdischarge.ajax.reload(); 
    });
});