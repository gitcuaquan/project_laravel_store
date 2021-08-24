<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;

class CategoriController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(["module_active" => "cat"]);
            return $next($request);
        });
        session()->forget('status');
    }
    function add_children()
    {
        $cat = category::all();
        $sub_cat = sub_category::all();
        return view('admin.cat.add_children', compact('cat', 'sub_cat'));
    }
    function add_parent()
    {
        $cat = category::all();
        $sub_cat = sub_category::all();
        return view('admin.cat.add_parent', compact('cat', 'sub_cat'));
    }
    function create(Request $request)
    {
        $request->validate(
            ['parent_id' => 'required'],
            ['required' => ":attribute Không Được Trống"],
            ['parent_id' => "Danh Mục Cha"]
        );
        sub_category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect(route('cat.add_children'))->with('status', 'Thêm Danh Mục Con Thành Công');
    }
    function create_parent(Request $request)
    {
        category::create(['name' => $request->name]);
        return redirect(route('cat.add_parent'))->with('status', 'Thêm Danh Mục Cha Thành Công');
    }
}
