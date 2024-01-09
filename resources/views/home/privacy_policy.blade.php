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
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~
        Service Details main Section
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div class="service-details_main-section section-padding-120">
        <div class="row justify-content-center ">
            <div class="col-lg-8">
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">Introduction</h3>
                    <p>
                        Welcome to {{$siteName}}, your trusted platform for genuine connections. Our Privacy Policy is designed
                        to inform you about the information we collect, how we collect it, and how we use and protect your data.
                        By using {{$siteName}}, you agree to the terms outlined in this policy.
                    </p>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">Information We Collect</h3>
                    <ul class="service-details_main-list">
                        <li>
                            <span>1. Registration Information</span>
                            <p>
                                When you create an account, we collect your basic details, including your name, email address,
                                and preferred account type (User or Escort).
                            </p>
                        </li>
                        <li>
                            <span>2. Identity Verification (KYC)</span>
                            <p>
                                To ensure a secure community, we may collect additional information for Know Your Customer
                                (KYC) verification, including government-issued identification.
                            </p>
                        </li>
                        <li>
                            <span>3. Profile Information</span>
                            <p>
                                Escorts can provide additional details, such as personality traits, services offered,
                                and unique attributes. Users may also customize their profiles.
                            </p>
                        </li>
                        <li>
                            <span>4. Location Information</span>
                            <p>
                                Escorts can set their location for more accurate connections. Users may share location
                                data for enhanced features.
                            </p>
                        </li>
                        <li>
                            <span>5. Communication Data</span>
                            <p>
                                We collect information exchanged through our messaging feature to facilitate communication between users and escorts.
                            </p>
                        </li>
                        <li>
                            <span>6. Device Information</span>
                            <p>
                                We may collect device information, including IP address, browser type, and operating
                                system, to improve our platform's performance and security.
                            </p>
                        </li>
                        <li>
                            <span>7. Cookies and Tracking Technologies</span>
                            <p>
                                {{$siteName}} uses cookies and similar technologies to enhance user experience, personalize
                                content, and analyze site traffic. You can manage cookie preferences in your browser settings.
                            </p>
                        </li>

                    </ul>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">How We Collect Information</h3>
                    <ul class="service-details_main-list">
                        <li>
                            <span>1. Directly from You</span>
                            <p>
                                Information is collected when you register, create a profile, and interact with our platform.
                            </p>
                        </li>
                        <li>
                            <span>2. Automated Technologies</span>
                            <p>
                                We use automated technologies, including cookies and tracking tools, to collect information
                                about your interactions with our platform.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">How We Store and Protect Information</h3>
                    <ul class="service-details_main-list">
                        <li>
                            <span>1. Data Security</span>
                            <p>
                                We employ industry-standard security measures to protect your information from unauthorized
                                access, disclosure, alteration, or destruction.
                            </p>
                        </li>
                        <li>
                            <span>2. Third-Party Services</span>
                            <p>
                                While we strive to protect your data, we cannot guarantee the security of information
                                transmitted to or from third-party services linked on our platform. Use caution and
                                review their privacy policies.
                            </p>
                        </li>
                        <li>
                            <span>3. Data Retention</span>
                            <p>
                                We retain your information for as long as necessary to provide our services and comply
                                with legal obligations. You can request data deletion through your account settings.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">How We Use Information</h3>
                    <ul class="service-details_main-list">
                        <li>
                            <span>1. Providing Services</span>
                            <p>
                                Your information is used to deliver and enhance our services, facilitate connections, and
                                ensure a seamless user experience.
                            </p>
                        </li>
                        <li>
                            <span>2. Communications</span>
                            <p>
                                We may use your contact information to send updates, newsletters, and relevant communications.
                                You can opt out of non-essential communications.
                            </p>
                        </li>
                        <li>
                            <span>3. Legal Compliance</span>
                            <p>
                                We may use and disclose your information as required by law or in response to legal requests.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">Your Choices and Rights</h3>
                    <ul class="service-details_main-list">
                        <li>
                            <span>1. Access and Control</span>
                            <p>
                                You can access, or update your account information through your account settings. To delete your
                                account, please contact support
                            </p>
                        </li>
                        <li>
                            <span>2. Cookies</span>
                            <p>
                                ou can manage cookie preferences through your browser settings. Note that disabling
                                cookies may impact certain features.
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="service-details_main-single">
                    <h3 class="service-details_main-title">Updates to Privacy Policy</h3>
                    <p>
                        We may update our Privacy Policy to reflect changes in our practices or legal requirements.
                        Check this page regularly for updates.
                    </p>
                    <p>
                        For any questions or concerns regarding our Privacy Policy, contact us at <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
