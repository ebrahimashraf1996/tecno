<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffersRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Ad;
use App\Models\Offer;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffersController extends Controller
{
    public function index()
    {
        $offers = Offer::all();

        return view('dashboard.offers.index', compact('offers'));
    }

    public function create()
    {
        return view('dashboard.offers.create');
    }

    public function store(OffersRequest $request)
    {
        // validation by offers Request

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('offers', $request->photo);
        }

        Offer::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.offers')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        if (!$offer)
            return redirect()->route('admin.offers')->with(['error' => 'هذا العرض غير موجود']);

        return view('dashboard.offers.edit', compact('offer'));
    }

    public function update(OffersRequest $request, $id)
    {
        try {
            // validation by Product Request  Request

            //Update DB


            $offer = Offer::with(['offerAds' => function ($q) {
                $q->selection();
            }])->find($id);

            if (!$offer)
                return redirect()->route('admin.offers')->with(['error' => 'هذا العرض غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($offer->photo);

                $fileName = uploadImage('offers', $request->photo);
                $offer->update([
                    'photo' => $fileName,
                ]);
            }

            $offer->update($request->except('_token', 'id', 'photo'));
            foreach ($offer->offerAds as $ad) {
                Ad::where('id', $ad->id)->update(['parent_status' => $request->is_active]);
            }

            DB::commit();
            return redirect()->route('admin.offers')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.offers')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $offer = Offer::find($id);

            // check if exists
            if (!$offer)
                return redirect()->route('admin.offers')->with(['error' => 'هذا العرض غير موجود ']);

            // delete Photo from folder
            deletePhotos($offer->photo);

            // delete row from Table
            $offer->delete();

            // redirect success
            return redirect()->route('admin.offers')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.offers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $offer = Offer::with(['offerAds' => function ($q) {
                $q->selection();
            }])->find($id);

            if (!$offer) {
                return redirect()->route('admin.offers')->with(['error' => 'هذا العرض غير موجود']);
            }


            $parent_status = $offer->is_active;

            $parent_status = $parent_status == 1 ? 0 : 1;
            $offer->update(['is_active' => $parent_status]);

            foreach ($offer->offerAds as $ad) {
                Ad::where('id', $ad->id)->update(['parent_status' => $parent_status]);
            }

            return redirect()->route('admin.offers')->with(['success' => 'تم تغيير حالة العرض بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.offers')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }
}

