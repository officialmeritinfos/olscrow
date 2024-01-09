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
                                    Welcome to {{$siteName}}, a platform where respect, professionalism, and positive interactions
                                    are paramount. To ensure a vibrant and safe community, please adhere to our community guidelines:
                                </p>
                            </div>
                            <h3 class="blog-title">Respectful Conduct</h3>
                            <p>
                                Approach every interaction with courtesy and respect, fostering a positive and welcoming atmosphere.
                            </p>
                            <p>
                                Discrimination, harassment, or any form of offensive behavior will not be tolerated.
                            </p>
                            <h3 class="blog-title">Professionalism</h3>
                            <p>
                                Escorts and users are expected to maintain a professional demeanor in all interactions.
                            </p>
                            <p>
                                Posting or sharing offensive, explicit, or inappropriate content is strictly prohibited e.g
                                Escorts must upload pictures with their body covered. Sharing of Nude contents are strictly
                                prohibited on {{$siteName}}.
                            </p>
                            <h3 class="blog-title">Communication Etiquette</h3>
                            <p>Respond promptly to messages and booking requests, maintaining open and respectful communication.</p>
                            <p>Respect the privacy and confidentiality of clients. Do not disclose personal information without consent.</p>
                            <h3 class="blog-title">
                                Trust and Transparency
                            </h3>
                            <p>
                                Provide accurate and honest information in profiles, ensuring transparency for clients.
                            </p>
                            <p>
                                Escorts and users are encouraged to communicate openly about expectations and preferences.
                            </p>
                            <h3 class="blog-title">Safety and Legal Compliance</h3>
                            <p>
                                Escorts must comply with all local laws and regulations while providing services.
                            </p>
                            <p>
                                Prioritize safety in all interactions. Report any concerns or suspicious activities promptly.
                            </p>
                            <h3 class="blog-title">Intellectual Property </h3>
                            <p>
                                Escorts retain the rights to their intellectual property. Unauthorized use of another escort's content is prohibited.
                            </p>
                            <h3 class="blog-title"> Dispute Resolution </h3>
                            <p>
                                Address disputes promptly and professionally. Escalate to {{$siteName}} support if resolution is challenging.
                            </p>
                            <p>
                                Accept resolutions reached by customer support after the designated timeframe for appeals.
                            </p>
                            <h3 class="blog-title">Code of Conduct</h3>
                            <p>
                                Escorts and users are expected to conduct themselves in a manner that upholds the integrity of the community.
                            </p>
                            <p>
                                Engaging in illegal activities on the platform is strictly prohibited.
                            </p>
                            <h3 class="blog-title">Reporting Violations</h3>
                            <p>
                                If you encounter inappropriate behavior, report it promptly to <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                            </p>
                            <p>
                                Deliberately false reports may result in penalties. Report only genuine concerns.
                            </p>
                            <h3 class="blog-title">Platform Usage</h3>
                            <p>
                                Escorts and users must adhere to the terms and conditions outlined by {{$siteName}}.
                            </p>
                            <p>
                                Complete profile verification processes as required for a trusted community.
                            </p>
                            <h3 class="blog-title">Consequences of Violations</h3>
                            <p>
                                Violations of community guidelines may result in penalties, suspension, or account termination.
                            </p>
                            <p>
                                Escorts and users have the right to appeal penalties within the designated timeframe.
                            </p>
                            <h3 class="blog-title">Ongoing Education</h3>
                            <p>
                                Keep yourself informed about updates to community guidelines and platform policies.
                            </p>
                            <p>
                                Embrace feedback and strive for continuous improvement in your interactions on {{$siteName}}.
                            </p>


                            <p>
                                Thank you for contributing to a positive and respectful community on {{$siteName}}. Together,
                                we create an environment where genuine connections thrive. If you have any questions or concerns,
                                contact us at <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
