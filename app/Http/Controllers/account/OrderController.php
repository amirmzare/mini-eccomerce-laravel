<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $userOrders = Order::query()
            ->where('user_id' , '=' , Auth::id())
            ->orderByDesc('created_at')
            ->paginate();

        return view('account.orders',compact('userOrders'));
    }
}
