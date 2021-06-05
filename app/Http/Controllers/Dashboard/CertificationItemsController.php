<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationItemsRequest;
use App\Models\CertificationItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificationItemsController extends Controller
{
    public function index()
    {
        $items = CertificationItem::all();

        return view('dashboard.certificationItems.index', compact('items'));
    }

    public function create()
    {
        return view('dashboard.certificationItems.create');
    }

    public function store(CertificationItemsRequest $request)
    {
        // validation by CertificationItemsRequest

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('certificationItems', $request->photo);
        }

        CertificationItem::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.certificate.items')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $item = CertificationItem::find($id);
        if (!$item)
            return redirect()->route('admin.certificate.items')->with(['error' => 'هذا العنصر غير موجود']);

        return view('dashboard.certificationItems.edit', compact('item'));
    }

    public function update(CertificationItemsRequest $request, $id)
    {
        try {
            // validation by CertificationItemsRequest

            //Update DB

            $item = CertificationItem::find($id);
            if (!$item)
                return redirect()->route('admin.certificate.items')->with(['error' => 'هذا العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($item->photo);

                $fileName = uploadImage('certificationItems', $request->photo);
                $item->update([
                    'photo' => $fileName,
                ]);
            }

            $item->update($request->except('_token', 'id', 'photo'));


            DB::commit();
            return redirect()->route('admin.certificate.items')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.certificate.items')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $item = CertificationItem::find($id);

            // check if exists
            if (!$item)
                return redirect()->route('admin.certificate.items')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete Photo from folder
            deletePhotos($item->photo);

            // delete row from Table
            $item->delete();

            // redirect success
            return redirect()->route('admin.certificate.items')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.certificate.items')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $item = CertificationItem::find($id);

            if (!$item) {
                return redirect()->route('admin.certificate.items')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $item->is_active;

            changeSts($status, $item);

            return redirect()->route('admin.certificate.items')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.certificate.items')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
