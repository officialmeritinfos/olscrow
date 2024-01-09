@extends('home.base')
@section('content')

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2  : Hero Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_hero-section section-padding-120">
        <div class="container">
            <div class="row row--custom">
                <div class="col-lg-5 col-md-7 col-xs-8 col-10" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="300">
                    <div class="home-2_hero-image-block">
                        <div class="home-2_hero-image">
                            <img src="{{asset('home/image/home-2/hero-image.jpg')}}" alt="hero image" />
                            <div class="home-2_hero-image-shape">
                                <img src="{{asset('home/image/home-2/hero-image-shape.svg')}}" alt="hero shape" />
                            </div>
                            <div class="home-2_hero-image-man-1">
                                <img src="{{asset('home/image/home-2/hero-image-man-1.png')}}" alt="hero shape" />
                            </div>
                            <div class="home-2_hero-image-man-2">
                                <img src="{{asset('home/image/home-2/hero-image-man-2.png')}}" alt="hero shape" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-auto col-lg-7 col-md-10" data-aos-duration="1000" data-aos="fade-right" data-aos-delay="300">
                    <div class="home-2_hero-content">
                        <div class="home-2_hero-content-text">
                            <h1 class="hero-content__title heading-lg text-black">
                                Find the perfect Escort match in your city.
                            </h1>
                            <p>
                                Indulge in a world where every moment is curated for refinement. Our companionship transcends
                                the ordinary, offering you a unique blend of sophistication and genuine connections.
                                Elevate your social experience with {{$siteName}}, where every encounter is tailored to perfection.
                                Discover the art of companionship like never before
                            </p>
                        </div>
                        <div class="home-2_hero-button-group">
                            <a href="{{route('register')}}" class="btn-masco btn-primary-l02 btn-fill--up">
                                <span>Get Started</span></a>
                            <a href="{{route('home.howItWorks')}}" class="btn-masco btn-outline-l02 btn-fill--up">
                                <span>Learn more</span></a>
                        </div>
                        <div class="home-2_hero-content-button__bottom-text">
                <span
                ><img
                        src="{{asset('home/image/icons/icon-star-green.svg')}}"
                        alt="green-star"
                    />Rated 4.9/5 - from over 600 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2 : Feature Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_feature-section section-padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xxl-6 col-lg-7 col-md-9">
                    <div class="section-heading">
                        <h2 class="section-heading__title heading-md text-black">Contains modern features for better experience</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gutter-y-default">
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="700">
                    <div class="feature-card h-100">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/icons/h02-feature-1.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title ">Intuitive User Interface</h3>
                            <p>
                                Experience seamless navigation with our user-friendly interface. {{$siteName}}'s modern design
                                ensures that every feature is easily accessible, allowing you to navigate effortlessly
                                and make the most of your time on the platform.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="600">
                    <div class="feature-card h-100">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/icons/h02-feature-2.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title ">Advanced Matching Algorithms</h3>
                            <p>
                                Our platform utilizes cutting-edge algorithms to connect you with companions that align
                                perfectly with your preferences. Enjoy a personalized and refined selection process,
                                ensuring that every interaction is tailored to your unique tastes and desires.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="500">
                    <div class="feature-card h-100">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/icons/h02-feature-3.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title ">Enhanced Security Measures</h3>
                            <p>
                                Your safety is our priority. {{$siteName}} incorporates state-of-the-art security features to
                                provide a secure and discreet environment. Rest assured, your interactions and personal
                                information are handled with the utmost care, creating a trustworthy space for genuine
                                connections.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2  : Content Section 1
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_content-section-1 section-padding-120 ">
        <div class="container">
            <div class="row row--custom">
                <div class="col-xl-5 col-lg-6 col-auto" data-aos-duration="1000" data-aos="fade-right">
                    <div class="home-2_content-image-1 content-image--mobile-width">
                        <img src="{{asset('home/image/home-2/content-1.png')}}" alt="alternative text">
                    </div>
                </div>
                <div class="offset-xl-1 col-xl-6 col-lg-6 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">
                                Safe Space for the Perfect Escort
                            </h2>
                            <p>
                                In our commitment to providing a secure and respectful environment, {{$siteName}} ensures that
                                your experience is not only enjoyable but also safe. Our platform prioritizes your
                                well-being, creating a space where you can confidently explore companionship.
                            </p>
                        </div>
                        <div class="content-divider"></div>
                        <div class="content-list-block">
                            <ul class="content-list">
                                <li class="content-list-item">
                                    <img src="{{asset('home/image/icons/icon-check-black.svg')}}" alt="alternative text">
                                    Verified Profiles.
                                </li>
                                <li class="content-list-item">
                                    <img src="{{asset('home/image/icons/icon-check-black.svg')}}" alt="alternative text">
                                    Discreet Transactions.
                                </li>
                                <li class="content-list-item">
                                    <img src="{{asset('home/image/icons/icon-check-black.svg')}}" alt="alternative text">
                                    Community Guidelines and Support.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2  : Content Section 2
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_content-section-2 padding-bottom-150">
        <div class="container">
            <div class="row row--custom">
                <div class="col-xl-auto col-lg-5 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="home-2_content-image-2 content-image--mobile-width">
                        <img src="{{asset('home/image/home-2/content-image-2.png')}}" alt="alternative text">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-right">
                    <div class="content">
                        <div class="content-text-block">
                            <h2 class="content-title heading-md text-black">
                                Secured transaction, Secured Companionship
                            </h2>
                            <p>
                                At {{$siteName}}, we believe that a foundation of trust is essential for any meaningful companionship.
                                With our commitment to both secure transactions and secure companionship, we strive to
                                create an environment where your peace of mind is paramount.
                            </p>
                            <p>
                                Our cutting-edge encryption technology ensures that every transaction on our platform is
                                safeguarded against potential threats, providing you with a secure financial experience.
                                Beyond the transactions, we extend this commitment to the very essence of companionship,
                                emphasizing the importance of respect, consent, and genuine connections.
                            </p>
                            <p>
                                At the intersection of financial security and companionship, {{$siteName}} stands as a beacon
                                of reliability. Join us in redefining the narrative of secure transactions and secure
                                companionship – where every interaction is not just a moment, but a journey built on trust.
                            </p>
                        </div>
                        <div class="content-button-block">
                            <a href="{{route('register')}}" class="btn-masco btn-masco btn-secondary-l02 btn-fill--up"><span>Get Started</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2 : Content Section 3
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_content-section-3 padding-bottom-120 bg-primary-l2-faded">
        <div class="container">
            <div class="row row--custom">
                <div class="col-xxl-6 col-lg-8 col-md-11">
                    <div class="section-heading">
                        <h2 class="content-title heading-md text-black">
                            Sense of privacy, for the fun of it.
                        </h2>
                        <p>
                            Indulge in the thrill of discreet connections with {{$siteName}}. Our platform values your privacy
                            as much as the excitement of your experiences. Explore a world where every moment is wrapped
                            in a sense of confidentiality, adding an extra layer of enjoyment to your journey.
                        </p>
                    </div>
                </div>
                <div class=" col-lg-12" data-aos-duration="1000" data-aos="fade-up">
                    <div class="home-2_content-image-3 ">
                        <img src="{{asset('home/image/home-2/video-image.png')}}" alt="alternative text">
                        <a href="https://www.youtube.com/watch?v=zo9dJFo8H8g" data-fancybox class="btn-play absolute-center btn-play--120 text-primary-l02">
                            <i class="fa-solid fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="ticker-01_section">
        <div class="ticker-01_wrapper">
            <div class="ticker-01_content">
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
            </div>
            <div class="ticker-01_content">
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
            </div>
            <div class="ticker-01_content">
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
            </div>
            <div class="ticker-01_content">
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
                <div class="ticker-item">
                    <p>Where fun and relaxation meet</p>
                    <p>🔥</p>
                </div>
            </div>
        </div>


    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Home 2  : Integration Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="home-2_integration-section section-padding-120 ">
        <div class="container">
            <div class="row row--custom ">
                <div class="offset-xl-1 col-xl-5 col-lg-5 col-auto" data-aos-duration="1000" data-aos="fade-left">
                    <div class="home-2_integration-image content-image--mobile-width">
                        <img src="{{asset('home/image/home-2/faces.jpg')}}" alt="alternative text">
                    </div>
                </div>
                <div class=" col-xl-6 col-lg-7 col-md-10 col-auto" data-aos-duration="1000" data-aos="fade-right">
                    <div class="content">
                        <div class="content_text-block">
                            <h2 class="content_title heading-md text-black">
                                Beautiful and verified Escorts In your city
                            </h2>
                            <p>
                                Discover the allure of beautiful and verified escorts right in your city with {{$siteName}}.
                                Our platform brings you a curated selection of companions who not only captivate with their
                                beauty but also undergo a thorough verification process for your peace of mind. Take the
                                next step in enhancing your social experiences – connect with the perfect companion through
                                {{$siteName}} today.
                            </p>
                        </div>
                        <div class="home-2_integration-button">
                            <a href="{{route('register')}}" class="btn-masco   btn-secondary-l02 btn-fill--up">
                                <span>Register Now!</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
