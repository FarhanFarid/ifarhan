$(document).ready(function () {
    // spirometry
    $('#navmiscellaneousspiro').on('click', function (e) {
        e.preventDefault();

        $('#report-mscspiro-table').DataTable().ajax.reload(null, false);
    });
    // spirometry

    // vomit
    $('#navmiscellaneousvomit').on('click', function (e) {
        e.preventDefault();

        $('#report-mscvomit-table').DataTable().ajax.reload(null, false);
    });
    // vomit

    // seizure
    $('#navmiscellaneousseizure').on('click', function (e) {
        e.preventDefault();

        $('#report-mscseizure-table').DataTable().ajax.reload(null, false);
    });
    // seizure

    // abdominal
    $('#navmiscellaneousabdominal').on('click', function (e) {
        e.preventDefault();

        $('#report-mscabdominal-table').DataTable().ajax.reload(null, false);
    });
    // abdominal

    // others
    $('#navmiscellaneousothers').on('click', function (e) {
        e.preventDefault();

        $('#report-mscothers-table').DataTable().ajax.reload(null, false);
    });
    // others

    // hypercyanotic spell
    $('#navmiscellaneoushyperspell').on('click', function (e) {
        e.preventDefault();

        $('#report-mschypercyanotic-table').DataTable().ajax.reload(null, false);
    });
    // hypercyanotic spell

    // apnoea
    $('#navmiscellaneousapnoea').on('click', function (e) {
        e.preventDefault();

        $('#report-mscapnoea-table').DataTable().ajax.reload(null, false);
    });
    // apnoea
});