<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdsRequest;
use App\Http\Requests\ProductAdRequest;
use App\Models\Ad;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ad::with([
            'product' => function ($q) {
                $q->selection();
            },
            'offer' => function ($q) {
                $q->selection();
            }
        ])->get();

        return view('dashboard.ads.index', compact('ads'));
    }

    public function create()
    {
        $products = Product::select('id', 'title_' . LaravelLocalization::getCurrentLocale() . ' as title')->active()->get();
        $offers = Offer::select('id', 'title_' . LaravelLocalization::getCurrentLocale() . ' as title')->active()->get();
        return view('dashboard.ads.create', compact('products', 'offers'));
    }

    public function store(AdsRequest $request)
    {
        // validation by Small Sections Request


        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('ads', $request->photo);
        }
        if ($request->type == 0) {
            $request->offer_id = null;
            $request->product_id = null;
        } elseif ($request->type == 1) {
            $request->offer_id = null;
        } elseif ($request->type == 2) {
            $request->product_id = null;
        }
        Ad::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'product_id' => $request->product_id,
            'offer_id' => $request->offer_id,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.ads')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $products = Product::active()->select('id', 'title_' . LaravelLocalization::getCurrentLocale() . ' as title')->get();
        $offers = Offer::active()->select('id', 'title_' . LaravelLocalization::getCurrentLocale() . ' as title')->get();
        $ad = Ad::find($id);
        if (!$ad)
            return redirect()->route('admin.ads')->with(['error' => 'هذا الإعلان غير موجود']);

        if ($ad->parent_status != 1)
            return redirect()->route('admin.ads')->with(['error' => 'برجاء تفعيل حالة المعلن عنه قبل اجراء أي تعديل علي الإعلان ']);


        return view('dashboard.ads.edit', compact('ad', 'products', 'offers'));
    }

    public function update(AdsRequest $request, $id)
    {
        try {
            // validation by Ads Request

            //Update DB

            $ad = Ad::find($id);

            if (!$ad)
                return redirect()->route('admin.ads')->with(['error' => 'هذا الإعلان غير موجود ']);


            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);



            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($ad->photo);

                $fileName = uploadImage('ads', $request->photo);
                $ad->update([
                    'photo' => $fileName,
                ]);
            }

            if ($request->type == 0) {
                $request->offer_id = null;
                $request->product_id = null;
            } elseif ($request->type == 1) {
                $request->offer_id = null;
            } elseif ($request->type == 2) {
                $request->product_id = null;
            }


            $ad->update($request->except('_token', 'id', 'photo','type'));


            DB::commit();
            return redirect()->route('admin.ads')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.ads')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific section
            $ad = Ad::find($id);

            // check if exists
            if (!$ad)
                return redirect()->route('admin.ads')->with(['error' => 'هذا الإعلان غير موجود ']);


            // delete Photo from folder
            deletePhotos($ad->photo);

            // delete row from Table
            $ad->delete();

            // redirect success
            return redirect()->route('admin.ads')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.ads')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $ad = Ad::find($id);

            if (!$ad) {
                return redirect()->route('admin.ads')->with(['error' => 'هذا الإعلان غير موجود']);
            }
            $status = $ad->is_active;

            changeSts($status, $ad);

            return redirect()->route('admin.ads')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.ads')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
