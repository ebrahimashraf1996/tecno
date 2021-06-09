<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecondSectionsRequest;
use App\Models\SecondSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;//secondSections

class SecondSectionController extends Controller
{
    public function index()
    {
        $sections = SecondSection::all();

        return view('dashboard.secondSections.index', compact('sections'));
    }

    public function create()
    {
        return view('dashboard.secondSections.create');
    }

    public function store(SecondSectionsRequest $request)
    {
        // validation by SecondSectionsRequest

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('secondSections', $request->photo);
        }

        SecondSection::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.second.sections')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $section = SecondSection::find($id);
        if (!$section)
            return redirect()->route('admin.second.sections')->with(['error' => 'هذا القسم غير موجود']);

        return view('dashboard.secondSections.edit', compact('section'));
    }

    public function update(SecondSectionsRequest $request, $id)
    {
        try {
            // validation by SecondSectionsRequest

            //Update DB

            $section = SecondSection::find($id);
            if (!$section)
                return redirect()->route('admin.second.sections')->with(['error' => 'هذا القسم غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {
                if (str_ends_with($section->photo, '.jpg') || str_ends_with($section->photo, '.png') || str_ends_with($section->photo, '.jpeg')) {
                    deletePhotos($section->photo);
                }
                $fileName = uploadImage('secondSections', $request->photo);
                $section->update([
                    'photo' => $fileName,
                ]);
            }

            $section->update($request->except('_token', 'id', 'photo'));


            DB::commit();
            return redirect()->route('admin.second.sections')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.second.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $section = SecondSection::find($id);

            // check if exists
            if (!$section)
                return redirect()->route('admin.second.sections')->with(['error' => 'هذا القسم غير موجود ']);

            // delete Photo from folder
            if (str_ends_with($section->photo, '.jpg') || str_ends_with($section->photo, '.png') || str_ends_with($section->photo, '.jpeg')) {
                deletePhotos($section->photo);
            }
            // delete row from Table
            $section->delete();

            // redirect success
            return redirect()->route('admin.second.sections')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.second.sections')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $section = SecondSection::find($id);

            if (!$section) {
                return redirect()->route('admin.second.sections')->with(['error' => 'هذا القسم غير موجود']);
            }
            $status = $section->is_active;

            changeSts($status, $section);

            return redirect()->route('admin.second.sections')->with(['success' => 'تم تغيير حالة القسم بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.second.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function removePhoto($id)
    {
        try {
            $section = SecondSection::find($id);

            if (!$section) {
                return redirect()->route('admin.second.sections')->with(['error' => 'هذا القسم غير موجود']);
            }

            if (str_ends_with($section->photo, '.jpg') || str_ends_with($section->photo, '.png') || str_ends_with($section->photo, '.jpeg')) {
                deletePhotos($section->photo);
            }

            $section->update([
                'photo' => null
            ]);

            return redirect()->route('admin.second.sections')->with(['success' => 'تم حذف صورة القسم بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.second.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
