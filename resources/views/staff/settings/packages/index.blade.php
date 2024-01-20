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
                <div class="col-lg-6 col-sm-6">
                    <div class="add-new-orders">
                        <a href="{{route('staff.settings.packages.add')}}" class="new-orders">
                            Add New Package
                            <i class="ri-add-circle-line"></i>
                        </a>
                    </div>
                </div>


            </div>

            <div class="latest-transaction-area">
                <div class="table-responsive" data-simplebar>
                    <table class="table align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">MONTH AMOUNT</th>
                            <th scope="col">ANNUAL AMOUNT</th>
                            <th scope="col">FEE</th>
                            <th scope="col">RECOMMENDED</th>
                            <th scope="col">IS FREE</th>
                            <th scope="col">HAS FEATURED</th>
                            <th scope="col">FEATURED DURATION</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">ACTION</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($packages as $package)
                            <tr>
                                <td>
                                    {{$package->name}}
                                </td>
                                <td>
                                    {{$package->description}}
                                </td>
                                <td>
                                    ${{$package->monthAmount}}
                                </td>
                                <td>
                                    ${{$package->annualAmount}}
                                </td>
                                <td>
                                    {{$package->fee}}%
                                </td>

                                <td class="status">
                                    @switch($package->isRecommended)
                                        @case(1)
                                            <i class="ri-checkbox-circle-line"></i>
                                            Yes
                                            @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            No
                                            @break
                                    @endswitch
                                </td>

                                <td class="status">
                                    @switch($package->isFree)
                                        @case(1)
                                            <i class="ri-checkbox-circle-line"></i>
                                            Yes
                                            @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            No
                                            @break
                                    @endswitch
                                </td>

                                <td class="status">
                                    @switch($package->hasFeatured)
                                        @case(1)
                                            <i class="ri-checkbox-circle-line"></i>
                                            Yes
                                            @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            No
                                            @break
                                    @endswitch
                                </td>

                                <td class="status">
                                    @switch($package->hasFeatured)
                                        @case(1)
                                            {{$package->featuredDuration}}
                                            @break
                                        @default
                                            <i class="bx bx-x-circle text-danger"></i>
                                            No
                                            @break
                                    @endswitch
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
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a class="dropdown-item" href="{{route('staff.settings.packages.edit',['id'=>$package->id])}}">
                                                    Edit
                                                    <i class="ri-eye-2-line"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{route('staff.settings.packages.id.delete',['id'=>$package->id])}}">
                                                    Delete
                                                    <i class="ri-delete-bin-4-fill"></i>
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
                        {{$packages->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('js')
        <script src="{{asset('requests/staff/packages.js')}}"></script>
    @endpush
@endsection

