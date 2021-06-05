<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::all();

        return view('dashboard.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('dashboard.gallery.create');
    }

    // Save Images in Folder Only
    public function save(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = uploadImage('gallery', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request)
    {
        // validation by galleryRequest Request
        try {
            DB::beginTransaction();
            if (!$request->has('document')) {
                return redirect()->route('admin.gallery.create')->with(['error' => 'برجاء اختيار صورة أو أكثر']);

            } else {

                // save dropzone images
                if ($request->has('document') && count($request->document) > 0) {
                    foreach ($request->document as $image) {
                        GalleryImage::create([
                            'is_active' => 1,
                            'photo' => $image,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.gallery')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {

            DB::rollBack();
            return redirect()->route('admin.gallery')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function destroy($id)
    {
        try {
            //get specific item
            $image = GalleryImage::find($id);

            // check if exists
            if (!$image)
                return redirect()->route('admin.gallery')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete Photo from folder
            deletePhotos($image->photo);

            // delete row from Table
            $image->delete();

            // redirect success
            return redirect()->route('admin.gallery')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.gallery')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $image = GalleryImage::find($id);

            if (!$image) {
                return redirect()->route('admin.gallery')->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $image->is_active;

            changeSts($status, $image);

            return redirect()->route('admin.gallery')->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.gallery')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
