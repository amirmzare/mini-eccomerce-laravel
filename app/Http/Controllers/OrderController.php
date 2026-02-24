<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderPostRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $userCartItems = CartService::getItemsWithDetails();

        $getTotalPrices = CartService::getTotalPrices();

        return view('cart', compact('userCartItems','getTotalPrices'));
    }

    public function add(OrderPostRequest $request)
    {
        CartService::add(
            $request->input('product_id'),
            $request->input('qty')
        );

        return redirect()->back();
    }

    public function removeItem(int $productId)
    {
        CartService::remove($productId);

        return back();
    }

    public function clear()
    {
        CartService::clear();

        return back();
    }

    public function updateQty(Request $request)
    {
        $cartItems = $request->input('cart_items');

        foreach ($cartItems as $cartItem) {
            CartService::updateQty($cartItem['product_id'], $cartItem['qty']);
        }

        return back();
    }
}
