$(document).ready(function () {
    // Initialize DataTables
    var tablesuspect = $('#suspecteddrug-table').DataTable({
        lengthMenu: [5, 10, 20, 50],
        dom: 'frtipl',
        scrollX: "300px",
    });

    var tableconco = $('#concodrug-table').DataTable({
        lengthMenu: [5, 10, 20, 50],
        dom: 'frtipl',
        scrollX: "300px",
    });

    // Event listener for checkboxes in Suspected Drug table
    $('#suspecteddrug-table tbody').on('change', 'input[type="checkbox"]', function () {
        var row = $(this).closest('tr'); // Get the parent row
        var rowData = tablesuspect.row(row).data(); // Get row data
        
        if ($(this).is(':checked')) {
            // Add the row to the Concomitant Drug table
            tableconco.row.add([
                rowData[1], // Product / Generic Name
                rowData[2], // Dose & Frequency Given
                rowData[3], // MAL and Batch No.
                rowData[4], // Therapy Dates Start
                rowData[5], // Therapy Dates Stop
                rowData[6]  // Indication
            ]).draw();
        } else {
            // Remove the row from the Concomitant Drug table
            tableconco.rows().every(function () {
                var data = this.data();
                if (data[0] === rowData[1] && data[1] === rowData[2]) {
                    this.remove();
                }
            });
            tableconco.draw();
        }
    });

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