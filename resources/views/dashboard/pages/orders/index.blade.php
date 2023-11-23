@extends('dashboard.layout.base')
@section('content')


    <div class="order-details-area mb-0">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <form class="search-bar d-flex">
                        <i class="ri-search-line"></i>
                        <input class="form-control search" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>

                <div class="col-lg-6 col-sm-6">
                    <div class="add-new-orders">
                        <button data-bs-target="#create_order" data-bs-toggle="modal" href="#" class="new-orders">
                            Add New Orders
                            <i class="ri-add-circle-line"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="latest-transaction-area">
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">SHORT-TIME FEE</th>
                            <th scope="col">OVERNIGHT FEE</th>
                            <th scope="col">WEEKEND FEE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($orders as $order)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <span class="badge bg-primary">#{{$order->reference}}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{$order->title}}
                                </td>
                                <td>
                                    {{$order->currency}} {{number_format($order->amount,2)}}
                                </td>
                                <td>
                                    {{$order->currency}} {{number_format($order->overnight,2)}}
                                </td>
                                <td>
                                    {{$order->currency}} {{number_format($order->weekend,2)}}
                                </td>

                                <td class="status">
                                    @switch($order->status)
                                        @case(1)
                                            <i class="ri-checkbox-circle-line"></i>
                                            Active
                                        @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            Inactive
                                        @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{route('user.orders.edit',['id'=>$order->reference])}}">
                                                    Edit
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" class="dropdown-item" href="#delete_order"
                                                data-value="{{$order->reference}}">
                                                    Delete
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" class="dropdown-item" data-value="{{$order->reference}}">
                                                    Share
                                                    <i class="ri-share-forward-2-fill text-primary"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>


    @push('js')
        @include('dashboard.pages.modal.order_modal')
        <script src="{{asset('requests/dashboard/orders.js')}}"></script>
        <script>

            $('#delete_order').on('show.bs.modal', function(event){
                const button = event.relatedTarget;

                const id = button.getAttribute('data-value');

                $('input[name="id"]').val(id)

            });
        </script>
    @endpush
@endsection
