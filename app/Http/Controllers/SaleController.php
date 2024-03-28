<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'customer_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
        ]);

        $totalPrice = 0;
        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);
            $index = array_search($productId, $request->products);
            $totalPrice += $product->price * $request->quantities[$index];
        }

        $newCustomer = Customer::create([
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
        ]);

        $newSale = Sale::create([
            'customer_id' => $newCustomer->id,
            'date' => date('Y-m-d'),
            'price_total' => $totalPrice,
        ]);

        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);
            $product->update([
                'stock' => $product->stock - $request->quantities[array_search($productId, $request->products)],
            ]);
        }

        foreach ($request->products as $productId) {
            $product = Product::findOrFail($productId);
            SalesDetail::create([
                'sale_id' => $newSale->id,
                'product_id' => $product->id,
                'quantity' => $request->quantities[array_search($productId, $request->products)],
                'subtotal' => $product->price * $request->quantities[array_search($productId, $request->products)],
            ]);
        }

        return redirect()->back()->with('success', 'Sale created successfully');
    }

    public function invoice(Request $request){
        $sale = Sale::all();
        $products = Product::all();
        return view('pages.goods.sale.invoice', compact('sale', 'products'));
    }
}
