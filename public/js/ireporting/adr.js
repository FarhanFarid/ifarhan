var tablesuspect = $('#reportadr-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - ADR (Suspected)',
            className: 'btn-dark',
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
                return '<span>'+row.patientinfo.patient.mrn+'</span>';
            }
        },
        {
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeno+'</span>';
            }
        },
        { 
            "data": 'onset', 
            "render": function (data, type, row)  {
                if(row.descriptions.onsettime == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'reportedby',
            "render": function (data, type, row)  {
                return '<span>'+row.createdby.name+'</span>';
            }
        },
        {
            "data": 'reporteddate',
            "render": function (data, type, row)  {
                if(row.created_at == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'suspecteddrug',
            "render": function (data, type, row) {
                var susdrugs = row.susdrugs;
                var html = '<ul>';
        
                susdrugs.forEach(function(response) {
                    html += '<li>' + response.product + '</li>'; 
                });
        
                html += '</ul>'; 
                return html; 
            }
        },
        {
            "data": 'age',
            "render": function (data, type, row) {
                if (row.created_at == null) {
                    return '<span></span>';
                } else {
                    var stopDate = moment(row.created_at); // Parse the transfuse_stop_at date
                    var today = moment(); // Get today's date
                    var daysDifference = today.diff(stopDate, 'days'); // Calculate the difference in days
                    
                    return '<span>' + daysDifference + ' day(s)</span>';
                }
            }
        },
        { 
            "data": 'report',
            "render": function (data, type, row)  {
                return '<div class="col-md-3"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-episodeno="' + row.episodeno + '"><i class="fa-regular fa-file-lines"></i></button></div>'; 
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.adr.worklistsuspect,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
        },
        dataType: "json",
    },
});

var tableconfirm = $('#reportadrconfirm-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - ADR (Confirm)',
            className: 'btn-dark',
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
                return '<span>'+row.patientinfo.patient.mrn+'</span>';
            }
        },
        {
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeno+'</span>';
            }
        },
        { 
            "data": 'onset', 
            "render": function (data, type, row)  {
                if(row.descriptions.onsettime == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'reportedby',
            "render": function (data, type, row)  {
                return '<span>'+row.createdby.name+'</span>';
            }
        },
        {
            "data": 'reporteddate',
            "render": function (data, type, row)  {
                if(row.created_at == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'suspecteddrug',
            "render": function (data, type, row) {
                var susdrugs = row.susdrugs;
                var html = '<ul>';
        
                susdrugs.forEach(function(response) {
                    html += '<li>' + response.product + '</li>'; 
                });
        
                html += '</ul>'; 
                return html; 
            }
        },
        {
            "data": 'age',
            "render": function (data, type, row) {
                if (row.created_at == null) {
                    return '<span></span>';
                } else {
                    var stopDate = moment(row.created_at); // Parse the transfuse_stop_at date
                    var today = moment(); // Get today's date
                    var daysDifference = today.diff(stopDate, 'days'); // Calculate the difference in days
                    
                    return '<span>' + daysDifference + ' day(s)</span>';
                }
            }
        },
        { 
            "data": 'report',
            "render": function (data, type, row)  {
                return '<div class="col-md-3"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-episodeno="' + row.episodeno + '"><i class="fa-regular fa-file-lines"></i></button></div>'; 
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.adr.worklistconfirm,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdateconfirm').val();
        },
        dataType: "json",
    },
});

var tablefalse = $('#reportadrfalse-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - ADR (False Report)',
            className: 'btn-dark',
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
                return '<span>'+row.patientinfo.patient.mrn+'</span>';
            }
        },
        {
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.episodeno+'</span>';
            }
        },
        { 
            "data": 'onset', 
            "render": function (data, type, row)  {
                if(row.descriptions.onsettime == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'reportedby',
            "render": function (data, type, row)  {
                return '<span>'+row.createdby.name+'</span>';
            }
        },
        {
            "data": 'reporteddate',
            "render": function (data, type, row)  {
                if(row.created_at == null){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+moment(row.created_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'suspecteddrug',
            "render": function (data, type, row) {
                var susdrugs = row.susdrugs;
                var html = '<ul>';
        
                susdrugs.forEach(function(response) {
                    html += '<li>' + response.product + '</li>'; 
                });
        
                html += '</ul>'; 
                return html; 
            }
        },
        {
            "data": 'age',
            "render": function (data, type, row) {
                if (row.created_at == null) {
                    return '<span></span>';
                } else {
                    var stopDate = moment(row.created_at); // Parse the transfuse_stop_at date
                    var today = moment(); // Get today's date
                    var daysDifference = today.diff(stopDate, 'days'); // Calculate the difference in days
                    
                    return '<span>' + daysDifference + ' day(s)</span>';
                }
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.adr.worklistfalse,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdatefalse').val();
        },
        dataType: "json",
    },
});


$(document).ready(function() {


    //Suspected
    $('#searchsuspect').on('keyup', function() {
        tablesuspect.search(this.value).draw();
    });

    $('#exportsuspect').on('click', function () {
        tablesuspect.button('.buttons-excel').trigger();  
    });

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        tablesuspect.ajax.reload(); 
    });

    $('#reportadr-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();

    
        var epsdno = $(this).data('episodeno');
        var baseUrl = config.routes.ireporting.adr.reportsuspect;
    
        // Append parameters to the URL
        var reportUrl = baseUrl + '&epsdno=' + encodeURIComponent(epsdno);
    
        // // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();   
        $('#adverse-drug-report').modal('show');
    });
    //


    //Confirmed
    $('#tableSearchInput').on('keyup', function() {
        tableconfirm.search(this.value).draw();
    });

    $('#exportExcelBtn').on('click', function () {
        tableconfirm.button('.buttons-excel').trigger(); 
    });

    $('#filterdateconfirm').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        tableconfirm.ajax.reload(); 
    });

    $('#reportadrconfirm-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();

    
        var epsdno = $(this).data('episodeno');
        var baseUrl = config.routes.ireporting.adr.reportconfirm;
    
        // console.log(epsdno);

        // Append parameters to the URL
        var reportUrl = baseUrl + '&epsdno=' + encodeURIComponent(epsdno);
    
        // // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();   
        $('#adverse-drug-report').modal('show');
    });
    //

    //False
    $('#searchfalse').on('keyup', function() {
        tablefalse.search(this.value).draw();
    });

    $('#exportfalse').on('click', function () {
        tablefalse.button('.buttons-excel').trigger(); 
    });

    $('#filterdatefalse').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        tablefalse.ajax.reload(); 
    });
    //

});