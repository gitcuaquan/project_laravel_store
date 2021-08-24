<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OderController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request , $next){
            session(["module_active"=>"oder"]);
            return $next($request);
        });
        
    }

    function index(){

        return view('admin.oder.show');

    }
    
    function showw($id){
        return view('admin.oder.detail');
    }

    function edit($id){
        return view('admin.oder.edit');

    }
}
