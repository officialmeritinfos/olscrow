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
                                    At {{$siteName}}, we are committed to fostering a platform that promotes transparency,
                                    responsibility, and respect. This page aims to address the issue of modern-day slavery
                                    and clarify our position as a platform where independent individuals connect, rather
                                    than an entity endorsing or overseeing the services provided.
                                </p>
                            </div>
                            <h3 class="blog-title">Independence of Escorts</h3>
                            <p>
                                <b>Independent Individuals</b>
                                Escorts featured on {{$siteName}} are independent individuals providing companionship services.
                                They do not work for {{$siteName}}, and we do not exert control over their actions.
                            </p>
                            <p>
                                <b>Platform, Not Employer</b>
                                {{$siteName}} serves as a platform for individuals to connect and render services. We do not
                                act as employers, and escorts operate as independent contractors.
                            </p>
                            <p>
                                <b>No Authorization of Services</b>
                                {{$siteName}} does not authorize or endorse specific services provided by escorts. Users and
                                escorts engage in independent agreements, and {{$siteName}} is not a party to these agreements.
                            </p>
                            <h3 class="blog-title">Liability and Responsibility</h3>
                            <p>
                                <b>Limited Liability</b>
                                {{$siteName}} is not liable for the actions, behaviors, or services provided by escorts on the
                                platform. We act solely as a medium for connecting individuals.
                            </p>
                            <p>
                                <b>Escorts' Sole Responsibility</b>
                                Escorts are responsible for their own actions and services. {{$siteName}} does not assume any
                                responsibility for the conduct or activities of escorts outside the platform.
                            </p>
                            <p>
                                <b>No Oversight of Activities</b>
                                {{$siteName}} does not have oversight or control over the day-to-day activities of escorts.
                                We do not monitor or regulate their services beyond the platform.
                            </p>
                            <h3 class="blog-title">Reporting Concerns</h3>
                            <p>
                                If users have concerns about potential inappropriate activities or violations, they are
                                encouraged to report them promptly to <a href="mailto:{{$web->email}}">{{$web->email}}</a>
                            </p>
                            <p>
                                Reports should be based on genuine concerns related to inappropriate behavior or potential
                                violations of community guidelines.
                            </p>
                            <h3 class="blog-title">
                                Modern-Day Slavery Awareness
                            </h3>
                            <p>
                                {{$siteName}} acknowledges the severity of modern-day slavery and is committed to raising
                                awareness about this global issue.
                            </p>
                            <p>
                                {{$siteName}} has a zero-tolerance policy for any form of exploitation, trafficking, or coerced
                                activities. Such behaviors violate our community guidelines.
                            </p>
                            <p>
                                {{$siteName}} actively collaborates with law enforcement agencies and other organizations to
                                address any instances of potential exploitation or human trafficking.
                            </p>
                            <h3 class="blog-title">Safety and Legal Compliance</h3>
                            <p>
                                Escorts must comply with all local laws and regulations while providing services.
                            </p>
                            <p>
                                Prioritize safety in all interactions. Report any concerns or suspicious activities promptly.
                            </p>
                            <h3 class="blog-title">Conclusion </h3>
                            <p>
                                {{$siteName}} is dedicated to maintaining a safe, transparent, and responsible platform. We urge
                                users to recognize the independence of escorts and understand our limited role as a connecting
                                platform. If you have any questions or concerns, feel free to contact us at
                                <a href="mailto:{{$web->email}}">{{$web->email}}</a>.
                                Together, let's contribute to a platform that values integrity, respect, and awareness.
                            </p>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
