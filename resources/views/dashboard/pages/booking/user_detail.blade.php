<div class="invoice-area">
    <div class="invoice-header mb-24 d-flex justify-content-between">
        <div class="invoice-left-text">
            <h3 class="mb-0">{{$siteName}}</h3>
            <p class="mt-2 mb-0">{!! $web->address !!}</p>
        </div>

        <div class="invoice-right-text">
            <h3 class="mb-0 text-uppercase">Booking</h3>
        </div>
    </div>

    <div class="invoice-middle mb-24">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="text text-start">
                    <h4 class="mb-2">Escort</h4>
                    <span class="d-block mb-2"><strong>Name:</strong> {{ucfirst($party->displayName)}}</span>
                    <span class="d-block mb-2"><strong>Tel:</strong> <a href="tel:{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($party->phone)}}">{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($party->phone)}}</a> </span>
                    <span class="d-block mb-2"><strong>Your Location:</strong> {{$booking->location}}</span>
                    <span class="d-block">{{$booking->state}}, {{$injected->getCountryByCode($booking->country)->name}}</span>
                </div>
            </div>


            <div class="col-lg-6 col-12">
                <div class="text text-end">
                    <h4 class="mb-2">Booking</h4>
                    <span class="d-block mb-2"><strong>Booking ID:</strong> {{$booking->reference}}</span>
                    <span class="d-block mb-2">{{date('D, d M Y H:i:s A',strtotime($booking->created_at))}}</span>
                    <span class="d-block mb-2"><strong>Status:</strong>
                                @switch($booking->status)
                            @case(1)
                                <span class="badge bg-success">
                                            <i class="ri-checkbox-circle-line"></i>
                                            Completed
                                        </span>
                                @break
                            @case(2)
                                <span class="badge bg-info">
                                            <i class="ri-stop-circle-fill"></i>
                                            Pending Acceptance
                                        </span>
                                @break
                            @case(4)
                                <span class="badge bg-primary">
                                            <i class="bx bx-refresh bx-spin"></i>
                                            Ongoing
                                        </span>
                                @break
                            @default
                                <span class="badge bg-danger">Cancelled</span>
                                @break
                        @endswitch
                            </span>
                    @if($booking->requestForTransport==1)
                        <span class="d-block mb-2"><strong>Transport Status:</strong>
                                    @switch($booking->transportStatus)
                                @case(1)
                                    <span class="badge bg-success">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Accepted
                                            </span>
                                    @break
                                @case(4)
                                    <span class="badge bg-info">
                                                <i class="bx bx-refresh bx-spin"></i>
                                               Pending Acceptance
                                            </span>
                                    @break
                                @default
                                    <span class="badge bg-danger">Declined</span>
                                    @break
                            @endswitch
                                </span>
                        <span class="d-block mb-2"><strong>Transport Fee:</strong>
                                    {{$booking->currency}}{{number_format($booking->transportFee,2)}}
                                </span>
                    @endif
                    @if($booking->approvedByEscort==1)
                        <span class="d-block mb-2"><strong>Delivery Status:</strong>
                                    @switch($booking->approvedByEscort)
                                @case(1)
                                    <span class="badge bg-success">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Approved By Escort
                                            </span>
                                    @break
                                @case(2)
                                    <span class="badge bg-info">
                                                <i class="bx bx-refresh bx-spin"></i>
                                               Pending Escort Approval
                                            </span>
                                    @break
                                @default
                                    <span class="badge bg-danger">Declined</span>
                                    @break
                            @endswitch
                                </span>
                        <span class="d-block mb-2"><strong>User Approval Status:</strong>
                                    @switch($booking->approvedByUser)
                                @case(1)
                                    <span class="badge bg-success">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Approved By User
                                            </span>
                                    @break
                                @case(2)
                                    <span class="badge bg-info">
                                                <i class="bx bx-refresh bx-spin"></i>
                                               Pending User Approval
                                            </span>
                                    @break
                            @endswitch
                                </span>
                        @if($booking->reported==1)
                            <span class="d-block mb-2"><strong>Report Status:</strong>
                                @switch($report->status)
                                    @case(1)
                                        <span class="badge bg-success">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Verdict Passed
                                            </span>
                                        @break
                                    @case(1)
                                        <span class="badge bg-primary">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Appealed By Escort
                                            </span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-info">
                                                <i class="bx bx-refresh bx-spin"></i>
                                               Awaiting Appeal
                                            </span>
                                        @break
                                @endswitch
                            </span>

                            <span class="d-block mb-2 mt-2">
                                <strong>Report Link:</strong>
                                <a href="{{route('user.bookings.report.detail',['id'=>$booking->reference])}}" class="primary-btn">View Report</a>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="invoice-table table-responsive mb-24">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Order Package</th>
                <th>Order Type</th>
                <th>Services</th>
                <th>Date Booked For</th>
                <th>Amount Paid</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>01</td>
                <td>
                    {{$injected->getOrderById($booking->orderId)->title}}
                </td>
                <td>
                    @switch($booking->orderType)
                        @case(1)
                            <span class="badge bg-info">Short-time</span>
                            @break
                        @case(1)
                            <span class="badge bg-dark">Overnight</span>
                            @break
                        @default
                            <span class="badge bg-primary">Weekend</span>
                            @break
                    @endswitch
                </td>
                <td class="text-end">
                    @php $services = explode(',',$package->services); @endphp
                    @foreach($services as $service)
                        <span class="badge bg-primary">
                                        {{$injected->getServiceById($service)->name}}
                                    </span>
                    @endforeach
                </td>
                <td class="text-end">
                    {{date('D, d M Y',$booking->bookDate)}}
                </td>
                <td class="text-end">
                    {{$booking->currency}}{{number_format($booking->amount,2)}}
                </td>
            </tr>

            </tbody>
        </table>
    </div>

    <div class="invoice-btn-box text-center row justify-content-center">
        @if($booking->status==2)
            <div class="col-md-6">
                <button data-bs-toggle="modal" data-bs-target="#cancelBookingUser" class="danger-btn mt-3">
                    <i class='bx bx-x-circle'></i> Cancel Booking
                </button>
            </div>
        @endif
        @if($booking->status==4)
            @if($booking->approvedByEscort==1)
                    <div class="acceptBooking col-md-6">
                        @if($booking->reported!=1)
                            <div id="countdown"></div>
                        @endif
                        <button data-bs-toggle="modal" data-bs-target="#userMarkDelivered" class="success-btn mt-3">
                            <i class='bx bx-check-circle'></i> Mark As Delivered
                        </button>
                    </div>
            @endif
            @if($booking->requestForTransport==1)
                @if($booking->transportStatus==4)
                        <div class="col-md-6">
                            <button data-bs-toggle="modal" data-bs-target="#approveEscortTransport" class="info-btn mt-3">
                                <i class='bx bx-train'></i> Approve Request for Transport Fee
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button data-bs-toggle="modal" data-bs-target="#rejectEscortTransport" class="warning-btn mt-3">
                                <i class='bx bx-x-circle'></i> Reject Request for Transport Fee
                            </button>
                        </div>
                @endif
            @endif
                <div class="col-md-6">
                    <button data-bs-toggle="modal" data-bs-target="#reportBookingUser" class="danger-btn mt-3">
                        <i class='bx bx-x-circle'></i> Report Booking
                    </button>
                </div>
        @endif
    </div>
</div>



@push('js')
    @include('dashboard.pages.booking.modal.user')
    <script src="{{asset('requests/dashboard/userBooking.js')}}"></script>
    <script>
        $(document).ready(function() {
            // Get the countdown timestamp from Blade variable
            var countdownTimestamp = {{ $booking->timeToApproveByClient }}; // Assuming $countdownTimestamp is in seconds
            // Convert the PHP timestamp to JavaScript Date object
            var countDownDate = new Date(countdownTimestamp * 1000); // Multiply by 1000 to convert seconds to milliseconds

            // Update the countdown every 1 second
            var x = setInterval(function() {
                // Get the current date and time
                var now = new Date().getTime();

                // Calculate the remaining time
                var distance = countDownDate - now;

                // Calculate days, hours, minutes, and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display the countdown in the element with id "countdown"
                document.getElementById("countdown").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                // If the countdown is over, hide the element with id "hiddenElement"
                if (distance < 0) {
                    clearInterval(x); // Stop the countdown
                    $('.acceptBooking').hide();
                }
            }, 1000); // Update every 1 second
        });
    </script>
@endpush
