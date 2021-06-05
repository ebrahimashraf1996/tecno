
@extends('layouts.admin')

@section('title')
    Control Panel
    @stop


@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @if(LaravelLocalization::setLocale() != 'ar')



                <div class="row mr-2 ml-2">
                    <button type="text" class="btn btn-lg btn-block btn-outline-warning mb-2"
                            id="type-error">برجاء تفعيل اللغة العربية من قائمة اللغات أعلي يمين الصفحة لكي تتمتع بأفضل تنسيق في محتوي لوحة التحكم
                    </button>
                </div>
                @endif
                @include('dashboard.includes.alerts.success')
                @include('dashboard.includes.alerts.errors')

                <div class="row">
                    <div class="co-md-12 text-center block">
                        <h1 style="color: #9905ab; font-family: serif; font-weight: 900; font-size: 48px">Techno One Dashboard</h1>
                    </div>
                    <div class="co-md-12 text-center block">
                        <img style="margin-top: 20px" width="360" height="300" src="{{asset('assets/front/images/logo.png')}}" alt="LOGO"/>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @stop
