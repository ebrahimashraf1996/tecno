<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactUsUser;
use Illuminate\Http\Request;

class AdminMessagesController extends Controller
{
    public function index()
    {
        $messages = ContactUsUser::selection()->get();
        return view('dashboard.messages.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactUsUser::selection()->find($id);
        if (!$message)
            return redirect()->route('admin.messages')->with(['error' => 'هذه الرسالة غير موجودة']);

        $message->update(['is_checked' => 1]);
        return view('dashboard.messages.show', compact('message'));
    }

    public function destroy($id)
    {
        try {
            $message = ContactUsUser::find($id);
            if (!$message)
                return redirect()->route('admin.messages')->with(['error' => 'هذه الرسالة غير موجودة']);
            $message->delete();

            return redirect()->route('admin.messages')->with(['success' => 'تم الحذف بنجاح']);


        } catch (\Exception $ex) {
            return redirect()->route('admin.messages')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
