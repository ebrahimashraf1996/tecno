<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterContactsRequest;
use App\Models\FooterSectionContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterSectionContactsController extends Controller
{
    public function index()
    {
        $contacts = FooterSectionContact::all();

        return view('dashboard.footerSectionContacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('dashboard.footerSectionContacts.create');
    }

    public function store(FooterContactsRequest $request)
    {
        // validation by Footer Contacts Request

        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            FooterSectionContact::create($request->except('_token'));
            DB::commit();
            return redirect()->route('admin.footer.section.contacts')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.footer.section.contacts')->with(['error' => 'حدث خطأ ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        $contact = FooterSectionContact::find($id);
        if (!$contact)
            return redirect()->route('admin.footer.section.contacts')->with(['error' => 'هذه العنصر غير موجود']);

        return view('dashboard.footerSectionContacts.edit', compact('contact'));
    }

    public function update(FooterContactsRequest $request, $id)
    {
        try {
            // validation by FooterContactsRequest  Request

            //Update DB

            $contact = FooterSectionContact::find($id);
            if (!$contact)
                return redirect()->route('admin.footer.section.contacts')->with(['error' => 'هذه العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $contact->update($request->except('_token', 'id'));


            DB::commit();
            return redirect()->route('admin.footer.section.contacts')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.footer.section.contacts')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific Image
            $contact = FooterSectionContact::find($id);

            // check if exists
            if (!$contact)
                return redirect()->route('admin.footer.section.contacts')->with(['error' => 'هذا العنصر غير موجود ']);


            // delete row from Table
            $contact->delete();

            // redirect success
            return redirect()->route('admin.footer.section.contacts')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.footer.section.contacts')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $contact = FooterSectionContact::find($id);

            if (!$contact) {
                return redirect()->route('admin.footer.section.contacts')->with(['error' => 'هذه العنصر غير موجود']);
            }
            $status = $contact->is_active;

            changeSts($status, $contact);

            return redirect()->route('admin.footer.section.contacts')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.footer.section.contacts')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}

