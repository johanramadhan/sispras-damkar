<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Proposal;
use App\Transaction;
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

        $revenue = $transactions->get()->reduce(function ($carry, $item){
            return $carry + $item->price;
        });

        $pengajuans = Proposal::with(['user','galleries']);
        $products = Product::with(['user','galleries']);

        $user = User::count();
        $product = Product::count();
        $proposal = Proposal::count();
        $transaction = Product::sum('price');
        $pengajuan = Proposal::sum('total_price');
        // $transaction = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        return view('pages.admin.dashboard',[
            'user' => $user,
            'product' => $product,
            'transaction' => $transaction,
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,

            'product_data' => $products->get(),
            'proposal' => $proposal,
            'pengajuan' => $pengajuan,
            'pengajuan_data' => $pengajuans->get(),
        ]);
    }
}
