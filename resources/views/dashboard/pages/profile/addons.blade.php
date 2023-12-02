@extends('dashboard.layout.base')
@section('content')

<div class="container-fluid">
    <div class="ui-kit-card mb-24">
        <div class="alert alert-primary" role="alert">
            We have made it possible for you to buy some of the Premium Features as an Add-on to your account. Note that
            this is not a subscription but a one time off. Meaning, you will need to manually purchase them again at their expiration.
            Select from below the Add-on to add to your account. Ensure you have completed your short KYC before proceeding. <b>Payments are non-refundable </b>
        </div>

    </div>
</div>

<div class="pricing-area">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-3">
                <div class="single-pricing-card">
                    <div class="pricing-bar">
                        <span>
                            Premium Account Featuring
                            @if($user->fetaured==1)
                                <sup class="text-success" title="Active on account"  data-bs-toggle="tooltip">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </sup>
                            @elseif($user->fetaured==4)
                                    <sup class="text-primary" title="Awaiting review"  data-bs-toggle="tooltip">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </sup>
                            @endif
                        </span>
                        <h2>{{$fiat->sign}}{{number_format($web->featuredFee*$fiat->rate,2)}} <sub>/ Per month</sub></h2>
                        <p>Let your profile be featured as a Top user, and get more clients</p>
                    </div>

                    <div class="price-list">
                        <ul>
                            <li>
                                <i class="ri-check-line"></i>
                                10x more clients
                            </li>
                            <li>
                                <i class="ri-check-line"></i>
                                Premium & Verified Badge
                            </li>

                            <li>
                                <i class="ri-check-line"></i>
                                Online 24/7 support
                            </li>
                        </ul>

                        <a data-bs-toggle="modal" href="#buyFeaturedPro" class="default-btn">
                            Buy Featured Addon
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="buyFeaturedPro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Buy Premium Featuring
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 submit-property-form" id="enrollSubscription" action="{{route('user.addon.featured.enroll')}}"
                      method="post">
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row ">
                                    <div class="col-lg-12 col-md-12" >
                                        <div class="form-group">
                                            <label>Interval <span class="required">*</span></label>
                                            <input type="number" class="form-control" name="interval">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="period">Period <span class="required">*</span></label>
                                            <select  class="form-control form-control-lg" name="period" id="period">
                                                <option value="">Select Option</option>
                                                <option value="1">Month</option>
                                                <option value="2">Year</option>
                                            </select>
                                        </div>
                                        <div class="text-primary" style="margin-top: -1rem;margin-bottom: 2rem;">
                                            <p id="balance">Your current subscription balance is {{$fiat->sign}}{{number_format($user->subscriptionBalance,2)}}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" >
                                        <div class="form-group">
                                            <label for="password">Password <span class="required">*</span></label>
                                            <input type="password" id="password" class="form-control" name="password">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="default-btn submit rounded-pill">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{asset('requests/dashboard/subscription.js')}}"></script>
@endpush
@endsection
