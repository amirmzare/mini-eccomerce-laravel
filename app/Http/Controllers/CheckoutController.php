<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderSevice;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $userCartItems = CartService::getItemsWithDetails();
        $getTotalPrices = CartService::getTotalPrices();

        return view('checkout',compact('userCartItems','getTotalPrices'));
    }

    public function post(Request $request)
    {
        $checkoutData = $request->only([
           'user_province',
           'user_city',
           'user_address',
           'user_postal_code',
           'user_mobile',
           'description',
        ]);

        try {
            OrderSevice::register($checkoutData);
        }catch (\Exception $exception){
            return back()->withErrors([$exception->getMessage()]);
        }


        return redirect()->route('account.orders');

    }

}


