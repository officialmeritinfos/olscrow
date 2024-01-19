@extends('staff.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')


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
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">CODE</th>
                            <th scope="col">SIGN</th>
                            <th scope="col">RATE</th>
                            <th scope="col">MINIMUM WITHDRAWAL</th>
                            <th scope="col">WITHDRAWAL FEE</th>
                            <th scope="col">STATUS</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($fiats as $fiat)
                            <tr>
                                <td>
                                    {{$fiat->name}}
                                </td>
                                <td>
                                    {{$fiat->code}}
                                </td>
                                <td>
                                    {{$fiat->sign}}
                                </td>
                                <td>
                                    {{$fiat->rate}}
                                </td>
                                <td>
                                    {{$fiat->minAmount}}
                                </td>
                                <td>
                                    {{$fiat->withdrawalFee}}
                                </td>

                                <td class="status">
                                    @switch($fiat->status)
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
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{$fiats->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

