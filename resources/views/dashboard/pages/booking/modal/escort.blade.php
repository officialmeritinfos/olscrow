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
                <form class="row g-3" id="fundMainBalance" action="{{route('user.account.fund')}}"
                      method="post">
                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Amount</label>
                        <input type="number" name="booking" class="form-control" id="inputEmail4"
                               required value="{{$booking->id}}"/>
                    </div>
                    <div class="col-12 text-center">
                        <p>This action will activate this booking and you could be penalized if you fail to meet up.</p>
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
