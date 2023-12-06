<!-- Modal -->
<div class="modal fade" id="initiateChat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Message {{$escort->displayName}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="createOrder" action="{{route('user.chat.initiateMessage')}}"
                      method="post">

                    <div class="col-md-12" style="display: none;">
                        <label for="inputEmail4" class="form-label">Message</label>
                        <input type="text" class="form-control" id="inputEmail4" name="receiver" value="{{$escort->id}}" />
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Message</label>
                        <textarea type="text" class="form-control summernote" id="inputEmail4" name="message" rows="5"
                                  placeholder="Write an attractive intro for your order"></textarea>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="default-btn submit rounded-pill">Start Chat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="reportProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="staticBackdropLabel">Report {{$escort->displayName}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="createOrder" action="{{route('user.chat.initiateMessage')}}"
                      method="post">

                    <div class="col-md-12 text-center text-danger">
                       <p>To report an Escort, please navigate to the particular transaction between both of you. We will take care of the rest.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
