@extends('dashboard.layout.base')
@section('content')
@inject('option','App\Traits\Custom')
<div class="container-fluid">
    <div class="text-center mt-3 mb-3">
        <button class="default-btn" data-bs-target="#addPayoutAccount" data-bs-toggle="modal">Add Payout Account</button>
    </div>
    <div class="latest-transaction-area">
        <div class="table-responsive h-auto" data-simplebar>
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">BANK</th>
                    <th scope="col">ACCOUNT NAME</th>
                    <th scope="col">ACCOUNT NUMBER</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">DATE ADDED</th>
                    <th scope="col"></th>

                </tr>
                </thead>
                <tbody class="searches">
                @foreach($option->userPayoutAccounts($user) as $bank)
                    <tr>
                        <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <span class="badge bg-primary">#{{$bank->reference}}</span>
                                </label>
                            </div>
                        </td>
                        <td>
                           {{$bank->bankName}}
                        </td>
                        <td>
                           {{$bank->accountName}}
                        </td>
                        <td>
                            {{$bank->accountNumber}}
                        </td>
                        <td>
                            @if($bank->status==1)
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
                            {{date('D, d M Y H:i:s',strtotime($bank->created_at))}}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-5">

            </div>
        </div>
    </div>
</div>

    @push('js')
        @include('dashboard.pages.profile.modal.payout_account')
        <script src="{{asset('requests/dashboard/sendOtp.js')}}"></script>
        <script src="{{asset('requests/dashboard/payoutAccount.js')}}"></script>
    @endpush
@endsection
