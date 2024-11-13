var table = $('#reportds-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'Bfrtipl',
    scrollX   : "300px",
    buttons: [
        {
            extend: 'excel',
            title: 'Report - Discharge Summary',
            className: 'btn-dark',
        },
    ],
    columns: [
        {
            "data": null,
            "render": function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            "data": 'mrn',
            "render": function (data, type, row)  {
                return '<span>'+row.mrn+'</span>';
            }
        },
        {
            "data": 'name',
            "render": function (data, type, row)  {
                return '<span>'+row.name+'</span>';
            }
        },
        {
            "data": 'episode',
            "render": function (data, type, row)  {
                return '<span>'+row.episode+'</span>';
            }
        },
        {
            "data": 'episodedate',
            "render": function (data, type, row)  {
                if(row.episodedate != null)
                    return '<span>'+moment(row.episodedate).format('DD/MM/YYYY')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'dischargedate',
            "render": function (data, type, row)  {
                if(row.dischargedate != null)
                    return '<span>'+moment(row.dischargedate).format('DD/MM/YYYY')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'reasonforadmission',
            "render": function (data, type, row)  {
                if(row.reasonforadmission != null)
                    return '<span>'+row.reasonforadmission+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'primarydiagnosis',
            "render": function (data, type, row)  {
                if(row.primarydiagnosis != null)
                    return '<span>'+row.primarydiagnosis+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'secondarydiagnosis',
            "render": function (data, type, row)  {
                if(row.secondarydiagnosis != null)
                    return '<span>'+row.secondarydiagnosis.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'previoussurgery',
            "render": function (data, type, row)  {
                if(row.previoussurgery != null)
                    return '<span>'+row.previoussurgery.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'relevantphysicalfinding',
            "render": function (data, type, row)  {
                if(row.relevantphysicalfinding != null)
                    return '<span>'+row.relevantphysicalfinding.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'principalprocedurefinding',
            "render": function (data, type, row)  {
                if(row.principalprocedurefinding != null)
                    return '<span>'+row.principalprocedurefinding.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'briefhospitalcourse',
            "render": function (data, type, row)  {
                if(row.briefhospitalcourse != null)
                {
                    if(row.briefhospitalcourse == 'Eventful' && row.briefhospitalcoursedesc != null)
                        return '<span>'+row.briefhospitalcourse+'<br />'+row.briefhospitalcoursedesc.replace(/\n/g,'<br/>')+'</span>';
                    else
                        return '<span>'+row.briefhospitalcourse+'</span>';
                }
                else
                    return '-';
            }
        },
        {
            "data": 'significantinpatientmed',
            "render": function (data, type, row)  {
                if(row.significantinpatientmed != null)
                    return '<span>'+row.significantinpatientmed.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'conditionpatientdis',
            "render": function (data, type, row)  {
                if(row.conditionpatientdis != null)
                    return '<span>'+row.conditionpatientdis.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'dischargemedication',
            "render": function (data, type, row)  {
                if(row.dischargemedication != null)
                    return '<span>'+row.dischargemedication.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'followupcareclinicvisit',
            "render": function (data, type, row)  {
                if(row.followupcareclinicvisit != null)
                    return '<span>'+row.followupcareclinicvisit.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'planmanagement',
            "render": function (data, type, row)  {
                if(row.planmanagement != null)
                    return '<span>'+row.planmanagement.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'referringdoctoraddress',
            "render": function (data, type, row)  {
                if(row.referringdoctoraddress != null)
                    return '<span>'+row.referringdoctoraddress.replace(/\n/g,'<br/>')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'finalby',
            "render": function (data, type, row)  {
                if(row.finalby != null)
                    return '<span>'+row.finalby+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'createdby',
            "render": function (data, type, row)  {
                if(row.createdby != null)
                    return '<span>'+row.createdby+', '+moment(row.createdat).format('DD/MM/YYYY hh:mm A')+'</span>';
                else
                    return '-';
            }
        },
        {
            "data": 'updatedby',
            "render": function (data, type, row)  {
                if(row.updatedby != null)
                    return '<span>'+row.updatedby+', '+moment(row.updatedat).format('DD/MM/YYYY hh:mm A')+'</span>';
                else
                    return '-';
            }
        },
    ],
    ajax: {
        method: 'get',
        url: config.routes.point.ds.data,
        dataSrc: "data",
        data: function (d) {
            d.dateRange = $('#filterdate').val();
        },
        dataType: "json",
    },
});

$(document).ready(function() {
    var currentDate = moment();

    $('#filterdate').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
    }).on('apply.daterangepicker', function(ev, picker) {
        table.ajax.reload(); 
    });
});