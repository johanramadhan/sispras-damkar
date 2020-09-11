@extends('layouts.dashboard')

@section('title')
    Sispras Dashboard Proposal Detail
@endsection

@section('content')
  <!-- Section Content -->
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">{{ $item->name }}</h2>
        <p class="dashboard-subtitle">
            Product Details
        </p>
      </div>
      <div class="dashboard-content">
        <!-- update product -->
        <div class="row">
          <div class="col-12">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('dashboard-proposal-updates', $item->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
              <div class="card">
                <div class="card-body">
                  <!-- card -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Barang</label>
                        <input 
                          type="text"
                          name="name" 
                          class="form-control"
                          value="{{ $item->name }}"
                        />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Kategori</label>
                          <select name="categories_id" class="form-control" required>
                            <option value="{{ $item->categories_id }}">Tidak diganti ({{ $item->category->name }})</option>
                            @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Merek Barang</label>
                        <input type="text" class="form-control" name="brand" value="{{ $item->brand }}" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Satuan</label>
                        <select name="satuan" class="form-control" required>
                          <option value="{{ $item->satuan }}">Tidak diganti ({{ $item->satuan }})</option>
                          <option value="Bidang">Bidang</option>
                          <option value="Unit">Unit</option>
                          <option value="Buah">Buah</option>
                          <option value="Jalan">Jalan</option>
                          <option value="Paket">Paket</option>
                          <option value="Besi">Besi</option>
                          <option value="Biro">Biro</option>
                          <option value="Fiber">Fiber</option>
                          <option value="Gros">Gros</option>
                          <option value="Helai">Helai</option>
                          <option value="Kali">Kali</option>
                          <option value="Kayu">Kayu</option>
                          <option value="Lembar">Lembar</option>
                          <option value="Lusin">Lusin</option>
                          <option value="Meter">Meter</option>
                          <option value="Pcs">Pcs</option>
                          <option value="Peket">Peket</option>
                          <option value="Plastik">Plastik</option>
                          <option value="Plong">Plong</option>
                          <option value="SET">SET</option>
                          <option value="Shet">Shet</option>
                          <option value="Stenlis">Stenlis</option>
                          <option value="Beton">Beton</option>
                          <option value="M2">M2</option>
                          <option value="Exp">Exp</option>
                          <option value="Kaleng">Kaleng</option>
                          <option value="Kotak">Kotak</option>
                          <option value="Pasang">Pasang</option>
                          <option value="Slop">Slop</option>
                          <option value="Sambungan">Sambungan</option>
                          <option value="m'">m'</option>
                          <option value="KVA">KVA</option>
                          <option value="Keping">Keping</option>
                        </select>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah Kebutuhan Maksimum</label>
                        <input type="number" class="form-control" name="max_requirement" value="{{ $item->max_requirement }}" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah Barang Yang Diajukan</label>
                        <input type="number" class="form-control" name="qty" id="qty" onkeyup="sum()" value="{{ $item->qty }}" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Harga Satuan</label>
                        <input type="number" class="form-control" name="price" id="price" onkeyup="sum()" value="{{ $item->price }}" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Total Harga</label>
                        <input type="number" class="form-control" readonly name="total_price" id="total_price" value="{{ $item->total_price }}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Manfaat Barang</label>
                        <textarea name="benefit" class="form-control" rows="3" required>{{ $item->benefit }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Link Video Dari Youtube</label>
                        <textarea name="link" class="form-control" rows="3" required>{{ $item->link }}</textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskription</label>
                        <textarea name="description" id="editor">{!! $item->description !!}</textarea>
                      </div>
                    </div>
                  </div>
                  <!-- button -->
                  <div class="row">
                    <div class="col text-right">
                      <button
                        type="submit"
                        class="btn btn-success px-5 btn-block"
                      >
                        Update Product
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- update thumbnail -->
        <div class="row mt-2">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  @foreach ($item->galleries as $gallery)
                    <div class="col-md-4 mb-3">
                      <div class="gallery-container">
                        <img
                          src="{{ Storage::url($gallery->photos ?? '') }}"
                          alt=""
                          class="w-100"
                        />
                        <a
                          href="{{ route('dashboard-proposal-gallery-delete', $gallery->id) }}" class="delete-gallery">
                          <img
                            src="/images/icon-delete.svg"
                            alt=""
                          />
                        </a>
                      </div>
                    </div>
                  @endforeach
                  <div class="col-12">
                    <form action="{{ route('dashboard-proposal-gallery-upload') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="proposals_id" value="{{ $item->id }}">
                    
                      <input
                        type="file"
                        name="photos"
                        id="file"
                        style="display: none;"
                        onchange="form.submit()"
                      />
                      <button
                        type="button"
                        class="btn btn-secondary btn-block mt-3"
                        onclick="thisFileUpload()">
                        Add Photo
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        function thisFileUpload() {
            document.getElementById("file").click();
        }
    </script>
    <script>
        CKEDITOR.replace("editor");
    </script>
    <script>
        function sum() {
            var qty = document.getElementById('qty').value;
            var price = document.getElementById('price').value;
            var result = parseInt(price) * parseInt(qty);
            if (!isNaN(result)) {
                document.getElementById('total_price').value = result;
            }
        }
    </script>
@endpush