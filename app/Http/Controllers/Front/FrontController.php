<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUserRequest;
use App\Models\Catalog;
use App\Models\CertificationItem;
use App\Models\CertificationP;
use App\Models\ContactUsUser;
use App\Models\GalleryImage;
use App\Models\LargeSection;
use App\Models\NavbarList;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Ad;
use App\Models\ProductImage;
use App\Models\SecondSection;
use App\Models\SliderImage;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function home()
    {
        $firstImage = SliderImage::first();

        $sections = LargeSection::active()->selection()->get();

        $images = SliderImage::active()->selection()->get();

        $sections_2 = SecondSection::active()->selection()->get();

        $ads = Ad::parentActive()->active()->selection()->get();

        return view('front.home', compact('images', 'sections', 'firstImage', 'sections_2', 'ads'));
    }

    public function productShow($id)
    {


        $images = ProductImage::selection()->where('product_id', $id)->get();

        $lower_image_id = ProductImage::where('product_id', $id)->select(['id'])->get();
        $lower_image_id = $lower_image_id->min();

        $product = Product::selection()->find($id);

        if ($product->is_active == 0)
            return redirect()->route('site.home')->with(['error' => 'حدث خطأ ما برجاء المحاولة فيما بعد']);

        return view('front.products', compact('product', 'images', 'lower_image_id'));
    }
    public function offerShow($id)
    {

        $offer = Offer::selection()->find($id);

        if ($offer->is_active == 0)
            return redirect()->route('site.home')->with(['error' => 'حدث خطأ ما برجاء المحاولة فيما بعد']);

        return view('front.offers', compact('offer'));
    }

    public function certifications()
    {

        $status = NavbarList::where('slug', 'site.certifications')->select('id', 'is_active')->get();
        $status= $status[0];
        if ($status->is_active == 0)
            return redirect()->route('site.home');


        $certification_Ps = CertificationP::active()->Selection()->get();

        $certification_items = CertificationItem::active()->selection()->get();

        return view('front.certifications', compact('certification_items', 'certification_Ps'));
    }

    public function warranty()
    {

        $status = NavbarList::where('slug', 'site.warranty')->select('id', 'is_active')->get();
        $status= $status[0];
        if ($status->is_active == 0)
            return redirect()->route('site.home');

        $warranties = Warranty::active()->selection()->get();

        return view('front.warranty', compact('warranties'));
    }

    public function gallery()
    {
        $status = NavbarList::where('slug', 'site.gallery')->select('id', 'is_active')->get();
        $status= $status[0];
        if ($status->is_active == 0)
            return redirect()->route('site.home');

        $photos = GalleryImage::active()->selection()->get();

        return view('front.gallery', compact('photos'));
    }

    public function catalogs()
    {

        $status = NavbarList::where('slug', 'site.catalogs')->select('id', 'is_active')->get();
        $status= $status[0];
        if ($status->is_active == 0)
            return redirect()->route('site.home');

        $catalogs = Catalog::active()->selection()->get();

        return view('front.catalogs', compact('catalogs'));
    }

    public function contacts()
    {

        $status = NavbarList::where('slug', 'site.contacts')->select('id', 'is_active')->get();
        $status= $status[0];
        if ($status->is_active == 0)
            return redirect()->route('site.home');

        return view('front.contact');
    }

    public function contactsPost(ContactUserRequest $request)
    {
        DB::beginTransaction();

        ContactUsUser::create($request->except('_token', 'submit'));
        DB::commit();
        return redirect()->route('site.contacts')->with(['success' => __('messages.thanks')]);
    }

}
