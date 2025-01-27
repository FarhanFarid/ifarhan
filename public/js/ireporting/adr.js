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
                if(row.adrlist.patientinfo != null){
                    return '<span>'+row.adrlist.patientinfo.patient.mrn+'</span>';
                }else{
                    return '<span>-</span>';
                }     
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                if(row.adrlist.patientinfo != null){
                    return '<span>'+row.adrlist.patientinfo.patient.name+'</span>';
                }else{
                    return '<span>-</span>';
                }     
            }
        },
        {
            "data": 'episodeno',
            "render": function (data, type, row)  {
                return '<span>'+row.adrlist.episodeno+'</span>';
            }
        },
        { 
            "data": 'onset', 
            "render": function (data, type, row)  {
                if(row.adrlist.onset_at == null){
                    return '<span>-</span>'; 
                }else { 
                    return '<span>'+moment(row.adrlist.onset_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'reportedby',
            "render": function (data, type, row)  {
                return '<span>-</span>';            }
        },
        {
            "data": 'reporteddate',
            "render": function (data, type, row)  {
                if(row.adrlist.reported_at == null){
                    return '<span>-</span>'; 
                }else { 
                    return '<span>'+moment(row.adrlist.reported_at).format('DD/MM/YYYY HH:mm')+'</span>'; 
                }
            }
        },
        {
            "data": 'suspecteddrug',
            "render": function (data, type, row) {
                return '<span>'+row.adrlist.drugname+'</span>';
            }
        },
        {
            "data": 'age',
            "render": function (data, type, row) {
                if (row.adrlist.reported_at == null) {
                    return '<span></span>';
                } else {
                    var stopDate = moment(row.adrlist.reported_at); // Parse the transfuse_stop_at date
                    var today = moment(); // Get today's date
                    var daysDifference = today.diff(stopDate, 'days'); // Calculate the difference in days
                    
                    return '<span>' + daysDifference + ' day(s)</span>';
                }
            }
        },
        { 
            "data": 'report',
            "render": function (data, type, row)  {
                var html = '';

                html += '<div class="row">';
                html += '<div class="col-md-4"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-episodeno="' + row.adrlist.episodeno + '" data-adrid="' + row.adrlist.adr_id + '"><i class="fa-regular fa-file-lines"></i></button></div>'; 
                html += '<div class="col-md-4"><button class="badge btn-sm badge-light-warning edit-report" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Report" data-episodeno="' + row.adrlist.episodeno + '" data-adrid="' + row.adrlist.adr_id + '"><i class="fa-solid fa-pen-to-square"></i></button></div>'; 
                html += '</div>'

                return html;
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
            "data": 'name',
            "render": function (data, type, row)  {
                if(row.patientinfo != null){
                    return '<span>'+row.patientinfo.patient.name+'</span>';
                }else{
                    return '<span>-</span>';
                }     
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
                return '<span>'+row.susdrugs.product+'</span>';
            }
        },
        { 
            "data": 'report',
            "render": function (data, type, row)  {
                return '<div class="col-md-3"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-episodeno="' + row.episodeno + '" data-adrid="' + row.adr_id + '"><i class="fa-regular fa-file-lines"></i></button></div>'; 
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
            "data": 'name',
            "render": function (data, type, row)  {
                if(row.patientinfo != null){
                    return '<span>'+row.patientinfo.patient.name+'</span>';
                }else{
                    return '<span>-</span>';
                }     
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
                return '<span>'+row.susdrugs.product+'</span>';
            }
        },
        { 
            "data": 'report',
            "render": function (data, type, row)  {
                return '<div class="col-md-3"><button class="badge btn-sm badge-light-primary gen-report" data-bs-toggle="tooltip" data-bs-placement="top" title="View Report" data-episodeno="' + row.episodeno + '" data-adrid="' + row.adr_id + '"><i class="fa-regular fa-file-lines"></i></button></div>'; 
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
        var adrid = $(this).data('adrid');
        var baseUrl = config.routes.ireporting.adr.reportsuspect;
    
        // Append parameters to the URL
        var reportUrl = baseUrl + '&epsdno=' + encodeURIComponent(epsdno) + '&adrid=' + encodeURIComponent(adrid);
    
        // // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();   
        $('#adverse-drug-report').modal('show');
    });

    $('#reportadr-table tbody').on('click', '.edit-report', function(e) {
        e.preventDefault();

        var episodeno = $(this).data('episodeno');
        var adrid = $(this).data('adrid');
        var url = config.routes.ireporting.adr.getpatientinfo;
        var urlform = config.routes.ireporting.adr.form;

        var urlObj = new URL(urlform);
        var searchParams = urlObj.searchParams;

        searchParams.set('epsdno', episodeno);
        searchParams.set('epid', '');
        searchParams.set('patid', '');
        searchParams.set('adrid', adrid);

        var updatedUrl = urlObj.origin + urlObj.pathname + '?' + searchParams.toString();

        console.log(updatedUrl);

        window.location.href = updatedUrl;

        // $.ajax({
        //     url: url,
        //     type: "POST",
        //     dataType: "json",
        //     data: { episodeno: episodeno },
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        //     },
        //     success: function(response) {
        //         if (response.status === 'success') {

        //             var urlObj = new URL(urlform);
        //             var searchParams = urlObj.searchParams;

        //             searchParams.set('epsdno', response.data.episodenumber);
        //             searchParams.set('epid', response.data.epid);
        //             searchParams.set('patid', response.data.patient.patid);

        //             var updatedUrl = urlObj.origin + urlObj.pathname + '?' + searchParams.toString();

        //             console.log(updatedUrl);

        //             window.location.href = updatedUrl;
        //         } 
        //     },
        //     error: function(xhr, status, error) {
        //         toastr.error('Error: ' + error, {timeOut: 5000});
        //     }
        // });
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
        var adrid = $(this).data('adrid');
        var baseUrl = config.routes.ireporting.adr.reportconfirm;
    
        // console.log(epsdno);

        // Append parameters to the URL
        var reportUrl = baseUrl + '&epsdno=' + encodeURIComponent(epsdno) + '&adrid=' + encodeURIComponent(adrid);
    
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
    $('#reportadrfalse-table tbody').on('click', '.gen-report', function(e) {
        e.preventDefault();

    
        var epsdno = $(this).data('episodeno');
        var adrid = $(this).data('adrid');
        var baseUrl = config.routes.ireporting.adr.reportconfirm;
    
        // console.log(epsdno);

        // Append parameters to the URL
        var reportUrl = baseUrl + '&epsdno=' + encodeURIComponent(epsdno) + '&adrid=' + encodeURIComponent(adrid);
    
        // // Load the report in the iframe
        $('#report-iframe').attr('src', reportUrl);
        $('.btn-maximize, .save-finalization').hide();
        $('.btn-maximize, .save-false').hide();   
        $('#adverse-drug-report').modal('show');
    });
    //

    $('.btn-print').on('click', function() {
        var iframe = document.getElementById('report-iframe');
        iframe.contentWindow.print();
    });
});