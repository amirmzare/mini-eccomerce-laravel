<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
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
