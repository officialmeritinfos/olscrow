@extends('dashboard.layout.base')
@section('content')

    <div class="pricing-area mb-24">
        <div class="container-fluid">
            @if($user->isEnrolled!=1)
                <div class="ui-kit-card mb-24">
                    <div class="alert alert-danger" role="alert">
                        You are not enrolled in any plan. Please enroll in any of the plans below to make your profile
                        public. We will not show your profile until you're enrolled in a package
                    </div>

                </div>
            @endif
            <div class="row justify-content-center">

                @foreach($packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-pricing-card active">
                            <div class="pricing-bar">
                                <span>
                                    {{$package->name}}
                                    @if($user->package==$package->id)
                                        <sup class="text-success" title="current"  data-bs-toggle="tooltip">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </sup>
                                    @endif
                                </span>
                                <h2>{{$fiat->sign}}{{number_format($package->monthAmount*$fiat->rate,2)}} <sub>/ Per month</sub></h2>
                                <p>{{$package->description}}</p>
                            </div>

                            <div class="price-list">
                                <ul>
                                    <li>
                                        <i class="ri-check-line"></i>
                                        {{$package->fee}}% connection fee
                                    </li>
                                    <li>
                                        <i class="ri-check-line"></i>
                                        Payment Security
                                    </li>
                                    <li>
                                        @if($package->hasFeatured==1)
                                            <i class="ri-check-line"></i>
                                            Featured Profile
                                        @else
                                            <i class="ri-close-line"></i>
                                            Featured Profile
                                        @endif
                                    </li>
                                    @if($package->hasFeatured==1)
                                    <li>
                                        <i class="ri-check-line"></i>
                                        Featured for {{$package->featuredDuration}}
                                    </li>
                                    @endif
                                    <li>
                                        <i class="ri-check-line"></i>
                                        Online 24/7 support
                                    </li>
                                </ul>

                                @if($user->isEnrolled!=1)
                                    <button data-bs-toggle="modal" data-bs-target="#enroll_subscription"
                                            class="default-btn" data-value="{{$package->id}}"
                                            data-annual="{{$package->annualAmount*$fiat->rate}}" data-month="{{$package->monthAmount*$fiat->rate}}"
                                            data-currency="{{$fiat->code}}" data-sign="{{$fiat->sign}}">
                                        Choose Plan
                                    </button>
                                @elseif($user->isEnrolled==1 && $user->package!=$package->id)
                                    <button data-bs-toggle="modal" data-bs-target="#enroll_subscription"
                                            class="default-btn" data-value="{{$package->id}}"
                                            data-annual="{{$package->annualAmount*$fiat->rate}}" data-month="{{$package->monthAmount*$fiat->rate}}"
                                            data-currency="{{$fiat->code}}" data-sign="{{$fiat->sign}}">
                                        Choose Plan
                                    </button>
                                @elseif(($user->isEnrolled==1) && ($user->renewSubscription!=1))
                                    <div class="text-center">
                                        <button class="btn btn-block btn-outline-success rounded-pill"
                                                data-bs-toggle="modal" data-bs-target="#reactivate_subscription">
                                            Reactivate Plan
                                        </button>
                                    </div>
                                @else
                                    <button class="default-btn" data-bs-toggle="modal" data-bs-target="#cancel_subscription">
                                        Cancel Subscription
                                    </button>
                                @endif
                            </div>

                            @if($package->isRecommended==1)
                                <span class="recommended">Recommended</span>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    @push('js')
        @include('dashboard.pages.modal.subscription_modal')
        <script>
            var subBalance = parseFloat("{{$user->subscriptionBalance}}");
            $('#enroll_subscription').on('show.bs.modal', function(event){
                const button = event.relatedTarget;
                $('#enrollSubscription')[0].reset();

                var id = button.getAttribute('data-value');
                var annualPrice = button.getAttribute('data-annual');
                var monthPrice = button.getAttribute('data-month');
                var currSign = button.getAttribute('data-sign');

                $('input[name="package"]').val(id)
                $('input[name="annual"]').val(annualPrice)
                $('input[name="month"]').val(monthPrice);

                $('#balance').html('Current Subscription balance is '+currSign+''+subBalance);



                $('select[name="paymentMethod"]').on('change',function (){
                    var method = $('select[name="paymentMethod"]').val();
                    if(Number(method)===2){


                        $('#amount').html(currSign+''+annualPrice.toLocaleString());
                        $('#duration').html('12 Months');
                        $('#totalAmount').html(currSign+''+annualPrice.toLocaleString());

                    }else {

                        $('#amount').html(currSign+''+monthPrice.toLocaleString());
                        $('#duration').html('1 Month');
                        $('#totalAmount').html(currSign+''+monthPrice.toLocaleString());
                    }
                })

            });
        </script>
        <script src="{{asset('requests/dashboard/subscription.js')}}"></script>
    @endpush
@endsection
