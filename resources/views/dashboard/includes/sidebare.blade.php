<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main" style="font-size: 14px"> الصور الخاصة بال Slider  </span>
                    <span
                        class="badge badge badge-primary badge-pill float-right mr-2">{{\App\Models\SliderImage::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.slider.images')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.slider.images.create')}}" data-i18n="nav.dash.crypto">أضافة
                            صورة جديده </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الأقسام الرئيسية 1 </span>
                    <span
                        class="badge badge badge-primary badge-pill float-right mr-2">{{\App\Models\LargeSection::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.large.sections')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.large.sections.create')}}"
                           data-i18n="nav.dash.crypto">أضافة قسم رئيسي جديد
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأقسام الرئيسية 2  </span>
                    <span
                        class="badge badge badge-primary badge-pill float-right mr-2">{{\App\Models\SecondSection::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.second.sections')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.second.sections.create')}}"
                           data-i18n="nav.dash.crypto">
                            أضافة قسم رئيسي جديد
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المنتجات  </span>
                    <span
                        class="badge badge badge-success  badge-pill float-right mr-2">{{\App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.products')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.products.create')}}" data-i18n="nav.dash.crypto">إضافة
                            منتج </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">اعلانات المنتجات  </span>
                    <span
                        class="badge badge badge-success  badge-pill float-right mr-2">{{\App\Models\ProductAd::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.ads')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.ads.create')}}" data-i18n="nav.dash.crypto">إضافة
                            اعلان </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الإعتمادات  </span>
                    <span
                        class="badge badge badge-success  badge-pill float-right mr-2">2</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.certificate')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض البراجراف </a>
                        <span
                            class="badge badge badge-primary  badge-pill float-right mr-2"  style="margin-top: -30px">{{\App\Models\CertificationP::count()}}</span>
                    </li>

                    <li class=""><a class="menu-item" href="{{route('admin.certificate.items')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض عناصر الإعتمادات </a>
                        <span
                            class="badge badge badge-primary  badge-pill float-right mr-2" style="margin-top: -30px">{{\App\Models\CertificationItem::count()}}</span>
                    </li>

                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">ضمان تكنو وان  </span>
                    <span
                        class="badge badge badge-success  badge-pill float-right mr-2">{{\App\Models\Warranty::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.warranty')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.warranty.create')}}" data-i18n="nav.dash.crypto">إضافة
                            عنصر </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">معرض الصور  </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\GalleryImage::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.gallery')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.gallery.create')}}" data-i18n="nav.dash.crypto">إضافة
                            صور </a>
                    </li>

                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الكتالوجات  </span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">{{\App\Models\Catalog::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.catalog')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.catalog.create')}}" data-i18n="nav.dash.crypto">إضافة
                            كتالوج </a>
                    </li>

                </ul>
            </li>

            {{-- Start Footer Part--}}
            <li class="nav-item"><a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> Footer</span>
                    <span
                        class="badge badge badge-warning  badge-pill float-right mr-2">3</span>
                </a>
                <ul class="menu-content">
                    <li class="nav-item"><a href=""><i class="la la-male"></i>
                            <span class="menu-title" style="font-size: 13px" data-i18n="nav.dash.main">التواصل الأجتماعي Footer</span>
                        </a>
                        <ul class="menu-content">
                            <li class=""><a class="menu-item" href="{{route('admin.social')}}"
                                                  data-i18n="nav.dash.ecommerce"> عرض الكل وتعديل </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item"><a href=""><i class="la la-male"></i>
                            <span class="menu-title" data-i18n="nav.dash.main"> التواصل - Footer </span>
                        </a>
                        <ul class="menu-content">
                            <li class=""><a class="menu-item" href="{{route('admin.footer.section.contacts')}}"
                                                  data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.footer.section.contacts.create')}}"
                                   data-i18n="nav.dash.crypto">إضافة وسيلة جديدة</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item"><a href=""><i class="la la-male"></i>
                            <span class="menu-title" style="font-size: 14px" data-i18n="nav.dash.main">البراجراف الخاص  Footer </span>
                        </a>
                        <ul class="menu-content">
                            <li class=""><a class="menu-item" href="{{route('admin.footer.section.paragraphs')}}"
                                                  data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                            </li>
                            <li><a class="menu-item" href="{{route('admin.footer.section.paragraphs.create')}}"
                                   data-i18n="nav.dash.crypto">إضافة براجراف جديد</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>

            {{-- End Footer Part--}}


            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">قوائم الموقع  </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\NavbarList::count()}} </span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.navbar.lists')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">بيانات الموقع </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2"></span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('project.info.edit')}}"
                                          data-i18n="nav.dash.ecommerce"> تعديل </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">مديري الموقع </span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{\App\Models\Admin::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class=""><a class="menu-item" href="{{route('admin.all')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل  </a>
                    </li>
                    <li class=""><a class="menu-item" href="{{route('admin.add.new.admin')}}"
                                          data-i18n="nav.dash.ecommerce"> إضافة مدير  </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>
