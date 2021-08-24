<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(["module_active" => "user"]);
            return $next($request);
        });
    }

    function index()
    {
        $users = User::all();
        $count_not_auth = count(User::where('email_verified_at',null)->get()) ;
        $count_adimn = count(User::where('role_id',1)->get()) ;
        $count_auth =count(User::where('email_verified_at',"!=",null)->get());
        return view('admin.user.show', compact('users','count_not_auth','count_adimn','count_auth'));
    }
    function add()
    {
        return view('admin.user.add');
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
                $extension = $file->getClientOriginalExtension();
                $location = 'files/avata';
                $file->move($location, $filename);
                $filepath = url('files/avata/' . $filename);
                $filepath_save = 'files/avata/' . $filename;
                $data['success'] = 1;
                $data['message'] = 'Đăng Ảnh Thành Công !';
                $data['filepath'] = $filepath;
                $data['pathsave'] = $filepath_save;
                $data['extension'] = $extension;
            } else {
                $data['success'] = 2;
                $data['message'] = 'Không thể tải ảnh';
            }
        }
        return response()->json($data);
    }
    function create(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'gender' => 'required',
                'role' => 'required',
                'date' => 'required',
                'path_img_thumb' => 'required'

            ],
            [
                'required' => ':attribute không Được Để Trống'
            ],
            [
                'gender' => 'giới tính',
                'role' => 'Phân Quyền',
                'date' => 'Ngày Sinh',
                'path_img_thumb' => 'Ảnh Đại Diện'
            ]

        );
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'birth_day' => $request->date,
            'avata' => $request->path_img_thumb,
            'role_id' => $request->role == null ? '1' : $request->role
        ];
        // dd($data);
        User::create($data);
        return redirect(route('user.show'))->with('status', 'Thêm Thành Viên Thành Công');
    }
    function delete($id)
    {
        $id_auth  = Auth::id();
        if ($id == $id_auth) {
            return redirect(route('user.show'))->with('err', '<strong> Cảnh Báo </strong>:Bạn Không Thể Thực Hiện Xóa Chính Mình ');
        } else {
            $unlink = User::find($id)->avata;
            unlink($unlink);
            User::find($id)->delete();
            return redirect(route('user.show'))->with('status', '<strong> Thông Báo </strong>:Xóa Thành Viên Thành Công');
        }
    }
    function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }
    function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => md5($request->password),
            'gender' => $request->gender,
            'phone_number' => $request->phone,
            'address' => $request->address,
            'birth_day' => $request->date,
            'role_id' => $request->role
        ];
        // dd($data);
        User::where('id', $id)->update($data);
        if (isset($request->img)) {
            if (User::find($id)->avata != null) {
                $link =  User::find($id)->avata;
                unlink($link);
            }
            $file = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $location = 'files/avata';
            $file->move($location, $filename);
            $filepath_save = 'files/avata/' . $filename;
            User::where('id', $id)->update(['avata' => $filepath_save]);
        }
        return redirect(route('user.show'))->with('status', 'Cập Nhật Thành Viên Thành Công');
    }
    function search(Request $request)
    {
        $data = [];
        if ($request->key != null) {
            $key = $request->key;
            $result =  User::where('email','LIKE',"%{$key}%")->get();
                $data['status']='success';
                $data['result']=$result;
        }
        return response()->json($data);
    }
}
