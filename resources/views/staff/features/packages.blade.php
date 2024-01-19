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
                            <th scope="col">ID</th>
                            <th scope="col">ESCORT</th>
                            <th scope="col">TITLE</th>
                            <th scope="col">SHORT-TIME FEE</th>
                            <th scope="col">OVERNIGHT FEE</th>
                            <th scope="col">WEEKEND FEE</th>
                            <th scope="col">STATUS</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($packages as $package)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <span class="badge bg-primary">#{{$package->reference}}</span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('staff.user.escort.details',['id'=>$injected->getUserById($package->user)->reference])}}"
                                       class="badge bg-info">
                                        {{$injected->getUserById($package->user)->name}}
                                    </a>
                                </td>
                                <td>
                                    {{$package->title}}
                                </td>
                                <td>
                                    {{$package->currency}} {{number_format($package->amount,2)}}
                                </td>
                                <td>
                                    {{$package->currency}} {{number_format($package->overnight,2)}}
                                </td>
                                <td>
                                    {{$package->currency}} {{number_format($package->weekend,2)}}
                                </td>

                                <td class="status">
                                    @switch($package->status)
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
                        {{$packages->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

