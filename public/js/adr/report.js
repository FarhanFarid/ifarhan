$(document).ready(function () {

    $('.gen-report').on('click', function() {
        var url = config.routes.adr.report.generate;
        $('#report-iframe').attr('src', url); 
        $('#adverse-drug-report').modal('show');
    });

});