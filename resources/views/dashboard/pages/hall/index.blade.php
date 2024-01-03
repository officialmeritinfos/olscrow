@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')
@push('css')
    <style>
        .fresh {
            background-color: #ffffff;
            color: #f90283;
            display: inline-block;
            border-radius: 50px 0 0 50px;
            padding: 15px 10px;
            position: absolute;
            top: 30px;
            right: 0;
        }

    </style>
@endpush
    <div class="product-area">
        <div class="container-fluid">

            <div class="row" style="margin-bottom: 5rem;">
                <div class="large-12 columns">
                    <div class="owl-carousel owl-theme">
                        @foreach($slideEscorts as $slideEscort)
                            <div class="item">
                                <div class="single-products">
                                    <div class="products-img">
                                        <img src="{{empty($slideEscort->photo)?'https://ui-avatars.com/api/?name='.$slideEscort->name.'&background=random&round=true':$slideEscort->photo}}" alt="Images">

                                        <div class="add-to-cart">
                                            <a href="{{route('user.escort.detail',['username'=>$slideEscort->username])}}" class="default-btn">
                                                View Detail
                                                <i class="ri-arrow-right-line"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="products-content d-flex justify-content-between">
                                        <div class="product-title flex-grow-0 text-start">
                                            <h3 class="fw-bolder">
                                                <a>
                                                    {{$slideEscort->displayName}}<small>
                                                        @if($slideEscort->isVerified==1)
                                                            <i class="ri-checkbox-circle-fill text-success" style="font-size: 1rem;"
                                                            data-bs-toggle="tooltip" title="Verified Profile"></i>
                                                        @endif
                                                    </small><sup>
                                                        @if (Cache::has('user-is-online-' . $slideEscort->id))
                                                            <span class="text-success">Online</span>
                                                        @else
                                                            <span class=" text-danger">Offline</span>
                                                        @endif
                                                    </sup>
                                                </a>
                                            </h3>
                                            <span class="price">
                                                {{$injected->getCityById($slideEscort->city)->name}}, {{$injected->getStateById($slideEscort->state)->name}},
                                                {{$injected->getCountryByCode($slideEscort->countryCode)->name}}
                                            </span>
                                        </div>

                                        <div class="flex-shrink-0 text-end">
                                            <span class="reviews">({{$injected->fetchEscortReviews($slideEscort->id)->count()}} Reviews)</span>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                            <span class="price">
                                                {!! \Illuminate\Support\Str::words($injected->fetchEscortProfile($slideEscort->id)->shortBio,20) !!}
                                            </span>
                                    </div>
                                </div>
                                <span class="fresh">Premium</span>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="product-area">
        <div class="container-fluid">
            <div class="col-12 mb-4">
                <h4 class="title">Fresh Escorts</h4>
            </div>
            <div class="row" style="margin-bottom: 5rem;">
               <div class="col-md-3">

                   @foreach($proEscorts as $proEscort)
                       <div class="item">
                           <div class="single-products">
                               <div class="products-img">
                                   <img src="{{empty($proEscort->photo)?'https://ui-avatars.com/api/?name='.$proEscort->name.'&background=random&round=true':$proEscort->photo}}" alt="Images">

                                   <div class="add-to-cart">
                                       <a href="{{route('user.escort.detail',['username'=>$proEscort->username])}}" class="default-btn">
                                           View Detail
                                           <i class="ri-arrow-right-line"></i>
                                       </a>
                                   </div>
                               </div>

                               <div class="products-content d-flex justify-content-between">
                                   <div class="product-title flex-grow-0 text-start">
                                       <h3 class="fw-bolder">
                                           <a>
                                               {{$proEscort->displayName}}<small>
                                                   @if($proEscort->isVerified==1)
                                                       <i class="ri-checkbox-circle-fill text-success" style="font-size: 1rem;"
                                                          data-bs-toggle="tooltip" title="Verified Profile"></i>
                                                   @endif
                                               </small><sup>
                                                   @if (Cache::has('user-is-online-' . $proEscort->id))
                                                       <span class="text-success">Online</span>
                                                   @else
                                                       <span class=" text-danger">Offline</span>
                                                   @endif
                                               </sup>
                                           </a>
                                       </h3>
                                       <span class="price">
                                                {{$injected->getCityById($proEscort->city)->name}}, {{$injected->getStateById($proEscort->state)->name}},
                                                {{$injected->getCountryByCode($proEscort->countryCode)->name}}
                                            </span>
                                   </div>

                                   <div class="flex-shrink-0 text-end">
                                       <span class="reviews">({{$injected->fetchEscortReviews($proEscort->id)->count()}} Reviews)</span>
                                   </div>
                               </div>
                               <div class="mt-4">
                                            <span class="price">
                                                {!! \Illuminate\Support\Str::words($injected->fetchEscortProfile($proEscort->id)->shortBio,20) !!}
                                            </span>
                               </div>
                           </div>
                       </div>
                   @endforeach
               </div>
            </div>

        </div>

    </div>

    <div class="product-area">
        <div class="container-fluid">
            <div class="col-12 mb-4">
                <h4 class="title">Our Escorts</h4>
            </div>
            <div class="row" style="margin-bottom: 5rem;">
                <div class="col-md-3">
                    @foreach($escorts as $escort)
                        <div class="item">
                            <div class="single-products">
                                <div class="products-img">
                                    <img src="{{empty($escort->photo)?'https://ui-avatars.com/api/?name='.$escort->name.'&background=random&round=true':$escort->photo}}" alt="Images">

                                    <div class="add-to-cart">
                                        <a href="{{route('user.escort.detail',['username'=>$escort->username])}}" class="default-btn">
                                            View Detail
                                            <i class="ri-arrow-right-line"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="products-content d-flex justify-content-between">
                                    <div class="product-title flex-grow-0 text-start">
                                        <h3 class="fw-bolder">
                                            <a>
                                                {{$escort->displayName}}<small>
                                                    @if($escort->isVerified==1)
                                                        <i class="ri-checkbox-circle-fill text-success" style="font-size: 1rem;"
                                                           data-bs-toggle="tooltip" title="Verified Profile"></i>
                                                    @endif
                                                </small><sup>
                                                    @if (Cache::has('user-is-online-' . $escort->id))
                                                        <span class="text-success">Online</span>
                                                    @else
                                                        <span class=" text-danger">Offline</span>
                                                    @endif
                                                </sup>
                                            </a>
                                        </h3>
                                        <span class="price">
                                                {{$injected->getCityById($escort->city)->name}}, {{$injected->getStateById($escort->state)->name}},
                                                {{$injected->getCountryByCode($escort->countryCode)->name}}
                                            </span>
                                    </div>

                                    <div class="flex-shrink-0 text-end">
                                        <span class="reviews">({{$injected->fetchEscortReviews($escort->id)->count()}} Reviews)</span>
                                    </div>
                                </div>
                                <div class="mt-4">
                                            <span class="price">
                                                {!! \Illuminate\Support\Str::words($injected->fetchEscortProfile($escort->id)->shortBio,20) !!}
                                            </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                var owl = $('.owl-carousel');
                owl.owlCarousel({
                    items: 4,
                    loop: true,
                    margin: 10,
                    autoplay: true,
                    autoplayTimeout: 1000,
                    autoplayHoverPause: true,
                    responsiveClass:true,
                    responsive:{
                        0:{
                            items:1,
                            nav:true
                        },
                        600:{
                            items:3,
                            nav:false,
                            loop:true
                        },
                        1000:{
                            items:4,
                            nav:false,
                            loop:true
                        }
                    }
                });
            })
        </script>
    @endpush

@endsection
