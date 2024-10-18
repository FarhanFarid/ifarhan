var table = $('#reportibloodatr-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IBLOOD-ATR',
            className: 'btn-dark',
        },
    ],
    columnDefs: [
        {
            "targets": 0,
            "width": "10%"
        },
        {
            "targets": 1,
            "width": "10%"
        },
        {
            "targets": 2,
            "width": "20%"
        },
        {
            "targets": 3,
            "width": "10%"
        },
        {
            "targets": 4,
            "width": "10%"
        },
        {
            "targets": 5,
            "width": "10%"
        },
        {
            "targets": 6,
            "width": "20%"
        },
        {
            "targets": 7,
            "width": "10%"
        },
        {
            "targets": 8,
            "width": "10%"
        },
        {
            "targets": 9,
            "width": "10%"
        },
    ],
    columns: [
        {
            "data": null,
            "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": 'mrn',
            "render": function (data, type, row)  {
                return '<span>'+row.mrn+'</span>';
            }
        },
        {
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeno+'</span>';
            }
        },
        {
            "data": 'bagno',
            "render": function (data, type, row)  {
                return '<span>'+row.bagno+'</span>';
            }
        },
        {
            "data": 'onset',
            "render": function (data, type, row)  {
                if(row.transfuse_start_at == null){
                    return '<span></span>';

                }else{
                    return '<span>'+moment(row.transfuse_start_at).format('DD/MM/YYYY HH:mm')+'</span>';
                }
            }
        },
        {
            "data": 'reportedby',
            "render": function (data, type, row)  {
                if(row.name == null){
                    return '<span></span>';

                }else{
                    return '<span>'+row.name+'</span>';
                }
            }
        },
        {
            "data": 'reporteddate',
            "render": function (data, type, row)  {
                if(row.created_at == null){
                    return '<span></span>';

                }else{
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>';
                }
            }
        },
        {
            "data": 'age',
            "render": function (data, type, row) {
                if (row.transfuse_stop_at == null) {
                    return '<span></span>';
                } else {
                    var stopDate = moment(row.transfuse_stop_at); // Parse the transfuse_stop_at date
                    var today = moment(); // Get today's date
                    var daysDifference = today.diff(stopDate, 'days'); // Calculate the difference in days
                    
                    return '<span>' + daysDifference + ' day(s)</span>';
                }
            }
        },
        {
            "data": 'status',
            "render": function (data, type, row)  {
                if(row.status_id == 1){
                    return '<span class="badge badge-light mr-5">Not Finalized</span>';
                }else if(row.status_id == 2){
                    return '<span class="badge badge-success mr-5">Finalized</span>';
                }else{
                    return '<span class="badge badge-warning mr-5">Pending</span>';
                }
            }
        },
        {
            "data": 'report',
            "render": function (data, type, row)  {
                return '<div class="col-md-3"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-bagno="' + row.bagno + '" data-episodeno="' + row.episodeno + '"><i class="fa-regular fa-file-lines"></i></button></div>';
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.iblood.atr.worklist,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
            d.status = $('#filterstatus').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {

    $('#reportibloodatr-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();
    
        var bagno = $(this).data('bagno');
        var epsdno = $(this).data('episodeno');
        var baseUrl = config.routes.ireporting.iblood.atr.report;
    
        // Append parameters to the URL
        var reportUrl = baseUrl + '&bagno=' + encodeURIComponent(bagno) + '&epsdno=' + encodeURIComponent(epsdno);

        console.log(reportUrl);
    
        // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide(); 
        $('#adverse-event-report').modal('show');
    });  
    
    $('.btn-print').on('click', function() {
        var iframe = document.getElementById('report-iframe');
        iframe.contentWindow.print(); // Trigger the print function of the iframe
    });

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload(); 
    });

  
    $('#filterstatus').on('change', function() {
        table.draw();  
    });

    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var status = $('#filterstatus').val();
            var expiryDate = moment(data[7], 'DD/MM/YYYY HH:mm'); 

            if (status === 'all') {
                return true;
            }

            if (status === '2' && data[9] === 'Finalized') {
                return true;  // Finalized
            } else if (status === '1' && data[9] === 'Not Finalized') {
                return true;  // Not Finalized
            }

            return false;
        }
    );
});