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

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    Conatct : Feature Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="contact_feature-section section-padding">
        <div class="container">
            <div class="row justify-content-center gutter-y-default">
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="">
                    <div class="feature-card">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/contact-details/feature-icon-1.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title">Chat with us</h3>
                            <p>We're waiting to help you every Monday-Friday from 8 am to 9 pm EST easily through our livechat</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="">
                    <div class="feature-card">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/contact-details/feature-icon-2.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title">Give us a call/Whatsapp support</h3>
                            <p>Give us a ring at <span>({{$web->phone}})</span>. Every monday-friday from 8 am to 8 pm.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="">
                    <div class="feature-card">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/contact-details/feature-icon-3.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title">Email Us</h3>
                            <p>Drop us an email at <span>{{$web->email}}</span> and you'll receive a reply within 24 hours.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-left" data-aos-delay="">
                    <div class="feature-card">
                        <div class="feature-card__icon">
                            <img src="{{asset('home/image/contact-details/feature-icon-3.svg')}}" alt="image alt">
                        </div>
                        <div class="feature-card__body">
                            <h3 class="feature-card__title">Investors</h3>
                            <p>
                                Do you want to join the {{$siteName}} team and invest in us, shoot us a mail for our pitch deck at
                                <span>{{$web->investorMail}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
