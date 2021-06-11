@extends('layouts.site')
@section('title')
    Home
@endsection
@section('style')

@stop
@section('content')
    <a href="#section2">
        <div id="scroll-down">
        </div>
    </a>

    {{--    <!--start of slider-->--}}
    {{--    <section id="home-slider" class="owlCarousel" dir="ltr">--}}

    {{--        <!-- Start Single Slide Item Here -->--}}
    {{--        @foreach($images as $image)--}}
    {{--            <div class="single-slide-item"--}}
    {{--                 style="background-image: url('{{$image->photo}}');background-size: cover;background-position: center;">--}}
    {{--                <div class="container">--}}
    {{--                    <div class="row align-items-center">--}}
    {{--                        <div class="col-md-6" dir="rtl">--}}
    {{--                            <h2></h2>--}}

    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        @endforeach--}}


    {{--    </section>--}}

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-inner" role="listbox">
            @foreach($images as $image)
                <div class="item {{$firstImage->id == $image->id ? 'active' : ''}}">
                    <img class="first-slide" style="width: 100%; height: 100vh" src="{{$image->photo}}"
                         alt="First slide">
                </div>
            @endforeach
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>








    {{--        <div class="camera_prev" style="background-color: red"><span></span></div>--}}



    {{--                <a class="ct-btn-scroll ct-js-btn-scroll" href="#section2">--}}
    {{--                    <img class="down-arrow" alt="Arrow Down Icon" src="{{asset('assets/front/images/logo.png')}}"></a>--}}
    <!--end of slider-->




    {{-- Start  contact-us--}}
    <section class="contact">
        <div class="container">
            <div class="row wow">
                <div class="col-sm-4 hidden-xs text-center">
                    <a href="{{route('site.contacts')}}">
                        <button> {{__('messages.home.contact')}}</button>
                    </a>
                </div>
                <div class="col-sm-8 col-xs-12 wow fadeIn small-contact-div">
                    <h2>{{__('messages.home.quality')}}</h2>
                    <a href="{{route('site.contacts')}}" class="visible-xs col-sm-4">
                        <button>{{__('messages.home.contact')}}</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    {{-- End  contact-us--}}



    <!--start of about-->
    <section class="about-us" id="section2">
        <div class="container">
            @foreach ($sections as $section)
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h2 class="wow fadeIn">{{$section->title}}</h2>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 5px">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="about-data wow">
                        @if(LaravelLocalization::getCurrentLocale() == 'en')
                            <div class="col-md-6 col-xs-12 col-sm-12 text-center" style="margin: 10px 0px;">
                                <p class="wow fadeIn"  style="font-size: 18px">
                                    {{$section->large_p}}
                                </p>
                            </div>
                            <div class="about-img col-md-6 col-xs-12 col-sm-12 text-center fadeIn"
                                 style="margin: 10px 0px;">
                                @if(str_ends_with($section->photo, 'g'))
                                    <img src="{{$section->photo}}" class="img-responsive" height="400" width="400">
                                @endif
                            </div>
                        @else
                            <div class="about-img col-md-6 col-xs-12 col-sm-12 text-center fadeIn"
                                 style="margin: 10px 0;">
                                @if(str_ends_with($section->photo, 'g'))
                                    <img src="{{$section->photo}}" class="" height="400" width="400">
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12 col-sm-12 text-center" style="margin: 10px 0px;">
                                <p class="wow fadeIn"  style="font-size: 18px">
                                    {{$section->large_p}}
                                </p>
                            </div>
                        @endif


                    </div>
                    @endforeach


                </div>
                <div class="line">

                </div>
        </div>
    </section>
    <!--end of about-->


    <!-- Service Side  wisely -->
{{--    <section style="background-image: url({{asset('assets/front/images/bgbgbg.jpg')}}); background-repeat: no-repeat; background-size: 100% 100%">--}}
    <section>
        <div class="container" id="services_sec">
            <div class="row" style="margin-top: 50px">

                @if(isset($ads))
                    @foreach($ads as $key => $ad)
                        @if ($key % 3 == 0)
            <div class="row">
                @endif
                        <div class="service_side wow fadeIn col-md-4 col-sm-12 col-xs-12" data-wow-duration="2s">
                            <div id="{{'services_item_'. $ad->id}}" class="single_service"
                                 style="background-image: url({{$ad->photo}})">
                                <div class="service_content">
                                    <div id={{'on_off_'. $ad->id}} class="open_close">

                                        <div style="margin-top: 22px">
                                        <span class="service_s">
                                            {{$ad->title}}
                                        </span>
                                        </div>
                                        <div id={{'service_more_'.$ad->id}} class="show_more">
                                            <p class="co_p">{{$ad->content}},
                                                @if($ad->product_id != null)
                                                    <a href="{{route('site.product', $ad->product_id)}}">
                                                        read more
                                                    </a>
                                                @elseif($ad->offer_id != null)
                                                    <a href="{{route('site.offer', $ad->offer_id)}}">
                                                        read more
                                                    </a>
                                                @endif
                                            </p>

                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                        @if ($key % 3 == 2)
</div>
                        @endif

                    @endforeach
                @endif


            </div>
            <div class="line">

            </div>

        </div>
    </section>
    <!-- //Service Side wisely -->



    <!--start of about-->
    <section class="about-us">
        <div class="container">
            @foreach ($sections_2 as $section)
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h2 class="wow fadeIn">{{$section->title}}</h2>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 5px">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="about-data wow">
                        @if(LaravelLocalization::getCurrentLocale() == 'en')
                            <div class="col-md-6 col-xs-12 col-sm-12 text-center" style="margin: 10px 0px;">
                                <p class="wow fadeIn"  style="font-size: 18px">
                                    {{$section->content}}
                                </p>
                            </div>
                            <div class="about-img col-md-6 col-xs-12 col-sm-12 text-center fadeIn"
                                 style="margin: 10px 0px;">
                                @if(str_ends_with($section->photo, 'g'))
                                    <img src="{{$section->photo}}" class="img-responsive" height="400" width="400">
                                @endif
                            </div>
                        @else
                            <div class="about-img col-md-6 col-xs-12 col-sm-12 text-center fadeIn"
                                 style="margin: 10px 0;">
                                @if(str_ends_with($section->photo, 'g'))
                                    <img src="{{$section->photo}}" class="" height="400" width="400">
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12 col-sm-12 text-center" style="margin: 10px 0px;">
                                <p class="wow fadeIn"  style="font-size: 18px">
                                    {{$section->content}}
                                </p>
                            </div>
                        @endif


                    </div>
                    @endforeach


                </div>

        </div>
    </section>
    <!--end of about-->



    {{-- Start some of our success Counter--}}
    <section class="facts" id="fun_facts"
             style="background-repeat:repeat;background-image: url({{asset('assets/front/images/city.jpg')}});">

        <div class="parallay-overlay">
            <div class="container">
                <div class="row">
                    <div class="wow slideIn" style="margin-bottom: -42px">
                        <div class="text-center">
                            <h2 class="facts_h text-center">
                                Some Success
                            </h2>

                            {{--                            line  Here--}}
                            <div class="line2" style="margin-top: 10px; width: 270px">
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!--Start Counter one -->

                    <div class="col-md-3 col-xs-12 text-center wow fadeIn" data-wow-duration="500ms"
                         data-wow-delay="500ms">
                        <div class="counters-item">
                            <br><br>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <br>
                            <br>
                            <br>
                            <br>
                            <strong class="counter">24</strong>
                            <br>
                            <br>
                            <p class="count_p">Hours Work Per Day</p>
                        </div>
                    </div>

                    <!--End Counter one -->

                    <!--Start Counter two-->

                    <div class="col-md-3 col-xs-12 text-center wow fadeIn" data-wow-duration="500ms"
                         data-wow-delay="500ms">
                        <div class="counters-item">
                            <br><br>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <br>
                            <br>
                            <br>
                            <br>
                            <strong class="counter">500</strong>
                            <br>
                            <br>
                            <p class="count_p">Satisfied Clients</p>
                        </div>
                    </div>

                    <!--End Counter two-->

                    <!--Start Counter three-->

                    <div class="col-md-3 col-xs-12 text-center wow fadeIn" data-wow-duration="500ms"
                         data-wow-delay="500ms">
                        <div class="counters-item">
                            <br><br>
                            <i class="fa fa-rocket" aria-hidden="true"></i>
                            <br>
                            <br>
                            <br>
                            <br>
                            <strong class="counter">5000</strong>
                            <br>
                            <br>
                            <p class="count_p">Done Projects</p>
                        </div>
                    </div>

                    <!--End Counter three-->

                    <!--Start Counter four-->

                    <div class="col-md-3 col-xs-12 text-center wow fadeIn" data-wow-duration="500ms"
                         data-wow-delay="500ms">
                        <div class="counters-item">
                            <br><br>
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <br>
                            <br>
                            <br>
                            <br>
                            <strong class="counter">2001</strong>
                            <br>
                            <br>
                            <p class="count_p">Since</p>
                        </div>
                    </div>

                    <!--End Counter four-->

                </div>
            </div>
        </div>


    </section>
    {{-- End some of our success Counter--}}


@endsection



@section('script')
    <script>

        $(document).ready(function () {

            // medical read more
            @if(isset($ads)  && $ads->count() > 0)
            @foreach($ads as $ad)
            $("{{'#services_item_'.$ad->id}}").on({
                mouseenter: function () {
                    $("{{'#on_off_'.$ad->id}}").css({
                        "margin-top": "0px",
                        "height": "250px",
                        "transition": "all 0.3s"
                    });
                    $("{{'#service_more_'.$ad->id}}").slideDown(200);

                },
                mouseleave: function () {
                    $("{{'#on_off_'.$ad->id}}").css({
                        "margin-top": "180px",
                        "height": "70px",
                        "transition": "all 0.3s"
                    });
                    $("{{'#service_more_'.$ad->id}}").slideUp(200);
                }

            });
            @endforeach

            @endif

        });


    </script>
@endsection
