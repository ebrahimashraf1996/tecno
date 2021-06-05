@extends('layouts.admin')
@section('title')
    تعديل قسم فرعي
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
                                    <a href="{{route('admin.small.sections')}}">
                                        الأقسام الفرعية
                                    </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل قسم فرعي
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل قسم فرعي </h4>
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
                                              action="{{route('admin.small.sections.update', $small_section->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$small_section -> id}}" type="hidden">

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> تعديل البيانات </h4>

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان القسم بالعربية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$small_section->title_ar}}"
                                                                   name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان القسم بالإنجليزية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$small_section->title_en}}"
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
                                                            <label for="projectinput1"> محتوي القسم بالعربية
                                                            </label>
                                                            <textarea type="text" id="name"
                                                                      class="form-control height-150"
                                                                      placeholder=" ادخل محتوي القسم بالعربية "
                                                                      name="small_p_ar">{{$small_section->small_p_ar}}</textarea>
                                                            @error("small_p_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> محتوي القسم بالإنجليزية
                                                            </label>
                                                            <textarea type="text" id="name"
                                                                      class="form-control height-150"
                                                                      placeholder=" ادخل محتوي القسم بالإنجليزية "
                                                                      name="small_p_en">{{$small_section->small_p_en}}</textarea>
                                                            @error("small_p_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> أيقونة القسم :
                                                            </label>
                                                            <input type="text" id="icon"
                                                                   class="form-control"
                                                                   placeholder=" مثال : <i class='fa fa-facebook' aria-hidden='true'></i> "
                                                                   value="{{$small_section->icon}}"
                                                                   name="icon">
                                                            <span>للبحث عن أيقونات أدخل علي هذا الرابط : </span>
                                                            <a href="https://fontawesome.com/v4.7/icons/"
                                                               target="_blank">Font Awesome</a>
                                                            @error("icon")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر القسم الرئيسي
                                                            </label>
                                                            <select name="large_section_id"
                                                                    class="select2 form-control">
                                                                <optgroup label="من فضلك أختر القسم ">
                                                                    @if($large_sections && $large_sections -> count() > 0)
                                                                        @foreach($large_sections as $large_section)
                                                                            <option
                                                                                value="{{$large_section -> id }}"
                                                                                @if($large_section -> id == $small_section -> large_section_id)  selected @endif>{{$large_section -> title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('large_section_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror

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
                                                                   @if($small_section -> is_active == 1) checked @endif/>
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
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                } else {
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
