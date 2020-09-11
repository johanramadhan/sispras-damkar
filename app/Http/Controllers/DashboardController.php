<?php

namespace App\Http\Controllers;

use App\Product;
use App\Proposal;
use App\TransactionDetail;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = TransactionDetail::with(['transaction.user','product.galleries'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            });

        $asets = Product::with(['user','galleries'])
                            ->where('users_id', Auth::user()->id);

        $proposals = Proposal::with(['user','galleries'])
                            ->where('users_id', Auth::user()->id);
        
        $proposal = Proposal::with(['galleries','category'])
                    ->where('users_id', Auth::user()->id)
                    ->latest()->get();
                            

        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });

        $producttotal = $asets->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });
        $proposaltotal = $proposals->get()->reduce(function ($carry, $item){
            return $carry + $item->total_price;
        });

        // $customer = User::count();

        return view('pages.dashboard',[
            'transaction_count' => $transactions->count(),
            'asets' => $asets->count(),
            'proposals' => $proposals->count(),
            'proposal' => $proposal,
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'producttotal' => $producttotal,
            'proposaltotal' => $proposaltotal,
        ]);
        
    }
}
