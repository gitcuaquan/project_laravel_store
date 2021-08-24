<?php

namespace App\Http\Controllers;

use App\Models\sub_category;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function ajaxCat(Request $request)
    {
        $key = $request->key;
        $result =  sub_category::where('parent_id', $key)->get(['id', 'name']);
        $data['status'] = "success";
        $data['res'] = $result;


        return response()->json($data);
    }
}
