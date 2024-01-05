
<!-- Modal -->
<div class="modal fade" id="addPayoutAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add Payout Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="addNGNPayoutMethod" action="{{route('user.payout.account.add')}}"
                      method="post">
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Bank</label>
                        <select name="bank" class="form-control" id="inputEmail4"
                               required >
                        </select>
                    </div>
                    <div class="col-md-12 mt-2" style="display: none;">
                        <label for="inputEmail4" class="form-label"></label>
                        <input value="{{route('user.get.banks')}}" class="bankLink">
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Account Number</label>
                        <input type="number" name="accountNumber" class="form-control" id="inputEmail4"
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
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="default-btn submit rounded-pill">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
