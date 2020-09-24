<?php

namespace App\Exports;

use App\Proposal;

use App\ProposalGallery;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProposalExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function view(): View
    {
        $proposals = Proposal::with(['user', 'category', 'galleries'])->get();
        $pengajuan = Proposal::sum('total_price');

        return view('pages.admin.exports.proposal', [
            'proposals' => $proposals,
            'pengajuan' => $pengajuan,
        ]);
    }

    

    
}
