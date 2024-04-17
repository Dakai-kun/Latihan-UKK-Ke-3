<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SalesDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('pages.dashboard');
    }

    public function user(){
        $user = User::all();
        return view('pages.user', compact('user'));
    }

    public function product(){
        $product = Product::all();
        return view('pages.goods.product.product', compact('product'));
    }

    public function sales(){
        $product = Product::all();
        return view('pages.goods.sale.sale', compact('product'));
    }
    
    public function invoice(){
        $sale = Sale::all();
        $product = Product::all();
        return view ('', compact('sale', 'product'));
    }

    public function detail(){
        $detail = SalesDetail::all();
        $sales = Sale::all();
        return view('pages.goods.detail.detail', compact('detail','sales'));
    }
}
