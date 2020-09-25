<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Admin\ProposalRequest;
use App\Proposal;
use App\ProposalGallery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Str;

class DashboardProposalController extends Controller
{
    public function index()
    {
      $proposals = Proposal::with(['galleries','category','user'])
                    ->where('users_id', Auth::user()->id)
                    ->latest()->get();
          
      $proposal = Proposal::with(['user','galleries'])
                            ->where('users_id', Auth::user()->id);
      
       $proposaltotal = $proposal->get()->reduce(function ($carry, $item){
            return $carry + $item->total_price;
        });

        if(request()->ajax())
        {
            $query = Proposal::with(['galleries','category'])
                    ->where('users_id', Auth::user()->id)
                    ->get();
            
          

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
                        <a class="dropdown-item" href="' .route('dashboard-proposal-edit', $item->id). '">
                          Sunting
                        </a>
                        <form action="'. route('dashboard-proposal-delete', $item->id) .'" method="POST">
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

        return view('pages.dashboard-proposals',[
          'proposals' => $proposals,
          'proposaltotal' => $proposaltotal,
        ]);
    }

    public function create()
    {
      $proposals = Proposal::with(['galleries','user','category']);
      $categories = Category::all();  
      $code = 'SISPRAS-' . mt_rand(0000,999999);
      
      return view('pages.dashboard-proposals-create',[
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

        return redirect()->route('dashboard-proposal');
    }

    public function detail(Request $request, $id)
    {
        // $item = Proposal::findOrFail($id);
        $categories = Category::all();
        $item = Proposal::with(['galleries','user','category'])->findOrFail($id);

        return view('pages.dashboard-proposals-details', [
          'item' => $item,
          'categories' => $categories,
        ]);
    }

    public function edit(Request $request, $id)
    {
        // $item = Proposal::findOrFail($id);
        $categories = Category::all();
        $item = Proposal::with(['galleries','user','category'])->findOrFail($id);

        return view('pages.dashboard-proposals-edit', [
          'item' => $item,
          'categories' => $categories,
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/proposal','public');

        ProposalGallery::create($data);

        return redirect()->route('dashboard-proposal-edit', $request->proposals_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProposalGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-proposal-edit', $item->proposals_id);
    }

    public function update(ProposalRequest $request, $id)
    {
        $data = $request->all();

        $item = Proposal::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-proposal');
    }

    public function delete($id)
    {
        $item = Proposal::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-proposal');

    }
}
