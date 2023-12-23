@if($user->accountType==1)
    <!-- Modal -->
    <div class="modal fade" id="escortAcceptBooking" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Accept Booking
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3" id="acceptBookingOrder" action="{{route('user.booking.accept')}}"
                          method="post">
                        <div class="col-md-12" style="display: none;">
                            <label for="inputEmail4" class="form-label">Amount</label>
                            <input type="number" name="booking" class="form-control" id="inputEmail4"
                                   required value="{{$booking->id}}"/>
                        </div>
                        <div class="col-12 text-center">
                            <p>This action will activate this booking and you will be penalized if you fail to meet up.</p>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="default-btn submit rounded-pill">
                                Accept Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="requestForTransport" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Request for Transport Fee
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3" id="requestForTransportForBooking" action="{{route('user.booking.request.transport')}}"
                          method="post">
                        <div class="col-md-12" style="display: none;">
                            <label for="inputEmail4" class="form-label">Id</label>
                            <input type="number" name="booking" class="form-control" id="inputEmail4"
                                   required value="{{$booking->id}}"/>
                        </div>
                        <div class="col-12 text-center">
                            <p>If the client accepts your transport fare request, we will debit your account balance of same amount and place it
                                in your transport fare account pending completion of booking.</p>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" id="inputEmail4"
                                   required/>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="info-btn submit rounded-pill">
                                Request for Transport
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="escortMarkDelivered" data-bs-backdrop="static"
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
                    <form class="row g-3" id="escortDeliveredBooking" action="{{route('user.booking.escort.markDelivered')}}"
                          method="post">
                        <div class="col-md-12" style="display: none;">
                            <label for="inputEmail4" class="form-label">Id</label>
                            <input type="number" name="booking" class="form-control" id="inputEmail4"
                                   required value="{{$booking->id}}"/>
                        </div>
                        <div class="col-12 text-center">
                            <p>
                                We will place this as delivered pending confirmation from the client. If they fail to either
                                appeal or confirm within {{$web->clientTimeToApproveBooking}}, we will automatically approve this and release your money.
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

    <!-- Modal -->
    <div class="modal fade" id="cancelBookingEscort" data-bs-backdrop="static"
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
                    <form class="row g-3" id="escortCancelBooking" action="{{route('user.booking.escort.cancel')}}"
                          method="post">
                        <div class="col-md-12" style="display: none;">
                            <label for="inputEmail4" class="form-label">Id</label>
                            <input type="number" name="booking" class="form-control" id="inputEmail4"
                                   required value="{{$booking->id}}"/>
                        </div>
                        <div class="col-12 text-center">
                            <p>
                               Full amount paid for will be refunded the client.
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
    <div class="modal fade" id="appealReport" data-bs-backdrop="static"
         data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Appeal Report
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3" id="escortAppealReport" action="{{route('user.booking.escort.appeal.report')}}"
                          method="post">
                        <div class="col-md-12" style="display: none;">
                            <label for="inputEmail4" class="form-label">Id</label>
                            <input type="number" name="booking" class="form-control" id="inputEmail4"
                                   required value="{{$booking->id}}"/>
                        </div>
                        <div class="col-12 text-center">
                            <p>
                                You have been reported by your client. If you feel this report is wrong, please appeal the report below with proofs.
                                At the end of the countdown, if not appealed, support will intervene and when we do, without any appeal from you,
                                we will judge in favor of your client.
                            </p>
                        </div>

                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Appeal Detail<sup class="text-danger">*</sup></label>
                            <textarea name="appealDetail" class="form-control" id="inputEmail4" rows="4"></textarea>
                            <small>Please be as detailed as possible.</small>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputEmail4"
                                   required/>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="primary-btn submit rounded-pill">
                                Appeal Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endif
