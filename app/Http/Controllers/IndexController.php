<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $title = 'صفحه اصلی';

        $productCategories = ProductCategory::query()
            ->limit(5)
            ->get();

        $newestProducts = Product::query()
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        $bestSellingProducts = Product::query()
            ->withSum('orderItems', "qty")
            ->orderByDesc('order_items_sum_qty')
            ->limit(4)
            ->get();

        return view('index', compact('title', 'productCategories', 'newestProducts', 'bestSellingProducts'));
    }
}
