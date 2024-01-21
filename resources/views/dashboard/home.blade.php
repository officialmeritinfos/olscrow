@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')
    @if($user->accountType==1)
        <div class="today-card-area pt-24">
            <div class="container-fluid">

                <div class="ui-kit-cards grid mb-24">
                    <h3>Basic Activities to Perform First</h3>
                    @if(empty($injected->escortHasProfile($user)))
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-global-fill"></i> Public Profile
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Set up your public information. This can be changed from the profile page later.
                                    </p>
                                </div>
                                <a href="{{route('user.profile.public')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Set
                                </a>
                            </div>
                        </div>
                    @endif

                    @if(empty($user->city))
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-global-fill"></i> Location & Display Name
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Setup your current location and availability. This can be changed later
                                    </p>
                                </div>
                                <a href="{{route('user.profile.location')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Set
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($user->isVerified!=4 && $user->isVerified!=1)
                            <div class="card shadow mb-3">
                                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                    <div class="flex-grow-1 mb-3 mb-md-0">
                                        <h5 class="card-title">
                                            <i class="ri-shield-check-fill"></i> User Verification
                                        </h5>
                                        <p class="card-text" style="word-break: break-word;">
                                            Verify your ID. This is necessary before you can go public
                                        </p>
                                    </div>
                                    <a href="{{route('user.verification')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                        Set
                                    </a>
                                </div>
                            </div>
                    @endif

                    @if(empty($injected->escortHasPackage($user)))
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-global-fill"></i> Packages
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Setup your packages which clients can book from
                                    </p>
                                </div>
                                <a href="{{route('user.orders')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Set
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($user->isEnrolled!=1)
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-global-fill"></i> Activate Account
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Activate your account by enrolling in one of our packages. This could be the free package.
                                    </p>
                                </div>
                                <a href="{{route('user.subscription')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Set
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Total Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                    title="Total booking that you have recorded on the platform, including pending and cancelled"></i></span>
                                <h6>{{$injected->escortTotalBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Completed Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                        title="Total booking you have recorded on the platform that have been completed."></i></span>
                                <h6>{{$injected->escortCompletedBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Open Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                   title="Refers to bookings that are open and currently ongoing"></i></span>
                                <h6>{{$injected->escortOngoingBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Pending Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                   title="Refers to bookings that are pending your acceptance"></i></span>
                                <h6>{{$injected->escortPendingBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Cancelled Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                        title="Total number of cancelled bookings"></i></span>
                                <h6>{{$injected->escortCancelledBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/user.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Total Earned<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                   title="Total amount you have earned from the platform"></i> </span>
                                <h6>{{$user->mainCurrency}}{{number_format($injected->escortTotalEarning($user),2)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Pending Withdrawal <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                          title="Total withdrawals from the platform pending review. Does not include cancelled withdrawals"></i></span>
                                <h6>{{$user->mainCurrency}}{{number_format($injected->totalPendingWithdrawal($user),2)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Completed Withdrawal<i class="ri-information-fill" data-bs-toggle="tooltip"
                                    title="Total withdrawals from the platform that are completed"></i></span>
                                <h6>{{$user->mainCurrency}}{{number_format($injected->totalCompletedWithdrawal($user),2)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Total Account Balance<i class="ri-information-fill" data-bs-toggle="tooltip" title="Total Amount belonging to you in the system."></i> </span>
                                <h6>
                                    {{$user->mainCurrency}} {{number_format($user->accountBalance+$user->transportBalance+$user->penaltyBalance+$user->subscriptionBalance,2)}}
                                </h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="latest-transaction-area">
            <div class="container-fluid">
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
                        <tbody>
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
                </div>
            </div>
        </div>



    @else
        <div class="today-card-area pt-24">
            <div class="container-fluid">
                <div class="ui-kit-cards grid mb-24">
                    <h3>Basic Activities to Perform First</h3>
                    @if($user->isVerified!=1)
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-user-5-fill"></i> Profile Setup
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Setup and manage your location & Profile
                                    </p>
                                </div>
                                <a href="{{route('user.profile.location')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Manage
                                </a>
                            </div>
                        </div>
                        <div class="card shadow mb-3">
                            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                                <div class="flex-grow-1 mb-3 mb-md-0">
                                    <h5 class="card-title">
                                        <i class="ri-shield-check-fill"></i> User Verification
                                    </h5>
                                    <p class="card-text" style="word-break: break-word;">
                                        Manage your Identity Verification
                                    </p>
                                </div>
                                <a href="{{route('user.verification')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                                    Manage
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Total Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                    title="Total booking that you have recorded on the platform, including pending and cancelled"></i></span>
                                <h6>{{$injected->userTotalBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Completed Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                        title="Total booking you have recorded on the platform that have been completed."></i></span>
                                <h6>{{$injected->userCompletedBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Open Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                   title="Refers to bookings that are open and currently ongoing"></i></span>
                                <h6>{{$injected->userOngoingBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Pending Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                      title="Refers to bookings that are pending escort acceptance"></i></span>
                                <h6>{{$injected->userPendingBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Cancelled Booking<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                        title="Total number of cancelled bookings"></i></span>
                                <h6>{{$injected->userCancelledBooking($user)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/user.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Pending Withdrawal <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                          title="Total withdrawals from the platform pending review. Does not include cancelled withdrawals"></i></span>
                                <h6>{{$user->mainCurrency}}{{number_format($injected->totalPendingWithdrawal($user),2)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Completed Withdrawal<i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                           title="Total withdrawals from the platform that are completed"></i></span>
                                <h6>{{$user->mainCurrency}}{{number_format($injected->totalCompletedWithdrawal($user),2)}}</h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-today-card d-flex align-items-center">
                            <div class="flex-grow-1">
                                <span class="today">Total Account Balance<i class="ri-information-fill" data-bs-toggle="tooltip" title="Total Amount belonging to you in the system."></i> </span>
                                <h6>
                                    {{$user->mainCurrency}} {{number_format($user->accountBalance+$user->transportBalance+$user->penaltyBalance+$user->subscriptionBalance,2)}}
                                </h6>
                            </div>

                            <div class="flex-shrink-0 align-self-center">
                                <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="latest-transaction-area">
            <div class="container-fluid">
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">ESCORT</th>
                            <th scope="col">AMOUNT</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">ORDER</th>
                            <th scope="col">DATE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
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
                                    <a href="{{route('user.escort.detail',['username'=>$injected->getUserById($booking->escortId)->username])}}" class="badge bg-primary">
                                        {{$injected->getUserById($booking->escortId)->username}}
                                    </a>
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
                </div>
            </div>
        </div>
    @endif
@endsection
