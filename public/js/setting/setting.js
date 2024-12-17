$(document).ready(function () {
	$.ajax({
        url: config.routes.setting.detail,
        type: 'GET',
        success: function(data) {
            var val = data.data;

            if(val.maintenance == 1)
            {
                $('input[name=maintenance]').filter("[value=1]").prop("checked",true);
            }
            else
            {
                $('input[name=maintenance]').filter("[value=1]").prop("checked",false);
            }
        }
    });

	$('.update-system').on('click', async function(){
        var form        = $(this).parent().parent().next().find('form');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.settings.update;

        var callback    = config.routes.page;

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            success: function(data) {
                if(data.status == 'success'){
                    Swal.fire({
                        title: "Success!",
                        text: "Successfully Updated Setting Details!",
                        icon: "success",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        window.location = callback;
                    });
                } else{
                    var errors = data;
                    $.each(errors, function(index, sm){
                        toastr.error(sm, {timeOut: 5000});
                    });
                }
            }
        });
    });
});