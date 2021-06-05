<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderImagesRequest;
use App\Models\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SliderImagesController extends Controller
{
    public function index()
    {
        $images = SliderImage::all();

        return view('dashboard.sliderImages.index', compact('images'));
    }

    public function create()
    {
        return view('dashboard.sliderImages.create');
    }

    public function store(SliderImagesRequest $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('sliderImages', $request->photo);
            }

            SliderImage::create([
                'photo' => $fileName,
                'is_active' => $request->is_active
            ]);
            DB::commit();
            return redirect()->route('admin.slider.images')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->route('admin.slider.images')->with(['error' => 'حدث خطأ ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
    {
        $image = SliderImage::find($id);
        if (!$image)
            return redirect()->route('admin.slider.images')->with(['error' => 'هذه الصورة غير موجودة']);

        return view('dashboard.sliderImages.edit', compact('image'));
    }

    public function update(SliderImagesRequest $request, $id)
    {
        try {
            // validation by Slider Images Request

            //Update DB

            $image = SliderImage::find($id);
            if (!$image)
                return redirect()->route('admin.slider.images')->with(['error' => 'هذه الصورة غير موجودة ']);

            DB::beginTransaction();

            // Photo Update
            if ($request->has('photo')) {
                deletePhotos($image->photo);
                $fileName = uploadImage('sliderImages', $request->photo);
                $image->update([
                        'photo' => $fileName,
                    ]);
            }

            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $image->update($request->except('_token', 'id', 'photo'));


            DB::commit();
            return redirect()->route('admin.slider.images')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.slider.images')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific Image
            $image = SliderImage::find($id);

            // check if exists
            if (!$image)
                return redirect()->route('admin.slider.images')->with(['error' => 'هذا الصورة غير موجودة ']);

            // delete photo from Folder
            deletePhotos($image->photo);

            // delete row from Table
            $image->delete();

            // redirect success
            return redirect()->route('admin.slider.images')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.slider.images')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $image = SliderImage::find($id);

            if (!$image) {
                return redirect()->route('admin.slider.images')->with(['error' => 'هذه الصورة غير موجود']);
            }
            $status = $image->is_active;

            changeSts($status, $image);

            return redirect()->route('admin.slider.images')->with(['success' => 'تم تغيير حالة الصورة بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.slider.images')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}
