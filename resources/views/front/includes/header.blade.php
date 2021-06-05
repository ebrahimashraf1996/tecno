<header>
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
    <div class="container">
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

                        @if(LaravelLocalization::getCurrentLocale() == 'ar')
                            <li class="dropdown" style="margin-right: -198px; margin-left: 43px;">
                        @else
                            <li class="dropdown" style="margin-left: -198px; margin-right: 43px;">
                        @endif

                                <a class="dropdown-toggle"
                                   data-toggle="dropdown">{{__('messages.'.LaravelLocalization::getCurrentLocale())}}
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a style="font-family: 'Times New Roman', Times, serif;" rel="alternate"
                                               hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                {{ $properties['native'] }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>

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
