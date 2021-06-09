@extends('layouts.site')
@section('title')
    Warranty
@stop
@section('content')

    <!--start of Warranty-->
    <section class="about-us" style="margin-top: 15px">
        <div class="container">
            @if(isset($warranties) && $warranties->count() >0)
                @foreach($warranties as $warranty)
                    <div class="row wow">
                        <div class="col-md-6 col-xs-12 wow fadeIn text-center " style="margin-top: 25px">
                            <div class="about-data">
                                <h2> {{$warranty->title}}</h2>
                                <div class="line2" style="width: 200px"></div>


                                <p class="about2" style="font-size: 24px; font-family: 'Times New Roman',serif;">
                                    {{$warranty->content}}
                                </p>

                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5 col-xs-12 wow fadeIn warranty-photo-div">
                            <div class="about-img">
                                <img src="{{$warranty->photo}}" height="350" width="100%" class="">
                            </div>
                        </div>
                    </div>

                    @if($warranties->count() > 1)
                        <div class="line">

                        </div>
                    @endif

                @endforeach
            @endif
        </div>


    </section>
    <!--end of Warranty-->

@endsection
