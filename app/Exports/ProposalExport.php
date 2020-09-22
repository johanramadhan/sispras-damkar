<?php

namespace App\Exports;

use App\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProposalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    
    public function view(): View
    {
        $proposals = Proposal::with(['user', 'category'])->get();

        return view('pages.admin.exports.proposal', [
            'proposals' => $proposals
        ]);
    }

    
}
