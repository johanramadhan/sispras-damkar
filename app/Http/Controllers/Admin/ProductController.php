<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;

Use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['user', 'category'])->get();
        $totalaset = Product::sum('total_price');
        if(request()->ajax())
        {
            $query = Product::with(['user', 'category']);
           

            return Datatables::of($query)
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
                        <a class="dropdown-item" href="' .route('product.edit', $item->id). '">
                          Sunting
                        </a>
                        <form action="'. route('product.destroy', $item->id) .'" method="POST">
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

        return view('pages.admin.product.index',[
          'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users = User::all();  
      $categories = Category::all();  
      
      return view('pages.admin.product.create',[
        'users' => $users,
        'categories' => $categories,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photos')->store('assets/product','public')
        ];

        ProductGallery::create($gallery);

        return redirect()->route('product.index')
          ->with('success', 'Data aset berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::with(['galleries','user','category'])->findOrFail($id);
        $users = User::all();  
        $categories = Category::all(); 

        return view('pages.admin.product.edit', [
          'item' => $item,
          'users' => $users,
          'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index')
          ->with('update', 'Data aset berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');

    }
}
