@extends('layouts.site')
@section('title')
    Products
@endsection

@section('content')

@if(isset($product))





    <!--start of Product-->
    <section class="about-us">
        <div class="container wow">
            <div class="row" style="margin-top:25px">
                <div class="col-md-7 col-xs-12  wow fadeIn">
                    <div class="about-data text-center">
                        <h2>{{$product->title}} </h2>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 10px;">
                        </div>

                        <p class="about2" style="font-size: 18px">{{$product->content}}</p>

                    </div>
                </div>
                <div class="col-md-5 col-xs-12" style="margin-top: 30px">
                    <div class="about-img  wow fadeIn col-md-12 col-xs-12">
                        <img src="{{$product->photo}}" width="100%" height="300px">
                    </div>
                    <div id="myCarousel" class="carousel slide col-md-12 col-xs-12" data-ride="carousel" style="width: auto; margin: 20px 0">
                        <!-- Indicators -->
                        <div class="carousel-inner" role="listbox">
                            @foreach($images as $image)
                                <div class="item {{$lower_image_id->id == $image->id ? 'active' : ''}}">
                                    <img class="first-slide" style=" height: 300px; width: 100%" src="{{$image->photo}}"
                                         alt="First slide">
                                </div>
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="left: 16px">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="right: 16px">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end of Product-->
    @endif

@endsection
