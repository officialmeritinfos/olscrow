@extends('staff.layout.base')
@section('content')

    <div class="order-details-area customer-area mb-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
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
                            <th scope="col">ESCORT ID</th>
                            <th scope="col">CUSTOMER</th>
                            <th scope="col">USERNAME</th>
                            <th scope="col">COUNTRY</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">DATE</th>
                            <th scope="col">VERIFICATION STATUS</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($escorts as $escort)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{$escort->reference}}</span>
                                </td>
                                <td>
                                    {{$escort->name}} ({{$escort->email}})
                                </td>
                                <td>
                                    {{$escort->username}}
                                </td>
                                <td class="bold">
                                    {{$escort->country}}
                                </td>
                                <td class="rating">
                                    {{$escort->gender}}
                                </td>
                                <td class="rating">
                                    {{date('d F, Y - H:i a',strtotime($escort->created_at))}}
                                </td>
                                <td>
                                    @switch($escort->isVerifiedg)
                                        @case(1)
                                            <span class="badge bg-success">Verified</span>
                                        @break
                                        @case(4)
                                            <span class="badge bg-primary">Submitted</span>
                                            @break
                                        @default
                                            <span class="badge bg-danger">Pending Verification</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @switch($escort->status)
                                        @case(1)
                                            <span class="badge bg-success">Active</span>
                                        @break
                                        @default
                                            <span class="badge bg-danger">Inactive</span>
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
                                                <a class="dropdown-item" href="{{route('staff.user.escort.details',['id'=>$escort->reference])}}">
                                                    Detail
                                                    <i class="ri-pencil-line"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{$escorts->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
