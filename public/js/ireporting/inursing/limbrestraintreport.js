var table_limbrestraint_asmt = $('#report-limbrestraint-assessment-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report Limb Restraint - Assessment',
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
            "width": "15%"
        },
        {
            "targets": 6,
            "width": "10%"
        },
        {
            "targets": 7,
            "width": "4%"
        },
        {
            "targets": 8,
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
            "data": 'ward',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.lookupward != null)
                    html += row.lookupward.ctloc_desc;
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'reasonsforrestraint',
            "render": function (data, type, row)  {
                var html = '';

                if(row.reason_restraint != null)
                    html += row.reason_restraint;
                    if(row.reason_restraint_given_to != null){
                        html += '<br/><br/><b>Given To: </b>'+row.reason_restraint_given_to;
                    }
                else
                    html += '';

                return html;
            }
        },
        {
            "data": 'orderingdoctor',
            "render": function (data, type, row)  {
                var html = '';

                if(row.ordering_doctor != null){
                    html += row.ordering_doctor;
                }
                else {
                    html += '';
                }

                return html;
            }
        },
        {
            "data": 'datetime',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row.date_time != null){
                    html += moment(row.date_time).format('DD/MM/YYYY hh:mm A');
                }
                else{
                    html += '';
                }

                return html;
            }
        },
        {
            "data": 'lastupdatedby',
            "className": 'text-center',
            "render": function (data, type, row)  {
                var html = '';

                if(row != null && row.lastmodified_by != null) 
                    html += row.lastmodifiedby + '<br>' + '@ &nbsp;' +
                            moment(row.lastmodified_at).format('DD/MM/YYYY') + '&nbsp;&nbsp;' + moment(row.lastmodified_at).format('hh:mm A');
                else
                    html += '';

                return html;
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.limbrestraint.data,
        dataSrc: "list",
        data: function (d) {
            d.dateRange = $('#filterdatelimb').val();
            d.ward = $('#filterwardlimb').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    $('#filterdatelimb').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table_limbrestraint_asmt.ajax.reload(); 
    });

    $('#filterwardlimb').select2({
        placeholder: "Please select...",
        width: "100%",
    });

    $('#filterwardlimb').on('change', function(e) {
        e.preventDefault();

        table_limbrestraint_asmt.ajax.reload();
    });
});