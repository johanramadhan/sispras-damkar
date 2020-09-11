<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProposalGalleryRequest;
use App\Proposal;
use App\ProposalGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProposalGalleryController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $query = ProposalGallery::with(['proposal']);

            return DataTables::of($query)
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
                        <form action="'. route('proposal-gallery.destroy', $item->id) .'" method="POST">
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
              ->editColumn('photos', function($item){
                 return $item->photos ? '<img src="'. Storage::url($item->photos) .'" style="max-height: 100px;" />' : '';
              })
              ->rawColumns(['action','photos'])
              ->make();
        }

        return view('pages.admin.proposal-gallery.index');
    }

    public function create()
    {
      $proposals = Proposal::all();
      
      return view('pages.admin.proposal-gallery.create',[
        'proposals' => $proposals,
      ]);
    }

    public function store(ProposalGalleryRequest $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/proposal','public');

        ProposalGallery::create($data);

        return redirect()->route('proposal-gallery.index');
    }

    public function destroy($id)
    {
        $item = ProposalGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('proposal-gallery.index');

    }
}
