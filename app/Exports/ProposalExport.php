<?php

namespace App\Exports;

use App\Proposal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProposalExport implements FromView, ShouldAutoSize
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
