<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
     /**
     * Show the application dashboard.
     *0000
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index(Request $request, $slug)
    {
        
        $item = Product::with(['galleries','user','category'])
                ->where('slug', $slug)
                ->firstOrFail();
        
        return view('pages.detail',[
            'item' => $item,
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
