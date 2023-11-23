<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="author" content="{{$siteName}}"/>
<meta name="description" content="{{$web->description}}"/>
<meta name="keywords" content="{{$web->keywords}}">
<meta name="csrf-token" content="{{ csrf_token() }}"/>
<!-- Bootstrap Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.min.css')}}">
<!-- Owl Theme Default Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/owl.theme.default.min.css')}}">
<!-- Owl Carousel Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/owl.carousel.min.css')}}">
<!-- Animate Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/animate.min.css')}}">
<!-- Remixicon CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/remixicon.css')}}">
<!-- boxicons CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/boxicons.min.css')}}">
<!-- MetisMenu Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/metismenu.min.css')}}">
<!-- Simplebar Min CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/simplebar.min.css')}}">
<!-- Style CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
<!-- Dark Mode CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/dark-mode.css')}}">
<!-- Responsive CSS -->
<link rel="stylesheet" href="{{asset('dashboard/css/responsive.css')}}">

<link rel="stylesheet" href="{{asset('dashboard/vendors/summernote/summernote-bs5.css')}}">
<!-- Selectize -->
<link rel="stylesheet" href="{{asset('dashboard/css/selectize.bootstrap5.css')}}">
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{asset($web->favicon)}}">
<!-- Title -->
<title>{{$pageName}} - {{$siteName}}</title>
@include('genericCss')
@stack('css')
