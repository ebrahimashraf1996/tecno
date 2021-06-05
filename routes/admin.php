<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


    /*
     * These Routes Are Available only For Admin After Login to Dashboard
     *
     * Dashboard Routes
     */

    Route::group(['namespace' => 'Dashboard', 'middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        // the first page admin visits if authenticated
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        // Get All Admins
        Route::get('/all','AdminAllController@index') -> name('admin.all');

        // Add New Admin
        Route::get('/add-new-admin','AddNewAdminController@create') -> name('admin.add.new.admin');
        Route::post('/store-new-admin','AddNewAdminController@store') -> name('admin.store.new.admin');

        // edit Admin Info
        Route::get('/admin-info/edit/{id}', 'AdminInfoEditController@editInfo')->name('admin.info.edit');
        Route::post('/admin-info/update/{id}', 'AdminInfoEditController@updateInfo')->name('admin.info.update');

        // Route for Logout from Dashboard
        Route::get('logout', 'LoginController@logout')->name('admin.logout');

        ############################### Start Project Info Routs ##################################

        Route::group(['prefix' => 'project-info'], function () {
            Route::get('edit', 'ProjectInfoController@edit')->name('project.info.edit');
            Route::post('update/{id}', 'ProjectInfoController@update')->name('project.info.update');
        });

        ############################### End Project Info Routs ##################################


        ############################### Start Nav Lists Routs ###################################

        Route::group(['prefix' => 'navbar-lists'], function () {
            Route::get('/', 'NavListsController@index')->name('admin.navbar.lists');

            Route::get('edit/{id}', 'NavListsController@edit')->name('admin.navbar.lists.edit');
            Route::post('update/{id}', 'NavListsController@update')->name('admin.navbar.lists.update');

            Route::get('change-status/{id}', 'NavListsController@changeStatus')->name('admin.navbar.lists.change.status');
        });

        ############################### End Nav Lists Routs #####################################


        ############################### start Slider Images Routs #####################################

        Route::group(['prefix' => 'slider-images'], function () {
            Route::get('/','SliderImagesController@index') -> name('admin.slider.images');
            Route::get('create','SliderImagesController@create') -> name('admin.slider.images.create');
            Route::post('store','SliderImagesController@store') -> name('admin.slider.images.store');
            Route::get('edit/{id}','SliderImagesController@edit') -> name('admin.slider.images.edit');
            Route::post('update/{id}','SliderImagesController@update') -> name('admin.slider.images.update');
            Route::get('delete/{id}','SliderImagesController@destroy') -> name('admin.slider.images.delete');
            Route::get('change-status/{id}', 'SliderImagesController@changeStatus')->name('admin.slider.images.change.status');
        });

        ############################### End Slider Images Routs #####################################

        ############################### start Large Sections Routs #####################################

        Route::group(['prefix' => 'large-sections'], function () {
            Route::get('/','LargeSectionsController@index') -> name('admin.large.sections');
            Route::get('create','LargeSectionsController@create') -> name('admin.large.sections.create');
            Route::post('store','LargeSectionsController@store') -> name('admin.large.sections.store');
            Route::get('edit/{id}','LargeSectionsController@edit') -> name('admin.large.sections.edit');
            Route::post('update/{id}','LargeSectionsController@update') -> name('admin.large.sections.update');
            Route::get('delete/{id}','LargeSectionsController@destroy') -> name('admin.large.sections.delete');
            Route::get('change-status/{id}', 'LargeSectionsController@changeStatus')->name('admin.large.sections.change.status');
            Route::get('remove-photo/{id}', 'LargeSectionsController@removePhoto')->name('admin.large.sections.remove.photo');
        });

        ############################### End Large Sections Routs #####################################

        ############################### start Small Sections Routs #####################################

        Route::group(['prefix' => 'small-sections'], function () {
            Route::get('/','SmallSectionsController@index') -> name('admin.small.sections');
            Route::get('create','SmallSectionsController@create') -> name('admin.small.sections.create');
            Route::post('store','SmallSectionsController@store') -> name('admin.small.sections.store');
            Route::get('edit/{id}','SmallSectionsController@edit') -> name('admin.small.sections.edit');
            Route::post('update/{id}','SmallSectionsController@update') -> name('admin.small.sections.update');
            Route::get('delete/{id}','SmallSectionsController@destroy') -> name('admin.small.sections.delete');
            Route::get('change-status/{id}', 'SmallSectionsController@changeStatus')->name('admin.small.sections.change.status');
        });

        ############################### End Small Sections Routs #####################################

        ############################### start Footer Section Contacts Routs #####################################

        Route::group(['prefix' => 'footer-section-contact'], function () {
            Route::get('/','FooterSectionContactsController@index') -> name('admin.footer.section.contacts');
            Route::get('create','FooterSectionContactsController@create') -> name('admin.footer.section.contacts.create');
            Route::post('store','FooterSectionContactsController@store') -> name('admin.footer.section.contacts.store');
            Route::get('edit/{id}','FooterSectionContactsController@edit') -> name('admin.footer.section.contacts.edit');
            Route::post('update/{id}','FooterSectionContactsController@update') -> name('admin.footer.section.contacts.update');
            Route::get('delete/{id}','FooterSectionContactsController@destroy') -> name('admin.footer.section.contacts.delete');
            Route::get('change-status/{id}', 'FooterSectionContactsController@changeStatus')->name('admin.footer.section.contacts.change.status');
        });

        ############################### End Footer Section Contacts Routs #####################################

        ############################### start Footer Section Right paragraph Routs #####################################

        Route::group(['prefix' => 'footer-section-paragraph'], function () {
            Route::get('/','FooterSectionParagraphController@index') -> name('admin.footer.section.paragraphs');
            Route::get('create','FooterSectionParagraphController@create') -> name('admin.footer.section.paragraphs.create');
            Route::post('store','FooterSectionParagraphController@store') -> name('admin.footer.section.paragraphs.store');
            Route::get('edit/{id}','FooterSectionParagraphController@edit') -> name('admin.footer.section.paragraphs.edit');
            Route::post('update/{id}','FooterSectionParagraphController@update') -> name('admin.footer.section.paragraphs.update');
            Route::get('delete/{id}','FooterSectionParagraphController@destroy') -> name('admin.footer.section.paragraphs.delete');
            Route::get('change-status/{id}', 'FooterSectionParagraphController@changeStatus')->name('admin.footer.section.paragraphs.change.status');
        });

        ############################### End Footer Section Right paragraph Routs #####################################

        ############################### start Products Routs #####################################

        Route::group(['prefix' => 'products'], function () {
            Route::get('/','ProductController@index') -> name('admin.products');
            Route::get('create','ProductController@create') -> name('admin.products.create');
            Route::post('store','ProductController@store') -> name('admin.products.store');
            Route::get('edit/{id}','ProductController@edit') -> name('admin.products.edit');
            Route::post('update/{id}','ProductController@update') -> name('admin.products.update');
            Route::get('delete/{id}','ProductController@destroy') -> name('admin.products.delete');
            Route::get('change-status/{id}', 'ProductController@changeStatus')->name('admin.products.change.status');
        });

        ############################### End Products Routs #####################################


        ############################### start Social Contacts Routs #####################################

        Route::group(['prefix' => 'social'], function () {
            Route::get('/','SocialController@index') -> name('admin.social');
            Route::get('edit/{id}','SocialController@edit') -> name('admin.social.edit');
            Route::post('update/{id}','SocialController@update') -> name('admin.social.update');
            Route::get('change-status/{id}', 'SocialController@changeStatus')->name('admin.social.change.status');
        });

        ############################### End Products Routs #####################################



        ############################### start certificate_p Routs #####################################

        Route::group(['prefix' => 'certificate'], function () {
            Route::get('/','CertificationController@index') -> name('admin.certificate');
            Route::get('create','CertificationController@create') -> name('admin.certificate.create');
            Route::post('store','CertificationController@store') -> name('admin.certificate.store');
            Route::get('edit/{id}','CertificationController@edit') -> name('admin.certificate.edit');
            Route::post('update/{id}','CertificationController@update') -> name('admin.certificate.update');
            Route::get('delete/{id}','CertificationController@destroy') -> name('admin.certificate.delete');
            Route::get('change-status/{id}', 'CertificationController@changeStatus')->name('admin.certificate.change.status');
        });

        ############################### End certificate_p Routs #####################################


        ############################### start certificate items Routs #####################################

        Route::group(['prefix' => 'certificate-items'], function () {
            Route::get('/','CertificationItemsController@index') -> name('admin.certificate.items');
            Route::get('create','CertificationItemsController@create') -> name('admin.certificate.items.create');
            Route::post('store','CertificationItemsController@store') -> name('admin.certificate.items.store');
            Route::get('edit/{id}','CertificationItemsController@edit') -> name('admin.certificate.items.edit');
            Route::post('update/{id}','CertificationItemsController@update') -> name('admin.certificate.items.update');
            Route::get('delete/{id}','CertificationItemsController@destroy') -> name('admin.certificate.items.delete');
            Route::get('change-status/{id}', 'CertificationItemsController@changeStatus')->name('admin.certificate.items.change.status');
        });

        ############################### End certificate items Routs #####################################

        ############################### start Warranty Routs #####################################

        Route::group(['prefix' => 'warranty'], function () {
            Route::get('/','WarrantyController@index') -> name('admin.warranty');
            Route::get('create','WarrantyController@create') -> name('admin.warranty.create');
            Route::post('store','WarrantyController@store') -> name('admin.warranty.store');
            Route::get('edit/{id}','WarrantyController@edit') -> name('admin.warranty.edit');
            Route::post('update/{id}','WarrantyController@update') -> name('admin.warranty.update');
            Route::get('delete/{id}','WarrantyController@destroy') -> name('admin.warranty.delete');
            Route::get('change-status/{id}', 'WarrantyController@changeStatus')->name('admin.warranty.change.status');
        });

        ############################### End Warranty Routs #####################################

        ############################### start Gallery Routs #####################################

        Route::group(['prefix' => 'gallery'], function () {
            Route::get('/','GalleryController@index') -> name('admin.gallery');
            Route::get('create','GalleryController@create') -> name('admin.gallery.create');
            Route::post('save','GalleryController@save') -> name('admin.gallery.save');
            Route::post('store','GalleryController@store') -> name('admin.gallery.store');
            Route::get('delete/{id}','GalleryController@destroy') -> name('admin.gallery.delete');
            Route::get('change-status/{id}', 'GalleryController@changeStatus')->name('admin.gallery.change.status');
        });

        ############################### End Gallery Routs #####################################


        ############################### start Warranty Routs #####################################

        Route::group(['prefix' => 'catalog'], function () {
            Route::get('/','CatalogController@index') -> name('admin.catalog');
            Route::get('create','CatalogController@create') -> name('admin.catalog.create');
            Route::post('store','CatalogController@store') -> name('admin.catalog.store');
            Route::get('edit/{id}','CatalogController@edit') -> name('admin.catalog.edit');
            Route::post('update/{id}','CatalogController@update') -> name('admin.catalog.update');
            Route::get('delete/{id}','CatalogController@destroy') -> name('admin.catalog.delete');
            Route::get('change-status/{id}', 'CatalogController@changeStatus')->name('admin.catalog.change.status');
        });

        ############################### End Warranty Routs #####################################

        ############################### start messages Routs #####################################

        Route::group(['prefix' => 'messages'], function () {
            Route::get('/','AdminMessagesController@index') -> name('admin.messages');
            Route::get('show/{id}','AdminMessagesController@show') -> name('admin.messages.show');
            Route::get('delete/{id}','AdminMessagesController@destroy') -> name('admin.messages.delete');
        });

        ############################### End messages Routs #####################################





    });


    /*
     * These Routs Are Available for Admins and Users
     *
     * Routs For login to Dashboard
     */
    Route::group(['namespace' => 'Dashboard', 'middleware' => 'guest:admin', 'prefix' => 'admin'], function () {

        Route::get('login', 'LoginController@login')->name('admin.login');
        Route::post('login', 'LoginController@postLogin')->name('admin.post.login');

    });
});


Auth::routes();












