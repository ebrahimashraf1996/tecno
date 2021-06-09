<!--start of footer  1  -->
<footer class="visible-xs text-center">
    <div class="container">
        <div class="row">

            <div class="col-sm-3 col-xs-12">
                <div class="footer-menu wow fadeIn">
                    <h3>{{__('messages.list')}}</h3>
                    {{--                            line  Here--}}
                    <div class="line2" style="margin-top: 5px; margin-bottom: 20px">

                    </div>
                    <div>
                        <a href="{{route('site.home')}}">{{__('messages.home')}}</a><br>
                        <a href="{{route('site.certifications')}}">{{__('messages.certifications')}}</a><br>
                        <a href="{{route('site.warranty')}}">{{__('messages.warranty')}}</a><br>
                        <a href="{{route('site.catalogs')}}">{{__('messages.catalogs')}}</a><br>
                        <a href="{{route('site.contacts')}}">{{__('messages.home.contact')}} </a><br>
                    </div>
                </div>
            </div>

            <div class="col-sm-3 col-xs-12" style="margin-top: 30px">
                <div class="footer-contact wow fadeIn">
                    <h3>{{__('messages.home.contact')}}</h3>
                    {{--                            line  Here--}}
                    <div class="line2" style="margin-top: 5px">

                    </div>
                    @foreach(\App\Models\FooterSectionContact::active()->selection()->get() as $contact)
                        <p><b>{{$contact->title}} : </b>{{$contact->span}}</p>
                    @endforeach


                </div>
            </div>
            <div class="col-sm-6 col-xs-12" style="margin-top: 20px">
                <div class="footer-about wow fadeIn">
                    @foreach(\App\Models\FooterSectionParagraph::active()->selection()->get() as $section)
                        <h3>{{$section->title}}</h3>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 5px">

                        </div>
                        <p>{{$section->content}}</p>
                    @endforeach
                    <div class="social-icons">
                        @foreach(\App\Models\Social::active()->selection()->get() as $social)

                            <a href="{{$social->url}}"><i class="fa fa-{{$social->title}} fa-2x"></i></a>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end of footer-->

<!--start of footer  2  -->
<footer class="hidden-xs text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-about wow fadeIn">
                    @foreach(\App\Models\FooterSectionParagraph::active()->selection()->get() as $section)
                        <h3>{{$section->title}}</h3>
                        {{--                            line  Here--}}
                        <div class="line2" style="margin-top: 5px">

                        </div>
                        <p>{{$section->content}}</p>
                    @endforeach
                    <div class="social-icons">
                        @foreach(\App\Models\Social::active()->selection()->get() as $social)

                            <a href="{{$social->url}}"><i class="fa fa-{{$social->title}} fa-2x"></i></a>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-contact wow fadeIn">
                    <h3>{{__('messages.home.contact')}}</h3>
                    {{--                            line  Here--}}
                    <div class="line2" style="margin-top: 5px">

                    </div>
                    @foreach(\App\Models\FooterSectionContact::active()->selection()->get() as $contact)
                        <p><b>{{$contact->title}} : </b>{{$contact->span}}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-menu wow fadeIn">
                    <h3>{{__('messages.list')}}</h3>
                    {{--                            line  Here--}}
                    <div class="line2" style="margin-top: 5px; margin-bottom: 20px">

                    </div>
                    <div>
                        <a href="{{route('site.home')}}">{{__('messages.home')}}</a><br>
                        <a href="{{route('site.certifications')}}">{{__('messages.certifications')}}</a><br>
                        <a href="{{route('site.warranty')}}">{{__('messages.warranty')}}</a><br>
                        <a href="{{route('site.catalogs')}}">{{__('messages.catalogs')}}</a><br>
                        <a href="{{route('site.contacts')}}">{{__('messages.home.contact')}} </a><br>
                    </div>
                </div>
            </div>

        </div>
    </div>
</footer>
<!--end of footer-->
