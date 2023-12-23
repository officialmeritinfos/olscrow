@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    <div class="invoice-area">
        <div class="invoice-header mb-24 d-flex justify-content-between">
            <div class="invoice-left-text">
                <h3 class="mb-0">{{$siteName}}</h3>
                <p class="mt-2 mb-0">{!! $web->address !!}</p>
            </div>

            <div class="invoice-right-text">
                <h3 class="mb-0 text-uppercase">Report</h3>
            </div>
        </div>

        <div class="invoice-middle mb-24">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="text text-start">
                        <h4 class="mb-2">PLAINTIFF</h4>
                        <span class="d-block mb-2"><strong>Name:</strong> {{ucfirst($client->username)}}</span>
                        <span class="d-block mb-2"><strong>Tel:</strong> <a href="tel:{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($client->phone)}}">{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($client->phone)}}</a> </span>
                        <span class="d-block mb-2"><strong>Booking Location:</strong> {{$booking->location}}</span>
                        <span class="d-block">{{$booking->state}}, {{$injected->getCountryByCode($booking->country)->name}}</span>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="text text-start">
                        <h4 class="mb-2">DEFENDANT</h4>
                        <span class="d-block mb-2"><strong>Name:</strong> {{ucfirst($escort->username)}}</span>
                        <span class="d-block mb-2"><strong>Tel:</strong> <a href="tel:{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($escort->phone)}}">{{$injected->getCountryByCode($booking->country)->phonecode}}{{ucfirst($escort->phone)}}</a> </span>
                        <span class="d-block mb-2"><strong>Booking Location:</strong> {{$booking->location}}</span>
                        <span class="d-block">{{$booking->state}}, {{$injected->getCountryByCode($booking->country)->name}}</span>
                    </div>
                </div>


                <div class="col-lg-4 col-12">
                    <div class="text text-end">
                        <h4 class="mb-2">SUIT</h4>
                        <span class="d-block mb-2"><strong>SUIT ID:</strong> {{$report->reference}}</span>
                        <span class="d-block mb-2">{{date('D, d M Y H:i:s A',strtotime($report->created_at))}}</span>
                        <span class="d-block mb-2"><strong>Status:</strong>
                                @switch($report->status)
                                    @case(1)
                                        <span class="badge bg-success">
                                                <i class="ri-checkbox-circle-line"></i>
                                                Resolved
                                            </span>
                                        @break
                                    @case(2)
                                        <span class="badge bg-info">
                                                <i class="ri-stop-circle-fill"></i>
                                                Pending Appeal
                                            </span>
                                        @break
                                    @case(4)
                                        <span class="badge bg-primary">
                                                <i class="bx bx-refresh bx-spin"></i>
                                                Appealed - Awaiting Resolution by Parties
                                            </span>
                                        @break

                                    @case(5)
                                        <span class="badge bg-primary">
                                            <i class="bx bx-refresh bx-spin"></i>
                                            Customer Support Intervened
                                        </span>
                                        @break
                                    @default
                                        <span class="badge bg-danger">Cancelled</span>
                                        @break
                            @endswitch
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-table table-responsive mb-24">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Report</th>
                    <th>Report Message</th>
                    <th>Appeal Message</th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td>
                        {{$reportType->title}}
                    </td>
                    <td>
                        <span style="word-break: break-word;">
                            {{$report->reportDetail}}
                        </span>
                    </td>
                    <td>
                        @switch($report->appealed)
                            @case(1)
                                <span style="word-break: break-word;">
                                    {{$report->appealMessage}}
                                </span>
                                @break
                            @default
                                <span class="badge bg-primary">Pending Appeal</span>
                                @break
                        @endswitch
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <div class="invoice-btn-box text-center">
            @if($booking->appealed==1)
                <div class="acceptBooking">
                    <div id="countdown" class="badge bg-primary" style="font-size: 25px;"></div>
                </div>
            @endif
        </div>
    </div>

    @push('js')
        <script>
            $(document).ready(function() {
                // Get the countdown timestamp from Blade variable
                var countdownTimestamp = {{ $report->timeSupportIntervene }}; // Assuming $countdownTimestamp is in seconds
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
                    document.getElementById("countdown").innerHTML ="Time for support to join: "+ days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    // If the countdown is over, hide the element with id "hiddenElement"
                    if (distance < 0) {
                        clearInterval(x); // Stop the countdown
                        $('.acceptBooking').hide();
                    }
                }, 1000); // Update every 1 second
            });
        </script>
    @endpush


@endsection
