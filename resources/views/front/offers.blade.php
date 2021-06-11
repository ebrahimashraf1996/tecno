@extends('layouts.site')
@section('title')
    {{$offer->title}}
@endsection

@section('content')

@if(isset($offer))

    <!--start of Product-->
    <section class="about-us">
        <div class="container wow">
            <div class="row" style="margin-top:25px">
                <div class="col-md-7 col-xs-12  wow fadeIn">
                    <div class="about-data text-center">
                        <h2>{{$offer->title}} </h2>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 10px;">
                        </div>

                        <p class="about2" style="font-size: 18px">{{$offer->content}}</p>

                    </div>
                </div>
                <div class="col-md-5 col-xs-12" style="margin-top: 30px">
                    <div class="about-img  wow fadeIn col-md-12 col-xs-12">
                        <img src="{{$offer->photo}}" width="100%" height="300px">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end of Product-->
    @endif

@endsection
