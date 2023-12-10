@extends('dashboard.layout.base')
@section('content')
    @inject('injected','App\Traits\Custom')

    @if($user->accountType==1)


    @else


    @endif


@endsection
