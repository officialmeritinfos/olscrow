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
                            <th scope="col">PACKAGE</th>
                            <th scope="col">BALANCE</th>
                            <th scope="col">DATE</th>
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
                                    <a href="{{route('staff.user.client.details',['id'=>$injected->getUserById($transaction->user)->reference])}}"
                                       class="badge bg-info">
                                        {{$injected->getUserById($transaction->user)->name}}
                                    </a>
                                </td>
                                <td>
                                    {{$transaction->currency}} {{number_format($transaction->amount,2)}}
                                </td>
                                <td>
                                    {{$injected->fetchSubscriptionPackageById($transaction->package)->name??'N/A'}}
                                </td>
                                <td>
                                    {{$transaction->currency}} {{number_format($transaction->balanceAfter,2)}}
                                </td>
                                <td>
                                    {{date('D, d M Y H:i:s',strtotime($transaction->created_at))}}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{route('staff.transactions.subscription.detail',['id'=>$transaction->reference])}}">
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

