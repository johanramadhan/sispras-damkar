<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Proposal;
use Illuminate\Http\Request;

class ProposalDetailController extends Controller
{
    public function detail(Request $request, $id)
    {
        $transaction = Proposal::with(['user','galleries'])
                          ->findOrFail($id);

        return view('pages.admin.dashboard-proposal-details',[
          'transaction' => $transaction
        ]);
    }

     public function update(Request $request, $id)
    {
      $data = $request->all();

      $item = Proposal::findOrFail($id);

      $item->update($data);

      return redirect()->route('dashboard-proposal-details', $id);
    }
}
