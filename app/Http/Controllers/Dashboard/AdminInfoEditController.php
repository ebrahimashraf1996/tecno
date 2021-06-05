<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminInfoEditController extends Controller
{
    public function editInfo($id)
    {
        $id = decrypt($id);
        $admin = Admin::find($id);

        if (!$admin)
            return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما برجاء المحاولة فيما بعد']);
        return view('dashboard.admin.edit', compact('admin'));
    }

    public function updateInfo(AdminEditRequest $request, $id)
    {
        try {
            $id = decrypt($id);
            $admin = Admin::find($id);

            if (!$admin)
                return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما برجاء المحاولة فيما بعد']);
            DB::beginTransaction();
            $admin->update($request->only('password'));


            DB::commit();
            return redirect()->route('admin.dashboard')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
