@extends('layouts.site')
@section('title')
    Products
@endsection

@section('content')

@if(isset($product))

    <!--start of Product-->
    <section class="about-us">
        <div class="container wow">
            <div class="row">
                <div class="col-md-7 col-xs-12  wow fadeInLeft">
                    <div class="about-data">
                        <h2>{{$product->title}} </h2>
                        <div class="cutter">
                            <div class="cut1"></div>
                            <div class="cut2"></div>
                        </div>

                        <p class="about2">{{$product->content}}</p>

                    </div>
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="about-img  wow fadeInRight">
                        <img src="{{$product->photo}}" width="400"
                             class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end of Product-->
    @endif

@endsection
