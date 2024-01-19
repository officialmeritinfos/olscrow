
<!-- Start Sidebar Area -->
<div class="side-menu-area">
    <div class="side-menu-logo bg-linear">
        <a href="{{route('staff.dashboard')}}" class="navbar-brand d-flex align-items-center">
            <img src="{{asset($web->logo)}}" alt="image">
            <span></span>
        </a>

        <div class="burger-menu d-none d-lg-block">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>

        <div class="responsive-burger-menu d-block d-lg-none">
            <span class="top-bar"></span>
            <span class="middle-bar"></span>
            <span class="bottom-bar"></span>
        </div>
    </div>

    <nav class="sidebar-nav" data-simplebar>
        <ul id="sidebar-menu" class="sidebar-menu">
            <li class="nav-item-title">MENU</li>
            <li>
                <a href="{{route('staff.dashboard')}}" class="box-style">
                    <i class="ri-dashboard-3-fill"></i>
                    <span class="menu-title">Overview</span>
                </a>
            </li>

            <li class="nav-item-title">APPS</li>

            <li>
                <a href="#" class="has-arrow box-style">
                    <i class="ri-user-2-line"></i>
                    <span class="menu-title">Users</span>
                </a>

                <ul class="sidemenu-nav-second-level">
                    <li>
                        <a href="{{route('staff.users.escorts')}}">
                            <span class="menu-title">Escorts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.users.clients')}}">
                            <span class="menu-title">Clients</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-arrow box-style">
                    <i class="ri-book-2-line"></i>
                    <span class="menu-title">Bookings</span>
                </a>

                <ul class="sidemenu-nav-second-level">
                    <li>
                        <a href="{{route('staff.bookings.ongoing')}}">
                            <span class="menu-title">Ongoing</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.bookings.completed')}}">
                            <span class="menu-title">Completed</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.bookings.pending')}}">
                            <span class="menu-title">Pending </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.bookings.reported')}}">
                            <span class="menu-title">Reported </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#" class="has-arrow box-style">
                    <i class="ri-money-dollar-circle-line"></i>
                    <span class="menu-title">Transactions</span>
                </a>

                <ul class="sidemenu-nav-second-level">
                    <li>
                        <a href="{{route('staff.transactions.subscriptions')}}">
                            <span class="menu-title">Subscriptions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.transactions.addons')}}">
                            <span class="menu-title">Addon Purchases </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.transactions.funding')}}">
                            <span class="menu-title">Account Funding </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.transactions.withdrawals')}}">
                            <span class="menu-title">Withdrawals </span>
                        </a>
                    </li>

                </ul>
            </li>

            @if($user->isAdmin)
                <li>
                    <a href="#" class="has-arrow box-style">
                        <i class="ri-bank-fill"></i>
                        <span class="menu-title">Staff</span>
                    </a>

                    <ul class="sidemenu-nav-second-level">
                        <li>
                            <a href="#">
                                <span class="menu-title">New Staff</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Staff List </span>
                            </a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="#" class="has-arrow box-style">
                        <i class="ri-settings-2-line"></i>
                        <span class="menu-title">Website Settings</span>
                    </a>

                    <ul class="sidemenu-nav-second-level">
                        <li>
                            <a href="#">
                                <span class="menu-title">General Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Supported Fiats </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Supported Countries </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Packages </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Report Types </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">FAQs </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="menu-title">Services </span>
                            </a>
                        </li>

                    </ul>
                </li>
            @endif

            <li>
                <a href="#" class="has-arrow box-style">
                    <i class="ri-bank-fill"></i>
                    <span class="menu-title">Escort Features</span>
                </a>

                <ul class="sidemenu-nav-second-level">
                    <li>
                        <a href="#">
                            <span class="menu-title">Escort Packages</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="menu-title">Features </span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="#" class="has-arrow box-style">
                    <i class="ri-shield-flash-fill"></i>
                    <span class="menu-title">Verifications</span>
                </a>

                <ul class="sidemenu-nav-second-level">
                    <li>
                        <a href="{{route('staff.verifications.pending')}}">
                            <span class="menu-title">Pending Verifications </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('staff.verifications.completed')}}">
                            <span class="menu-title">Completed Verifications </span>
                        </a>
                    </li>


                </ul>
            </li>

        </ul>


        <div class="dark-bar">
            <a href="#" class="d-flex align-items-center">
                <span class="dark-title">Enable Dark Theme</span>
            </a>

            <div class="form-check form-switch">
                <input type="checkbox" class="checkbox" id="darkSwitch">
            </div>
        </div>
    </nav>
</div>
<!-- End Sidebar Area -->
