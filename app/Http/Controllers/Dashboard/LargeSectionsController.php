<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LargeSectionsRequest;
use App\Http\Requests\LargeSectionsUpdateRequest;
use App\Models\LargeSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LargeSectionsController extends Controller
{
    public function index()
    {
        $large_sections = LargeSection::all();

        return view('dashboard.largeSections.index', compact('large_sections'));
    }

    public function create()
    {
        return view('dashboard.largeSections.create');
    }

    public function store(LargeSectionsRequest $request)
    {
        // validation by Large Sections Request

        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('largeSections', $request->photo);
            }

            LargeSection::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'large_p_ar' => $request->large_p_ar,
                'large_p_en' => $request->large_p_en,
                'is_active' => $request->is_active,
                'photo' => $fileName,
            ]);
            DB::commit();
            return redirect()->route('admin.large.sections')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.large.sections')->with(['error' => 'حدث خطأ ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        $large_section = LargeSection::find($id);
        if (!$large_section)
            return redirect()->route('admin.large.sections')->with(['error' => 'هذه القسم غير موجود']);

        return view('dashboard.largeSections.edit', compact('large_section'));
    }

    public function update(LargeSectionsUpdateRequest $request, $id)
    {
        try {
            // validation by Large Sections Update Request

            //Update DB

            $large_section = LargeSection::find($id);
            if (!$large_section)
                return redirect()->route('admin.large.sections')->with(['error' => 'هذه القسم غير موجود ']);

            DB::beginTransaction();

            // Photo Update
            if ($request->has('photo')) {
                if (str_ends_with($large_section->photo, 'g') ) {
                    deletePhotos($large_section->photo);
                }
                $fileName = uploadImage('largeSections', $request->photo);
                $large_section->update([
                    'photo' => $fileName,
                ]);
            }

            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $large_section->update($request->except('_token', 'id', 'photo'));


            DB::commit();
            return redirect()->route('admin.large.sections')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.large.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific Image
            $large_section = LargeSection::find($id);

            // check if exists
            if (!$large_section)
                return redirect()->route('admin.large.sections')->with(['error' => 'هذا القسم غير موجود ']);

            // delete photo from Folder
            if (str_ends_with($large_section->photo, '.jpg') || str_ends_with($large_section->photo, '.png') || str_ends_with($large_section->photo, '.jpeg')) {
                deletePhotos($large_section->photo);
            }

            // delete row from Table
            $large_section->delete();

            // redirect success
            return redirect()->route('admin.large.sections')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.large.sections')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $large_section = LargeSection::find($id);

            if (!$large_section) {
                return redirect()->route('admin.large.sections')->with(['error' => 'هذه القسم غير موجود']);
            }
            $status = $large_section->is_active;

            changeSts($status, $large_section);

            return redirect()->route('admin.large.sections')->with(['success' => 'تم تغيير حالة القسم بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.large.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
    public function removePhoto($id)
    {
        try {
            $large_section = LargeSection::find($id);

            if (!$large_section) {
                return redirect()->route('admin.large.sections')->with(['error' => 'هذا القسم غير موجود']);
            }

            if (str_ends_with($large_section->photo, '.jpg') || str_ends_with($large_section->photo, '.png') || str_ends_with($large_section->photo, '.jpeg')) {
                deletePhotos($large_section->photo);
            }
            $large_section->update([
                'photo' => null
            ]);

            return redirect()->route('admin.large.sections')->with(['success' => 'تم حذف صورة القسم بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.large.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
