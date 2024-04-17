<?php

namespace App\Http\Controllers;

use App\Exports\DetailExport;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function store(Request $request)
    {
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
            'user_id' => auth()->user()->id,
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

        return redirect('/dashboard/sales/invoice/' . $newSale->id)->with('success', 'Sale created successfully');
    }

    public function invoice($id)
    {
        $customer = Customer::find($id);
        $sale = Sale::find($id);
        $details = SalesDetail::where('sale_id', $id)->get();
        return view('pages.goods.product.invoice', compact('sale', 'details', 'customer'));
    }

    public function export_excel_detail()
    {
        return Excel::download(new DetailExport, 'detail-sales.xlsx');
    }

    public function pdf(){
        $sales = Sale::all();
        $pdf = Pdf::loadview('pages.goods.product.pdf', ['sales' => $sales]);
        return $pdf->download('sales.pdf');
    }

    public function detail_destroy($id)
    {
        Sale::find($id)->delete();
        SalesDetail::where('sale_id', $id)->delete();
        return redirect()->back()->with('success', 'Detail Sale deleted successfully');
    }

    public function delete_sale($id)
    {
        Sale::find($id)->delete();
        return redirect('/dashboard/sales')->with('success', 'Sale Rejected');
    }
}
