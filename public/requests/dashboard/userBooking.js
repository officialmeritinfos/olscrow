const userBookingRequest =function (){
    //approve request for transport
    const approveRequestForTransport=function (){
        //process the form submission
        $('#approveEscortTransportRequest').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#approveEscortTransportRequest').attr('action');
            var baseURLs='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: baseURL,
                method: "POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#approveEscortTransportRequest :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "please wait ...",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error===true)
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
                            $("#approveEscortTransportRequest :input").prop("readonly", false);

                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.info(data.message);

                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#approveEscortTransportRequest :input").prop("readonly", false);



                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#approveEscortTransportRequest :input").prop("readonly", false);
                            window.location.replace(data.data.redirectTo)
                        }, 5000);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    $("#approveEscortTransportRequest :input").prop("readonly", false);
                    $('.submit').attr('disabled', false);
                    $(".submit").LoadingOverlay("hide");
                },
            });
        });
    }
    //reject request for transport
    const rejectRequestForTransport=function (){
        //process the form submission
        $('#rejectEscortTransportRequest').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#rejectEscortTransportRequest').attr('action');
            var baseURLs='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: baseURL,
                method: "POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#rejectEscortTransportRequest :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "please wait ...",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error===true)
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
                            $("#rejectEscortTransportRequest :input").prop("readonly", false);

                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.info(data.message);

                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#rejectEscortTransportRequest :input").prop("readonly", false);



                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#rejectEscortTransportRequest :input").prop("readonly", false);
                            window.location.replace(data.data.redirectTo)
                        }, 5000);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    $("#rejectEscortTransportRequest :input").prop("readonly", false);
                    $('.submit').attr('disabled', false);
                    $(".submit").LoadingOverlay("hide");
                },
            });
        });
    }

    //cancel booking
    const cancelBooking=function (){
        //process the form submission
        $('#userCancelBooking').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#userCancelBooking').attr('action');
            var baseURLs='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: baseURL,
                method: "POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#userCancelBooking :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "please wait ...",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error===true)
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
                            $("#userCancelBooking :input").prop("readonly", false);

                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.info(data.message);

                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#userCancelBooking :input").prop("readonly", false);



                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#userCancelBooking :input").prop("readonly", false);
                            window.location.replace(data.data.redirectTo)
                        }, 5000);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    $("#userCancelBooking :input").prop("readonly", false);
                    $('.submit').attr('disabled', false);
                    $(".submit").LoadingOverlay("hide");
                },
            });
        });
    }

    //mark booking delivered
    const markBookingDelivered=function (){
        //process the form submission
        $('#userDeliveredBooking').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#userDeliveredBooking').attr('action');
            var baseURLs='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: baseURL,
                method: "POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#userDeliveredBooking :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "completing, please wait ...",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error===true)
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
                            $("#userDeliveredBooking :input").prop("readonly", false);

                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.info(data.message);

                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#userDeliveredBooking :input").prop("readonly", false);



                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#userDeliveredBooking :input").prop("readonly", false);
                            window.location.replace(data.data.redirectTo)
                        }, 5000);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    $("#userDeliveredBooking :input").prop("readonly", false);
                    $('.submit').attr('disabled', false);
                    $(".submit").LoadingOverlay("hide");
                },
            });
        });
    }
    //user report booking
    const reportBooking=function (){
        //process the form submission
        $('#userReportedBooking').submit(function(e) {
            e.preventDefault();
            var baseURL = $('#userReportedBooking').attr('action');
            var baseURLs='';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: baseURL,
                method: "POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function(){
                    $('.submit').attr('disabled', true);
                    $("#userReportedBooking :input").prop("readonly", true);
                    $(".submit").LoadingOverlay("show",{
                        text        : "reporting, please wait ...",
                        size        : "20"
                    });
                },
                success:function(data)
                {
                    if(data.error===true)
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
                            $("#userReportedBooking :input").prop("readonly", false);

                        }, 3000);
                    }
                    if(data.error === 'ok')
                    {
                        toastr.options = {
                            "closeButton" : true,
                            "progressBar" : true
                        }
                        toastr.info(data.message);

                        $('.submit').attr('disabled', false);
                        $(".submit").LoadingOverlay("hide");
                        $("#userReportedBooking :input").prop("readonly", false);



                        setTimeout(function(){
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                            $("#userReportedBooking :input").prop("readonly", false);
                            window.location.replace(data.data.redirectTo)
                        }, 5000);
                    }
                },
                error:function (jqXHR, textStatus, errorThrown){
                    toastr.options = {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                    toastr.error(errorThrown);
                    $("#userReportedBooking :input").prop("readonly", false);
                    $('.submit').attr('disabled', false);
                    $(".submit").LoadingOverlay("hide");
                },
            });
        });
    }

    return {
        init: function() {
            approveRequestForTransport();
            rejectRequestForTransport();
            cancelBooking();
            markBookingDelivered();
            reportBooking();
        }
    };
}();

jQuery(document).ready(function() {
    userBookingRequest.init();
});
