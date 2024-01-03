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
            </div>

            <div class="latest-transaction-area">
                <div class="table-responsive" data-simplebar>
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

            <div class="row">
                <div class="col-lg-6 col-sm-6">
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
                            <th scope="col">AMOUNT</th>
                            <th scope="col">DESTINATION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($trans as $tran)
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
                        {{$trans->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
