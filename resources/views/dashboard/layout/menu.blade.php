
<!-- Start Sidebar Area -->
<div class="side-menu-area">
    <div class="side-menu-logo bg-linear">
        <a href="{{route('user.dashboard')}}" class="navbar-brand d-flex align-items-center">
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
                <a href="{{route('user.dashboard')}}" class="box-style">
                    <i class="ri-dashboard-3-fill"></i>
                    <span class="menu-title">Overview</span>
                </a>
            </li>

            <li class="nav-item-title">APPS</li>

            <li>
                <a href="{{route('user.account')}}" class="box-style">
                    <i class="ri-money-dollar-box-line"></i>
                    <span class="menu-title">Account</span>
                </a>
            </li>
            @if($user->accountType==1)
                <li>
                    <a href="{{route('user.orders')}}" class="box-style">
                        <i class="ri-file-3-fill"></i>
                        <span class="menu-title">Orders</span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{{route('user.bookings')}}" class="box-style">
                    <i class="ri-book-2-fill"></i>
                    <span class="menu-title">Bookings</span>
                </a>
            </li>

            <li>
                <a href="chat" class="box-style">
                    <i class="ri-file-paper-2-fill"></i>
                    <span class="menu-title">Transactions</span>
                </a>
            </li>

            <li>
                <a href="chat" class="box-style">
                    <i class="ri-list-ordered"></i>
                    <span class="menu-title">Hall</span>
                </a>
            </li>

            <li>
                <a href="{{route('user.profile')}}" class="box-style">
                    <i class="ri-user-settings-fill"></i>
                    <span class="menu-title">Profile</span>
                </a>
            </li>
            <li>
                <a href="chat" class="box-style">
                    <i class="ri-chat-2-fill"></i>
                    <span class="menu-title">Chats</span>
                </a>
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
