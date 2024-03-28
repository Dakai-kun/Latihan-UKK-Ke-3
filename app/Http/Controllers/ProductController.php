<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(){
        return view('pages.goods.product.create');
    }

    public function store(Request $request){
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return redirect('/dashboard/goods/product')->with('success', 'Product created successfully!');
    }
    
    public function edit($id){
        $product = Product::find($id);
        return view('pages.goods.product.edit', compact('product'));
    }

    public function update(Request $request, $id){
        $updateProduct = $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Product::find($id)->update($updateProduct);

        return redirect('/dashboard/goods/product')->with('success', 'Product updated successfully!');
    }

    public function updateStock(Request $request, $id){
        $updateStock = $request->validate([
            'stock' => 'required',
        ]);

        Product::find($id)->update([
            'stock' => $request->stock + Product::find($id)->stock
        ]);

        Return redirect('/dashboard/goods/product')->with('success', 'Product stock updated successfully!');
    }

    public function delete($id){
        Product::find($id)->delete();
        return redirect('/dashboard/goods/product')->with('success', 'Product deleted successfully!');
    }
}
