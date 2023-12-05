@extends('dashboard.layout.base')
@section('content')
    @inject('options','App\Traits\Custom')
    <div class="chat-content-area mt-20">
        <div class="container-fluid">

            <div class="messagePage">
                <div class="content-right">
                    <div class="chat-area">
                        <div class="chat-list-wrapper">
                            <div class="chat-list">
                                <div class="chat-list-header d-flex align-items-center">
                                    <div class="header-left d-flex align-items-center me-2">
                                        <div class="avatar me-2">
                                            <img src="{{asset('dashboard/images/avatar.png')}}" width="70" height="70" class="rounded-circle" id="receiverImage" alt="image">
                                            <span class="status-online"></span>
                                        </div>
                                        <h6 class="mb-0 font-weight-bold receiver"></h6>
                                    </div>
                                </div>

                                <div class="chat-container" data-simplebar>
                                    <div class="chat-content">

                                    </div>
                                </div>

                                <div class="chat-list-footer">
                                    <form class="d-flex align-items-center" method="post" id="sendMessage" action="{{route('user.chat.sendMessage')}}">
                                        @csrf

                                        <input type="text" class="form-control" id="message" name="message" placeholder="Type your message...">
                                        <input type="text" class="form-control" name="chatId" style="display: none;"/>

                                        <button type="submit" class="send-btn d-inline-block submit">Send <i class="bx bx-paper-plane"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script>

            function refreshChat(){
                var chatId = "{{$chat->reference}}";
                var url = "{{route('user.chat.content',['id'=>$chat->reference])}}";
                $('input[name="chatId"]').val(chatId);
                $.ajax({
                    url: url,
                    method: 'GET',
                })
                    .done(function(data) {
                        $('.defaultPage').hide();
                        $('.messagePage').show();


                        if (data.error === true) {
                            toastr.options = { "closeButton": true, "progressBar": true };
                            toastr.error(data.data.error);
                        } else if (data.error === 'ok') {
                            $('.receiver').html(data.data.receiver);
                            $('#receiverImage').attr('src', data.data.photo);
                            //console.log(data.data.data);
                            var messages = data.data.data;
                            // Container to hold grouped messages
                            var groupedMessages = {};

                            $.each(messages, function(index, message) {
                                var date = new Date(message.created_at);

                                var formattedDate = date.toISOString().split('T')[0];

                                if (!groupedMessages[formattedDate]) {
                                    groupedMessages[formattedDate] = [];
                                }

                                groupedMessages[formattedDate].push(message);
                            });

                            // Display messages with date headings
                            var htmlContent = '';
                            $.each(groupedMessages, function(date, messages) {
                                htmlContent += '<div class="badge badge-pill bg-light text-dark my-3">' + getDateHeading(date) + '</div>';

                                $.each(messages, function(index, message) {
                                    var messageClass = (message.sender != {{ Auth::id() }}) ? 'chat-left' : '';

                                    htmlContent += '<div class="chat ' + messageClass + '">';
                                    htmlContent += '<div class="chat-avatar"><a href="#" class="d-inline-block"><img src="'+message.photo+'" width="50" height="50" class="rounded-circle" alt="image"> </a></div>';
                                    htmlContent += '<div class="chat-body"><div class="chat-message" style="margin-bottom:2rem;"><p>'+ message.message+'</p><span class="time d-block">'+message.hour+'</span></div></div></div>';
                                });
                            });

                            $('.chat-content').html(htmlContent);

                        }

                        $(".chat-container").LoadingOverlay("hide");
                    })
                    .fail(function(xhr, status, error) {
                        toastr.options = { "closeButton": true, "progressBar": true };
                        toastr.error(error);
                    });
            }
            // Function to get date heading (e.g., yesterday, two days ago)
            function getDateHeading(date) {
                var today = new Date();
                var messageDate = new Date(date);

                if (isSameDay(today, messageDate)) {
                    return 'Today';
                } else if (isSameDay(today.setDate(today.getDate() - 1), messageDate)) {
                    return 'Yesterday';
                } else {
                    return formatDate(messageDate);
                }
            }

            // Function to check if two dates are the same day
            function isSameDay(date1, date2) {
                return date1 instanceof Date &&
                    date2 instanceof Date &&
                    date1.getDate() === date2.getDate() &&
                    date1.getMonth() === date2.getMonth() &&
                    date1.getFullYear() === date2.getFullYear();
            }

            // Function to format date as 'X days ago'
            function formatDate(date) {
                var options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString(undefined, options);
            }
            //call function on page load
            $(function (){
                refreshChat();
            });

            //call function every 10 seconds
            setInterval(refreshChat,5000)

            //send message
            $('#sendMessage').submit(function(e) {
                if ($('#message').val().trim() === '') {
                    // Prevent form submission
                    e.preventDefault();
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error('message is empty');
                }else {

                    e.preventDefault();
                    var baseURL = $('#sendMessage').attr('action');
                    var baseURLs = '';
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: baseURL,
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        beforeSend: function () {
                            $('.submit').attr('disabled', true);
                            $("#sendMessage :input").prop("readonly", true);
                            $(".submit").LoadingOverlay("show", {
                                text: "please wait ...",
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
                                    $("#sendMessage :input").prop("readonly", false);

                                }, 3000);
                            }
                            if (data.error === 'ok') {

                                $('#sendMessage')[0].reset();
                                toastr.options = {
                                    "closeButton": true,
                                    "progressBar": true
                                }
                                toastr.info(data.message);

                                $('.submit').attr('disabled', false);
                                $(".submit").LoadingOverlay("hide");
                                $("#sendMessage :input").prop("readonly", false);

                                var chatId = data.data.reference;
                                var url = data.data.link;
                                $('input[name="chatId"]').val(chatId);
                                $.ajax({
                                    url: url,
                                    method: 'GET',
                                    beforeSend: function() {
                                        $(".chat-container").LoadingOverlay("show", {
                                            size: "5", progress:true
                                        });
                                    }
                                })
                                    .done(function(data) {
                                        $('.defaultPage').hide();
                                        $('.messagePage').show();


                                        if (data.error === true) {
                                            toastr.options = { "closeButton": true, "progressBar": true };
                                            toastr.error(data.data.error);
                                        } else if (data.error === 'ok') {
                                            $('.receiver').html(data.data.receiver);
                                            $('#receiverImage').attr('src', data.data.photo);
                                            //console.log(data.data.data);
                                            var messages = data.data.data;
                                            // Container to hold grouped messages
                                            var groupedMessages = {};

                                            $.each(messages, function(index, message) {
                                                var date = new Date(message.created_at);

                                                var formattedDate = date.toISOString().split('T')[0];

                                                if (!groupedMessages[formattedDate]) {
                                                    groupedMessages[formattedDate] = [];
                                                }

                                                groupedMessages[formattedDate].push(message);
                                            });

                                            // Display messages with date headings
                                            var htmlContent = '';
                                            $.each(groupedMessages, function(date, messages) {
                                                htmlContent += '<div class="badge badge-pill bg-light text-dark my-3">' + getDateHeading(date) + '</div>';

                                                $.each(messages, function(index, message) {
                                                    var messageClass = (message.sender != {{ Auth::id() }}) ? 'chat-left' : '';

                                                    htmlContent += '<div class="chat ' + messageClass + '">';
                                                    htmlContent += '<div class="chat-avatar"><a href="#" class="d-inline-block"><img src="'+message.photo+'" width="50" height="50" class="rounded-circle" alt="image"> </a></div>';
                                                    htmlContent += '<div class="chat-body"><div class="chat-message" style="margin-bottom:2rem;"><p>'+ message.message+'</p><span class="time d-block">'+message.hour+'</span></div></div></div>';
                                                });
                                            });

                                            $('.chat-content').html(htmlContent);

                                        }

                                        $(".chat-container").LoadingOverlay("hide");
                                    })
                                    .fail(function(xhr, status, error) {
                                        toastr.options = { "closeButton": true, "progressBar": true };
                                        toastr.error(error);
                                    });


                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.error(errorThrown);
                            $("#sendMessage :input").prop("readonly", false);
                            $('.submit').attr('disabled', false);
                            $(".submit").LoadingOverlay("hide");
                        },
                    });

                }
            });
        </script>
    @endpush
@endsection
