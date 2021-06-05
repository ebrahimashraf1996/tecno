<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterParagraphRequest;
use App\Models\FooterSectionParagraph;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterSectionParagraphController extends Controller
{
    public function index()
    {
        $paragraphs = FooterSectionParagraph::all();

        return view('dashboard.footerSectionParagraphs.index', compact('paragraphs'));
    }

    public function create()
    {
        return view('dashboard.footerSectionParagraphs.create');
    }

    public function store(FooterParagraphRequest $request)
    {
        // validation by Footer paragraph Request

        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            FooterSectionParagraph::create($request->except('_token'));
            DB::commit();
            return redirect()->route('admin.footer.section.paragraphs')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'حدث خطأ ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        $paragraph = FooterSectionParagraph::find($id);
        if (!$paragraph)
            return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'هذه العنصر غير موجود']);

        return view('dashboard.footerSectionParagraphs.edit', compact('paragraph'));
    }

    public function update(FooterParagraphRequest $request, $id)
    {
        try {
            // validation by FooterParagraphRequest  Request

            //Update DB

            $paragraph = FooterSectionParagraph::find($id);
            if (!$paragraph)
                return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'هذه العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $paragraph->update($request->except('_token', 'id'));


            DB::commit();
            return redirect()->route('admin.footer.section.paragraphs')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $paragraph = FooterSectionParagraph::find($id);

            // check if exists
            if (!$paragraph)
                return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'هذا العنصر غير موجود ']);


            // delete row from Table
            $paragraph->delete();

            // redirect success
            return redirect()->route('admin.footer.section.paragraphs')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $paragraph = FooterSectionParagraph::find($id);

            if (!$paragraph) {
                return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'هذه العنصر غير موجود']);
            }
            $status = $paragraph->is_active;

            changeSts($status, $paragraph);

            return redirect()->route('admin.footer.section.paragraphs')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.footer.section.paragraphs')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
