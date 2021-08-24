<?php

namespace App\Http\Controllers;

use App\Mail\SendBill;
use App\Models\Products;
use App\Models\user_cart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Products::find($id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => ['thumb' => $product->thumnail]
        ]);
        session()->flash('status', 'success');
        return redirect('product/0');
    }
    public function detail_add($id, Request $request)
    {
        $product = Products::find($id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price,
            'options' => ['thumb' => $product->thumnail]
        ]);
        session()->flash('status', 'success');
        return redirect("product/show/{$id}");
    }
    function delete(Request $request)
    {
        $rowId = $request->rowId;
        return response()->json(['status' => $rowId]);
    }
    function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email
        ];
        $cart_id = $data['phone'] . "-" . time();
        Cart::store($cart_id);
        user_cart::create([
            'cart_id' => $cart_id,
            'user_id' => Auth::user() != null ? Auth::user()->id : null,
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email']
        ]);
        Mail::to($data['email'])->send(new SendBill($data));

        return response()->json(['status' => 'success', 'bill_code' => $cart_id]);
    }

    function update(Request $request)
    {
        $rowId = $request->rowId;
        $oder = $request->oder;

        $price = Cart::get($rowId)->price;

        Cart::update($rowId, $oder);

        $data = [
            'num_oder' => Cart::content()->count(),
            'total' => Cart::total(0, ',', '.'),
            'sub_total' => number_format($price * $oder, 0, ',', '.'),
            'num_oder' => Cart::content()->count()
        ];
        return response()->json($data);
    }
}
