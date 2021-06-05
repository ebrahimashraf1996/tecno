<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAddRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddNewAdminController extends Controller
{

    public function create()
    {
        return view('dashboard.admin.create');
    }

    public function store(AdminAddRequest $request)
    {
        // validation by AdminAddRequest

        DB::beginTransaction();
        Admin::create($request->except('_token'));
        DB::commit();
        return redirect()->route('admin.all')->with(['success' => 'تم الإضافة بنجاح']);

    }
}
