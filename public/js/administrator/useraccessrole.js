var table = $('#adminuseraccessrole-table').DataTable({
    lengthMenu: [10, 20, 50, 100],
    dom       : 'frtipl',
    scrollX   : "300px",
    columnDefs: [
        {
            "targets": 0,
            "width": "15%"
        },
        {
            "targets": 1,
            "width": "30%"
        },
        {
            "targets": 2,
            "width": "30%"
        },
        {
            "targets": 3,
            "width": "15%"
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
            "data": 'tcusergroup',
            "render": function (data, type, row)  {
                return '<span>'+row.tcusergroup+'</span>';
            }
        },
        {
            "data": 'quipperolename',
            "render": function (data, type, row)  {
                return '<span>'+row.quipperolename+'</span>';
            }
        },
        {
            "data": null,
            "orderable": false,
            "render": function (data, type, row)  {
                var id              = row.id;
                var tcusergroup     = row.tcusergroup;
                var quipperolename  = row.quipperolename;
                var created         = row.createdby.name.toUpperCase()+'<br />'+moment(row.created_at).format('DD/MM/YYYY hh:mm A');
                if(row.updatedby != null)
                {
                    var updated = row.updatedby.name.toUpperCase()+'<br />'+moment(row.updated_at).format('DD/MM/YYYY hh:mm A');
                }
                else
                {
                    var updated = '-';
                }

                var html    = '';

                html += '<div class="row" style="text-align: center; display: block"><a href="#" class="btn btn-icon btn-warning btn-circle btn-md mr-2 edit-accessrole" data-id="'+id+'" data-tcusergroup="'+tcusergroup+'" data-quipperolename="'+quipperolename+'" title="Edit"><i class="las la-edit fs-2"></i></a>&nbsp;';

                html += '</div>';

                return html;
            }
        }
    ],

    ajax: {
        method : 'get',
        url: config.routes.accessrole.list,
        dataSrc:"data",
        dataType : "json"
    }
}).on('click', 'a.edit-accessrole', function(e) {
    e.preventDefault();

    var id              = $(this).data('id');
    var tcusergroup     = $(this).data('tcusergroup');
    var quipperolename  = $(this).data('quipperolename');

    $('#idedit').val(id);
    $('#tcusergroupedit').val(tcusergroup);
    $('#quipperolenameedit').val(quipperolename);

    $('#editaccessrole').modal('show');
});

$(document).ready(function () {
    $('.new-accessrole').on('click', function(e){
        $('#addaccessrole').modal('show');
    });

    $('#addaccessrole').on('hidden.bs.modal', function() {
        $('#addaccessrole form')[0].reset();
    });

    $('#editaccessrole').on('hidden.bs.modal', function() {
        $('#editaccessrole form')[0].reset();
    });

    $("#addaccessrole, #editaccessrole").modal({
        show: false,
        backdrop: 'static'
    });

    $('.save-accessrole').on('click', async function(){
        var form        = $(this).parent().parent().find('form');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.accessrole.store;

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            success: function(data) {
                if(data.status == 'success'){
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Added!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#addaccessrole').modal('hide');
                    $('#adminuseraccessrole-table').DataTable().ajax.reload();
                } else{
                    var errors = data;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed')
                        {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            }
        });
    });

    $('.update-accessrole').on('click', async function(){
        var form        = $(this).parent().parent().find('form');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.accessrole.update;

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            success: function(data) {
                if(data.status == 'success'){
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Updated!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    $('#editaccessrole').modal('hide');
                    $('#adminuseraccessrole-table').DataTable().ajax.reload();
                } else{
                    var errors = data;
                    $.each(errors, function(index, sm){
                        if(sm != 'failed')
                        {
                            toastr.error(sm, {timeOut: 5000});
                        }
                    });
                }
            }
        });
    });
});