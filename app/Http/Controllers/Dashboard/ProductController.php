<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
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

            $product = Product::find($id);
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
            $product = Product::find($id);

            if (!$product) {
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود']);
            }
            $status = $product->is_active;

            changeSts($status, $product);

            return redirect()->route('admin.products')->with(['success' => 'تم تغيير حالة المنتج بنجاح']);

        } catch (\Exception $exception) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }
}

