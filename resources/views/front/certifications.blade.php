@extends('layouts.site')
@section('title')
    Certifications
@endsection


@section('content')

    <!--start of services-->
    <section class="services-page text-center">
        <div class="container wow">

                @if(isset($certification_Ps) && $certification_Ps->count() > 0)
                    @foreach($certification_Ps as $item)
                    <div class="row wow fadeIn" style="background-color: #d4d4d4;">
                        <h2>{{$item->title}}</h2>
                        {{--                            line  Here--}}
                        <div class="line2" style="background: #2a002f">
                            </div>
                        <p class="services1"><b>
                                {{$item->content}}
                            </b></p>
                        @if($certification_Ps->count() > 1)

                            <div class="line">

                            </div>

                        @endif
                    </div>
                    @endforeach
                @endif



            <div class="row wow fadeIn" style="margin-top: 10px">
                <div><h2>{{__('messages.certifications')}}</h2></div>
                {{--                            line heart Here--}}
                <div class="line2" style="background: #2a002f">
                </div>
                <br>

                @if(isset($certification_items) && $certification_items->count() > 0)
                    @foreach($certification_items as $item)
                        <div class="col-sm-6 col-xs-12 {{$certification_items->count() < 2 ? 'col-md-12' : 'col-md-6'}}">
                            <div class="certimg">
                                <a href="{{$item->photo}}" target="_blank">
                                    <img src="{{$item->photo}}" style="width: auto">
                                </a>

                            </div>
                            <div class="service">
                                <h3>{{$item->title}} </h3>
                                <p>{{$item->content}}</p>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>
        </div>
    </section>
    <!--end of services-->

@endsection
