const galleryRequest =function (){
    //upload
    const submitForm=function (){
        //process the form submission
        $('#galleryUpload').submit(function(e) {

            // Get the number of selected files
            var numberOfFiles = $('[name="photos[]"]')[0].files.length;

            // Set your maximum allowed number of files
            var maxFilesAllowed = 5; // Change this according to your requirements

            // Check if the number of files exceeds the limit
            if (numberOfFiles > maxFilesAllowed) {

                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error('You can only upload a maximum of ' + maxFilesAllowed + ' photos.');
                e.preventDefault(); // Prevent form submission
            }else {
                e.preventDefault();
                var baseURL = $('#galleryUpload').attr('action');
                e.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: baseURL,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function () {
                        $('.submit').attr('disabled', true);
                        $("#galleryUpload :input").prop("readonly", true);
                        $(".submit").LoadingOverlay("show", {
                            text: "uploading",
                            size: "20"
                        });
                    },
                    success: function (data) {
                        if (data.error === true) {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.error(data.data.error);
                            //return to natural stage
                            setTimeout(function () {
                                $('.submit').attr('disabled', false);
                                $(".submit").LoadingOverlay("hide");
                                $("#galleryUpload :input").prop("readonly", false);
                            }, 3000);
                        }
                        if (data.error === 'ok') {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.success(data.message);
                            //return to natural stage
                            setTimeout(function () {
                                $('.submit').attr('disabled', false);
                                $(".submit").LoadingOverlay("hide");
                                location.reload();
                            }, 3000);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        }
                        toastr.error(errorThrown);
                        //return to natural stage
                        setTimeout(function () {
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#galleryUpload :input").prop("readonly", false);
                        }, 3000);
                    }
                });
            }
        });
    }

    return {
        init: function() {
            submitForm();
        }
    };
}();

jQuery(document).ready(function() {
    galleryRequest.init();
});
