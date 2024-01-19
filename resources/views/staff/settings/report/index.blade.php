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
                            <th scope="col">CONTENT</th>
                            <th scope="col">PENALTY($)</th>
                            <th scope="col">STATUS</th>
                        </tr>
                        </thead>
                        <tbody class="searches">
                        @foreach($reports as $report)
                            <tr>
                                <td>
                                    {{$report->title}}
                                </td>
                                <td>
                                    {{$report->content}}
                                </td>
                                <td>
                                    ${{$report->penalty}}
                                </td>

                                <td class="status">
                                    @switch($report->status)
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
                        {{$reports->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

