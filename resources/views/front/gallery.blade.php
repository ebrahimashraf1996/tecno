@extends('layouts.site')
@section('title')
    Gallery
@endsection

@section('content')
    @if(isset($photos) && $photos->count() > 0)
        <!--Start of gallery-->
        <section class="gallery wow" style="margin-bottom: 20px;">
            <div class="text-center wow fadeIn gall-icon">
                <h1>{{__('messages.gallery')}}
                </h1>
                {{--                            line heart Here--}}
                <div class="line2" style="width: 200px">
                </div>
            </div>
            <div class="container wow fadeIn">
                <div class="row">
                    <div class='list-group gallery'>
                        @foreach($photos as $photo)
                            <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3' style="height: 270px">
                                <a class="thumbnail fancybox" rel="ligthbox"
                                   href="{{$photo->photo}}">
                                    <img class="img-responsive" alt="Gallery Image"
                                         src="{{$photo->photo}}" style="height: 252px;"/>
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
