<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificationsRequest;
use App\Models\CertificationP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CertificationController extends Controller
{
    public function index()
    {
        $certifications_p_s = CertificationP::all();

        return view('dashboard.certifications.index', compact('certifications_p_s'));
    }

    public function create()
    {
        return view('dashboard.certifications.create');
    }

    public function store(CertificationsRequest $request)
    {
        // validation by Product Request

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);



        CertificationP::create($request->except('_token'));
        DB::commit();
        return redirect()->route('admin.certificate')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $certifications_p = CertificationP::find($id);
        if (!$certifications_p)
            return redirect()->route('admin.certificate')->with(['error' => 'هذا العنصر غير موجود']);

        return view('dashboard.certifications.edit', compact('certifications_p'));
    }

    public function update(CertificationsRequest $request, $id)
    {
        try {
            // validation by Certifications Request

            //Update DB

            $certifications_p = CertificationP::find($id);
            if (!$certifications_p)
                return redirect()->route('admin.certificate')->with(['error' => 'هذا العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $certifications_p->update($request->except('_token', 'id'));


            DB::commit();
            return redirect()->route('admin.certificate')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.certificate')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $certifications_p = CertificationP::find($id);

            // check if exists
            if (!$certifications_p)
                return redirect()->route('admin.certificate')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete row from Table
            $certifications_p->delete();

            // redirect success
            return redirect()->route('admin.certificate')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.certificate')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $certifications_p = CertificationP::find($id);

            if (!$certifications_p) {
                return redirect()->route('admin.certificate')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $certifications_p->is_active;

            changeSts($status, $certifications_p);

            return redirect()->route('admin.certificate')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.certificate')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
