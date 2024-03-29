<!doctype html>
<html lang="zxx">
<head>
    @include('staff.layout.css')
</head>

<body class="body-bg-f5f5f5">
@inject('option','App\Traits\Custom')
<!-- Start Preloader Area -->
<div class="preloader">
    <div class="content">
        <div class="box"></div>
    </div>
</div>
<!-- End Preloader Area -->
@include('staff.layout.menu')

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


                    <li class="nav-item dropdown profile-nav-item">
                        <a class="nav-link dropdown-toggle avatar" href="#" id="navbarDropdown-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{empty($user->photo)?'https://ui-avatars.com/api/?name='.$user->name.'&background=random&round=true':$user->photo}}"
                                 class="rounded-circle" alt="Images" style="width: 50px;">
                            <h3>{{$user->name}}</h3>
                            <span>
                                {{$option->fetchRole($user->role)->name??'N/A'}}
                            </span>
                        </a>

                        <div class="dropdown-menu">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="{{empty($user->photo)?'https://ui-avatars.com/api/?name='.$user->name.'&background=random&round=true':$user->photo}}"
                                         class="rounded-circle" alt="image" style="width: 100px;">
                                </div>

                                <div class="info text-center">
                                    <span class="name">{{$user->name}}</span>
                                    <p class="mb-3 email">
                                        ID:  <span data-clipboard-text="{{$user->reference}}" class="copy">{{$user->reference}}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{route('user.profile')}}" class="nav-link">
                                            <i class="ri-user-line"></i>
                                            <span>Profile</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{route('user.chats')}}" class="nav-link">
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

    <div class="mb-2 mt-3">
        <a href="javascript: history.go(-1)" class="btn default-btn"><i class="bx bx-arrow-to-left"></i> Go back</a>
    </div>

    <div class="page-title-area" style="margin-bottom: 0;">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6">
                    <div class="page-title">
                        <h6>{{$pageName}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <div class="flex-grow-1"></div>

    <div class="footer-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="copy-right">
                        <p>Copyright &copy; {{date('Y')}} {{$siteName}}.  </p>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="social-link">
                        <ul>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class="ri-facebook-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.twitter.com/" target="_blank">
                                    <i class="ri-twitter-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.youtube.com/" target="_blank">
                                    <i class="ri-youtube-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.vimeo.com/" target="_blank">
                                    <i class="ri-vimeo-fill"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <i class="ri-instagram-fill"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content Area -->

<!-- Start Go Top Area -->
<div class="go-top">
    <i class="ri-arrow-up-s-fill"></i>
    <i class="ri-arrow-up-s-fill"></i>
</div>
<!-- End Go Top Area -->


@include('staff.layout.js')

</body>
</html>
