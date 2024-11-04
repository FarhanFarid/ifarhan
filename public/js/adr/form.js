$(document).ready(function() {
    // Initially hide the fatal details section
    $('#fataldetails').hide();

    // Listen for changes on the outcome radio buttons
    $('input[name="outcome"]').change(function() {
        if ($(this).val() === 'fatal') {
            // Show the fatal details section when 'fatal' is selected
            $('#fataldetails').show();
        } else {
            // Hide the fatal details section if other options are selected
            $('#fataldetails').hide();
        }
    });
});