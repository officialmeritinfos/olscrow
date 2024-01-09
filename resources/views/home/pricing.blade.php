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
    Pricing 2  : Pricing Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="pricing-2_main_pricing-section section-padding-120">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-xxl-6 col-lg-7 col-md-9">
                    <div class="section-heading">
                        <h2 class="section-heading__title heading-md ">Our Pricing Package for Escorts</h2>
                        <div class="pricing-2_main-pricing-control-block">
                            <div class="pricing-control-3">
                                <span data-pricing-trigger="pricing-1" data-target="monthly">Per Month</span>
                                <span data-pricing-trigger="pricing-1" data-target="yearly" class="pricing-control-3__indicator indicator-white toggle"></span>
                                <span data-pricing-trigger="pricing-1" data-target="yearly">Per Year</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row--custom gutter-y-30 justify-content-center" data-plan-id="pricing-1" data-plan-active="monthly">
                @foreach($packages as $package)
                    <div class="col-lg-4 col-md-6" data-aos-duration="1000" data-aos="fade-up">
                        <div class="pricing-card active">
                            <div class="pricing-card__head">
                                <h3 class="pricing-card__plan">{{$package->name}}</h3>
                                <h3 class="pricing-card__price-block">
                                    $<span class="pricing-card__price dynamic-value" data-yearly="{{$package->annualAmount}}"
                                           data-monthly="{{$package->monthAmount}}">{{$package->monthAmount}}</span>/month</h3>
                                <p>
                                    {{$package->description}}
                                </p>
                            </div>
                            <div class="pricing-card__body">
                                <ul class="pricing-card__list">
                                    @if($package->hasFeatured==1)
                                        <li>Featured Profile</li>
                                    @else
                                        <li class="disabled">Featured Profile</li>

                                    @endif
                                        @if($package->hasFeatured==1)
                                            <li>
                                                Featured for {{$package->featuredDuration}}
                                            </li>
                                        @endif
                                    <li>Online 24/7 support</li>
                                    <li>Payment Security</li>
                                    <li>{{$package->fee}}% connection fee</li>
                                </ul>
                                <div class="pricing-card__button">
                                    <a href="{{route('register')}}" class="btn-masco rounded-pill w-100">Create profile now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>


@endsection
