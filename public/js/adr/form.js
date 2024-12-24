$(document).ready(function () {
    // Initialize DataTables
    var tablesuspect = $('#suspecteddrug-table').DataTable({
        lengthMenu: [5, 10, 20, 50],
        dom: 'frtipl',
        scrollX: "300px",
    });

    var tableconco = $('#concodrug-table').DataTable({
        dom: 'rtil',
        scrollX: "300px",
    });

    $('input[type="radio"]').click(function() {
        if ($(this).data('wasChecked')) {
            $(this).prop('checked', false);
            $(this).data('wasChecked', false);
        } else {
            $('input[type="radio"]').data('wasChecked', false);
            $(this).data('wasChecked', true);
        }
    });

    $('input[name="outcome"]').change(function() {
        if ($(this).val() === 'fatal') {
            $('#fataldetails').show();
        } else {
            $('#fataldetails').hide();
            $('#fataldate').val('');
            $('#causeofdeath').val('');

        }
    });

    $('.add-drug').on('click', function() {

        $('#add-suspected-drug').modal('show');

    });

    let selectedRows = [];

    // $('#submitconcodrug').on('click', function () {
    //     var product = $('#product').val();
    //     var dose = $('#dose').val();
    //     var frequency = $('#frequency').val();
    //     var batchno = $('#batchno').val();
    //     var startdate = moment($('#startdate').val()).format('DD/MM/YYYY');
    //     var stopdate = $('#stopdate').val() ? moment($('#stopdate').val()).format('DD/MM/YYYY') : '' ;
    //     var indication = $('#indication').val();

    //     if (!product || !dose || !frequency || !batchno || !startdate ) {
    //         alert('Please fill in all fields before submitting.');
    //         return;
    //     }

    //     var newRow = `
    //         <tr>
    //             <td>${product}</td>
    //             <td>${dose} (${frequency})</td>
    //             <td>${batchno}</td>
    //             <td>${startdate}</td>
    //             <td>${stopdate}</td>
    //             <td>${indication}</td>
    //         </tr>
    //     `;
    

    //     tableconco.row.add($(newRow)).draw();

    //     $('#add-suspected-drug form')[0].reset();

    //     $('#add-suspected-drug').modal('hide');
    // });

    function syncSelectedRows() {
        selectedRows = []; // Clear the array
        $('#concodrug-table tbody tr').each(function () {
            const row = $(this);
            if (row.find('input[type="checkbox"]').is(':checked')) {
                const rowData = {
                    productName: row.find('td:eq(1)').text().trim(),
                    doseFrequency: row.find('td:eq(2)').text().trim(),
                    malBatchNo: row.find('td:eq(3)').text().trim(),
                    therapyStart: row.find('td:eq(4)').text().trim(),
                    therapyStop: row.find('td:eq(5)').text().trim(),
                    indication: row.find('td:eq(6)').text().trim()
                };
                selectedRows.push(rowData);
            }
        });
    }

    $('#suspecteddrug-table tbody').on('click', '.remove-row', function () {
        var row = $(this).closest('tr'); 
        var rowData = tablesuspect.row(row).data(); 
        
        tablesuspect.row(row).remove().draw();
        
        tableconco.rows((idx, data, node) => {
            return isRowMatching(data, rowData);
        }).remove().draw();
    });

    $('#concodrug-table').on('change', 'input[type="checkbox"]', function() {
        const row = $(this).closest('tr');
        const rowData = {
            productName: row.find('td:eq(1)').text().trim(),
            doseFrequency: row.find('td:eq(2)').text().trim(),
            malBatchNo: row.find('td:eq(3)').text().trim(),
            therapyStart: row.find('td:eq(4)').text().trim(),
            therapyStop: row.find('td:eq(5)').text().trim(),
            indication: row.find('td:eq(6)').text().trim()
        };
    
        if ($(this).is(':checked')) {
            if (!selectedRows.some(r => JSON.stringify(r) === JSON.stringify(rowData))) {
                selectedRows.push(rowData);
            }
        } else {
            selectedRows = selectedRows.filter(r => JSON.stringify(r) !== JSON.stringify(rowData));
        }
    });
    
    $('.save-adr').on('click', async function() {
        var form     = $(this).parent().parent().find('form#adrform');
        var formData = form.serializeArray(); 
        var url      = config.routes.adr.report.save;

    
        var concomitantDrugs = selectedRows;
    
        formData.concomitantDrugs = concomitantDrugs;

        var data  = {
            formData: formData,
            concomitantDrugs: concomitantDrugs
        };
    
        console.log(data);
    
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            // beforeSend: function(){
            //     $("#loading-overlay").show();
            // },
            success: function(data) {

                Swal.fire({
                    title: "Success!",
                    text: "Successfully Saved!",
                    icon: "success",
                    buttonsStyling: false,
                    showConfirmButton: false,
                    timer: 3000
                });
                
                setTimeout(function() {
                    location.reload();
                }, 3000);
                
            },
            error: function(xhr, status, error) {
                toastr.error('Error saving reaction: ' + error, {timeOut: 5000});
            }
        });
    });
    
    $('#concodrug-table').on('draw.dt', function() {
        $('#concodrug-table tbody tr').each(function() {
            const row = $(this);
            const rowData = {
                productName: row.find('td:eq(1)').text().trim(),
                doseFrequency: row.find('td:eq(2)').text().trim(),
                malBatchNo: row.find('td:eq(3)').text().trim(),
                therapyStart: row.find('td:eq(4)').text().trim(),
                therapyStop: row.find('td:eq(5)').text().trim(),
                indication: row.find('td:eq(6)').text().trim()
            };
    
            if (selectedRows.some(r => JSON.stringify(r) === JSON.stringify(rowData))) {
                row.find('input[type="checkbox"]').prop('checked', true);
            }
        });
    });
    
    var concodrugs = window.concoDrugs || [];

    $('#concodrug-table').on('draw.dt', function () {
        $('#concodrug-table tbody tr').each(function () {
            const row = $(this);
            const rowData = {
                productName: row.find('td:eq(1)').text().trim(),
                doseFrequency: row.find('td:eq(2)').text().trim(),
                malBatchNo: row.find('td:eq(3)').text().trim(),
                therapyStart: row.find('td:eq(4)').text().trim(),
                therapyStop: row.find('td:eq(5)').text().trim(),
                indication: row.find('td:eq(6)').text().trim()
            };
    
            if (concodrugs.some(drug => 
                drug.product === rowData.productName &&
                drug.dose === rowData.doseFrequency &&
                drug.batchno === rowData.malBatchNo
            )) {
                row.find('input[type="checkbox"]').prop('checked', true);
            }
        });
    
        syncSelectedRows();
    });
    
    $('#concodrug-table').trigger('draw.dt');
    

});