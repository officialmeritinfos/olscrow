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
                            <div class="service-details_main-single">
                                <h3 class="service-details_main-title">Introduction</h3>
                                <p>
                                    Welcome to {{$siteName}}, where genuine connections meet professionalism. As an independent
                                    escort on our platform, it's crucial to understand and adhere to the following terms and conditions:
                                </p>
                            </div>
                            <h3 class="blog-title">1.0 Balances and Payments</h3>
                            <p><b>1.1 Main Balance</b></p>
                            <ul>
                                <li>Escorts can withdraw funds from their Main Balance.</li>
                                <li>
                                    For minimum Withdrawal and withdrawal charge, please see the table below:
                                </li>
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
                                <p>
                                    You accept the above fee and agree to be charged them upon each withdrawal.
                                </p>
                                <li>Only funds in Main Balance can be withdrawn</li>
                            </ul>

                            <h3 class="blog-title">1.2 Transport Balance</h3>
                            <p>
                                Transport Balances are held pending the completion of a booking
                            </p>
                            <p>
                                Clients may turn down requests for transportation fare.
                            </p>
                            <h3 class="blog-title">1.3 Penalty Balance</h3>
                            <p>
                                Penalty Balances are for payment of penalties incurred due to policy violations.
                            </p>
                            <p>
                                Penalties are deducted directly from the Penalty Balance.
                            </p>
                            <h3 class="blog-title">
                                1.4 Subscription Balance
                            </h3>
                            <p>
                                Subscription Balances are used for funding subscription plans.
                            </p>
                            <p>
                                Non-refundable, as they contribute to access premium features.
                            </p>
                            <h3 class="blog-title">2. Independent Contractor Status:</h3>
                            <p>
                                Escorts are independent contractors, not employees of {{$siteName}}.
                            </p>
                            <p>
                                Escorts are solely responsible for their taxes and legal obligations.
                            </p>
                            <h3 class="blog-title">3. Responsibilities and Cancellations:</h3>
                            <h3 class="blog-title">3.1 Failure to Meet Clients:</h3>
                            <p>
                                Escorts are responsible for fulfilling confirmed bookings.
                            </p>
                            <p>
                                Failure to meet clients without justifiable reasons may result in penalties.
                            </p>
                            <h3 class="blog-title"> 3.2 Booking Cancellations: </h3>
                            <p>
                                Escorts must adhere to their booking commitments.
                            </p>
                            <p>
                                Excessive cancellations may impact ranking on the platform.
                            </p>
                            <h3 class="blog-title">3.3 Client Cancellations:</h3>
                            <p>
                                If a client cancels a booking within the designated timeframe, the booking is automatically refunded.
                            </p>
                            <p>
                                Escorts are urged to respond promptly to booking requests.
                            </p>
                            <h3 class="blog-title">4. Disclaimers and Appeals:</h3>
                            <p>
                                Escorts are independent individuals; {{$siteName}} is not responsible for their actions.
                            </p>
                            <p>
                                Escorts are urged to appeal reported bookings within the designated timeframe.
                            </p>
                            <p>
                                After the timeframe, customer support may intervene, and the resolution reached will be final.
                            </p>
                            <h3 class="blog-title">5. Transport Fares</h3>
                            <p>
                                Transport fares paid by clients are held in the Transport Balance until service delivery.
                            </p>
                            <p>
                                Clients can turn down requests for transportation fare.
                            </p>
                            <p>
                                Escorts are required to adhere to confirmed bookings or face penalties.
                            </p>
                            <h3 class="blog-title">6. Ranking System</h3>
                            <p>
                                Too many cancellations may affect an escort's ranking on the platform.
                            </p>
                            <p>
                                Escorts are encouraged to maintain a high level of professionalism.
                            </p>
                            <h3 class="blog-title">7. Ratings and Reviews</h3>
                            <p>
                                Escorts may receive ratings and reviews from clients based on their experiences.
                            </p>
                            <p>
                                Honest and constructive feedback is encouraged to maintain a transparent community.
                            </p>
                            <h3 class="blog-title">8. Code of Conduct</h3>
                            <p>
                                Escorts are expected to conduct themselves professionally, respecting clients and fellow escorts.
                            </p>
                            <p>
                                Discriminatory, offensive, or inappropriate behavior is strictly prohibited.
                            </p>
                            <h3 class="blog-title">9. Communication Etiquette</h3>
                            <p>
                                Escorts are required to communicate respectfully and promptly with clients.
                            </p>
                            <p>
                                Prompt responses to messages and booking requests are essential for a positive user experience.
                            </p>
                            <h3 class="blog-title">10. Confidentiality</h3>
                            <p>
                                Escorts must respect the privacy and confidentiality of clients.
                            </p>
                            <p>
                                Sharing personal information or violating client confidentiality may result in penalties.
                            </p>
                            <h3 class="blog-title">11. Intellectual Property</h3>
                            <p>
                                Escorts retain the rights to their intellectual property, including images and profile content.
                            </p>
                            <p>
                                Unauthorized use or reproduction of another escort's content is strictly prohibited.
                            </p>
                            <h3 class="blog-title">12. Legal Compliance</h3>
                            <p>
                                Escorts must comply with all local laws and regulations while providing services.
                            </p>
                            <p>
                                Any illegal activities or violation of laws may lead to account suspension or termination.
                            </p>
                            <h3 class="blog-title">13. Account Security</h3>
                            <p>
                                Escorts are responsible for maintaining the security of their accounts, including passwords.
                            </p>
                            <p>
                                Report any suspicious activity promptly to <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                            </p>
                            <h3 class="blog-title">14. Platform Usage Guidelines</h3>
                            <p>
                                Escorts must adhere to {{$siteName}}'s community guidelines, which govern behavior on the platform.
                            </p>
                            <p>
                                Violation of guidelines may result in penalties, suspension, or account termination.
                            </p>
                            <h3 class="blog-title">15. Termination of Services</h3>
                            <p>
                                {{$siteName}} reserves the right to terminate services for escorts who violate these terms and conditions.
                            </p>
                            <p>
                                Termination may result from repeated policy violations, illegal activities, or breaches of trust.
                            </p>
                            <h3 class="blog-title">16. Amendments to Terms and Conditions</h3>
                            <p>
                                {{$siteName}} reserves the right to update or modify these terms and conditions at any time.
                            </p>
                            <p>
                                Escorts will be notified of changes, and continued use of the platform implies acceptance of the revised terms.
                            </p>
                            <h3 class="blog-title">17. Governing Law</h3>
                            <p>
                                These terms and conditions are governed by the laws of the State of Delaware, without regard
                                to its conflict of law principles.
                            </p>


                            <p>
                                By continuing to use {{$siteName}}, you acknowledge and agree to these additional terms and conditions.
                                It is the responsibility of escorts to stay informed about updates and changes. If you have any
                                questions or concerns, please contact us at <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
