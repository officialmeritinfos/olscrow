@extends('dashboard.layout.base')
@section('content')

    <div class="container-fluid" style="margin-bottom: 5rem;">

        @if($user->accountType==1)
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-shield-check-fill"></i> Escort Verification
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Manage your Identity Verification
                        </p>
                    </div>
                    <a href="{{route('user.verification')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-bank-card-2-fill"></i> Subscription
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Manage your subscriptions
                        </p>
                    </div>
                    <a href="{{route('user.subscription')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-global-fill"></i> Public Profile
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Manage information shown to the public
                        </p>
                    </div>
                    <a href="{{route('user.profile.public')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-user-5-fill"></i> Profile Setup
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Setup and manage your location & Profile
                        </p>
                    </div>
                    <a href="{{route('user.profile.location')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-gift-2-fill"></i> Profile Addons
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Manage Addons for your account
                        </p>
                    </div>
                    <a href="{{route('user.addons')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-gallery-fill"></i> Account Gallery
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Upload photos for your potential clients
                        </p>
                    </div>
                    <a href="{{route('user.gallery')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>


        @else
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-user-5-fill"></i> Profile Setup
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Setup and manage your location & Profile
                        </p>
                    </div>
                    <a href="{{route('user.profile.location')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>

            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-shield-check-fill"></i> User Verification
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Manage your Identity Verification
                        </p>
                    </div>
                    <a href="{{route('user.verification')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
        @endif
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-key-2-fill"></i> Account Security
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Secure your account
                        </p>
                    </div>
                    <a href="{{route('user.security')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-gift-2-fill"></i> Referrals
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Refer your colleagues/friends and earn 5% of our transaction charges on their successful bookings
                        </p>
                    </div>
                    <a href="{{route('user.referrals')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                    <div class="flex-grow-1 mb-3 mb-md-0">
                        <h5 class="card-title">
                            <i class="ri-bank-fill"></i> Payout Accounts
                        </h5>
                        <p class="card-text" style="word-break: break-word;">
                            Setup and manage your payout accounts.
                        </p>
                    </div>
                    <a href="{{route('user.payout-accounts')}}" class="btn btn-outline-primary rounded-pill btn-sm small-button">
                        Manage
                    </a>
                </div>
            </div>
    </div>

@endsection
