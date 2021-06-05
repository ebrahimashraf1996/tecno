@extends('layouts.site')
@section('title')
    Warranty
@stop
@section('content')

    <!--start of Warranty-->
    <section class="about-us">
        <div class="container">
            @if(isset($warranties) && $warranties->count() >0)
                @foreach($warranties as $warranty)
                    <div class="row wow">
                        <div class="col-md-6 col-xs-12 wow fadeInLeft">
                            <div class="about-data">
                                <h2> {{$warranty->title}}</h2>
                                <div class="cutter">
                                    <div class="cut1"></div>
                                    <div class="cut2"></div>
                                </div>

                                <p class="about2" style="font-size: 24px; font-family: Comic Sans MS,cursive;">
                                    {{$warranty->content}}
                                </p>

                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 wow fadeInRight">
                            <div class="about-img">
                                <img src="{{$warranty->photo}}" width="400" class="img-responsive">
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
                        <div class="col-md-2"></div>
                        <div class="col-md-8" style=" text-align: center; background: black; height: 1px">
                        </div>
                        <div class="col-md-2"></div>

                    </div>

                @endforeach
            @endif
        </div>


    </section>
    <!--end of Warranty-->

@endsection
