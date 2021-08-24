<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Products;
use App\Models\sub_category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientContrller extends Controller
{
    function __construct()
    {
    }
    function home()
    {

        $sub_cat =  sub_category::all();
        $cat = category::all();
        return view('client.home', compact('cat', 'sub_cat'));
    }
    function product($cat_id = 0)
    {
        $sub_cat =  sub_category::all();
        $cat = category::all();
        if ($cat_id == 0) {
            $products = Products::all();
            return view('client.product', compact('products', 'sub_cat', 'cat'));
        }
    }
    function delete(Request $request)
    {
        $rowId = $request->rowId;
        Cart::remove($rowId);
        $data = [
            'status' => 'success',
            'id_remove' => $rowId,
            'num_oder' => Cart::content()->count(),
            'total' => Cart::total()
        ];
        return response()->json($data);
    }
    function show($id)
    {
        $sub_cat =  sub_category::all();
        $cat = category::all();
        $product = Products::find($id);
        return view('client.detail', compact('product','sub_cat', 'cat'));
    }
}
