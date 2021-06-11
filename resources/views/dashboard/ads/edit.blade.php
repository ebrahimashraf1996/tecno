@extends('layouts.admin')
@section('title')
    تعديل الإعلان
@stop
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.ads')}}">
                                        الإعلانات
                                    </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل الإعلان
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل الإعلان </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('admin.ads.update', $ad->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$ad -> id}}" type="hidden">


                                            <div class="row">
                                                <div class="col-md-3">صورة الإعلان</div>
                                                <div class="text-center col-md-6">
                                                    <img style="width: 300px; height: 300px;" src="{{$ad -> photo}}">
                                                </div>
                                                <br><br><br>
                                                <br><br><br>
                                                <br><br><br><br><br><br>
                                                <br><br><br>
                                                <br><br><br>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label> صورة الإعلان </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" id="file" name="photo">
                                                            <span class="file-custom"></span>
                                                        </label>
                                                        @error('photo')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> تعديل البيانات </h4>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان الإعلان بالعربية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$ad->title_ar}}"
                                                                   name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان الإعلان بالإنجليزية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$ad->title_en}}"
                                                                   name="title_en">
                                                            @error("title_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> محتوي الإعلان بالعربية
                                                            </label>
                                                            <textarea type="text" id="name"
                                                                      class="form-control height-150"
                                                                      placeholder=" ادخل محتوي القسم بالعربية "
                                                                      name="content_ar">{{$ad->content_ar}}</textarea>
                                                            @error("content_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> محتوي الإعلان بالإنجليزية
                                                            </label>
                                                            <textarea type="text" id="name"
                                                                      class="form-control height-150"
                                                                      placeholder=" ادخل محتوي القسم بالإنجليزية "
                                                                      name="content_en">{{$ad->content_en}}</textarea>
                                                            @error("content_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">

                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="0"
                                                                   @if($ad->product_id == null && $ad->offer_id == null)
                                                                   checked
                                                                   @endif
                                                                   class="switchery"
                                                                   data-color="success"
                                                            />

                                                            <label
                                                                class="card-title ml-1">
                                                                اعلان منفصل
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="1"
                                                                   @if($ad->product_id != null)
                                                                   checked
                                                                   @endif
                                                                   class="switchery"
                                                                   data-color="success"
                                                            />

                                                            <label
                                                                class="card-title ml-1">
                                                                اعلان لمنتج
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-1">
                                                            <input type="radio"
                                                                   name="type"
                                                                   value="2"
                                                                   @if($ad->offer != null)
                                                                   checked
                                                                   @endif
                                                                   class="switchery"
                                                                   data-color="success"
                                                            />

                                                            <label
                                                                class="card-title ml-1">
                                                                اعلان لعرض
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" style="padding-top: 16px">
                                                        @error('product_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                        @error('offer_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>


                                                <div class="row @if($ad -> product_id == null)  hidden @endif" id="products_list">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر المنتج
                                                            </label>
                                                            &nbsp;
                                                            <select name="product_id" class="select2 form-control"
                                                                    style="width: 25%">
                                                                <optgroup label=" ">
                                                                    <option value=""
                                                                            @if($ad -> product_id == null)  selected @endif >
                                                                        من فضلك أختر المنتج
                                                                    </option>
                                                                    @if($products && $products -> count() > 0)
                                                                        @foreach($products as $product)
                                                                            <option
                                                                                value="{{$product -> id }}"
                                                                                @if($product -> id == $ad -> product_id)  selected @endif>{{$product -> title}}</option>

                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row @if($ad -> offer_id == null)  hidden @endif" id="offers_list">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر العرض
                                                            </label>
                                                            &nbsp;
                                                            <select name="offer_id" class="select2 form-control"
                                                                    style="width: 25%">
                                                                <optgroup label=" ">
                                                                    <option value="" @if($ad -> offer_id == null)  selected @endif >
                                                                        من فضلك أختر العرض
                                                                    </option>
                                                                    @if($offers && $offers -> count() > 0)
                                                                        @foreach($offers as $offer)
                                                                            <option
                                                                                value="{{$offer -> id }}"
                                                                                @if($offer -> id == $ad -> offer_id)  selected @endif>{{$offer -> title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>


                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   @if($ad -> is_active == 1) checked @endif/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop

@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function () {
                if (this.checked && this.value == '1') { // 1 => product
                    $('#products_list').removeClass('hidden');
                    $('#offers_list').addClass('hidden');

                }
                if (this.checked && this.value == '2') { // 2 => offer
                    $('#offers_list').removeClass('hidden');
                    $('#products_list').addClass('hidden');
                }
                if (this.checked && this.value == '0') { // 0 => normal ad
                    $('#products_list').addClass('hidden');
                    $('#offers_list').addClass('hidden');
                }

            });
    </script>

@endsection
