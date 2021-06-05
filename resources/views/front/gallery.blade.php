@extends('layouts.site')
@section('title')
    Gallery
@endsection

@section('content')
    @if(isset($photos) && $photos->count() > 0)
        <!--Start of gallery-->
        <section class="gallery wow" style="margin-bottom: 20px;">
            <div class="text-center wow fadeInUp">
                <h1>{{__('messages.gallery')}}
                </h1>
                <div class="cutter">
                    <div class="cut2"></div>
                    <div class="cut1"></div>
                    <div class="cut2"></div>
                </div>
            </div>
            <div class="container wow fadeInLeft">
                <div class="row">
                    <div class='list-group gallery'>
                        @foreach($photos as $photo)
                            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3' style="height: 270px">
                                <a class="thumbnail fancybox" rel="ligthbox"
                                   href="{{$photo->photo}}">
                                    <img class="img-responsive" alt="Gallery Image"
                                         src="{{$photo->photo}}" height="270"/>

                                </a>
                            </div> <!-- col-6 / end -->
                        @endforeach
                    </div> <!-- list-group / end -->
                </div> <!-- row / end -->
            </div> <!-- container / end -->
        </section>
        <!--end of gallery-->
    @endif

@endsection
