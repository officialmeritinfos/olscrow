@extends('staff.layout.base')
@section('content')
    @inject('option','App\Traits\Custom')

    <div class="profile-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="cover-img">
                        <img src="{{asset('dashboard/images/cover-img.jpg')}}" alt="Images">
                    </div>

                    <div class="profile-face">
                        <div class="row align-items-end justify-content-center">
                            <div class="col-lg-4 col-md-4">
                                <div class="avatar">
                                    <img src="{{empty($escort->photo)?'https://ui-avatars.com/api/?name='.$escort->name.'&background=random&round=true':$escort->photo}}" alt="Images">
                                    <h6>{{$escort->name}} @if($escort->isVerified==1)
                                            <i class="ri-checkbox-circle-fill text-success" style="font-size: 1rem;"
                                               data-bs-toggle="tooltip" title="Verified Profile"></i>
                                        @endif</h6>
                                    <p>
                                        {{$escort->email}}<br/>
                                        <small><b>Username:</b> {{$escort->username}}</small>
                                        <small>
                                            @if (Cache::has('user-is-online-' . $escort->id))
                                                <span class="text-success">Online</span>
                                            @else
                                                <span class=" text-danger">Offline</span>
                                            @endif
                                        </small>
                                    </p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$fiat->sign}}{{number_format($escort->accountBalance)}}</h6>
                                    <p>Account Balance</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$fiat->sign}}{{number_format($escort->subscriptionBalance)}}</h6>
                                    <p>Sub. Balance</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$fiat->sign}}{{number_format($escort->penaltyBalance)}}</h6>
                                    <p>Penalty Balance</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$fiat->sign}}{{number_format($escort->transportBalance)}}</h6>
                                    <p>Transport Balance</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-face" id="userFeatures">
                        <div class="row align-items-end justify-content-center">
                            <h6 class="mb-3">Escort Features</h6>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->convertToAge($escort->dateOfBirth)}} Yrs</h6>
                                    <p>Age</p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->fetchEscortProfile($escort->id)->education}}</h6>
                                    <p>Education</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->fetchEscortProfile($escort->id)->occupation}}</h6>
                                    <p>Occupation</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->weight)->name}}</h6>
                                    <p>Weight</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->height)->name}}</h6>
                                    <p>Height</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->bustSize)->name}}</h6>
                                    <p>Bust Size</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->build)->name}}</h6>
                                    <p>Build</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->looks)->name}}</h6>
                                    <p>Looks</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6>{{$option->getUserFeature($option->fetchEscortProfile($escort->id)->ethnicity)->name}}</h6>
                                    <p>Ethnicity</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="projects">
                                    <h6 style="word-break: break-word;">{{$option->fetchEscortProfile($escort->id)->sexualOrientation}}</h6>
                                    <p>Sexual Orientation</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-face" id="userFeatures">
                        <div class="row align-items-end justify-content-center">
                            <h6 class="mb-3">Escort Services</h6>
                            @php
                                $servs = explode(',',$profile->services)
                            @endphp
                            @foreach($servs as $serv)
                                <div class="col-lg-4 col-sm-6 col-md-4">
                                    <div class="projects">
                                        <h6></h6>
                                        <p>{{$option->getServiceById($serv)->name}}</p>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>

                    <div class="profile-information">
                        <h6>Information</h6>
                        <p>
                            {!! $profile->about !!}
                        </p>
                        <h6>Short Bio</h6>
                        <p>
                            {!! $profile->shortBio !!}
                        </p>
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <tbody>
                                <tr>
                                    <th scope="row">Display Name :</th>
                                    <td>{{$escort->displayName}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>
                                        <a href="tel:{{$escort->phone??'N/A'}}">{{$escort->phone??'N/A'}}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Country :</th>
                                    <td>{{$option->getCountryByCode($user->countryCode)->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">State :</th>
                                    <td>{{$option->getStateById($user->state)->name??'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">City :</th>
                                    <td>{{$option->getCityById($user->city)->name??'N/A'}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Status :</th>
                                    <td>
                                        @switch($user->isPublic)
                                            @case(1)
                                                <span class="badge bg-success">Public</span>
                                                @break
                                            @default
                                                <span class="badge bg-danger">Private</span>
                                                @break
                                        @endswitch
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="profile-experience">
                        <h6>Packages</h6>

                        <div class="pricing-area">
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    @foreach($packages as $package)

                                        <div class="col-lg-12 col-md-12">
                                            <div class="single-pricing-card">
                                                <div class="pricing-bar">
                                                    <span>{{$package->title}}  </span>
                                                    <p>{!! $package->description !!}</p>
                                                </div>

                                                <div class="price-list">
                                                    <ul>
                                                        @if(!empty($package->amount) || $package->amount!=0)
                                                            <li>
                                                                <i class="ri-check-line"></i>
                                                                <b>Short-time:</b>
                                                                {{$package->currency}}{{number_format($package->amount)}}
                                                            </li>
                                                        @endif
                                                        @if(!empty($package->overnight) || $package->overnight!=0)
                                                            <li>
                                                                <i class="ri-check-line"></i>
                                                                <b>Overnight:</b>
                                                                {{$package->currency}}{{number_format($package->overnight)}}
                                                            </li>
                                                        @endif
                                                        @if(!empty($package->weekend) || $package->weekend!=0)
                                                            <li>
                                                                <i class="ri--check-line"></i>
                                                                <b>Weekend:</b>
                                                                {{$package->currency}}{{number_format($package->weekend)}}
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <h6>Photos</h6>
                        @push('css')
                            <style>
                                .thumbnail-container {
                                    display: flex;
                                    flex-wrap: wrap;
                                }

                                .thumbnail {
                                    width: 200px; /* Adjust as needed */
                                    height: 200px; /* Adjust as needed */
                                    object-fit: cover; /* Maintain aspect ratio and cover the container */
                                    margin: 5px; /* Optional margin between thumbnails */
                                }
                            </style>
                            <!-- Lightbox CSS -->
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
                        @endpush
                        <div class="ui-kit-card grid mb-24 row thumbnail-container justify-content-center">
                            @php
                                $cnt=1;
                            @endphp
                            @foreach($photos as $photo)

                                <div class="col-md-3">
                                    <a href="{{$photo->photo}}" data-fancybox="gallery" data-caption="Image {{$cnt}} ">
                                        <img src="{{$photo->photo}}" class="img-thumbnail thumbnail">
                                    </a>
                                </div>
                                @php
                                    $cnt++;
                                @endphp
                            @endforeach
                        </div>
                    </div>
                    @if($reviews->count()>0)
                        <div class="analytics-area mt-4">
                            <div class="activity-timeline" data-simplebar>
                                <h3>Escort Reviews</h3>

                                <ul>
                                    @inject('injected','App\Traits\Custom')
                                    @foreach($reviews as $review)
                                        <li>
                                            <a href="#">
                                                <i class="ri-add-line"></i>
                                                <h6>{{$injected->getUserById($review->reviewer)->displayName??'N/A'}}</h6>
                                                <p> {{$review->content}}</p>
                                                <span>{{date('d, F Y')}}</span>
                                            </a>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-7">
                    <div class="today-card-area">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">Total Earnings</span>
                                        <h6>{{$fiat->sign}} {{$totalEarning}}</h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <img src="{{asset('dashboard/images/icon/discount.png')}}" alt="Images">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">Total Deposits</span>
                                        <h6>{{$fiat->sign}} {{$totalDeposits}}</h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <img src="{{asset('dashboard/images/icon/user.png')}}" alt="Images">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">Total Withdrawals</span>
                                        <h6>{{$fiat->sign}} {{$totalWithdrawals}}</h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">Total Subscriptions</span>
                                        <h6>{{$fiat->sign}} {{$totalSubs}}</h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <img src="{{asset('dashboard/images/icon/groop.png')}}" alt="Images">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="ui-kit-cards grid mb-24">

                            <h6>BOOKINGS</h6>
                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto">
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
                                                                <a class="dropdown-item" href="{{route('staff.bookings.detail',['id'=>$booking->reference])}}">
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

                    <div class="container-fluid">
                        <div class="ui-kit-cards grid mb-24">
                            <h3>DEPOSITS</h3>

                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto" data-simplebar>
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th >Amount</th>
                                            <th >Destination</th>
                                            <th>Bank</th>
                                            <th>Account Number</th>
                                            <th>Narration</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($deposits as $deposit)
                                            <tr>
                                                <td>
                                        <span class="badge bg-primary">
                                            {{$deposit->orderReference}}
                                        </span>
                                                </td>
                                                <td>
                                                    {{$deposit->currency}}{{number_format($deposit->amountToPay,2)}}
                                                    ({{$deposit->currency}}{{number_format($deposit->amount,2)}})
                                                </td>
                                                <td>
                                                    {{$deposit->type}}
                                                </td>
                                                <td>
                                                    {{empty($deposit->bank)?'N/A':$deposit->bank}}
                                                </td>
                                                <td>
                                                    {{empty($deposit->accountNumber)?'N/A':$deposit->accountNumber}}
                                                </td>
                                                <td>
                                                    <span class="badge bg-dark">{{strtoupper($deposit->reference)}}</span>
                                                </td>
                                                <td>
                                                    {{date('D, d M Y H:i:s',strtotime($deposit->created_at))}}
                                                </td>
                                                <td>
                                                    @switch($deposit->status)
                                                        @case(1)
                                                            <span class="badge bg-success">Completed</span>
                                                            @break
                                                        @case(2)
                                                            <span class="badge bg-primary">Pending</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-danger">Cancelled</span>
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
                                                                <a class="dropdown-item" href="{{route('staff.transactions.funding.detail',['id'=>$deposit->reference])}}">
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
                                        {{$deposits->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="ui-kit-cards grid mb-24">
                            <h3>Account Withdrawal</h3>

                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto" data-simplebar>
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th >Amount</th>
                                            <th>Bank</th>
                                            <th>Account Number</th>
                                            <th>Narration</th>
                                            <th>DATE</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($withdrawals as $withdrawal)
                                            <tr>
                                                <td>
                                        <span class="badge bg-primary">
                                            {{$withdrawal->reference}}
                                        </span>
                                                </td>
                                                <td>
                                                    {{$withdrawal->currency}}{{number_format($withdrawal->amount,2)}}
                                                    ({{$withdrawal->currency}}{{number_format($withdrawal->amountCredit,2)}})
                                                </td>
                                                <td>
                                                    {{empty($option->fetchPayoutAccountByReference($withdrawal->paymentDetails))?'N/A':$option->fetchPayoutAccountByReference($withdrawal->paymentDetails)->bankName}}
                                                </td>
                                                <td>
                                                    {{empty($option->fetchPayoutAccountByReference($withdrawal->paymentDetails))?'N/A':$option->fetchPayoutAccountByReference($withdrawal->paymentDetails)->accountNumber}}
                                                    (
                                                    {{empty($option->fetchPayoutAccountByReference($withdrawal->paymentDetails))?'N/A':$option->fetchPayoutAccountByReference($withdrawal->paymentDetails)->accountName}}
                                                    )
                                                </td>
                                                <td>
                                                    <span class="badge bg-dark">Withdrawal from Account</span>
                                                </td>
                                                <td>
                                                    {{date('D, d M Y H:i:s',strtotime($withdrawal->created_at))}}
                                                </td>
                                                <td>
                                                    @switch($withdrawal->status)
                                                        @case(1)
                                                            <span class="badge bg-success">Completed</span>
                                                            @break
                                                        @case(2)
                                                            <span class="badge bg-primary">Pending</span>
                                                            @break
                                                        @default
                                                            <span class="badge bg-danger">Cancelled</span>
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
                                                                <a class="dropdown-item" href="{{route('staff.transactions.withdrawals.detail',['id'=>$withdrawal->reference])}}">
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
                                        {{$withdrawals->links()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-details-area mb-0">
                        <div class="container-fluid">


                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">AMOUNT</th>
                                            <th scope="col">PURPOSE</th>
                                        </tr>
                                        </thead>
                                        <tbody class="searches">
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <span class="badge bg-primary">#{{$transaction->reference}}</span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($transaction->type==1)
                                                        <span class="badge bg-success">
                                            + {{$transaction->currency}} {{number_format($transaction->amount,2)}}
                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                            - {{$transaction->currency}} {{number_format($transaction->amount,2)}}
                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$transaction->purpose}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-5">
                                        {{$transactions->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="order-details-area mb-5 mt-5">
                        <div class="container-fluid">


                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">AMOUNT</th>
                                            <th scope="col">DESTINATION</th>
                                            <th scope="col"></th>
                                        </tr>
                                        </thead>
                                        <tbody class="searches">
                                        @foreach($userTransactions as $tran)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <span class="badge bg-primary">#{{$tran->reference}}</span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if($tran->type==1)
                                                        <span class="badge bg-success">
                                            + {{$tran->currency}} {{number_format($tran->amount,2)}}
                                        </span>
                                                    @else
                                                        <span class="badge bg-danger">
                                            - {{$tran->currency}} {{number_format($tran->amount,2)}}
                                        </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ucwords($tran->accountTo).' Balance'??'Account Balance'}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-5">
                                        {{$userTransactions->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="order-details-area" style="margin-bottom: 10rem;">
                        <div class="container-fluid">
                            <h3>Subscription Payments</h3>

                            <div class="latest-transaction-area">
                                <div class="table-responsive" data-simplebar>
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">AMOUNT</th>
                                            <th scope="col">DATE</th>
                                        </tr>
                                        </thead>
                                        <tbody class="searches">
                                        @foreach($subscriptions as $order)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <span class="badge bg-primary">#{{$order->reference}}</span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$order->currency}} {{number_format($order->amount,2)}}
                                                </td>
                                                <td>
                                                    {{date('F, d M Y H:i:s',strtotime($order->created_at))}}
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-5">
                                        {{$subscriptions->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="order-details-area mb-5">
                        <div class="container-fluid">

                            <div class="row">
                                <div class="col-lg-6 col-sm-6 mx-auto">
                                    <form class="search-bar d-flex">
                                        <i class="ri-search-line"></i>
                                        <input class="form-control searchInput" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>

                            </div>

                            <div class="latest-transaction-area">
                                <div class="table-responsive h-auto">
                                    <table class="table align-middle mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">ESCORT</th>
                                            <th scope="col">VIDEO</th>
                                            <th scope="col">PHOTO</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">DATE</th>
                                            <th scope="col">ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody class="searches">
                                        @foreach($verifications as $verification)
                                            <tr>
                                                <td>
                                                    <a href="{{route('staff.user.escort.details',['id'=>$injected->getUserById($verification->user)->reference])}}"
                                                       class="badge bg-info">
                                                        {{$injected->getUserById($verification->user)->name}}
                                                    </a>
                                                </td>
                                                <td>
                                                    <p>
                                                        Your browser doesn't support HTML video. Here is a
                                                        <a href="{{$verification->liveVideo}}">link to the video</a> instead.
                                                    </p>
                                                </td>
                                                <td>
                                                    <img src="{{$verification->photo}}" style="width: 100px;"/>
                                                </td>
                                                <td class="status">
                                                    @switch($verification->status)
                                                        @case(1)
                                                            <i class="ri-checkbox-circle-line"></i>
                                                            Approved
                                                            @break
                                                        @case(4)
                                                            <i class="bx bx-refresh bx-spin text-primary"></i>
                                                            Pending Approval
                                                            @break
                                                        @default
                                                            <i class="bx bx-x-circle text-danger"></i>
                                                            Cancelled
                                                            @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    {{date('d M, Y H:i a',strtotime($verification->created_at))}}
                                                </td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-2-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" href="{{route('staff.verifications.detail',['id'=>$verification->id])}}">
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
                                        {{$verifications->links()}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>

    @push('js')
        <!-- Lightbox JS -->
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        @endpush
@endsection
