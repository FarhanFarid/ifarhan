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

    $('#submitsusdrug').on('click', function () {
        var product = $('#product').val();
        var dose = $('#dose').val();
        var frequency = $('#frequency').val();
        var batchno = $('#batchno').val();
        var startdate = moment($('#startdate').val()).format('DD/MM/YYYY');
        var stopdate = $('#stopdate').val() ? moment($('#stopdate').val()).format('DD/MM/YYYY') : '' ;
        var indication = $('#indication').val();

        if (!product || !dose || !frequency || !batchno || !startdate ) {
            alert('Please fill in all fields before submitting.');
            return;
        }

        var newRow = `
            <tr>
                <td style="min-width: 100px; text-align: center; vertical-align: middle;">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                        </div>
                        <div class="col-md-3 d-flex justify-content-center">
                            <button class="badge btn-sm badge-light-danger remove-row">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td>${product}</td>
                <td>${dose} (${frequency})</td>
                <td>${batchno}</td>
                <td>${startdate}</td>
                <td>${stopdate}</td>
                <td>${indication}</td>
            </tr>
        `;
    

        tablesuspect.row.add($(newRow)).draw();

        $('#add-suspected-drug form')[0].reset();

        $('#add-suspected-drug').modal('hide');
    });

    $('#suspecteddrug-table tbody').on('click', '.remove-row', function () {
        var row = $(this).closest('tr'); 
        var rowData = tablesuspect.row(row).data(); 
        
        tablesuspect.row(row).remove().draw();
        
        tableconco.rows((idx, data, node) => {
            return isRowMatching(data, rowData);
        }).remove().draw();
    });
    
    $('#suspecteddrug-table tbody').on('change', 'input[type="checkbox"]', function () {
        var row = $(this).closest('tr'); 
        var rowData = tablesuspect.row(row).data(); 
        
        if ($(this).is(':checked')) {
            tableconco.row.add([
                rowData[1], 
                rowData[2], 
                rowData[3], 
                rowData[4], 
                rowData[5], 
                rowData[6] 
            ]).draw();
        } else {
            
            tableconco.rows((idx, data, node) => {
                return isRowMatching(data, rowData); 
            }).remove().draw(); 
        }
    });
    
    function isRowMatching(data1, data2) {
        return (
            data1[0] === data2[1] && 
            data1[1] === data2[2] && 
            data1[2] === data2[3] && 
            data1[3] === data2[4] && 
            data1[4] === data2[5] && 
            data1[5] === data2[6]    
        );
    }
    


    $('.save-adr').on('click', async function() {
        var form     = $(this).parent().parent().find('form#adrform');
        var formData = form.serializeArray(); 
        var url      = config.routes.adr.report.save;

    
        var suspectedDrugs   = getTableData('#suspecteddrug-table');
        var concomitantDrugs = getTableData('#concodrug-table');
    
        formData.suspectedDrugs   = suspectedDrugs;
        formData.concomitantDrugs = concomitantDrugs;

        var data  = {
            formData: formData,
            suspectedDrugs: suspectedDrugs,
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
    

    function getTableData(tableSelector) {

        var tableData = [];

        if(tableSelector == "#suspecteddrug-table"){

            $(tableSelector).find('tbody tr').each(function() {
                var row = $(this);
                var rowData = {
                    productName: row.find('td:eq(1)').text().trim(),   
                    doseFrequency: row.find('td:eq(2)').text().trim(),   
                    malBatchNo: row.find('td:eq(3)').text().trim(),      
                    therapyStart: row.find('td:eq(4)').text().trim(),    
                    therapyStop: row.find('td:eq(5)').text().trim(),    
                    indication: row.find('td:eq(6)').text().trim(),     
                };
                tableData.push(rowData);
            });

        }else{

            $(tableSelector).find('tbody tr').each(function() {
                var row = $(this);
                var rowData = {
                    productName: row.find('td:eq(0)').text().trim(),    
                    doseFrequency: row.find('td:eq(1)').text().trim(),   
                    malBatchNo: row.find('td:eq(2)').text().trim(),      
                    therapyStart: row.find('td:eq(3)').text().trim(),    
                    therapyStop: row.find('td:eq(4)').text().trim(),     
                    indication: row.find('td:eq(5)').text().trim(),      
                };
                tableData.push(rowData);
            });

        }

        return tableData;
    }

    // Ensure concoDrugs is properly loaded
    var concoDrugs = window.concoDrugs || [];

    // Loop through each row in the Suspected Drug table
    $('#suspecteddrug-table tbody tr').each(function () {
        var row = $(this);
        
        // Extract the necessary row data (e.g., Product, Dose, Batch No., etc.)
        var rowData = {
            product: row.find('td:nth-child(2)').text().trim(),
            dose: row.find('td:nth-child(3)').text().trim(),
            batchno: row.find('td:nth-child(4)').text().trim(),
            start_date: row.find('td:nth-child(5)').text().trim(),
            stop_date: row.find('td:nth-child(6)').text().trim(),
            indication: row.find('td:nth-child(7)').text().trim()
        };

        console.log(rowData);

        // Check if this row's data matches any entry in the concoDrugs array
        var isMatch = false;
        concoDrugs.forEach(function(drug) {

            var drugData = {
                product: drug.product.trim(),
                dose: drug.dose.trim(),
                batchno: drug.batchno.trim(),
                start_date: drug.start_date ? moment(drug.start_date, 'YYYY-MM-DD').format('DD/MM/YYYY') : '',
                stop_date: drug.stop_date ? moment(drug.stop_date, 'YYYY-MM-DD').format('DD/MM/YYYY') : '',
                indication: drug.indication.trim()
            };

            if (
                drugData.product === rowData.product &&
                drugData.dose === rowData.dose &&
                drugData.batchno === rowData.batchno &&
                drugData.start_date === rowData.start_date &&
                drugData.stop_date === rowData.stop_date &&
                drugData.indication === rowData.indication
            ) {
                isMatch = true;
            }
        });

        // If a match is found, check the checkbox
        if (isMatch) {
            row.find('input[type="checkbox"]').prop('checked', true);
        }
    });
    

});