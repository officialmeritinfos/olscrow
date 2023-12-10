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
                            <th scope="col">DATE</th>
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
                                <td>
                                    {{date('D, d M Y H:i:s',strtotime($booking->created_at))}}
                                </td>

                                <td class="status">
                                    @switch($booking->status)
                                        @case(1)
                                            <i class="ri-checkbox-circle-line"></i>
                                            Completed
                                            @break
                                        @case(2)
                                            <i class="ri-stop-circle-fill text-info"></i>
                                            Pending Acceptance
                                            @break
                                        @case(4)
                                            <i class="bx bx-refresh bx-spin text-primary"></i>
                                            Ongoing
                                            @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            Cancelled
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
                                                <a class="dropdown-item" href="{{route('user.bookings.detail',['id'=>$booking->reference])}}">
                                                    Details
                                                    <i class="ri-eye-2-line"></i>
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
