<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Proposal;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index()
    {
        $users = User::all();
        $proposals = Proposal::with(['galleries'])->paginate(32);

        return view('pages.pengajuan',[
            'users' => $users,
            'proposals' => $proposals
        ]);
    }

    public function detail(Request $request, $slug)
    {
        $users = User::all();
        $user = User::where('slug', $slug)->firstOrFail();
        $proposals = Proposal::with(['galleries'])->where('users_id', $user->id)->paginate(32);

        return view('pages.pengajuan',[
            'users' => $users,
            'proposals' => $proposals
        ]);
    }
}
