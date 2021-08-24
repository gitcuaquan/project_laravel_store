<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\img_products;
use App\Models\Products;
use App\Models\sub_category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(["module_active" => "product"]);
            return $next($request);
        });
    }

    public function index()
    {
        $products = Products::paginate(5);
        return view('admin.product.show', compact('products'));
    }
    public function add()
    {
        $sub_cat =  sub_category::all();
        $cat = category::all();
        return view('admin.product.add', compact('cat', 'sub_cat'));
    }
    public function ajax(Request $request)
    {
        $data = array();
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:png,jpg,jpeg,svg,gif|max:8192'
        ], [
            'mimes' => 'File Không Phải Là File Ảnh'
        ]);
        if ($validator->fails()) {
            $data['success'] = 0;
            $data['error'] = $validator->errors()->first('file'); // Error response
        } else {
            if ($request->file('file')) {
                $file = $request->file('file');
                $filename = time() . '_' . $file->getClientOriginalName();
                // File extension
                $extension = $file->getClientOriginalExtension();
                // File upload location
                $location = 'files/thumbnail';
                // Upload file
                $file->move($location, $filename);
                // File path
                $filepath = url('files/thumbnail/' . $filename);
                $filepath_save = 'files/thumbnail/' . $filename;
                // Response
                $data['success'] = 1;
                $data['message'] = 'Đăng Ảnh Thành Công !';
                $data['filepath'] = $filepath;
                $data['pathsave'] = $filepath_save;
                $data['extension'] = $extension;
            } else {
                // Response
                $data['success'] = 2;
                $data['message'] = 'Không thể tải ảnh';
            }
        }
        return response()->json($data);
    }
    public function ajaxMuti(Request $request)
    {
        $validatedData = $request->validate([
            'images' => 'required',
            'images.*' => 'mimes:jpg,png,jpeg,gif,svg'
        ]);

        if ($request->TotalImages > 0) {
            for ($x = 0; $x < $request->TotalImages; $x++) {
                if ($request->hasFile('images' . $x)) {
                    $file = $request->file('images' . $x);

                    $filename = time() . '_' . $file->getClientOriginalName();
                    // $extension = $file->getClientOriginalExtension();
                    // File upload location
                    $location = 'files/details';
                    // Upload file
                    $file->move($location, $filename);
                    // File path
                    $filepath = url('files/details/' . $filename);
                    $filepath_save = 'files/details/' . $filename;
                    // $path = $file->store('public/images');
                    $insert[$x]['name'] = $filename;
                    $insert[$x]['path'] = $filepath;
                    $insert[$x]['path_save'] = $filepath_save;
                }
            }
            return response()->json(['status' => 'success', 'img' => $insert]);
        }
    }
    public function ajaxCat(Request $request)
    {
        $key = $request->key;
        $result =  sub_category::where('parent_id', $key)->get(['id', 'name']);
        $data['status'] = "success";
        $data['res'] = $result;
        return response()->json($data);
    }
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'width' => 'numeric',
            'height' => 'numeric',
            'long' => 'numeric',
            'material' => 'required',
            'description' => 'required',
            'path_img_thumb' => 'required',
            'amount' => 'required|numeric',
            'category' => 'required',
        ], [
            'required' => ' :attribute không được để trống',
            'numeric' => 'Vui lòng Nhập Số Vào :attribute',
            'min' => ":attribute Quá Ngắn"
        ], [
            'name' => 'Tên Sản Phẩm',
            'price' => 'Giá Sản Phẩm',
            'width' => 'Độ Rộng',
            'height' => 'Độ Cao',
            'long' => 'Dộ Dài',
            'material' => 'Chât liệu',
            'description' => 'Mô Tả',
            'path_img_thumb' => 'Ảnh Đại Diện',
            'amount' => 'Số Lượng',
            'category' => 'Loại Sản Phẩm'
        ]);

        $result =  Products::create([
            'name' => $request->name,
            'price' =>  $request->price,
            'width' =>  $request->width,
            'height' =>  $request->height,
            'long' =>  $request->long,
            'material' =>  $request->material,
            'description' =>  $request->description,
            'thumnail' =>  $request->path_img_thumb,
            'amount' => $request->amount,
            'cat_id' => $request->category,
        ]);
        $id =  $result->id;
        if (!empty($request->path_img)) {
            foreach ($request->path_img as $link) {
                img_products::create([
                    'product_id' => $id,
                    'path' => $link
                ]);
            }
        }
        if (isset($id)) {
            return redirect('admin/product/add')->with(['status' => 'Thêm Sản Phẩm Thành Công ']);
        } else {
            unlink(url($result->thumnail));
            return 'thêm thất bại';
        }
    }
    public function edit($id)
    {   
        $product = Products::find($id);
        $parent_id =  sub_category::find($product->cat_id);
        $sub_cat =  sub_category::all();
        $cat = category::all();
        $img =  img_products::where('product_id', $id)->get();
        return view('admin.product.edit', compact('product', 'img','sub_cat','cat','parent_id'));
    }
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'width' => 'numeric',
            'height' => 'numeric',
            'long' => 'numeric',
            'material' => 'required',
            'description' => 'required',
            'amount' => 'required|numeric',
            'category' => 'required',
            'img' => 'image|max:9000',

        ], [
            'required' => ' :attribute không được để trống',
            'numeric' => 'Vui lòng Nhập Số Vào :attribute',
            'min' => ":attribute Quá Ngắn",
            'image' => ":attribute Cẩn Đưa Vào File Ảnh"
        ], [
            'name' => 'Tên Sản Phẩm',
            'price' => 'Giá Sản Phẩm',
            'width' => 'Độ Rộng',
            'height' => 'Độ Cao',
            'long' => 'Dộ Dài',
            'material' => 'Chât liệu',
            'description' => 'Mô Tả',
            'amount' => 'Số Lượng',
            'category' => 'Loại Sản Phẩm',
            'img' => 'Ảnh đại hiện',
            'images' => 'Các Ảnh Mô Tả'
        ]);

        $data = [
            'name' => $request->name,
            'price' =>  $request->price,
            'width' =>  $request->width,
            'height' =>  $request->height,
            'long' =>  $request->long,
            'material' =>  $request->material,
            'description' =>  $request->description,
            'amount' => $request->amount,
            'cat_id' => $request->category,
        ];
        Products::where('id', $id)->update($data);
        if (isset($request->img)) {
            $link =  Products::find($id)->thumnail;
            unlink($link);
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = 'files/thumbnail';
            $file->move($location, $filename);
            $filepath_save = 'files/thumbnail/' . $filename;
            Products::where('id', $id)->update(['thumnail' => $filepath_save]);
        }
        if (isset($request->images)) {
            if (!empty($request->path_unlink)) {
                foreach ($request->path_unlink as $item) {
                    img_products::where('path', $item)->delete();
                    unlink($item);
                }
            }
            $file = $request->file('images');
            $data = [];
            foreach ($file as $img) {
                $filename = time() . '_' . $img->getClientOriginalName();
                $location = 'files/details';
                $img->move($location, $filename);
                $filepath_save = 'files/details/' . $filename;
                $data[] =  $filepath_save;
            }
            foreach ($data as $i) {
                img_products::create([
                    'product_id' => $id,
                    'path' => $i
                ]);
            }
        }

        return redirect(route('product.show'))->with('status', 'Cập Nhật Thành Công');
    }
    function delete($id)
    {
        $img = Products::find($id);
        $data  = img_products::where('product_id', $id)->get('path');
        foreach ($data as $i) {
            unlink($i['path']);
        }
        img_products::where('product_id', $id)->delete();
        if (unlink($img['thumnail']) && Products::find($id)->delete()) {
            return redirect(route('product.show'))->with('status', 'Xóa Sản Phẩm Thành Công');
        } else {
            return redirect(route('product.show'))->with('status', 'Xóa Sản Phẩm Thất Bại');
        }
    }
}
