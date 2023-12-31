@extends('dashboard.layout.base')
@section('content')
@inject('option','App\Traits\Custom')
    <div class="wallet-chart-area with-exchange">
        <div class="container-fluid">
            <div class="row align-items-center">
                @if($user->accountType==1)

                    <div class="col-lg-4">
                        <div class="mb-24">
                            <div class="emmeli-bg">
                                <h3>FUNDING NOTICE</h3>
                                <p>
                                    Three accounts are currently supported by {{$siteName}}
                                    and they serve different purposes. <br/>
                                    <b>N.B</b>: Only funds in Main Balance can be withdrawn/refundable.
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Subscription Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                            title="Funds in this account are charged for your account renewals. If this account runs to
                                            zero(0), your subscription will automatically cancel, and access will be limited."></i>
                                        </span>
                                        <h6>
                                            <span class="text-primary">
                                                {{$user->mainCurrency}} {{number_format($user->subscriptionBalance,2)}}
                                            </span>
                                        </h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Main Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                            title="Funds in this account can be withdrawn at any time, and can also
                                                            be used for paying other utilities on the platform. Your service charges
                                                            are credited into this account."></i>
                                        </span>
                                        <h6>
                                            <span style="word-break: break-word;">
                                                {{$user->mainCurrency}} {{number_format($user->accountBalance,2)}}
                                            </span>
                                        </h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#fund_main_balance">
                                                        <i class="bx bx-money"></i>
                                                        Fund Balance
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#convert_main_balance">
                                                        <i class="bx bx-repeat"></i>
                                                        Convert Balance
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#withdraw_main_balance">
                                                        <i class="ri-send-plane-fill"></i>
                                                        Withdraw Balance
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Penalty Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                               title="Funds here are utilized to pay fees accumulated due to
                                                               your inability to meet up with your escort-client agreement."></i>
                                        </span>
                                        <span class="text-info">
                                                {{$user->mainCurrency}} {{number_format($user->penaltyBalance,2)}}
                                            </span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Transport Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                               title="Funds here are utilized for transport purpose.
                                                               When a client accepts your transportation fee request,
                                                               it is held here till completion. If you fail to meet up as
                                                               agreed, we will refund this while also initiating the appropriate penalty."></i>
                                        </span>
                                        <span class="text-info">
                                                {{$user->mainCurrency}} {{number_format($user->transportBalance,2)}}
                                            </span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Referral Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                               title="Funds here are amount you received from your referrals"></i>
                                        </span>
                                        <span class="text-info">
                                                {{$user->mainCurrency}} {{number_format($user->referralBalance,2)}}
                                            </span>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#convert_referral_balance">
                                                        <i class="bx bx-repeat"></i>
                                                        Convert Balance
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </div>


                        </div>
                    </div>
                @else

                    <div class="col-lg-12">
                        <div class="row justify-content-center">


                            <div class="col-lg-4">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">Main Balance</span>
                                        <h6>
                                            <span style="word-break: break-word;">
                                                {{$user->mainCurrency}} {{number_format($user->accountBalance,2)}}
                                            </span>
                                        </h6>
                                    </div>

                                    <div class="flex-shrink-0 align-self-center">
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#fund_main_balance">
                                                        <i class="bx bx-money"></i>
                                                        Fund Balance
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#withdraw_main_balance">
                                                        <i class="ri-send-plane-fill"></i>
                                                        Withdraw Balance
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="single-today-card d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <span class="today">
                                            Referral Balance <i class="ri-information-fill" data-bs-toggle="tooltip"
                                                                title="Funds here are amount you received from your referrals"></i>
                                        </span>
                                        <span class="text-info">
                                                {{$user->mainCurrency}} {{number_format($user->referralBalance,2)}}
                                            </span>
                                    </div>
                                    <div class="flex-shrink-0 align-self-center ">
                                        <div class="dropdown">
                                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                <li>
                                                    <a class="dropdown-item" data-bs-toggle="modal" href="#convert_referral_balance">
                                                        <i class="bx bx-repeat"></i>
                                                        Convert Balance
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                @endif
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="ui-kit-cards grid mb-24">
            <h3>Account Funding</h3>

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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        @include('dashboard.pages.modal.fund_account')
        <script src="{{asset('requests/dashboard/account_funding.js')}}"></script>
        <script src="{{asset('requests/dashboard/sendOtp.js')}}"></script>
    @endpush
@endsection
