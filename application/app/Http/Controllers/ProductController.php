<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function productsByCategory($category)
    {
        $response = DB::table('products')->rightJoin('product_categories', function ($join) {
            $join->on('products.id', '=', 'product_categories.product_id');
        })
            ->where('product_categories.category_id', '=', $category)
            ->select('products.id', 'products.name')
            ->orderBy('products.id')
            ->get();

        return response()->json($response);
    }



    public function addProduct(Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        if ($req->name)
            $product = Product::create(array('name' => $req->name));

        if ($req->categories) {
            $categories = explode(',', str_replace(' ', '', $req->categories));

            foreach ($categories as $category) {
                ProductCategory::create(array('product_id' => $product->id, 'category_id' => $category));
            }
        }

        return response()->json($product, 201);
    }

    public function editProduct(Product $product, Request $req)
    {
        if ($req->all() == [])
            return response()->json('', 400);

        if ($req->name)
            $product->update(array('name' => $req->name));

        if ($req->categories) {
            DB::table('product_categories')->where('product_id', '=', $product->id)->delete();

            $categories = explode(',', str_replace(' ', '', $req->categories));

            foreach ($categories as $category) {
                ProductCategory::create(array('product_id' => $product->id, 'category_id' => $category));
            }
        }

        return response()->json($product, 200);
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return response()->json('', 204);
    }
}
