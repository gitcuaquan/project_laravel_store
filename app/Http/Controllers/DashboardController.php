<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request , $next){
            session(["module_active"=>"dashboard"]);
            return $next($request);
        });
        
    }
    function index(){
        if (Auth::user()->role_id == 1) {
            return view('admin.dashboard');
        }
        if (Auth::user()->role_id == 2) {
            return redirect('/');
        }
    }
}
