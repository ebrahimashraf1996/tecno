<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarrantyRequest;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarrantyController extends Controller
{
    public function index()
    {
        $warranties = Warranty::all();

        return view('dashboard.warranty.index', compact('warranties'));
    }

    public function create()
    {
        return view('dashboard.warranty.create');
    }

    public function store(WarrantyRequest $request)
    {
        // validation by WarrantyRequest Request

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('warranty', $request->photo);
        }

        Warranty::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.warranty')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $warranty = Warranty::find($id);
        if (!$warranty)
            return redirect()->route('admin.warranty')->with(['error' => 'هذا العنصر غير موجود']);

        return view('dashboard.warranty.edit', compact('warranty'));
    }

    public function update(WarrantyRequest $request, $id)
    {
        try {
            // validation by Product Request  Request

            //Update DB

            $warranty = Warranty::find($id);
            if (!$warranty)
                return redirect()->route('admin.warranty')->with(['error' => 'هذا العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($warranty->photo);

                $fileName = uploadImage('warranty', $request->photo);
                $warranty->update([
                    'photo' => $fileName,
                ]);
            }

            $warranty->update($request->except('_token', 'id', 'photo'));


            DB::commit();
            return redirect()->route('admin.warranty')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.warranty')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $warranty = Warranty::find($id);

            // check if exists
            if (!$warranty)
                return redirect()->route('admin.warranty')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete Photo from folder
            deletePhotos($warranty->photo);

            // delete row from Table
            $warranty->delete();

            // redirect success
            return redirect()->route('admin.warranty')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.warranty')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $warranty = Warranty::find($id);

            if (!$warranty) {
                return redirect()->route('admin.warranty')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $warranty->is_active;

            changeSts($status, $warranty);

            return redirect()->route('admin.warranty')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.warranty')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
