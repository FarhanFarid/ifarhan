var tablebed = $('#bedmanagement-table').DataTable({
    lengthMenu: [15, 20, 30, 50],
    dom: 'rtipl',
    scrollX: "300px",
    
    ajax: {
        method: 'get',
        url: config.routes.bed.getWardList,
        dataType: "json",
        dataSrc: function(json) {
            let formattedData = [];

            if (json.status === "success") {
                Object.values(json.data).forEach(ward => {
                    if (ward.BedList && Object.keys(ward.BedList).length > 0) {
                        Object.values(ward.BedList).forEach(bed => {
                            let bedstatus = bed.bedstatus  + " (" + bed.bedstatuscmt + ")";
                            let bedtype = bed.bedtype1;
                            let downgrade = bed.beddowngrade === 'Y' ? 'Downgrade: Yes' : '';
                            let upgrade = bed.forceupgrade === 'Y' ? 'Forced Upgrade: Yes' : '';

                            let upgradeText = '-';
                            if (downgrade && upgrade) {
                                upgradeText = `${downgrade}<br>${upgrade}`;
                            } else if (downgrade) {
                                upgradeText = downgrade;
                            } else if (upgrade) {
                                upgradeText = upgrade;
                            }

                            if (!bed.bedstatus) {
                                if (bed.name) {
                                    bedstatus = 'Occupied';
                                } else {
                                    bedstatus = 'Unoccupied';
                                }
                            }

                            if (!bedtype) {
                                bedtype = 'General';
                            }

                            let tooltipContent = "-";
        
                            if (bed.BedRequestList && Object.keys(bed.BedRequestList).length > 0) {
                                // Take the first BedRequestList entry (assuming only one)
                                const bedRequest = Object.values(bed.BedRequestList)[0];
                                tooltipContent = 
                                    "Requested By: " + (bedRequest.bruser || '-') + "\n" +
                                    "Ward: " + (bedRequest.brward || '-') + "\n" +
                                    "Bed: " + (bedRequest.brbed || '-') + "\n" +
                                    "Status: " + (bedRequest.brstatus || '-') + "\n" +
                                    "Date: " + (bedRequest.brdate || '-') + "\n" +
                                    "Time: " + (bedRequest.brtime || '-');
                            }
                            
                            formattedData.push({
                                ward: ward.wardcode,
                                bed: bed.bedno || "-",
                                roomtype: bed.roomtype || "-",
                                room: bed.room || "-",
                                bedstatus: bedstatus,
                                bedtype: bedtype,
                                booked: bed.BedRequestList && Object.keys(bed.BedRequestList).length > 0 ? 
                                `<span data-bs-toggle="tooltip" data-bs-placement="top" title="${tooltipContent.replace(/\n/g, '&#10;')}">Yes</span>` 
                                : "-",
                                mrn: bed.mrn || "-",
                                upgrade: upgradeText,
                                episodeno: bed.episodeno ? '<button class="badge btn-sm badge-light-primary patient-details" style="border: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Open patient details" data-episodeno="' + bed.episodeno + '">' + bed.episodeno + '</button>' : "-"                            });
                        });
                    }

                    if (ward.NurseStation && Object.keys(ward.NurseStation).length > 0) {
                        Object.values(ward.NurseStation).forEach(nurse => {

                            let tooltipContent = "-";
        
                            if (nurse.BedRequestList && Object.keys(nurse.BedRequestList).length > 0) {
                                // Take the first BedRequestList entry (assuming only one)
                                const bedRequest = Object.values(nurse.BedRequestList)[0];
                                tooltipContent = 
                                    "Requested By: " + (bedRequest.bruser || '-') + "\n" +
                                    "Ward: " + (bedRequest.brward || '-') + "\n" +
                                    "Bed: " + (bedRequest.brbed || '-') + "\n" +
                                    "Status: " + (bedRequest.brstatus || '-') + "\n" +
                                    "Date: " + (bedRequest.brdate || '-') + "\n" +
                                    "Time: " + (bedRequest.brtime || '-');
                            }

                            formattedData.push({
                                ward: ward.wardcode,
                                bed: "-",
                                roomtype: "-",
                                room: "NurseStation",
                                bedstatus: "-",
                                bedtype: "NurseStation",
                                booked: nurse.BedRequestList && Object.keys(nurse.BedRequestList).length > 0 ? 
                                `<span data-bs-toggle="tooltip" data-bs-placement="top" title="${tooltipContent.replace(/\n/g, '&#10;')}">Yes</span>` 
                                : "-",
                                mrn: nurse.mrn || "-",
                                upgrade: nurse.forceupgrade === 'Y' ? 'Forced Upgrade: Yes' : (nurse.beddowngrade === 'Y' ? 'Downgrade: Yes' : '-'),
                                episodeno: nurse.episodeno
                                    ? '<button class="badge btn-sm badge-light-primary patient-details" style="border: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Open patient details" data-episodeno="' + nurse.episodeno + '">' + nurse.episodeno + '</button>'
                                    : "-"
                            });
                        });
                    }
                });
            }

            return formattedData;
        }
    },

    columns: [
        { data: "ward", className: "text-center" },
        { data: "bed", className: "text-center" },
        { data: "roomtype", className: "text-center" },
        { data: "room", className: "text-center" },
        { data: "bedstatus", className: "text-center" },
        { data: "bedtype", className: "text-center" },
        { data: "upgrade", className: "text-center" },
        { data: "booked", className: "text-center" },
        { data: "mrn", className: "text-center" },
        { data: "episodeno", className: "text-center" }
    ],

    createdRow: function(row, data) {
        if (data.ward === "PICU") {
            $(row).css("background-color", "#cce5ff"); 
        }
        if (data.ward === "A2ZONE1") {
            $(row).css("background-color", "#FFFAFA");  
        }
        if (data.ward === "A3ZONE1") {
            $(row).css("background-color", "#F0FFF0");  
        }
        if (data.ward === "A3ZONE2") {
            $(row).css("background-color", "#F0FFFF");  
        }
        if (data.ward === "A4ZONE1") {
            $(row).css("background-color", "#FDF5E6");  
        }
        if (data.ward === "A4ZONE2") {
            $(row).css("background-color", "#FFFAF0");  
        }
        if (data.ward === "ACCU") {
            $(row).css("background-color", "#DCDCDC");  
        }
        if (data.ward === "AHDU") {
            $(row).css("background-color", "#FFE4E1");  
        }
        if (data.ward === "AICU") {
            $(row).css("background-color", "#F8F8FF");  
        }
        if (data.ward === "B1ZONE2") {
            $(row).css("background-color", "#F0FFFF");  
        }
        if (data.ward === "B2ZONE1") {
            $(row).css("background-color", "#FFEBCD");  
        }
        if (data.ward === "B2ZONE2") {
            $(row).css("background-color", "#FFF8DC");  
        }
        if (data.ward === "B3ZONE1") {
            $(row).css("background-color", "#E0FFFF");  
        }
        if (data.ward === "B3ZONE2") {
            $(row).css("background-color", "#E6E6FA");  
        }
        if (data.ward === "B4ZONE1") {
            $(row).css("background-color", "#D8BFD8");  
        }
        if (data.ward === "B4ZONE2") {
            $(row).css("background-color", "#B0E0E6");  
        }
        if (data.ward === "B5ZONE1") {
            $(row).css("background-color", "#7FFFD4");  
        }
        if (data.ward === "B5ZONE2") {
            $(row).css("background-color", "#EE82EE");  
        }
        if (data.ward === "EMY") {
            $(row).css("background-color", "#FFEFD5");  
        }
        if (data.ward === "HDU") {
            $(row).css("background-color", "#FFA07A");  
        }
        if (data.ward === "HDUCD") {
            $(row).css("background-color", "#FFC0CB");  
        }
        if (data.ward === "PCICU") {
            $(row).css("background-color", "#FFFACD");  
        }
        if (data.ward === "PICU2") {
            $(row).css("background-color", "#F0E68C");  
        }
        if (data.ward === "WE") {
            $(row).css("background-color", "#ADFF2F");  
        }
    }
});

$(document).ready(function() {

    $('#searchbed').on('keyup', function() {
        tablebed.search(this.value).draw();
    });

    $('#ward').on('change', function() {
        let selectedWard = $(this).val();
        tablebed.column(0).search(selectedWard).draw();
    });

    $('#room').on('change', function() {
        let selectedRoom = $(this).val();
        tablebed.column(2).search(selectedRoom).draw();
    });

    $('#bedupgrade').on('change', function() {
        let selectedBed = $(this).val();
        tablebed.column(6).search(selectedBed).draw();
    });

    $('#status').on('change', function () {
        let selectedStat = $(this).val();
    
        if (selectedStat && selectedStat.length > 0) {
            let regex = selectedStat.map(status => `^${status}`).join('|');
            tablebed.column(4).search(regex, true, false).draw();
        } else {
            tablebed.column(4).search('').draw();
        }
    });

    $('#booked').on('change', function() {
        if (this.checked) {
            tablebed.column(7).search('^Yes$', true, false).draw();
        } else {
            tablebed.column(7).search('').draw();
        }
    });

    $('#bedtype').on('change', function () {
        let selectedtype = $(this).val(); 
    
        if (selectedtype && selectedtype.length > 0) {
            let regex = selectedtype.map(type => `^${type}$`).join('|');
            tablebed.column(5).search(regex, true, false).draw();
        } else {
            tablebed.column(5).search('').draw();
        }
    });

    $('#bedmanagement-table').on('click', '.patient-details', function() {

        var episodeno   = $(this).data('episodeno');
        var url         = config.routes.bed.getPatientInfo;

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            data: { epsdno: episodeno },
            // beforeSend: function(){
            //     $("#loading-overlay").show();
            // },
            success: function(data) {

                var payors = Object.values(data.data.payorList || {}) 
                .map(p => p.payorDesc)           
                .join(', ');                     

                $('#patient-name').text(data.data.pName || "-");
                $('#patient-mrn').text(data.data.prn || "-");
                $('#patient-epi').text(episodeno || "-");
                $('#patient-dob').text(data.data.pdob || "-");
                $('#patient-bloodtype').text(data.data.bgDesc || "-");
                $('#patient-epidate').text(data.data.epiDate || "-");
                $('#patient-age').text(data.data.ageY + " Years " + data.data.ageM + " Months " + data.data.ageD + " Days " || "-");
                $('#patient-sex').text(data.data.pgender || "-");
                $('#patient-weight').text(data.data.weight || "-");
                $('#patient-height').text(data.data.height || "-");
                $('#patient-bmi').text(data.data.bmi || "-");
                $('#patient-bsa').text(data.data.BSA || "-");
                $('#patient-payor').text( payors || "-");
                $('#patient-gltype').text(data.data.gltype || "-");
                $('#patient-epidoc').text(data.data.epiDoc || "-");
                $('#patient-epidept').text(data.data.epiDeptDesc || "-");
                $('#patient-name').text(data.data.pName || "-");
                $('#patient-name').text(data.data.pName || "-");
                $('#patient-name').text(data.data.pName || "-");

                $('#patient-details').modal('show');

            },
            error: function(xhr, status, error) {
                toastr.error('Error saving reaction: ' + error, {timeOut: 5000});
            }
        });
    });


});
