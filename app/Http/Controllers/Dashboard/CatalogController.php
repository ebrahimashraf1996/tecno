<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogRequest;
use App\Models\Catalog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all();

        return view('dashboard.catalogs.index', compact('catalogs'));
    }

    public function create()
    {
        return view('dashboard.catalogs.create');
    }

    public function store(CatalogRequest $request)
    {
        // validation by Product Request
        try {

            DB::beginTransaction();

            // Check is_active
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            // Upload Photo
            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('catalogsCover', $request->photo);
            }


            $PDF_fileName = "";
            if ($request->has('pdf')) {
                $PDF_fileName = uploadPdf('catalogsPDF', $request->pdf);
            }


            Catalog::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'content_ar' => $request->content_ar,
                'content_en' => $request->content_en,
                'is_active' => $request->is_active,
                'photo' => $fileName,
                'pdf' => $PDF_fileName,
            ]);
            DB::commit();
            return redirect()->route('admin.catalog')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.catalog')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function edit($id)
    {
        $catalog = Catalog::find($id);
        if (!$catalog)
            return redirect()->route('admin.catalog')->with(['error' => 'هذا العنصر غير موجود']);

        return view('dashboard.catalogs.edit', compact('catalog'));
    }

    public function update(CatalogRequest $request, $id)
    {
        try {
            // validation by CatalogRequest

            //Update DB

            $catalog = Catalog::find($id);
            if (!$catalog)
                return redirect()->route('admin.catalog')->with(['error' => 'هذا العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($catalog->photo);

                $fileName = uploadImage('catalogsCover', $request->photo);
                $catalog->update([
                    'photo' => $fileName,
                ]);
            }

            // PDF Update
            if ($request->has('pdf')) {

                deletePdf($catalog->pdf);

                $PDF_fileName = uploadPdf('catalogsPDF', $request->pdf);
                $catalog->update([
                    'pdf' => $PDF_fileName,
                ]);
            }


            $catalog->update($request->except('_token', 'id', 'photo', 'pdf'));


            DB::commit();
            return redirect()->route('admin.catalog')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.catalog')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $catalog = Catalog::find($id);

            // check if exists
            if (!$catalog)
                return redirect()->route('admin.catalog')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete Photo from folder
            deletePhotos($catalog->photo);

            // delete pdf from folder
            deletePdf($catalog->pdf);


            // delete row from Table
            $catalog->delete();

            // redirect success
            return redirect()->route('admin.catalog')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.catalog')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $catalog = Catalog::find($id);

            if (!$catalog) {
                return redirect()->route('admin.catalog')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $catalog->is_active;

            changeSts($status, $catalog);

            return redirect()->route('admin.catalog')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.catalog')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
