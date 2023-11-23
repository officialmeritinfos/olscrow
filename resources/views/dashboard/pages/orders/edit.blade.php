@extends('dashboard.layout.base')
@section('content')

    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24 col-md-8 mx-auto">

            <form class="row g-3" id="editOrder" action="{{route('user.orders.update')}}"
                  method="post">
                @csrf
                <div class="col-md-12 mt-2">
                    <label for="inputEmail4" class="form-label">Title</label>
                    <input type="text" class="form-control" id="inputEmail4" name="title" value="{{$order->title}}">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Description</label>
                    <textarea type="text" class="form-control summernote" id="inputEmail4" name="description" rows="5"
                              placeholder="Write an attractive intro for your order">{{$order->description}}</textarea>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="inputEmail4" class="form-label">Services</label>
                    <select name="service[]" class="form-control selectize" id="inputEmail4"
                            required multiple>
                        <option value="">Select services</option>
                        @php
                            $servs = explode(',',$order->services)
                        @endphp
                        @foreach($services as $service)
                            @foreach($servs as $serv)
                                @if($service->id ==$serv)
                                    <option value="{{$service->id}}" selected>{{$service->name}}</option>
                                @endif
                                @continue
                            @endforeach
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="inputEmail4" class="form-label">Short-time Amount</label>
                    <input type="number" name="amount" step="0.01" class="form-control" id="inputEmail4"
                           required value="{{$order->amount}}"/>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="inputEmail4" class="form-label">Overnight Amount</label>
                    <input type="number" name="overnight" step="0.01" class="form-control" id="inputEmail4"
                           required value="{{$order->overnight}}"/>
                </div>
                <div class="col-12 mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck" name="personalized" value="1"
                            {{($order->personalized==1)?'checked':''}}/>
                        <label class="form-check-label" for="gridCheck">
                            Make private
                        </label>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="inputEmail4" class="form-label">Status</label>
                    <select name="status" class="form-control selectize" id="inputEmail4"
                            required>
                        <option value="1" {{($order->status==1)?'selected':''}}>Active</option>
                        <option value="2" {{($order->status==2)?'selected':''}}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-12 mt-2" style="display: none;">
                    <label for="inputEmail4" class="form-label">ID</label>
                    <input type="text" class="form-control" id="inputEmail4" name="id" value="{{$order->reference}}">
                </div>
                <div class="col-12 text-center mt-2">
                    <button type="submit" class="default-btn submit rounded-pill">Update order</button>
                </div>
            </form>

        </div>
    </div>

    @push('js')
        <script src="{{asset('requests/dashboard/orders.js')}}"></script>
    @endpush
@endsection
