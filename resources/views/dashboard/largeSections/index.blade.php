@extends('layouts.admin')
@section('title')
     الأقسام الرئيسية 2
@stop
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الأقسام الرئيسية - 1
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الأقسام الرئيسية - 1 </h4>
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
                                    <div class="card-body card-dashboard">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="{{route('admin.large.sections.create')}}"
                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">إضافة قسم جديد</a>
                                            </div>
                                        </div>
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal"  style="text-align: center">
                                            <thead class="">
                                            <tr>
                                                <th>العنوان بالعربية </th>
                                                <th> المحتوي بالعربية </th>
                                                <th>العنوان بالأنجليزية </th>
                                                <th> المحتوي بالأنجليزية </th>
                                                <th>الصورة </th>
                                                <th>الحالة </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody >

                                            @isset($large_sections)
                                                @foreach($large_sections as $large_section)

                                                    <tr>
                                                        <td>{{$large_section -> title_ar}}</td>
                                                        <td><div  style=" overflow: hidden; height: 130px; width: 200px">{{$large_section -> large_p_ar}}</div></td>
                                                        <td>{{$large_section -> title_en}}</td>
                                                        <td><div  style=" overflow: hidden; height: 130px; width: 200px">{{$large_section -> large_p_en}}</div></td>
                                                        <td> @if(str_ends_with($large_section->photo, 'g'))<img style="width: 150px; height: 100px;" src="{{$large_section -> photo}}">@else لا يوجد @endif</td>
                                                        <td>{{$large_section -> getActive()}}</td>
                                                        <td>

                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.large.sections.edit',$large_section -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{route('admin.large.sections.delete',$large_section -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

                                                                <a href="{{route('admin.large.sections.change.status',$large_section -> id)}}"
                                                                   class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                                                    {{$large_section->is_active == 1 ? 'إالغاء تفعيل' : 'تفعيل'}}
                                                                </a>
                                                                @if(str_ends_with($large_section->photo, 'g'))
                                                                <a href="{{route('admin.large.sections.remove.photo',$large_section -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف صورة القسم</a>
                                                                @endif


                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    @stop
