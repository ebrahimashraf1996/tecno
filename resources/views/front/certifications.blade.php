@extends('layouts.site')
@section('title')
    Certifications
@endsection


@section('content')

    <!--start of services-->
    <section class="services-page text-center">
        <div class="container wow">
            <div class="row wow fadeInRight">
                @if(isset($certification_Ps) && $certification_Ps->count() > 0)
                    @foreach($certification_Ps as $item)
                        <h2>{{$item->title}}</h2>
                        <div class="cutter">
                            <div class="cut2"></div>
                            <div class="cut1"></div>
                            <div class="cut2"></div>
                        </div>
                        <p class="services1"><b>
                                {{$item->content}}
                            </b></p>
                    @endforeach
                @endif

            </div>

            <div class="row wow fadeInLeft">
                @if(isset($certification_items) && $certification_items->count() > 0)
                    @foreach($certification_items as $item)
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="certimg">
                                <img src="{{$item->photo}}" class="">
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
