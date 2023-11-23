const escortVerificationRequest =function (){
    //add
    const submitForm=function (){
        //process the form submission
        $('#editOrder').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#editOrder').attr('action');
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:baseURL,
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#editOrder :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "uploading",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error ===true)
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.error(data.data.error);
                        //return to natural stage
                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#editOrder :input").prop("readonly", false);
                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.success(data.message);
                        //return to natural stage
                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            location.reload();
                        }, 3000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    //return to natural stage
                    setTimeout(function(){
                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#editOrder :input").prop("readonly", false);
                    }, 3000);
                }
            });
        });
    }
    return {
        init: function() {
            submitForm();
        }
    };
}();

jQuery(document).ready(function() {
    escortVerificationRequest.init();
});
