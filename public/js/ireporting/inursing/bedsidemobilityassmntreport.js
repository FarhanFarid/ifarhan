var table_bmat = $('#report-bmat-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Bedside Mobility Assessment Tool (BMAT)',
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
            "width": "15%"
        },
        {
            "targets": 6,
            "width": "15%"
        },
        {
            "targets": 7,
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
                    html += '-';

                return html;
            }
        },
        {
            "data": 'date',
            "className": 'text-center',
            "render": function (data, type, row) {
                var html = '';

                if(row != null && row.date != null)
                    html += moment(row.date).format('DD/MM/YYYY');
                else
                    html += '-';

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

                if(row != null && row.status_bmat != null) {
						if(row.status_bmat === 'Level 1')
							html += '<span class="badge badge-danger text-white p-3 fs-7">'+row.status_bmat+'</span>';
						else if(row.status_bmat === 'Level 2')
							html += '<span class="badge text-white p-3 fs-7" style="background-color: #e17f26;">'+row.status_bmat+'</span>';
						else if(row.status_bmat === 'Level 3')
							html += '<span class="badge badge-warning text-white p-3 fs-7">'+row.status_bmat+'</span>';
						else if(row.status_bmat === 'Level 4')
							html += '<span class="badge badge-success text-white p-3 fs-7">'+row.status_bmat+'</span>';
						else
							html += '<span class="badge badge-danger text-white p-3 fs-7">No status</span>';
					}
					else
						html += '-';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.bedsidemobilityassmnt.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatebmat').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatebmat').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_bmat.ajax.reload(); 
    });
});