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
                            <th scope="col">DESCRIPTION</th>
                            <th scope="col">MONTH AMOUNT</th>
                            <th scope="col">ANNUAL AMOUNT</th>
                            <th scope="col">FEE</th>
                            <th scope="col">RECOMMENDED</th>
                            <th scope="col">IS FREE</th>
                            <th scope="col">HAS FEATURED</th>
                            <th scope="col">FEATURED DURATION</th>
                            <th scope="col">STATUS</th>
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

