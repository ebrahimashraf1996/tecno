<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialRequest;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialController extends Controller
{
    public function index()
    {
        $socials = Social::all();

        return view('dashboard.social.index', compact('socials'));
    }

    public function edit($id)
    {
        $social = Social::find($id);
        if (!$social)
            return redirect()->route('admin.social')->with(['error' => 'هذا العنصر غير موجود']);

        return view('dashboard.social.edit', compact('social'));
    }

    public function update(SocialRequest $request, $id)
    {
        try {
            // validation by SocialRequest

            //Update DB

            $social = Social::find($id);
            if (!$social)
                return redirect()->route('admin.social')->with(['error' => 'هذا العنصر غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);



            $social->update($request->only('url', 'is_active'));


            DB::commit();
            return redirect()->route('admin.social')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.social')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }


    public function changeStatus($id)
    {
        try {
            $social = Social::find($id);

            if (!$social) {
                return redirect()->route('admin.social')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $social->is_active;

            changeSts($status, $social);

            return redirect()->route('admin.social')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.social')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
