@extends('layouts.site')

@section('title')
    Catalogs
@stop

@section('content')
    @if(isset($catalogs) && $catalogs->count() >0)
        <section class="catalog gallery wow" style="margin-bottom: 20px;">
            <div class="text-center wow fadeIn">
                <h1>{{__('messages.catalogs')}}</h1>
                {{-- line Here--}}
                <div class="line2">
                </div>
            </div>

            <div class="container fadeIn">
                <div class="row">
                    @if(isset($catalogs) && $catalogs->count() > 0)
                    @foreach($catalogs as $catalog)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="our-team">
                            <div class="picture">
                                <img class="img-fluid" src="{{$catalog->photo}}">
                            </div>
                            <div class="team-content">
                                <h3 class="name">{{$catalog -> title}}</h3>
                                <p class="title">{{$catalog -> content}}</p>
                            </div>
                            <ul class="social">
                                <li style="width:100%"><a href="{{$catalog -> pdf}}" class="btn" >Download</a></li>

                            </ul>
                        </div>
                    </div>
                        @endforeach
                        @endif
                </div>
            </div>

        </section>
        <!--end of gallery-->


    @endif
@endsection
