<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function home() {
    $products = Product::with('category')->get();
    $categories = Category::all();
    return view('user.home', compact('products', 'categories'))
           ->with('titlePage', 'Home');
}
    public function filter($id){
        $category = Category::find($id);
        if (!$category) {
            return view('errors.404page');
        }

        $products = Product::with('category')
            ->whereHas('category', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->get();

        $categories = Category::all(); // supaya tombol tetap muncul
        return view('user.home', [
            'titlePage' => $category->name,
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function detail($id){
        $product = Product::find($id);
        if(!$product){
            return view('errors.404page');
        }
        return view('user.detail', [
            'titlePage' => 'Detail',
            'product' => $product
        ]);
    }
}
