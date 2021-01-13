<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use App\Proposal;
use App\ProposalGallery;
use PDF;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProposalExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\ProposalRequest;
use App\Http\Requests\Admin\ProposalGalleryRequest;


class ProposalController extends Controller
{
    public function index()
    {
      $proposals = Proposal::with(['user', 'category'])->get();
      $pengajuan = Proposal::sum('total_price');
        
      if(request()->ajax())
        {
            $query = Proposal::with(['user', 'category']);

            return DataTables::of($query)
              ->addColumn('price', function($item) {
                return '
                Rp'. ( number_format ($item->price) ) .'
                ';
              })
              ->addColumn('total_price', function($item) {
                return '
                Rp'. ( number_format ($item->total_price) ) .'
                ';
              })
              ->addColumn('action', function($item) {
                return '
                  <div class="btn-group">
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle mr-1 mb-1"        
                        type="button"
                        data-toggle="dropdown">
                        Aksi
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="' .route('proposal.edit', $item->id). '">
                          Edit
                        </a>
                        <a class="dropdown-item" href="' .route('dashboard-proposal-details', $item->id). '">
                          Detail
                        </a>
                        <form action="'. route('proposal.destroy', $item->id) .'" method="POST">
                          '. method_field('delete') . csrf_field() .'
                          <button type="submit" class="dropdown-item text-danger">
                            Hapus
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>
                ';
              })
              ->rawColumns(['action'])
              ->make();
        }        

        return view('pages.admin.proposal.index',[
          'proposals' => $proposals,
          'pengajuan' => $pengajuan,
        ]);
    }

    public function export()
    {
      return Excel::download(new ProposalExport, 'pengajuan damkar_2021.xlsx');
      // return (new ProposalExport)->download('pengajuan damkar_2021.xlsx');
      
    }

    public function exportPdf()
    {
      $proposals = Proposal::all();
      $pengajuans = Proposal::sum('total_price');
      $pdf = PDF::loadView('pages.admin.exports.exportpdf',[
        'proposals' => $proposals,
        'pengajuans' => $pengajuans
        
      ])->setPaper('f4', 'portrait')->setWarnings(false);

      // ->setPaper('f4', 'portrait')

      return $pdf->stream();
      
    }

    public function exportPdftable()
    {
      $proposals = Proposal::all();
      $pdf = PDF::loadView('pages.admin.exports.exportpdftable', ['proposals' => $proposals])->setPaper('f4', 'landscape')
      ->setWarnings(false);

      // ->setPaper('f4', 'portrait')

      return $pdf->stream();
      
    }

    public function create()
    {
      $proposals = Proposal::with(['galleries','user','category']);
      $users = User::all();  
      $categories = Category::all();  
      $code = 'SISPRAS-' . mt_rand(0000,999999);
      
      return view('pages.admin.proposal.create',[
        'users' => $users,
        'proposals' => $proposals,
        'categories' => $categories,
        'code' => $code
      ]);
    }

     public function store(ProposalRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $proposal = Proposal::create($data);

        $gallery = [
            'proposals_id' => $proposal->id,
            'photos' => $request->file('photos')->store('assets/proposal','public')
        ];

        ProposalGallery::create($gallery);

        return redirect()->route('proposal.index')
            ->with('success', 'Data pengajuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        // $item = Proposal::findOrFail($id);
        $users = User::all();  
        $categories = Category::all();
        $item = Proposal::with(['galleries','user','category'])->findOrFail($id);

        return view('pages.admin.proposal.edit', [
          'item' => $item,
          'users' => $users,
          'categories' => $categories,
        ]);
    }

    public function update(ProposalRequest $request, $id)
    {
        $data = $request->all();

        $item = Proposal::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('proposal.index')
            ->with('update', 'Data pengajuan berhasil diedit');
    }

    public function destroy($id)
    {
        $item = Proposal::findOrFail($id);
        $item->delete();

        return redirect()->route('proposal.index');

    }

}
