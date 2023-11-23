@extends('dashboard.layout.base')
@section('content')
@inject('injected','App\Traits\Custom')

@if($user->accountType==1)

    <div class="order-details-area mb-0">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-6 col-sm-6 mx-auto">
                    <form class="search-bar d-flex">
                        <i class="ri-search-line"></i>
                        <input class="form-control search" type="search" placeholder="Search" aria-label="Search">
                    </form>
                </div>

            </div>

            <div class="latest-transaction-area">
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">CLIENT</th>
                            <th scope="col">AMOUNT</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">ORDER</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($bookings as $booking)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <span class="badge bg-primary">#{{$booking->reference}}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    {{$injected->getUserById($booking->user)->username}}
                                </td>
                                <td>
                                    {{$booking->currency}} {{number_format($booking->amount,2)}}
                                </td>
                                <td>
                                    @switch($booking->orderType)
                                        @case(1)
                                            <span class="badge bg-info">Short-time</span>
                                        @break
                                        @case(1)
                                            <span class="badge bg-dark">Overnight</span>
                                        @break
                                        @default
                                            <span class="badge bg-primary">Weekend</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    {{$injected->getOrderById($booking->orderId)->title}}
                                </td>

                                <td class="status">
                                    @switch($booking->status)
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
                                                <a class="dropdown-item" href="{{route('user.orders.edit',['id'=>$booking->reference])}}">
                                                    Edit
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" class="dropdown-item" href="#delete_order"
                                                   data-value="{{$booking->reference}}">
                                                    Delete
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-bs-toggle="modal" class="dropdown-item" data-value="{{$booking->reference}}">
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
                        {{$bookings->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@else


@endif

@endsection
