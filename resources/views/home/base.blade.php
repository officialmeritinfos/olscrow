<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="color-scheme" content="dark light">
    <title>
        {{$siteName}}  - {{$pageName}}
    </title>
    <link rel="shortcut icon" href="{{asset($web->favicon)}}" type="image/x-icon">
    <!-- Plugin'stylesheets  -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/fonts/typography/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('home/fonts/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('home/plugins/aos/aos.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('home/plugins/fancybox/jquery.fancybox.min.css')}}">
    <!-- Vendor stylesheets  -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/demo.css')}}">
    <style>
        @import url('https://fonts.cdnfonts.com/css/clash-display');
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@500;600;700&amp;display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Public+Sans:wght@500;600;700;800;900&amp;display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Cabin:wght@500;600;700&amp;display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&amp;display=swap');
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&amp;display=swap');
        @import url('https://fonts.cdnfonts.com/css/clash-display');
    </style>
</head>

<body>
<div class="preloader-wrapper">
    <div class="lds-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<div class="page-wrapper overflow-hidden">
    <!--~~~~~~~~~~~~~~~~~~~~~~~~
     Header Area
 ~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <header class="site-header site-header--transparent">
        <div class="container">
            <nav class="navbar site-navbar">
                <!--~~~~~~~~~~~~~~~~~~~~~~~~
                  Brand Logo
              ~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div class="brand-logo">
                    <a href="{{route('home.index')}}">
                        <!-- light version logo (logo must be black)-->
                        <img class="logo-light" src="{{asset($web->logo)}}" alt="brand logo">
                        <!-- Dark version logo (logo must be White)-->
                    </a>
                </div>
                <div class="menu-block-wrapper ">
                    <div class="menu-overlay"></div>
                    <nav class="menu-block" id="append-menu-header">
                        <div class="mobile-menu-head">
                            <a href="{{route('home.index')}}">
                                <img src="{{asset($web->logo2)}}" alt="brand logo">
                            </a>
                            <div class="current-menu-title"></div>
                            <div class="mobile-menu-close">&times;</div>
                        </div>
                        <ul class="site-menu-main">

                            <li class="nav-item">
                                <a href="{{route('home.index')}}" class="nav-link-item drop-trigger">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('home.about')}}" class="nav-link-item drop-trigger">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('home.howItWorks')}}" class="nav-link-item drop-trigger">How It Works</a>
                            </li>
                            <li class="nav-item nav-item-has-children">
                                <a href="#" class="nav-link-item drop-trigger">Pages<i class="fas fa-angle-down"></i>
                                </a>
                                <div class="sub-menu" id="submenu-3">
                                    <ul class="sub-menu_list">

                                        <li class="sub-menu_item">
                                            <a href="{{route('legal.escort.terms')}}">
                                                <span class="menu-item-text">Escort Terms</span>
                                            </a>
                                        </li>
                                        <li class="sub-menu_item">
                                            <a href="{{route('legal.client.terms')}}">
                                                <span class="menu-item-text">Client Terms</span>
                                            </a>
                                        </li>
                                        <li class="sub-menu_item">
                                            <a href="{{route('home.escort.guide')}}">
                                                <span class="menu-item-text">Escort Guide</span>
                                            </a>
                                        </li>
                                        <li class="sub-menu_item">
                                            <a href="{{route('home.faq')}}">
                                                <span class="menu-item-text">FAQs</span>
                                            </a>
                                        </li>

                                        <li class="sub-menu_item nav-item-has-children child-item">
                                            <a class="sub-menu__item-link">
                                                <span class="menu-item-text">Account</span>
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                            <div class="sub-menu child-sub" id="submenu-10">
                                                <ul class="sub-menu_list">
                                                    <li class="sub-menu_item">
                                                        <a href="{{route('login')}}">
                                                            <span class="menu-item-text">Sign In</span>
                                                        </a>
                                                    </li>
                                                    <li class="sub-menu_item">
                                                        <a href="{{route('register')}}">
                                                            <span class="menu-item-text">Sign Up</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('home.contact')}}" class="nav-link-item drop-trigger">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~
                mobile menu trigger
               ~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div class="mobile-menu-trigger">
                    <span></span>
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~
                  Mobile Menu Hamburger Ends
                ~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div class="header-cta-btn-wrapper">
                    <a href="{{route('login')}}" class="btn-masco btn-masco--header btn-masco--header-secondary">
                        <span>Login</span>
                    </a>
                    <a href="{{route('register')}}" class="btn-masco btn-masco--header   btn-secondary-l02 btn-fill--up">
                        <span>Sign up</span></a>
                </div>
            </nav>
        </div>
    </header>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~
     navbar-
    ~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    @yield('content')

    <!--~~~~~~~~~~~~~~~~~~~~~~~~
     Home 2 : CTA
~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <section class="cta-home-2 section-padding-100">
        <div class="container">
            <div class="cta-home-2-shape-wrapper">
                <div class="cta-home-2-shape-1">
                    <img src="{{asset('home/image/home-2/cta-shape-1.svg')}}" alt="image alt">
                </div>
                <div class="cta-home-2-shape-2">
                    <img src="{{asset('home/image/home-2/cta-shape-2.svg')}}" alt="image alt">
                </div>
            </div>
            <div class="cta-content-block">
                <h2 class="cta-home-2__title heading-md text-white">Sign up today and find the perfect escort for your satisfaction.</h2>
                <a href="{{route('register')}}" class="btn-masco btn-secondary-l02 btn-fill--up">
                    <span>Get started for free</span></a>
            </div>
        </div>
    </section>
    <div class="footer-v2 footer-padding-default footer-l02">
        <div class="container">
            <div class="row row--footer-main">
                <div class="col-md-6 col-lg-5 col-xl-auto">
                    <div class="footer-v2__content-block">
                        <div class="footer-v2__content-text">
                            <div class="footer-brand">
                                <img src="{{asset($web->logo)}}" alt="image alt">
                            </div>
                            <p>
                                Club, Professional meeting, massages etc an all-in-one platform to find the perfect
                                companion you need - whether for the night, weekend or as you desire.
                            </p>
                        </div>
                        <ul class="list-social list-social--hvr-black">
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa-brands fa-github"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-auto">
                    <div class="footer-v2__list-block">
                        <div class="row row--list-block">
                            <div class="col-auto col-md-3 col-lg-auto col-xl-auto">
                                <h3 class="footer-title">Primary Pages</h3>
                                <ul class="footer-list">
                                    <li>
                                        <a href="{{route('home.about')}}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.howItWorks')}}">How it Works</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.faq')}}">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.contact')}}">Contact</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto col-md-3 col-lg-auto col-xl-auto">
                                <h3 class="footer-title">Utility pages</h3>
                                <ul class="footer-list">
                                    <li>
                                        <a href="{{route('register')}}">Registration Page</a>
                                    </li>
                                    <li>
                                        <a href="{{route('login')}}"> Login Page</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.pricing')}}"> Pricing</a>
                                    </li>
                                    <li>
                                        <a href="{{route('recoverPassword')}}"> Account Recovery</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto col-md-3 col-lg-auto col-xl-auto">
                                <h3 class="footer-title">Resources</h3>
                                <ul class="footer-list">
                                    <li>
                                        <a href="{{route('legal.reports')}}">Supported Reports</a>
                                    </li>
                                    <li>
                                        <a href="{{route('legal.privacy')}}"> Privacy policy</a>
                                    </li>
                                    <li>
                                        <a href="{{route('legal.escort.terms')}}"> Escorts Terms & Conditions</a>
                                    </li>
                                    <li>
                                        <a href="{{route('legal.client.terms')}}"> Clients Terms & Conditions</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto col-md-3 col-lg-auto col-xl-auto">
                                <h3 class="footer-title">Download now</h3>
                                <div class="footer-store-buttons">
                                    <a href="#">
                                        <img src="{{asset('home/image/common/app-store.png')}}" alt="image alt">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('home/image/common/play-store.png')}}" alt="image alt">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-block">
            <div class="container">
                <div class="copyright-inner text-center  copyright-border">
                    <p>© Copyright {{date('Y')}}, All Rights Reserved by {{$siteName}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor Scripts -->
<script src="{{asset('home/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('home/plugins/jquery/jquery-migrate.min.js')}}"></script>
<script src="{{asset('home/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- Plugin's Scripts -->
<script src="{{asset('home/plugins/inlineSvg/inlineSvg.min.js')}}"></script>
<script src="{{asset('home/plugins/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('home/plugins/aos/aos.min.js')}}"></script>
<script src="{{asset('home/plugins/isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('home/plugins/isotope/packery.pkgd.min.js')}}"></script>
<script src="{{asset('home/plugins/isotope/image.loaded.js')}}"></script>
<script src="{{asset('home/plugins/slick/slick.min.js')}}"></script>
<script src="{{asset('home/plugins/countdown/jquery.countdown.js')}}" defer></script>
<script src="{{asset('home/js/menu.js')}}"></script>
<script src="{{asset('home/js/custom.js')}}"></script>
<!-- Activation Script -->
</body>
</html>
