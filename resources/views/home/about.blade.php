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
                        We are a Luxury brand that care about your relaxation and comfort.
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
                            <img src="{{asset('home/image/about/video-image.png')}}" alt="alternative text">
                        </div>
                        <a href="https://www.youtube.com/watch?v=4ScOVrDCTf0" data-fancybox class="btn-play absolute-center btn-play">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Elevating Connections with {{$siteName}}</h2>
                            <p>
                                Founded in 2023, {{$siteName}} emerged with a distinct vision — to redefine the landscape of
                                companionship and provide a platform that transcends the conventional boundaries of social connections.
                            </p>
                            <p>
                                {{$siteName}} was born out of a realization that traditional approaches to companionship lacked
                                a nuanced touch, a void where authenticity and modernity could intersect. The founders,
                                passionate about creating meaningful connections, envisioned a space where individuals
                                could explore companionship in an environment guided by respect, discretion, and genuine
                                experiences.
                            </p>
                            <div class="content-divider"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~
  About : Fact Section
~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_fact-section  section-padding-120">
        <div class="container">
            <div class="row row--custom ">
                <div class="col-xxl-auto  col-lg-7 col-md-10 col-auto">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">Our Mission & The {{$siteName}} Experience</h2>
                            <p>
                                At {{$siteName}}, our mission is to foster an ecosystem where every interaction is an immersive
                                experience. We aim to break away from the stereotypes surrounding companionship platforms,
                                creating a haven for those seeking more than mere encounters – a place where connections
                                are nurtured, and moments become unforgettable.
                            </p>
                            <p>
                                Immerse yourself in a world where each interaction is meticulously curated. {{$siteName}} is
                                not just a platform; it's a journey designed for those who appreciate the art of companionship.
                                Each connection is a chapter in a story, carefully crafted to offer a truly unique experience.
                            </p>
                        </div>
                        <div class="content-button-block">
                            <a href="{{route('register')}}" class="btn-masco btn-primary rounded-pill btn-fill--up"><span>Get in touch</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-auto">
                    <div class="about_stats-wrapper">
                        <div class="col-6">
                            <div class="about_stats-single">
                                <h2 class="about_stats-single__count">{{$injected->totalActiveEscorts()}}</h2>
                                <span>Total Escorts</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about_stats-single">
                                <h2 class="about_stats-single__count">90%</h2>
                                <span>Active Engagement</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about_stats-single">
                                <h2 class="about_stats-single__count">{{$injected->completedBooking()}}</h2>
                                <span>Completed Booking</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="about_stats-single">
                                <h2 class="about_stats-single__count">72+</h2>
                                <span>Countries Supported</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~
   About : Feature Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="about_feature-section section-padding-120 bg-light-2">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-8 col-sm-10 col-xs-10">
                    <div class="section-heading">
                        <h2 class="section-heading__title heading-md text-black">Our core values that drive everything we do</h2>
                    </div>
                </div>
            </div>
            <div class="row feature-widget-7-row  ">
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-1.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Transparency and Authenticity</h4>
                            <p>
                                At {{$siteName}}, transparency is more than a buzzword; it's a commitment. We believe in
                                fostering authentic connections by being transparent in our processes, ensuring that
                                every interaction is grounded in honesty and openness.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-2.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Respect for Diversity</h4>
                            <p>
                                Our platform celebrates diversity in all its forms. We believe that everyone deserves to
                                find companionship that resonates with their individuality. {{$siteName}} is a space where
                                diversity is not just acknowledged but embraced.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-3.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Privacy as a Priority</h4>
                            <p>
                                Privacy isn't an afterthought; it's one of our core values. We prioritize the security of
                                your personal information, creating a space where you can explore companionship with the
                                confidence that your privacy is safeguarded.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-4.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Commitment to Safety</h4>
                            <p>
                                Safety is paramount at {{$siteName}}. We are dedicated to providing a secure environment for
                                all users, implementing stringent verification processes and community guidelines to ensure
                                that every interaction is safe and respectful.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-5.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Excellence in Quality</h4>
                            <p>
                                Quality is the bedrock of {{$siteName}}. From the selection of escorts to the features on our
                                platform, we strive for excellence. Our commitment to quality ensures that every aspect
                                of your experience with {{$siteName}} exceeds expectations.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-8 col-9">
                    <div class="feature-widget-7">
                        <div class="feature-widget-7__icon-wrapper">
                            <img src="{{asset('home/image/about/feature-icon-6.svg')}}" alt="feature icon">
                        </div>
                        <div class="feature-widget-7__body">
                            <h4 class="feature-widget-7__title">Innovation and Adaptability</h4>
                            <p>
                                {{$siteName}} thrives on innovation. We are committed to staying ahead of the curve, constantly
                                evolving and adapting to meet the changing needs of our community. Our platform is a dynamic
                                space that embraces innovation for the benefit of our users.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
