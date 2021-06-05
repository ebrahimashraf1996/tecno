<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\NavListsRequest;
use App\Models\NavbarList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NavListsController extends Controller
{
    public function index()
    {
        $lists = NavbarList::all();

        return view('dashboard.navLists.index', compact('lists'));
    }

    public function edit($id)
    {
        $list = NavbarList::find($id);
        if (!$list)
            return redirect()->route('admin.navbar.lists')->with(['error' => 'هذه القائمة غير موجودة']);

        return view('dashboard.navLists.edit', compact('list'));

    }

    public function update(NavListsRequest $request, $id)
    {
        try {
            $list = NavbarList::find($id);

            if (!$list)
                return redirect()->route('admin.navbar.lists')->with(['error' => 'هذا القائمة غير موجودة']);

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $list->update($request->except('id', '_token'));

            DB::commit();
            return redirect()->route('admin.navbar.lists')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.navbar.lists')->with(['error' => 'حدث خطأ ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $list = NavbarList::find($id);

            if (!$list) {
                return redirect()->route('admin.navbar.lists')->with(['error' => 'هذه القائمة غير موجود']);
            }
            $status = $list->is_active;

            changeSts($status, $list);

            return redirect()->route('admin.navbar.lists')->with(['success' => 'تم تغيير حالة القائمة بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.navbar.lists')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
