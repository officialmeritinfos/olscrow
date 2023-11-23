<!-- Modal -->
<div class="modal fade" id="create_order" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Create Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="createOrder" action="{{route('user.orders.create')}}"
                      method="post">
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Title</label>
                        <input type="text" class="form-control" id="inputEmail4" name="title">
                    </div>
                    <div class="col-md-12">
                        <label for="inputEmail4" class="form-label">Description</label>
                        <textarea type="text" class="form-control summernote" id="inputEmail4" name="description" rows="5"
                        placeholder="Write an attractive intro for your order"></textarea>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Services</label>
                        <select name="service[]" class="form-control selectize" id="inputEmail4"
                                required multiple>
                            <option value="">Select services</option>
                            @foreach($services as $service)
                                <option value="{{$service->id}}">{{$service->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Short-time Amount</label>
                        <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Overnight Amount</label>
                        <input type="number" name="overnight" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-md-12 mt-2">
                        <label for="inputEmail4" class="form-label">Weekend Amount</label>
                        <input type="number" name="weekend" step="0.01" class="form-control" id="inputEmail4"
                               required/>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck" name="personalized" value="1"/>
                            <label class="form-check-label" for="gridCheck">
                               Make private
                            </label>
                        </div>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="default-btn submit rounded-pill">Create order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="delete_order" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Delete Order
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form class="row g-3" id="deleteOrder" action="{{route('user.orders.delete')}}"
                      method="post">
                    @csrf
                    <p class="text-center">
                        Do you really Wish to delete this order. It cannot be recovered.
                    </p>
                    <div class="col-md-12 mt-2" style="display: none;">
                        <label for="inputEmail4" class="form-label">ID</label>
                        <input type="text" class="form-control" id="inputEmail4" name="id">
                    </div>
                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-outline-danger submit rounded-pill">Delete order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
