<!DOCTYPE html>
<html>
<head><title>@yield('title')</title>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="apple-touch-icon" href="{{asset('assets/front/images/logo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/front/images/logo.png')}}">
    <link rel='stylesheet' href='{{asset('assets/front/font-awesome/css/font-awesome.min.css')}}'>
    <link rel='stylesheet' href='{{asset('assets/front/css/bootstrap.min.css')}}'>
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
        <img src="{{asset('assets/front/images/TOlogo.jpg')}}" alt="loader">
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
    <p class="wow fadeIn"><span><a class="cr" href="https://www.facebook.com/NoOneGiveShit" style="color: #701792;">Ebrahim Ashraf</a></span> - All Rights Reserved {{date('Y')}}.</p>
</section>
<!--end of copy-->
@yield('script')
<script src='{{asset('assets/front/js/jquery-1.12.1.min.js')}}'></script>
<script src='{{asset('assets/front/js/bootstrap.min.js')}}'></script>
<script src='{{asset('assets/front/js/preloader.js')}}'></script>
<script src='{{asset('assets/front/js/camera.js')}}'></script>
<script src='{{asset('assets/front/js/wow.min.js')}}'></script>
<script src='{{asset('assets/front/js/owl.carousel.min.js')}}'></script>
<script src='{{asset('assets/front/js/jquery.fancybox.min.js')}}'></script>
<script src='{{asset('assets/front/js/main.js')}}'></script>

</body>

</html>
