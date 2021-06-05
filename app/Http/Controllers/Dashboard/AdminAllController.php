<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminAllController extends Controller
{
    public function index() {
        $admins = Admin::selection()->get();
        return view('dashboard.admin.index',compact('admins'));
    }
}
