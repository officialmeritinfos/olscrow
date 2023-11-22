
<!doctype html>
<html lang="zxx">
<head>
    @include('dashboard.layout.css')
</head>

<body class="body-bg-f5f5f5">
<!-- Start Preloader Area -->
<div class="preloader">
    <div class="content">
        <div class="box"></div>
    </div>
</div>
<!-- End Preloader Area -->
@include('dashboard.layout.menu')

<!-- Start Main Content Area -->
<div class="main-content d-flex flex-column">
    <div class="container-fluid">
        <nav class="navbar main-top-navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="responsive-burger-menu d-block d-lg-none">
                    <span class="top-bar"></span>
                    <span class="middle-bar"></span>
                    <span class="bottom-bar"></span>
                </div>




                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item">
                        <a href="#" class="nav-link ri-fullscreen-btn" id="fullscreen-button">
                            <i class="ri-fullscreen-line"></i>
                        </a>
                    </li>



                    <li class="nav-item notification-box messenger-list dropdown">
                        <div class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="notification-btn">
                                <i class="ri-messenger-line"></i>
                                <span class="badge">5</span>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <div class="dropdown-header d-flex justify-content-between align-items-center bg-linear">
                                <span class="title d-inline-block">5 New Message</span>
                                <span class="mark-all-btn d-inline-block">Clear All</span>
                            </div>

                            <div class="dropdown-body" data-simplebar>

                                <a href="chat" class="dropdown-item d-flex">
                                    <div class="icon">
                                        <img src="{{asset('dashboard/images/avatar.png')}}" alt="Images">
                                    </div>

                                    <div class="content">
                                        <span class="d-block">Alex Dew</span>
                                        <p class="m-0">Lorem ipsum dolor sit, amet consectetur</p>
                                        <p class="sub-text mb-0">2 sec ago</p>
                                    </div>
                                </a>


                            </div>

                            <div class="dropdown-footer">
                                <a href="chat" class="dropdown-item">View All</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item notification-box dropdown">
                        <div class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="notification-btn">
                                <i class="ri-notification-2-line"></i>
                                <span class="badge">6</span>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <div class="dropdown-header d-flex justify-content-between align-items-center bg-linear">
                                <span class="title d-inline-block">6 New Notifications</span>
                                <span class="mark-all-btn d-inline-block">Mark all as read</span>
                            </div>

                            <div class="dropdown-body" data-simplebar>

                                <a href="inbox" class="dropdown-item d-flex align-items-center">
                                    <div class="icon">
                                        <i class='bx bx-message-rounded-dots'></i>
                                    </div>

                                    <div class="content">
                                        <span class="d-block">Just sent a new message!</span>
                                        <p class="sub-text mb-0">2 sec ago</p>
                                    </div>
                                </a>

                            </div>

                            <div class="dropdown-footer">
                                <a href="inbox" class="dropdown-item">View All</a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown profile-nav-item">
                        <a class="nav-link dropdown-toggle avatar" href="#" id="navbarDropdown-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{$user->name}}&background=random&round=true"
                                 class="rounded-circle" alt="Images" style="width: 50px;">
                            <h3>{{$user->name}}</h3>
                            <span>
                                @switch($user->accountType)
                                    @case(1)
                                        Escort
                                    @break
                                    @default
                                        User
                                    @break
                                @endswitch
                            </span>
                        </a>

                        <div class="dropdown-menu">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="https://ui-avatars.com/api/?name={{$user->name}}&background=random&round=true"
                                         class="rounded-circle" alt="image">
                                </div>

                                <div class="info text-center">
                                    <span class="name">{{$user->name}}</span>
                                    <p class="mb-3 email">
                                        {{$user->reference}}
                                    </p>
                                </div>
                            </div>

                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="profile" class="nav-link">
                                            <i class="ri-user-line"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="chat" class="nav-link">
                                            <i class="ri-mail-send-line"></i>
                                            <span>My Inbox</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="dropdown-footer">
                                <ul class="profile-nav">
                                    <li class="nav-item">
                                        <a href="{{route('logout')}}" class="nav-link">
                                            <i class="ri-login-circle-line"></i>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>

                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="ri-settings-5-line"></i>
                        </a>
                    </li>
                    -->
                </ul>
            </div>
        </nav>
    </div>

    @yield('content')

</div>
<!-- End Main Content Area -->

    <!-- Start Go Top Area -->
    <div class="go-top">
        <i class="ri-arrow-up-s-fill"></i>
        <i class="ri-arrow-up-s-fill"></i>
    </div>
    <!-- End Go Top Area -->

   @include('dashboard.layout.js')
</body>
</html>
