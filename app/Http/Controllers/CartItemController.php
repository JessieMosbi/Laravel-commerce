<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdateCartItem;
use App\Models\Cart;
use App\Models\CartItem;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute 是必填',
            'integer' => ':attribute 必須為整數',
            'between' => ':attribute 不在 :min 和 :max 之間'
        ];

        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ], $message);

        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $validatedData = $validator->validate(); // 此函數會儲存驗證通過的資料

        $cart = Cart::find($validatedData['cart_id']);
        $cartItem = $cart->cartItems()->create([
            'product_id' => $validatedData['product_id'],
            'quantity' => $validatedData['quantity']
        ]);

        return response()->json($cartItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 執行 update function 時，會呼叫 UpdateCartItem 裡面的程式去做 validation
    public function update(UpdateCartItem $request, $id)
    {
        $form = $request->validated();
        // CartItem::find($id)->update([
        //     'quantity' => $form['quantity']
        // ]);
        $item = CartItem::find($id); // fill: 先填好但不儲存
        $item->fill(['quantity' => $form['quantity']]);
        $item->save();
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CartItem::withTrashed()->find($id)->forceDelete();
        return response()->json(true);
    }
}
