@extends('staff.layout.base')
@section('content')
    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24">
            <h4 class="mt-1">Website Information</h4><hr/>

            <form class="row g-3" id="generalSetting" action="{{route('staff.settings.general-settings.update')}}"
                  method="post">
                @csrf
                <div class="col-md-6 mt-3">
                    <label for="inputEmail4" class="form-label">
                        Name<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" class="form-control form-control-lg" id="inputEmail4" name="name"
                    value="{{$web->name}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Email<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="email" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$web->email}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Feedback Email<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="feedbackMail" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$web->feedbackMail}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Investor Email<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="investorMail" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$web->investorMail}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Phone<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="phone" class="form-control form-control-lg" id="inputPassword4"
                    value="{{$web->phone}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputAddress" class="form-label">
                        Address <sup class="text-danger">*</sup>
                    </label>
                    <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="address">{{$web->address}}</textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputAddress" class="form-label">
                        Description <sup class="text-danger">*</sup>
                    </label>
                    <textarea type="text" class="form-control form-control-lg summernote" id="inputAddress" name="description">{{$web->description}}</textarea>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Tagline<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="tagline" class="form-control form-control-lg" id="inputPassword4" value="{{$web->tagline}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Keywords<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="keywords" class="form-control form-control-lg" id="inputPassword4" value="{{$web->keywords}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Minimum Penalty Fee Balance<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="penaltyFee" class="form-control form-control-lg" id="inputPassword4" value="{{$web->penaltyFee}}">
                </div>

                <div class="col-md-4 mt-3">
                    <label for="inputEmail4" class="form-label">Email Verification<sup class="text-danger">*</sup></label>
                    <select name="emailVerification" class="form-control selectize" id="inputEmail4"
                            required>
                        <option value="">Select Status</option>
                        <option value="1" {{($web->emailVerification==1)?'selected':''}}>OFF</option>
                        <option value="2" {{($web->emailVerification!=1)?'selected':''}}>ON</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Base Currency<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="currency" class="form-control form-control-lg" id="inputPassword4" value="{{$web->currency}}">
                </div>

                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Code Expiration Time<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="codeExpire" class="form-control form-control-lg" id="inputPassword4" value="{{$web->codeExpire}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Fee for Featured Addon<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="featuredFee" class="form-control form-control-lg" id="inputPassword4" value="{{$web->featuredFee}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Referral bonus<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="refBonus" class="form-control form-control-lg" id="inputPassword4" value="{{$web->refBonus}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Affiliate Commission<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="affiliateCommission" class="form-control form-control-lg" id="inputPassword4" value="{{$web->affiliateCommission}}">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Booking Acceptance Time<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="bookingAcceptanceTime" class="form-control form-control-lg" id="inputPassword4" value="{{$web->bookingAcceptanceTime}}">
                </div>

                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                       Client Time To Approve<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="clientTimeToApproveBooking" class="form-control form-control-lg" id="inputPassword4" value="{{$web->clientTimeToApproveBooking}}">
                </div>

                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Time for Support To Intervene<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="supportInterveneTime" class="form-control form-control-lg" id="inputPassword4" value="{{$web->supportInterveneTime}}">
                </div>

                <div class="col-md-6 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Subscription Charge Number of Retry<sup class="text-danger">*</sup>
                    </label>
                    <input type="text" name="subscriptionChargeRetry" class="form-control form-control-lg" id="inputPassword4" value="{{$web->subscriptionChargeRetry}}">
                </div>

                <div class="col-md-12 mt-3">
                    <label for="inputPassword4" class="form-label">
                        Pin<sup class="text-danger">*</sup>
                    </label>
                    <input type="password" name="pin" class="form-control form-control-lg" id="inputPassword4" placeholder="Enter account pin to proceed"/>
                </div>

                <div class="col-12 text-center mt-5">
                    <button type="submit" class="default-btn submit rounded-pill">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>

    </div>



    @push('js')
        <script src="{{asset('requests/staff/general_settings.js')}}"></script>
    @endpush
@endsection
