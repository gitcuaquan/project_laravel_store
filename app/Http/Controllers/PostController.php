<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(["module_active" => "post"]);
            return $next($request);
        });
    }

    function index()
    {
        $posts = Post::paginate(6);
        return view('admin.post.show', compact('posts'));
    }
    function add()
    {
        return view('admin.post.add');
    }
    function create(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'path_img_thumb' => 'required'
        ], [
            'required' => ':attribute Không Được Để Trống'
        ], [
            'content' => 'Chi Tiết Bài Viết',
            'path_img_thumb' => 'Ảnh Đại Diện'
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $request->path_img_thumb
        ]);
        return redirect(route('post.add'))->with('status', 'Thêm Bài Viết Thành Công');
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
    function edit($id)
    {
        $post = Post::find($id);
        return view('admin.post.edit', compact('post'));
    }
    function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'content' => 'required',
        ], [
            'required' => ':attribute Không Được Để Trống'
        ], [
            'content' => 'Chi Tiết Bài Viết',
        ]);
        Post::where('id', $id)->update([
            'title' => $request->title,
            'content'=>$request->content
        ]);
        if($request->hasFile('img')){
            $link =  Post::find($id)->thumbnail;
            unlink($link);
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = 'files/thumbnail';
            $file->move($location, $filename);
            $filepath_save = 'files/thumbnail/' . $filename;
            Post::where('id', $id)->update(['thumbnail' => $filepath_save]);
        }
        return redirect(route('post.show'))->with('status','Sửa Bài Viết Thành Công');
    }
    function delete($id){
        $unlink = Post::find($id)->thumbnail;
        unlink($unlink);
        Post::find($id)->delete();
        return redirect(route('post.show'))->with('status','Xóa Bài Viết Thành Công');
    }
}
