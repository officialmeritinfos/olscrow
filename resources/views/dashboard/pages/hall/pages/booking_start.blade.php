@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')
    <div class="checkout-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="ui-kit-cards grid mb-24">
                        <h3 class="mb-4">Package: {{$package->title}}</h3>

                        <form class="row g-3" id="createOrder" action="{{route('user.booking.process')}}"
                              method="post">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Order Type</label>
                                <select class="form-control selectize" id="inputEmail4" name="orderType">
                                    <option value="">Select the Order Type</option>
                                    @if(!empty($package->amount)||$package->amount!=0)
                                        <option value="1">Short-time</option>
                                    @endif
                                    @if(!empty($package->overnight)||$package->overnight!=0)
                                        <option value="2">Overnight</option>
                                    @endif
                                    @if(!empty($package->weekend)||$package->weekend!=0)
                                        <option value="3">Weekend</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">
                                    Country<sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="Which country are you going to stay with the escort"></i>
                                </label>
                                <select class="form-control selectize" id="inputPassword4" name="country">
                                    <option value="">Select your country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->iso3}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">
                                    State/Region <sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="Which state will the escort travel to?"></i>
                                </label>
                                <input type="text" class="form-control" id="inputAddress" name="state">
                            </div>
                            <div class="col-md-4">
                                <label for="inputAddress" class="form-label">
                                    Address<sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="Where will you stay with the escort"></i>
                                </label>
                                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="location">
                            </div>
                            <div class="col-md-6" style="display: none;">
                                <label for="inputAddress" class="form-label">
                                    Package <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="inputAddress" name="package" value="{{$package->reference}}">
                            </div>
                            <div class="col-md-6" style="display: none;">
                                <label for="inputAddress" class="form-label">
                                    Escort <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" class="form-control" id="inputAddress" name="escort" value="{{$escort->id}}">
                            </div>


                            <div class="col-md-4">
                                <label for="inputCity" class="form-label">
                                    Date to Meet<sup class="text-danger">*</sup>
                                    <i class="ri-information-fill" data-bs-toggle="tooltip" title="When will you be meeting with the escort?"></i>
                                </label>
                                <input type="date" class="form-control" id="inputCity" name="dateToMeet">
                            </div>
                            <div class="col-md-12">
                                <label for="inputCity" class="form-label">
                                    Password<sup class="text-danger">*</sup>
                                </label>
                                <input type="password" class="form-control" id="inputCity" name="password">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" name="acceptedTerm" required>
                                    <label class="form-check-label" for="gridCheck">
                                        I agree to the {{$siteName}} terms of booking.
                                        <i class="ri-information-fill" data-bs-toggle="tooltip" title="If escort fails to meet you,
                                        the escort will be penalized and amount paid for TFare will be reimbursed from their subsequent booking."></i>
                                    </label>
                                </div>
                            </div>

                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="order-details ml-15">
                        <div class="cart-totals mb-0">
                            <h3>Order Summary</h3>

                            <ul class="cart-total-list">
                                @if(!empty($package->amount)||$package->amount!=0)
                                    <li>Short-time: <span>{{$package->currency}}{{number_format($package->amount,2)}}</span></li>
                                @endif
                                @if(!empty($package->overnight)||$package->overnight!=0)
                                    <li>Overnight: <span>{{$package->currency}}{{number_format($package->overnight,2)}}</span></li>
                                @endif
                                @if(!empty($package->weekend)||$package->weekend!=0)
                                    <li>Weekend: <span>{{$package->currency}}{{number_format($package->weekend,2)}}</span></li>
                                @endif
                                    <li><small class="text-primary">Your account balance is <strong>{{$user->mainCurrency}} {{number_format($user->accountBalance,2)}}</strong></small></li>
                                <li>
                                    <button type="submit" class="default-btn d-block submit">Charge and Place booking</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                </form>
            </div>

        </div>
    </div>

@push('js')
    <script src="{{asset('requests/dashboard/orders.js')}}"></script>
@endpush
@endsection
