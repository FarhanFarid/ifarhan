
var currentDate = moment();
var table = $('#reportpreadmission-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - IDA (PRE-ADMISSION)',
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
            "width": "10%"
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
            "width": "20%"
        },
        {
            "targets": 8,
            "width": "10%"
        },
    ],
    columns: [
        
    ],
    ajax: {
        method: 'get',
        url: config.routes.ireporting.ida.preadmission.getdata,
        dataSrc: "data",
        dataType: "json",
    },
});