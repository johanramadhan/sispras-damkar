<?php

namespace App\Http\Controllers;

use App\Category;
use App\Proposal;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $proposals = Proposal::with(['galleries'])->paginate(32);

        return view('pages.pengajuan',[
            'categories' => $categories,
            'proposals' => $proposals
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $proposals = Proposal::with(['galleries'])->where('categories_id', $category->id)->paginate(32);

        return view('pages.pengajuan',[
            'categories' => $categories,
            'proposals' => $proposals
        ]);
    }
}
