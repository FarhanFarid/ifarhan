$(document).ready(function() {

    $('#nearmissbaothers').change(function() {
        if ($(this).is(':checked')) {
            $('#nearmissbaothersinput').show();
        } else {
            $('#nearmissbaothersinput').hide();
        }
    });

    $('#otherincidentsothers').change(function() {
        if ($(this).is(':checked')) {
            $('#otherincidentsothersinput').show();
        } else {
            $('#otherincidentsothersinput').hide();
        }
    });

    $('.form-check-input').change(function() {
        if ($('#discoveredpre').is(':checked') || $('#discoveredduring').is(':checked') || $('#discoveredpost').is(':checked')) {
            $('#discovereddetailsinput').show();
        } else {
            $('#discovereddetailsinput').hide();
        }
    });
   
});