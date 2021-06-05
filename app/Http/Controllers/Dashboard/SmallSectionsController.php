<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LargeSectionsRequest;
use App\Http\Requests\LargeSectionsUpdateRequest;
use App\Http\Requests\SmallSectionsRequest;
use App\Models\LargeSection;
use App\Models\SmallSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SmallSectionsController extends Controller
{
    public function index()
    {
        $small_sections = SmallSection::with(['largeSection' => function ($q) {
            $q->selection();
        }])->get();

        return view('dashboard.smallSections.index', compact('small_sections'));
    }

    public function create()
    {
        $large_sections = LargeSection::select('id', 'title_'.LaravelLocalization::getCurrentLocale() . ' as title')->get();
        return view('dashboard.smallSections.create', compact('large_sections'));
    }

    public function store(SmallSectionsRequest $request)
    {
        // validation by Small Sections Request


            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            SmallSection::create([
                'title_ar' => $request->title_ar,
                'title_en' => $request->title_en,
                'small_p_ar' => $request->small_p_ar,
                'small_p_en' => $request->small_p_en,
                'large_section_id' => $request->large_section_id,
                'is_active' => $request->is_active,
                'icon' => $request->icon,
            ]);
            DB::commit();
            return redirect()->route('admin.small.sections')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $large_sections = LargeSection::select('id', 'title_'.LaravelLocalization::getCurrentLocale() . ' as title')->get();
        $small_section = SmallSection::find($id);
        if (!$small_section)
            return redirect()->route('admin.small.sections')->with(['error' => 'هذه القسم غير موجود']);

        return view('dashboard.smallSections.edit', compact('small_section', 'large_sections'));
    }

    public function update(SmallSectionsRequest $request, $id)
    {
        try {
            // validation by Small Sections Update Request

            //Update DB

            $small_section = SmallSection::find($id);
            if (!$small_section)
                return redirect()->route('admin.small.sections')->with(['error' => 'هذه القسم غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $small_section->update($request->except('_token', 'id'));


            DB::commit();
            return redirect()->route('admin.small.sections')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.small.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific section
            $small_section = SmallSection::find($id);

            // check if exists
            if (!$small_section)
                return redirect()->route('admin.small.sections')->with(['error' => 'هذا القسم غير موجود ']);



            // delete row from Table
            $small_section->delete();

            // redirect success
            return redirect()->route('admin.small.sections')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.small.sections')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $small_section = SmallSection::find($id);

            if (!$small_section) {
                return redirect()->route('admin.small.sections')->with(['error' => 'هذه القسم غير موجود']);
            }
            $status = $small_section->is_active;

            changeSts($status, $small_section);

            return redirect()->route('admin.small.sections')->with(['success' => 'تم تغيير حالة القسم بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.small.sections')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
