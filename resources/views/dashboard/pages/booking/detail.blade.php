@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    @if($user->accountType==1)
        @include('dashboard.pages.booking.escort_detail')
    @else
        @include('dashboard.pages.booking.user_detail')
    @endif


@endsection
