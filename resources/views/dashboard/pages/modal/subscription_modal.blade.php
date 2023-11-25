<!-- Modal -->
<div class="modal fade" id="enroll_subscription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Enroll In Subscription
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 submit-property-form" id="enrollSubscription" action="{{route('user.subscription.enroll')}}"
                      method="post">
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="row ">
                                    <div class="col-lg-12 col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label>Package <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="package">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label>Annual Fee <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="annual">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label>Monthly Fee <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="month">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label for="paymentMethod">Payment method <span class="required">*</span></label>
                                            <select type="text" class="form-control selectize" name="paymentMethod" id="paymentMethod">
                                                <option value="">Select Option</option>
                                                <option value="1">Monthly</option>
                                                <option value="2">Annual</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-primary">
                                        <p id="balance"></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="order-details ml-15">
                                    <div class="cart-totals mb-0">

                                        <ul class="cart-total-list">
                                            <li>Amount <span id="amount"></span></li>
                                            <li>Duration <span id="duration"></span></li>
                                            <li><b>Payable Total</b> <span><b id="totalAmount"></b></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="default-btn submit rounded-pill">Enroll</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="cancel_subscription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Cancel Subscription
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 submit-property-form" id="cancelSubscription" action="{{route('user.subscription.cancel')}}"
                      method="post">
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row ">

                                    <div class="text-center text-primary">
                                        <p>
                                            You are about cancelling your subscription to this package. This package will
                                            run till the end of it's duration and will not renew thereafter.
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-outline-danger submit rounded-pill">Cancel Renewal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reactivate_subscription" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Reactivate Subscription
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3 submit-property-form" id="reactivateSubscription" action="{{route('user.subscription.reactivate')}}"
                      method="post">
                    <div class="checkout-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="row ">

                                    <div class="text-center text-primary">
                                        <p>
                                           You will not be charged for this action. Your subscription will renew at the end of its cycle.
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-outline-success submit rounded-pill">Reactivate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
