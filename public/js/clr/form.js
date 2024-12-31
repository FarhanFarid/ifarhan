$(document).ready(function () {

    $('.save-event1').on('click', async function() {
        var form = $('#clreventone');
        var formData = form.serializeArray(); 
        var url      = config.routes.clr.save.eventone;

        // console.log(formData);
        // console.log(url);

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            // beforeSend: function(){
            //     $("#loading-overlay").show();
            // },
            success: function(response) {

                if (response.status == 'success') {
                    Swal.fire({
                   title: "Success!",
                   text: "Successfully Saved!",
                   icon: "success",
                   buttonsStyling: false,
                   showConfirmButton: false,
                   timer: 3000
                   })

                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                    
               }else{
                   Swal.fire({
                       title: "Failed!",
                       text: "Please make sure password is correct ",
                       icon: "error",
                       buttonsStyling: false,
                       showConfirmButton: false,
                       timer: 3000
                   })
               }
                
            },
            error: function(xhr, status, error) {
                toastr.error('Error saving reaction: ' + error, {timeOut: 5000});
            }
        });
    });

    $('.save-event2').on('click', async function() {
        var form = $('#clreventone');
        var formData = form.serializeArray(); 
        var url      = config.routes.clr.save.eventtwo;

        // console.log(formData);
        // console.log(url);

        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            // beforeSend: function(){
            //     $("#loading-overlay").show();
            // },
            success: function(response) {

                if (response.status == 'success') {
                    Swal.fire({
                   title: "Success!",
                   text: "Successfully Saved!",
                   icon: "success",
                   buttonsStyling: false,
                   showConfirmButton: false,
                   timer: 3000
                   })

                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                    
               }else{
                   Swal.fire({
                       title: "Failed!",
                       text: "Please make sure password is correct ",
                       icon: "error",
                       buttonsStyling: false,
                       showConfirmButton: false,
                       timer: 3000
                   })
               }
                
            },
            error: function(xhr, status, error) {
                toastr.error('Error saving reaction: ' + error, {timeOut: 5000});
            }
        });
    });

});