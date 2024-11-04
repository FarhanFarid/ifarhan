$(document).ready(function() {
    $("#password").keyup(function(event) {
        if (event.keyCode === 13) {
            $(".submitlogin").click();
        }
    });
    
	$('.submitlogin').on('click', async function(){

        var form        = $(this).parent().parent().parent().find('form');
        var formData    = await getAllInput(form);
        var data        = processSerialize(formData);
        var url         = config.routes.login;

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function(){
                $("#loading-overlay").show();
            },
            success: function(data) {
                $("#loading-overlay").hide();
                if(data.status == 'success')
                {
                    window.location.replace(config.routes.dashboard);
                }
                else
                {
                    Swal.fire({
                        title: "Failed!",
                        text: data.message,
                        icon: "error",
                        buttonsStyling: false,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            }
        });
    });
});