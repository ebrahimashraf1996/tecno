<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Ad;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('dashboard.products.index', compact('products'));
    }

    public function create()
    {
        return view('dashboard.products.create');
    }

    public function store(ProductRequest $request)
    {
        // validation by Product Request

        DB::beginTransaction();

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $fileName = "";
        if ($request->has('photo')) {
            $fileName = uploadImage('products', $request->photo);
        }

        Product::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
            'is_active' => $request->is_active,
            'photo' => $fileName,
        ]);
        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function edit($id)
    {
        $product = Product::find($id);
        if (!$product)
            return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);

        return view('dashboard.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        try {
            // validation by Product Request  Request

            //Update DB

            $product = Product::with(['productAds' => function ($q) {
                $q->selection();
            }])->find($id);
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

            DB::beginTransaction();


            // Status Update
            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            // Photo Update
            if ($request->has('photo')) {

                deletePhotos($product->photo);

                $fileName = uploadImage('products', $request->photo);
                $product->update([
                    'photo' => $fileName,
                ]);
            }

            $product->update($request->except('_token', 'id', 'photo'));

            foreach ($product->productAds as $ad) {
                Ad::where('id', $ad->id)->update(['parent_status' => $request->is_active]);
            }


            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroy($id)
    {
        try {
            //get specific paragraph
            $product = Product::find($id);

            // check if exists
            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

            // delete Photo from folder
            deletePhotos($product->photo);

            // delete row from Table
            $product->delete();

            // redirect success
            return redirect()->route('admin.products')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function changeStatus($id)
    {
        try {
            $product = Product::with(['productAds' => function ($q) {
                $q->selection();
            }])->find($id);

            if (!$product) {
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);
            }


            $parent_status = $product->is_active;

            $parent_status = $parent_status == 1 ? 0 : 1;
            $product->update(['is_active' => $parent_status]);

            foreach ($product->productAds as $ad) {
                Ad::where('id', $ad->id)->update(['parent_status' => $parent_status]);
            }

            return redirect()->route('admin.products')->with(['success' => 'تم تغيير حالة المنتج بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function showImages($id)
    {
        $product = Product::selection()->find($id);
        $images = ProductImage::where('product_id', $id)->selection()->get();
        return view('dashboard.productImages.index', compact('product', 'images'));
    }

    public function addImages($id)
    {
        $product = Product::selection()->find($id);
        // check if exists
        if (!$product)
            return redirect()->back()->with(['error' => 'هذا العنصر غير موجود ']);

        return view('dashboard.productImages.create', compact('product'));
    }

    // Save Images in Folder Only
    public function saveImages(Request $request)
    {
        $file = $request->file('dzfile');
        $filename = uploadImage('productImages', $file);

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function storeImages(Request $request)
    {
        try {
            DB::beginTransaction();
            if (!$request->has('document')) {
                return redirect()->route('admin.product.images.create', $request->product_id)->with(['error' => 'برجاء اختيار صورة أو أكثر']);

            } else {

                // save dropzone images
                if ($request->has('document') && count($request->document) > 0) {
                    foreach ($request->document as $image) {
                        ProductImage::create([
                            'is_active' => 1,
                            'photo' => $image,
                            'product_id' => $request->product_id,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.products.show.images', $request->product_id)->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {

            DB::rollBack();
            return redirect()->route('admin.products.show.images', $request->product_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }


    public function imageDestroy($id)
    {
        try {
            //get specific item
            $image = ProductImage::find($id);

            // check if exists
            if (!$image)
                return redirect()->back()->with(['error' => 'هذا العنصر غير موجود ']);

            // delete Photo from folder
            deletePhotos($image->photo);

            // delete row from Table
            $image->delete();

            // redirect success
            return redirect()->back()->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->back()(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function imageChangeStatus($id)
    {
        try {
            $image = ProductImage::find($id);

            if (!$image) {
                return redirect()->back()->with(['error' => 'هذا العنصر غير موجود']);
            }
            $status = $image->is_active;

            changeSts($status, $image);

            return redirect()->back()->with(['success' => 'تم تغيير حالة العنصر بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }


}

