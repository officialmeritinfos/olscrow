<!-- Jquery Min JS -->
<script src="{{asset('dashboard/js/jquery.min.js')}}"></script>
<!-- Bootstrap Bundle Min JS -->
<script src="{{asset('dashboard/js/bootstrap.bundle.min.js')}}"></script>
<!-- Owl Carousel Min JS -->
<script src="{{asset('dashboard/js/owl.carousel.min.js')}}"></script>
<!-- Metismenu Min JS -->
<script src="{{asset('dashboard/js/metismenu.min.js')}}"></script>
<!-- Simplebar Min JS -->
<script src="{{asset('dashboard/js/simplebar.min.js')}}"></script>
<!-- mixitup Min JS -->
<script src="{{asset('dashboard/js/mixitup.min.js')}}"></script>
<!-- Dark Mode Switch Min JS -->
<script src="{{asset('dashboard/js/dark-mode-switch.min.js')}}"></script>
<!-- Apexcharts Min JS -->
<script src="{{asset('dashboard/js/apexcharts/apexcharts.min.js')}}"></script>
<!-- Charts Custom Min JS -->
<script src="{{asset('dashboard/js/charts-custom.js')}}"></script>
<!-- Form Validator Min JS -->
<script src="{{asset('dashboard/js/form-validator.min.js')}}"></script>
<!-- Contact JS -->
<script src="{{asset('dashboard/js/contact-form-script.js')}}"></script>
<!-- Ajaxchimp Min JS -->
<script src="{{asset('dashboard/js/ajaxchimp.min.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('dashboard/js/custom.js')}}"></script>
@stack('js')

@include('basicInclude')

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
{{--<script src="{{asset('dashboard/js/requests/enable-push.js')}}"></script>--}}
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->

<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyCPJZiIzFlPKdobzbs9d3DU_Xmw5Tb7Cys",
        authDomain: "oloscrow.firebaseapp.com",
        projectId: "oloscrow",
        storageBucket: "oloscrow.appspot.com",
        messagingSenderId: "610638936110",
        appId: "1:610638936110:web:5ef9b1cae3e4f96492c7bf"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function () {
            return messaging.getToken()
        }).then(function(token) {

            axios.post("{{ route('push.store') }}",{
                _method:"PATCH",
                token
            }).then(({data})=>{
                console.log(data)
            }).catch(({response:{data}})=>{
                console.error(data)
            })

        }).catch(function (err) {
            console.log(`Token Error :: ${err}`);
        });
    }

    initFirebaseMessagingRegistration();

    messaging.onMessage(function({data:{body,title}}){
        new Notification(title, {body});
    });
</script>
<script src="{{asset('dashboard/vendors/summernote/summernote-bs5.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
        });
    });
</script>
<script src="{{asset('dashboard/js/selectize.min.js')}}"></script>
<script>
    $('.selectize').selectize();
    $('.selectizeAdd').selectize({
        create:true,
        showAddOptionOnCreate:true,
        createOnBlur:true,
        highlight:true,
        hideSelected:true
    });
</script>

<script>
    $(document).ready(function(){
        $(".search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".searches tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<script>
    var clipboard = new ClipboardJS('.copy');
    clipboard.on('success', function(e) {
        toastr.options = { "closeButton": true, "progressBar": true };
        toastr.success('Successfully copied');
    });

</script>
