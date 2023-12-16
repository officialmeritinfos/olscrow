<!-- Modal -->
<div class="modal fade" id="approveEscortTransport" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Approve Escort Transport Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="approveEscortTransportRequest" action="{{route('user.booking.approve.transport')}}"
                      method="post">
                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Id</label>
                        <input type="number" name="booking" class="form-control" id="inputEmail4"
                               required value="{{$booking->id}}"/>
                    </div>
                    <div class="col-12 text-center">
                        <p>Your account balance will be debited for this purpose. Enter your password below to confirm this action</p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="success-btn submit rounded-pill">
                            Approve Transport Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="rejectEscortTransport" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Reject Escort Transport Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="rejectEscortTransportRequest" action="{{route('user.booking.reject.transport')}}"
                      method="post">
                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Id</label>
                        <input type="number" name="booking" class="form-control" id="inputEmail4"
                               required value="{{$booking->id}}"/>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Why do you reject the request?</label>
                        <textarea name="reason" class="form-control" id="inputEmail4"
                                  required></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="warning-btn submit rounded-pill">
                            Reject Transport Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="cancelBookingUser" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Cancel booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="userCancelBooking" action="{{route('user.booking.user.cancel')}}"
                      method="post">
                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Id</label>
                        <input type="number" name="booking" class="form-control" id="inputEmail4"
                               required value="{{$booking->id}}"/>
                    </div>
                    <div class="col-12 text-center">
                        <p>
                            Full amount paid for will be refunded.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Why are you cancelling this booking?</label>
                        <textarea name="reason" class="form-control" id="inputEmail4"
                                  required rows="4"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="danger-btn submit rounded-pill">
                            Cancel Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="userMarkDelivered" data-bs-backdrop="static"
     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Mark Booking as Delivered
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="userDeliveredBooking" action="{{route('user.booking.user.markDelivered')}}"
                      method="post">
                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Id</label>
                        <input type="number" name="booking" class="form-control" id="inputEmail4"
                               required value="{{$booking->id}}"/>
                    </div>
                    <div class="col-12 text-center">
                        <p>
                            We will mark this as completed and funds released to escort. This process is irreversible.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="success-btn submit rounded-pill">
                            Mark Delivered
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
