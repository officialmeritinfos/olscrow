@extends('home.base')
@section('content')
    @inject('injected','App\Traits\Custom')
    @push('css')
        <style>
            .accordion{
                margin: 40px 0;
            }
            .accordion .item {
                border: none;
                margin-bottom: 50px;
                background: none;
            }
            .t-p{
                padding: 40px 30px 0px 30px;
            }
            .accordion .item .item-header h2 button.btn.btn-link {
                background: #333435;
                color: white;
                border-radius: 0px;
                font-family: 'Poppins';
                font-size: 16px;
                font-weight: 400;
                line-height: 2.5;
                text-decoration: none;
            }
            .accordion .item .item-header {
                border-bottom: none;
                background: transparent;
                padding: 0px;
                margin: 2px;
            }

            .accordion .item .item-header h2 button {
                color: white;
                font-size: 20px;
                padding: 15px;
                display: block;
                width: 100%;
                text-align: left;
            }

            .accordion .item .item-header h2 i {
                float: right;
                font-size: 30px;
                color: #eca300;
                background-color: black;
                width: 60px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                border-radius: 5px;
            }

            button.btn.btn-link.collapsed i {
                transform: rotate(0deg);
            }

            button.btn.btn-link i {
                transform: rotate(180deg);
                transition: 0.5s;
            }

        </style>
    @endpush
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

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~
            Service Details main Section
        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="service-details_main-section section-padding-120">
        <div class="row justify-content-center ">
            <div class="col-lg-8">
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">Introduction</h3>
                    <p>
                        This table sets forth the various type of reports that can be made against an escort, and the
                        corresponding penalty. Note that we are at liberty to remove any or influence the prices as we deem fit.
                    </p>
                </div>
                <div class="container">
                    <div class="accordion" id="accordionExample">
                        @foreach($reports as $report)

                            <div class="item">
                                <div class="item-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne{{$report->id}}" aria-expanded="true" aria-controls="collapseOne">
                                            {{$report->title}}
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne{{$report->id}}" class="collapse" aria-labelledby="headingOne"
                                     data-parent="#accordionExample">
                                    <div class="t-p">
                                        <p>
                                            {{$report->content}}
                                        </p>
                                        @if($report->penalize==1)
                                            <p><b>PENALTY</b>: ${{$report->penalty}}</p>
                                        @else
                                            <p><b>PENALTY</b>: No Penalty</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
