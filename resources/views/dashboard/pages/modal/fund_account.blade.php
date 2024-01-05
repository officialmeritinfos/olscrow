<!-- Modal -->
<div class="modal fade" id="fund_main_balance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add money to your account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="fundMainBalance" action="{{route('user.account.fund')}}"
                      method="post">
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                        required/>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck"
                            required>
                            <label class="form-check-label" for="gridCheck">
                                I confirm that i have read {{$siteName}} terms & conditions about
                                account funding, and agree to them.
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="default-btn submit rounded-pill">Fund Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentDetails" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Bank Transfer
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="paymentD">
                    <div class="col-12">
                        <p> Once your payment is received, your account will be credited.</p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Bank</label>
                        <input type="text" class="form-control bank" id="inputEmail4"
                               readonly/>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">
                            Account Number
                            <i class="ri-clipboard-fill copy" style="font-size: 15px;"
                               data-clipboard-target="#accNumber"></i>
                        </label>
                        <input type="text" class="form-control accNumber" id="accNumber"
                               readonly/>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">
                            Amount
                            <i class="ri-clipboard-fill copy" style="font-size: 15px;"
                               data-clipboard-target="#amount"></i>
                        </label>
                        <input type="text" class="form-control amount" id="amount"
                        readonly/>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">
                            Narration
                            <i class="ri-clipboard-fill copy" style="font-size: 15px;"
                               data-clipboard-target="#narration"></i>
                        </label>
                        <input type="text" class="form-control ref" id="narration"
                               readonly/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="convert_main_balance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Convert To an account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="convertMainBalance" action="{{route('user.account.convert')}}"
                      method="post">
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-md-12 col-12 mt-2">
                        <div class="form-group">
                            <label>Account</label>
                            <select class="form-control" name="account">
                                <option value="">Select account Type</option>
                                <option value="2">Penalty Balance</option>
                                <option value="1">Subscription Balance</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck"
                                   required>
                            <label class="form-check-label" for="gridCheck">
                               I acknowledge that funds converted are non-refundable.
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="default-btn submit rounded-pill">Convert Funds</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="convert_referral_balance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Convert To an account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="convertReferralBalance" action="{{route('user.account.convert.referral')}}"
                      method="post">
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck"
                                   required>
                            <label class="form-check-label" for="gridCheck">
                                I acknowledge that funds converted are non-refundable.
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="default-btn submit rounded-pill">Convert Funds</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="withdraw_main_balance" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Withdraw Funds
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="withdrawMainBalance" action="{{route('user.account.withdraw')}}"
                      method="post">
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">OTP</label>
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" placeholder="Enter OTP"
                                   aria-label="Recipient's username" aria-describedby="basic-addon2" name="otp">
                            <button type="button" class="input-group-text sendOtp" id="basic-addon2" data-bs-otp="{{route('user.send.otp')}}">Send OTP</button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Payout Account</label>
                        <select name="bank" class="form-control selectize" id="inputEmail4"
                               required>
                            @foreach($banks as $bank)
                                <option value="{{$bank->reference}}">{{$bank->bankName}} - ({{$bank->accountNumber}} - {{$bank->accountName}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>


                    <div class="col-12 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck"
                                   required>
                            <label class="form-check-label" for="gridCheck">
                                I accept the terms of withdrawal as in the Terms & Conditions page.
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="default-btn submit rounded-pill">Withdraw</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
