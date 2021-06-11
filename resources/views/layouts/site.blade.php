<!DOCTYPE html>
<html>
<head><title>@yield('title')</title>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="apple-touch-icon" href="{{asset('assets/front/images/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/front/images/logo.png')}}">
    <link rel='stylesheet' href='{{asset('assets/front/font-awesome/css/font-awesome.min.css')}}'>


    @if(Route::currentRouteName() == 'site.home'|| Route::currentRouteName() == 'site.product')
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
              integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu"
              crossorigin="anonymous">
    @else
        <link rel='stylesheet' href='{{asset('assets/front/css/bootstrap.min.css')}}'>
    @endif
    <link rel='stylesheet' href='{{asset('assets/front/css/owl.carousel.min.css')}}'>
    <link rel='stylesheet' href='{{asset('assets/front/css/jquery.fancybox.min.css')}}'>
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/camera.css')}}">
    <link rel='stylesheet' href='{{asset('assets/front/css/style.css')}}'>
    @yield('style')
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body {{LaravelLocalization::getCurrentLocale() == 'ar' ? 'dir=rtl' : 'dir=ltr'}}>


<div class="preloader-wrapper">
    <div class="preloader">
        <img src="{{asset('assets/front/images/logo.png')}}" alt="loader">
    </div>
</div>

@include('front.includes.alerts.success')
@include('front.includes.alerts.errors')
<!--start of Header-->
@include('front.includes.header')
<!--end of Header-->

{{--Start Content Here--}}
@yield('content')
{{--End Content Here--}}


<!--start of footer-->
@include('front.includes.footer')
<!--end of footer-->


<!--start of copy-->
<section class="copy text-center" dir="ltr">
    <p class="wow fadeIn"><span class="cr" style="color: #701792;">Techno One</span>
        - All Rights Reserved {{date('Y')}}.</p>
</section>
<!--end of copy-->

<script src='{{asset('assets/front/js/jquery-1.12.1.min.js')}}'></script>

@if(Route::currentRouteName() == 'site.home')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
            integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
            crossorigin="anonymous"></script>
@else
    <script src='{{asset('assets/front/js/bootstrap.min.js')}}'></script>
@endif

<script src='{{asset('assets/front/js/preloader.js')}}'></script>
<script src='{{asset('assets/front/js/camera.js')}}'></script>
<script src='{{asset('assets/front/js/wow.min.js')}}'></script>
<script src='{{asset('assets/front/js/owl.carousel.min.js')}}'></script>
<script src='{{asset('assets/front/js/jquery.fancybox.min.js')}}'></script>
<!--counter-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="{{asset('assets/front/js/jquery.counterup.min.js')}}"></script>
<!--/counter-->
@yield('script')
<script src='{{asset('assets/front/js/main.js')}}'></script>

</body>

</html>
