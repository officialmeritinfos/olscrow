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
    FAQ  : FAQ Section
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="faq-section_main section-padding-120">
        <div class="container">
            <div class="row row--custom justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion-style-1" id="faq-1_faq">
                        @foreach($faqs as $faq)

                            <div class="accordion-item">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faq-{{$faq->id}}_faq-item" aria-expanded="false" aria-controls="faq-1_faq-item">
                                    Q. {{$faq->question}}
                                </button>
                                <div id="faq-{{$faq->id}}_faq-item" class="accordion-collapse collapse" data-bs-parent="#faq-1_faq">
                                    <div class="accordion-item__body">
                                        {{$faq->answer}}
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            </div>
            <div class="section-button">
                <a href="{{route('home.contact')}}" class="btn-masco btn-fill--up rounded-pill"><span>Still, have any questions? Contact us</span></a>
            </div>
        </div>
    </div>


@endsection
