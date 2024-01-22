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
                            <th scope="col">ESCORT</th>
                            <th scope="col">VIDEO</th>
                            <th scope="col">PHOTO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($escorts as $escort)
                            <tr>
                                <td>
                                    <a href="{{route('staff.user.escort.details',['id'=>$injected->getUserById($escort->user)->reference])}}"
                                       class="badge bg-info">
                                        {{$injected->getUserById($escort->user)->name}}
                                    </a>
                                </td>
                                <td>
                                    <video controls width="100">
                                        <source src="{{$client->liveVideo}}"/>
                                        <p>
                                            Your browser doesn't support HTML video. Here is a
                                            <a href="{{$client->liveVideo}}">link to the video</a> instead.
                                        </p>
                                    </video>
                                </td>
                                <td>
                                    <img src="{{$escort->photo}}" style="width: 200px;"/>
                                </td>
                                <td class="status">
                                    @switch($escort->status)
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
                                    {{date('d M, Y H:i a',strtotime($escort->created_at))}}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{route('staff.verifications.detail',['id'=>$escort->id])}}">
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
                        {{$escorts->links()}}
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
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">CLIENT</th>
                            <th scope="col">VIDEO</th>
                            <th scope="col">PHOTO</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">DATE</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <a href="{{route('staff.user.client.details',['id'=>$injected->getUserById($client->user)->reference])}}"
                                       class="badge bg-info">
                                        {{$injected->getUserById($client->user)->name}}
                                    </a>
                                </td>
                                <td>
                                    <video controls width="100">
                                        <source src="{{$client->liveVideo}}"/>
                                        <p>
                                            Your browser doesn't support HTML video. Here is a
                                            <a href="{{$client->liveVideo}}">link to the video</a> instead.
                                        </p>
                                    </video>
                                </td>
                                <td>
                                    <img src="{{$client->photo}}" style="width: 200px;"/>
                                </td>
                                <td class="status">
                                    @switch($client->status)
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
                                    {{date('d M, Y - H:i a',strtotime($client->created_at))}}
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{route('staff.verifications.detail',['id'=>$client->id])}}">
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
                        {{$clients->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

