@extends('staff.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')


    <div class="order-details-area mb-0">
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
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">USER</th>
                            <th scope="col">AMOUNT</th>
                            <th scope="col">BANK</th>
                            <th scope="col">ACCOUNT NUMBER</th>
                            <th scope="col">NARRATION</th>
                            <th scope="col">DATE</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
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
                                    @if($injected->getUserById($transaction->user)->accountType==1)
                                        <a href="{{route('staff.user.escort.details',['id'=>$injected->getUserById($transaction->user)->reference])}}"
                                           class="badge bg-info">
                                            {{$injected->getUserById($transaction->user)->name}}
                                        </a>
                                    @else
                                        <a href="{{route('staff.user.client.details',['id'=>$injected->getUserById($transaction->user)->reference])}}"
                                           class="badge bg-info">
                                            {{$injected->getUserById($transaction->user)->name}}
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    {{$transaction->currency}}{{number_format($transaction->amount,2)}}
                                </td>
                                <td>
                                    {{empty($injected->fetchPayoutAccountByReference($transaction->paymentDetails))?'N/A':$injected->fetchPayoutAccountByReference($transaction->paymentDetails)->bankName}}
                                </td>
                                <td>
                                    {{empty($injected->fetchPayoutAccountByReference($transaction->paymentDetails))?'N/A':$injected->fetchPayoutAccountByReference($transaction->paymentDetails)->accountNumber}}
                                </td>
                                <td>
                                    <span class="badge bg-dark">Withdrawal from Account</span>
                                </td>
                                <td>
                                    {{date('D, d M Y H:i:s',strtotime($transaction->created_at))}}
                                </td>
                                <td>
                                    @switch($transaction->status)
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
                                                <a class="dropdown-item" href="{{route('staff.transactions.withdrawals.detail',['id'=>$transaction->reference])}}">
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
                        {{$transactions->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

