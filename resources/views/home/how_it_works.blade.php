@extends('home.base')
@section('content')
    @inject('injected','App\Traits\Custom')
    <div class="inner_banner-section">
        <img class="inner_banner-background-image" src="{{asset('home/image/common/inner-bg.png')}}" alt="image alt">
        <div class="container">
            <div class="inner_banner-content-block">
                <h3 class="inner_banner-title">{{$pageName}}</h3>
                <ul class="banner__page-navigator">
                    <li>
                        <a href="{{route('home.index')}}">Home</a>
                    </li>
                    <li class="active">
                        <a href="#">
                            {{$pageName}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~
    About : Banner Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_banner-section">
        <div class="container">
            <div class="row justify-content-center row--custom">
                <div class="col-12">
                    <div class="row banner_image-row padding-top-100">
                        <div class="col-xs-4 col-7">
                            <div class="single-image-1">
                                <img src="{{asset('home/image/about/banner-image-1.png')}}" alt="alternative text">
                            </div>
                        </div>
                        <div class="col-xs-4 col-7">
                            <div class="single-image-2">
                                <img src="{{asset('home/image/about/banner-image-2.png')}}" alt="alternative text">
                            </div>
                        </div>
                        <div class="col-xs-4 col-7">
                            <div class="single-image-3">
                                <img src="{{asset('home/image/about/banner-image-3.png')}}" alt="alternative text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~
    ABout : Brand Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="brand-section">
        <div class="container">
            <div class="brands-wrapper-inner">
                <div class="brand-heading">
                    <h3 class="brand-heading__title heading-md">
                        {{$siteName}} is your safe Haven for relaxation and fun with escorts in your city.
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~
  About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/register.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Registration</h2>
                            <p>
                                Begin your journey on {{$siteName}} by creating an account. Provide basic information,
                                and choose whether you're a user seeking companionship or an escort looking to connect with clients.
                            </p>
                            <h2 class="content-title heading-md text-black">Account Type Selection</h2>
                            <p>
                                Tailor your experience by selecting your account type. Users can explore and connect with
                                escorts, while escorts can create profiles to showcase their services. This step ensures
                                a personalized journey right from the start.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
 About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/verification_page.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">KYC Verification</h2>
                            <p>
                                For enhanced security, both users and escorts undergo Know Your Customer (KYC) verification.
                                This step helps establish a trusted community, ensuring that everyone on {{$siteName}} is genuine
                                and committed to a safe and respectful environment.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/escort_public_profile.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Profile Update(For Escorts)</h2>
                            <p>
                                Escorts can now personalize their profiles. Showcase your personality, services, and
                                unique attributes. A well-crafted profile not only attracts potential clients but
                                also sets the stage for meaningful connections.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/location_setup.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Location Update(For Escorts)</h2>
                            <p>
                                Escorts can specify their location for more accurate connections. Whether you're available
                                in a specific city or willing to travel, setting up your location ensures that users can
                                find the perfect companion based on their preferences.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/escort_package.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Package Setup (For Escorts)</h2>
                            <p>
                                Customize your services by setting up packages. Define the duration, offerings, and rates
                                for your companionship. This step streamlines the booking process, making it easier for
                                users to find and book the perfect escort.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/escort_handle_booking.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Collecting Bookings</h2>
                            <p>
                                As an escort, receive and manage booking requests seamlessly through the platform. Users
                                can explore profiles, browse packages, and initiate bookings. Escorts have the flexibility
                                to accept or decline based on their availability and preferences.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ~~~~~~~~~~~~~~~~~~~~~
About : Content Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_content-section bg-light-2  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-6 col-lg-5 col-md-6 col-7">
                    <div class="about_content-image-block ">
                        <div class="about_content-image content-image--mobile-width">
                            <img src="{{asset('home/image/booking_detail.png')}}" alt="alternative text">
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Completing Bookings</h2>
                            <p>
                                Once a booking is confirmed, both users and escorts receive detailed information. Escorts
                                can prepare for the encounter, and users can anticipate a smooth and enjoyable experience.
                                {{$siteName}} ensures that every booking is a step toward a respectful and memorable connection.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
