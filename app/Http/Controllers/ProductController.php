<?php

namespace App\Http\Controllers;

use App\Enums\ProductStatus;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->applySort()
            ->applyFilter()
            ->applySearch()
            ->where('status', '=', ProductStatus::ENABLE)
            ->paginate()
            ->withQueryString();

        $productCategories = ProductCategory::all();
        return view('products.index', compact('products', 'productCategories'));
    }

    public function show(Product $product)
    {
        $product->load('productCategory');

        $relatedProducts= Product::query()
            ->where('product_category_id' ,'=',$product->product_category_id)
            ->where('id','!=' , $product->id)
            ->limit(6)
            ->get();


        return view('products.show', compact('product','relatedProducts'));
    }
}
