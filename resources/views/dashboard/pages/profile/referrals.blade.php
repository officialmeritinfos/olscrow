@extends('dashboard.layout.base')
@section('content')

    <div class="container-fluid">

        <div class="ui-kit-card mb-24">
            <h3>Referral Instruction</h3>
            <div class="alert alert-dark" role="alert">
                <h4 class="alert-heading">Refer & Earn!</h4>
                <p>
                    Thanks for taking interest in our Referral programme. As a disclaimer, {{$siteName}}
                    is not a brothel service neither do we offer dating services. Every Escort on our platform are independent
                    and do not work for us. As such, their safety and security is their responsibility. We are only a
                    platform that makes booking for their service simple, and stress-free, while allowing for the security of
                    their payments.
                </p>
                <hr>
                <p class="mb-0">
                    Refer an Escort to use our platform for their booking, and receive <b>{{$web->refBonus}}%</b> of our charge on their booking.
                    That means, for each booking they process successfully, and for which we charge, you earn <strong>{{$web->refBonus}}%</strong> of our
                    charge forever. This is not applicable to account funding and other payments.
                </p>
                <hr>
                <p class="mb-0">
                    Click the button below to copy your unique referral link.
                    <button class="btn btn-sm btn-info copy" data-clipboard-text="{{route('register',['ref'=>$user->username,'type'=>'referral'])}}"><i class="ri-file-copy-2-fill"></i></button>
                </p>
            </div>
        </div>

        <div class="order-details-area mb-5 mt-5">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <form class="search-bar d-flex">
                            <i class="ri-search-line"></i>
                            <input class="form-control search" type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>

                <div class="latest-transaction-area">
                    <div class="table-responsive" data-simplebar>
                        <table class="table align-middle mb-0">
                            <thead>
                            <tr>
                                <th scope="col">NAME</th>
                                <th scope="col">TYPE</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">ACCOUNT</th>
                                <th scope="col">DATE JOINED</th>
                            </tr>
                            </thead>
                            <tbody class="searches">
                            @foreach($referrals as $referral)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <span class="badge bg-primary">#{{$referral->username}}</span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        @if($referral->referralType==1)
                                            <span class="badge bg-success">
                                                Referral
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                Affiliate
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($referral->status==1)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($referral->emailVerified==1)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($referral->isVerified==1)
                                            <span class="badge bg-success">
                                                Verified
                                            </span>
                                        @elseif($referral->isVerified==4)
                                            <span class="badge bg-primary">
                                                Pending Review
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Unverified
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{date('D, d M Y H:i:s',strtotime($referral->created_at))}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-5">
                            {{$referrals->links()}}
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
