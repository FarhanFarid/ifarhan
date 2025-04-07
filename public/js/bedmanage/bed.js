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
                            formattedData.push({
                                ward: ward.wardcode,
                                bed: bed.bedno || "-",
                                roomtype: bed.roomtype || "-",
                                room: bed.room || "-",
                                bedstatus: bed.bedstatus || "-",
                                mrn: bed.mrn || "-",
                                patientName: bed.name || "-",
                                episodeno: bed.episodeno ? '<button class="badge btn-sm badge-light-primary patient-details" style="border: none;" data-bs-toggle="tooltip" data-bs-placement="top" title="Open patient details" data-episodeno="' + bed.episodeno + '">' + bed.episodeno + '</button>' : "-"                            });
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
        { data: "mrn", className: "text-center" },
        { data: "patientName", className: "text-center" },
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


});
