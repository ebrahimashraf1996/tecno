<header>
    <div class="social-data">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-6 text-left" style="margin-top: 5px;">
                    <div class="social-icons">
                        @foreach(\App\Models\Social::active()->selection()->get() as $social)
                            <a href="{{$social->url}}"><i class="fa fa-{{$social->title}} fa-2x"></i></a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 col-xs-6 col-sm-6">

                </div>
                <div class="col-md-2 col-sm-6 col-xs-6 text-center">
                    <ul>
                        <li class="dropdown" style="list-style: none">
                            <a class="dropdown-toggle lang-link"
                               data-toggle="dropdown"><img class="flag" src="{{asset('assets/front/images/'.LaravelLocalization::getCurrentLocale().'_flag.png')}}" alt="">{{LaravelLocalization::getCurrentLocale()}}
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a  rel="alternate"
                                           hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <img class="flag" src="{{asset('assets/front/images/'.$localeCode.'_flag.png')}}" alt="">{{ $localeCode }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>
    <section class="header-logo text-center">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-xs-12">
                    <div class="header-data">
                        <div class="row">


                            <div class="col-xs-12 text-center">

                                @foreach(\App\Models\ProjectInfo::selection()->get() as $info)
                                    <div class="logo-img">
                                        <img src="{{$info->logo}}"
                                             alt="Techno One Logo" height="80">
                                    </div>
                                    <div class="desc">
                                        <p>{{$info->title}}</p>
                                    </div>
                                @endforeach

                            </div>


                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">


                        @foreach(\App\Models\NavbarList::active()->selection()->get() as $list)
                            @if($list->id == 2)
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown">{{$list->name}} <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach(\App\Models\Product::active()->selection()->get() as $product)
                                            <li>
                                                <a href="{{route('site.product', $product->id)}}">{{$product->title}}  </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                            @elseif($list->id == 7)
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown">{{$list->name}} <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        @foreach(\App\Models\Offer::active()->selection()->get() as $offer)
                                            <li>
                                                <a href="{{route('site.offer', $offer->id)}}">{{$offer->title}}  </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </li>
                                @else
                                <li><a href="{{route($list->slug)}}">{{$list->name}}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>



{{--@foreach(\App\Models\NavbarList::active()->selection()->get() as $list)--}}
{{--    @if($list->name_en == 'Products')--}}
{{--        <li class="dropdown">--}}
{{--            <a class="dropdown-toggle" data-toggle="dropdown">{{$list->name}} <span--}}
{{--                    class="caret"></span></a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                @foreach(\App\Models\Product::active()->selection()->get() as $product)--}}
{{--                    <li>--}}
{{--                        <a href="{{route('site.product', $product->id)}}">{{$product->title}}  </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}

{{--            </ul>--}}
{{--        </li>--}}
{{--    @endif--}}
{{--    @if ($list->name_en == 'Offers')--}}
{{--        <li class="dropdown">--}}
{{--            <a class="dropdown-toggle" data-toggle="dropdown">{{$list->name}} <span--}}
{{--                    class="caret"></span></a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                @foreach(\App\Models\Offer::active()->selection()->get() as $offer)--}}
{{--                    <li>--}}
{{--                        <a href="{{route('site.offer', $offer->id)}}">{{$offer->title}}  </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}

{{--            </ul>--}}
{{--        </li>--}}
{{--    @else--}}
{{--        <li><a href="{{route($list->slug)}}">{{$list->name}}</a></li>--}}
{{--    @endif--}}
{{--@endforeach--}}
