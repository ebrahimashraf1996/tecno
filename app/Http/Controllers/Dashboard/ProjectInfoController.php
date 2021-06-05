<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageInfoRequest;
use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectInfoController extends Controller
{
    public function edit()
    {
        $proInfo = ProjectInfo::first();
        if (!$proInfo)
            return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما يرجي المحاولة فيما بعد ']);
        return view('dashboard.projectInfo.edit', compact('proInfo'));
    }

    public function update(PageInfoRequest $request, $id)
    {
        try {
            // validation by PageInfoRequest

            //Update DB

            $proInfo = ProjectInfo::find($id);
            if (!$proInfo)
                return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما يرجي المحاولة فيما بعد ']);

            DB::beginTransaction();
            if ($request->has('logo')) {
                $fileName = uploadImage('projectLogo', $request->logo);
                deletePhotos($proInfo->logo);
                ProjectInfo::where('id', $id)
                    ->update([
                        'logo' => $fileName,
                    ]);

            }

            $proInfo->update($request->except('_token', 'id', 'logo'));


            DB::commit();
            return redirect()->route('admin.dashboard')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }


    }
}
