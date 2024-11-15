var tablesuspect = $('#reportibloodatr-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IBLOOD-ATR (Suspected)',
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
            "data": 'location',
            "render": function (data, type, row)  {
                if(row.location == null ){
                    return '<span></span>';

                }else{
                    return '<span>'+row.location+'</span>';
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
        },
        dataType: "json",
    },
});

var tableconfirm = $('#reportibloodatrconfirm-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IBLOOD-ATR (Confirm)',
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
                }else { 
                    return '<span>'+moment(row.transfuse_start_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        { 
            "data": 'location', 
            "render": function (data, type, row)  {
                if(row.location == null ){
                    return '<span></span>'; 
                }else { 
                    return '<span>'+row.location+'</span>'; 
                }
            }
        },
        {   
            "data": 'reportedby',
            "render": function (data, type, row)  {
                if(row.name == null){ 
                    return '<span></span>'; 
                }
                else { 
                    return '<span>'+row.name+'</span>'; 
                }
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
            "data": 'age', 
            "render": function (data, type, row) {
                if (row.transfuse_stop_at == null) { 
                    return '<span></span>'; 
                }else { 
                    var stopDate = moment(row.transfuse_stop_at); 
                    var today = moment(); 
                    var daysDifference = today.diff(stopDate, 'days');
                    return '<span>' + daysDifference + ' day(s)</span>'; 
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
        url: config.routes.ireporting.iblood.atr.worklistconfirm,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdateconfirm').val();
        },
        dataType: "json",
    },
});




var tablefalse = $('#reportibloodatrfalse-table').DataTable({
    lengthMenu: [5, 10, 20, 50],
    dom       : 'rtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IBLOOD-ATR (False Report)',
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
            "data": 'location',
            "render": function (data, type, row)  {
                if(row.location == null ){
                    return '<span></span>';

                }else{
                    return '<span>'+row.location+'</span>';
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
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.iblood.atr.worklistfalse,
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

    $('#reportibloodatr-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();
    
        var bagno = $(this).data('bagno');
        var epsdno = $(this).data('episodeno');
        var baseUrl = config.routes.ireporting.iblood.atr.report;
    
        // Append parameters to the URL
        var reportUrl = baseUrl + '&bagno=' + encodeURIComponent(bagno) + '&epsdno=' + encodeURIComponent(epsdno);
    
        // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();  
        $('#adverse-event-report').modal('show');
    });

    $('.btn-print').on('click', function() {
        var iframe = document.getElementById('report-iframe');
        iframe.contentWindow.print();
    });

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload(); 
    });
    //

    //Confirmed
    $('#tableSearchInput').on('keyup', function() {
        tableconfirm.search(this.value).draw();
    });

    $('#exportExcelBtn').on('click', function () {
        tableconfirm.button('.buttons-excel').trigger(); 
    });

    $('#reportibloodatrconfirm-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();
    
        var bagno = $(this).data('bagno');
        var epsdno = $(this).data('episodeno');
        var baseUrl = config.routes.ireporting.iblood.atr.reportconfirm;
    
        // Append parameters to the URL
        var reportUrl = baseUrl + '&bagno=' + encodeURIComponent(bagno) + '&epsdno=' + encodeURIComponent(epsdno);
    
        // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();   
        $('#adverse-event-report').modal('show');
    });

    $('#filterdateconfirm').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        tableconfirm.ajax.reload(); 
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