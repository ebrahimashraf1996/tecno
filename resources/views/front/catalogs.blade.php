@extends('layouts.site')

@section('title')
    Catalogs
@stop

@section('content')
    @if(isset($catalogs) && $catalogs->count() >0)
        <section class="catalog gallery wow" style="margin-bottom: 20px;">
            <div class="text-center wow fadeInDown">
                <h1>{{__('messages.catalogs')}}</h1>

                <div class="cutter">
                    <div class="cut2"></div>
                    <div class="cut1"></div>
                    <div class="cut2"></div>
                </div>
            </div>
            <div class="container wow fadeInUp">
                <div class="row">
                    @foreach($catalogs as $catalog)
                        <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                            <div class="title text-center" style="margin-bottom: -20px">
                                <h4>{{$catalog -> title}}</h4>
                            </div>
                            <div class="cutter text-center">
                                <div class="cut1"></div>
                                <div class="cut2"></div>
                            </div>

                            <div class="cat-img">
                                <img class="img-responsive" alt=""
                                     src="{{$catalog->photo}}" height="225" width="225">
                            </div>
                            <div class='down text-center pdf-file'>
                                <a class="btn btn-primary" href='{{$catalog -> pdf}}'>PDF</a>
                            </div> <!-- text-right / end -->
                        </div>
                    @endforeach


                </div> <!-- row / end -->
            </div> <!-- container / end -->
        </section>
        <!--end of gallery-->
    @endif
@endsection
