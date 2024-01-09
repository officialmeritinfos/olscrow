@extends('home.base')
@section('content')
    @inject('injected','App\Traits\Custom')
    <div class="inner_banner-section">
        <img class="inner_banner-background-image" src="{{asset('home/image/common/inner-bg.png')}}" alt="image alt">
        <div class="container">
            <div class="inner_banner-content-block">
                <h3 class="inner_banner-title">{{$pageName}}</h3>
                <ul class="banner__page-navigator">
                    <li>
                        <a href="{{route('home.index')}}">Home</a>
                    </li>
                    <li class="active">
                        <a href="#">
                            {{$pageName}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="blog-details_main-wrapper section-padding-120">
            <div class="row">
                <div class="col-xl-12">
                    <div class="blog-content">

                        <div class="blog-content-wrapper">
                            <h3 class="blog-title">Terms and Conditions for Clients on {{$siteName}}</h3>

                            <p>
                                <strong>1. Account Usage:</strong>
                                <br>
                                <strong>1.1 Registration:</strong> Clients must register for an account to access {{$siteName}} services. Account information should be accurate and kept up-to-date.
                            </p>

                            <p>
                                <strong>2. Payment Terms:</strong>
                                <br>
                                <strong>2.1 Minimum Withdrawal:</strong>
                                Clients are subject to a minimum withdrawal amounts and charges as detailed below: <br/>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Currency</th>
                                        <th scope="col">Minimum Withdrawal</th>
                                        <th scope="col">Withdrawal Charge</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fiats as $fiat)
                                        <tr>
                                            <td>{{$fiat->code}}</td>
                                            <td>{{$fiat->minAmount}}</td>
                                            <td>{{$fiat->withdrawalFee}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                                <strong>2.2 Escort Transportation Fare:</strong> Clients are required to pay for the transportation fare if requested by the escort as part of the service agreement.
                            </p>

                            <p>
                                <strong>3. Booking and Cancellation:</strong>
                                <br>
                                <strong>3.1 Booking Process:</strong> Clients can browse and select escorts, send booking requests, and provide necessary details for a seamless experience.
                                <br>
                                <strong>3.2 Transportation Fare:</strong> Clients can agree or decline requests for transportation fare from escorts. Payment for transportation fare is a separate transaction.
                                <br>
                                <strong>3.3 Cancellation:</strong> Clients may cancel bookings within the designated timeframe for a refund. Late cancellations may incur penalties.
                                <br>
                                <strong>3.4 No-Show Policy:</strong> Clients are expected to show up for confirmed bookings. Failure to do so without proper communication may result in penalties.
                            </p>

                            <p>
                                <strong>4. Conduct and Communication:</strong>
                                <br>
                                <strong>4.1 Respectful Behavior:</strong> Clients are expected to treat escorts with respect and courtesy, maintaining a professional demeanor in all interactions.
                                <br>
                                <strong>4.2 Communication Etiquette:</strong> Timely and respectful communication is essential. Clients should provide clear expectations and preferences.
                                <br>
                                <strong>4.3 No Discrimination:</strong> Discrimination or harassment based on race, gender, religion, or any other criteria is strictly prohibited.
                            </p>

                            <p>
                                <strong>5. Liability and Responsibilities:</strong>
                                <br>
                                <strong>5.1 Limited Liability:</strong> {{$siteName}} is not liable for the conduct, actions, or services of escorts. Clients engage in independent agreements with escorts.
                                <br>
                                <strong>5.2 Escort Transportation:</strong> Clients are responsible for transportation fare and agree to pay if included as part of the service. {{$siteName}} is not responsible for disputes related to transportation fare.
                                <br>
                                <strong>5.3 Legal Compliance:</strong> Clients must comply with all local laws and regulations while using {{$siteName}} services.
                            </p>

                            <p>
                                <strong>6. Safety and Privacy:</strong>
                                <br>
                                <strong>6.1 Personal Safety:</strong> Clients should prioritize their personal safety and report any concerns or suspicious activities promptly.
                                <br>
                                <strong>6.2 Privacy:</strong> Clients must respect the privacy and confidentiality of escorts. Sharing personal information without consent is prohibited.
                            </p>

                            <p>
                                <strong>7. Reviews and Ratings:</strong>
                                <br>
                                <strong>7.1 Honest Feedback:</strong> Clients are encouraged to provide honest and constructive reviews based on their experiences with escorts.
                                <br>
                                <strong>7.2 No Defamatory Content:</strong> Posting defamatory or false content in reviews is strictly prohibited.
                            </p>

                            <p>
                                <strong>8. Termination of Services:</strong>
                                <br>
                                <strong>8.1 Violation Consequences:</strong> {{$siteName}} reserves the right to terminate services for clients who violate these terms and conditions. Termination may result from repeated policy violations or illegal activities.
                                <br>
                                <strong>8.2 Appeal Process:</strong> Clients have the right to appeal penalties within the designated timeframe.
                            </p>

                            <p>
                                <strong>9. Amendments to Terms and Conditions:</strong>
                                <br>
                                <strong>9.1 Stay Informed:</strong> Clients should stay informed about updates to terms and conditions. Continued use of the platform implies acceptance of the revised terms.
                            </p>

                            <p>
                                Thank you for being part of the {{$siteName}} community, where mutual respect, professionalism, and transparent interactions create meaningful connections.
                            </p>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
