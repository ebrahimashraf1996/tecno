@extends('layouts.site')
@section('title')
    Home
@endsection
@section('style')

@stop
@section('content')

    <section id="sec_1">
        <div class="container">

        </div>

    </section>
    <!--start of slider-->
    <section id="home-slider" class="owlCarousel" dir="ltr">

        <!-- Start Single Slide Item Here -->
        @foreach($images as $image)
            <div class="single-slide-item"
                 style="background-image: url('{{$image->photo}}');background-size: cover;background-position: center;">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6" dir="rtl">
                            <h2></h2>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach


    </section>


    <a href="#section2">
        <div id="scroll-down">
        </div>
    </a>





{{--        <div class="camera_prev" style="background-color: red"><span></span></div>--}}



    {{--                <a class="ct-btn-scroll ct-js-btn-scroll" href="#section2">--}}
    {{--                    <img class="down-arrow" alt="Arrow Down Icon" src="{{asset('assets/front/images/logo.png')}}"></a>--}}
    <!--end of slider-->

    <!--start of about-->
    <section class="about-us" id="section2">
        <div class="container">
            <div class="row">


                @foreach ($sections as $section)

                    <div class="col-md-4 col-xs-12 wow">
                        <div class="about-data">
                            <h2 class="wow fadeInLeft">{{$section->title}}</h2>
                            <div class="cutter">
                                <div class="cut1"></div>
                                <div class="cut2"></div>

                                <div class="about-img">
                                    @if(str_ends_with($section->photo, 'g'))
                                        <img src="{{$section->photo}}" class="img-responsive">
                                    @endif
                                </div>

                                <p class="wow fadeInRight" style="text-align:right">
                                    {{$section->large_p}}
                                </p>
                                <div class="row">
                                    @foreach(\App\Models\SmallSection::where('large_section_id', $section->id)->selection()->get() as $item)
                                        <div class="col-sm-6 col-xs-12 wow fadeInUp">
                                            <div class="row">
                                                <div class="col-xs-9 text-right">
                                                    <p class="lead1">{{$item->title}}</p>
                                                    <p class="lead2">{{$item->small_p}}</p>
                                                </div>
                                                <div class="col-xs-3">{!! $item->icon !!}</div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!--end of about-->

    <!--start of contact-->
    <section class="contact">
        <div class="container">
            <div class="row wow">
                <div class="col-sm-4 hidden-xs text-center">
                    <a href="{{route('site.contacts')}}">
                        <button> {{__('messages.home.contact')}}</button>
                    </a>
                </div>
                <div class="col-sm-8 col-xs-12 wow fadeInRight">
                    <h2>{{__('messages.home.quality')}}</h2>
                    <a href="{{route('site.contacts')}}" class="visible-xs">
                        <button>{{__('messages.home.contact')}}</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--end of contact-->

@endsection
