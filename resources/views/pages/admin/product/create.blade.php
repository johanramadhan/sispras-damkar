@extends('layouts.admin')

@section('title')
    Create - Aset
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
  >
    <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Aset</h2>
          <p class="dashboard-subtitle">
              Create New Aset
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif
              <div class="card">
                <div class="card-body">
                  <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nama Aset</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Pemilik Aset</label>
                          <select name="users_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Kategori</label>
                          <select name="categories_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div> 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Jumlah Barang</label>
                          <input type="number" name="qty" id="qty" onkeyup="sum()" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Satuan</label>
                          <select name="satuan" class="form-control" required>
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
                          <label>Harga Satuan</label>
                          <input type="number" name="price" id="price" onkeyup="sum()" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label>Kondisi Aset</label>
                         <select name="kondisi" class="form-control" required>
                           <option value="Baik">Baik</option>
                           <option value="Rusak Ringan">Rusak Ringan</option>
                           <option value="Rusak Berat">Rusak Berat</option>
                         </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Total Harga</label>
                          <input type="number" class="form-control" name="total_price" id="total_price" readonly/>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                         <label>Status Aset</label>
                         <select name="status" class="form-control" required>
                           <option value="Pembelian">Pembelian</option>
                           <option value="Hibah">Hibah</option>
                           <option value="dll">dll</option>
                         </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Merek</label>
                          <input type="text" name="brand" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Link Video Dari Youtube</label> <small><i>( Masukkan link video barang jika ada )</i></small>
                          <textarea name="link" class="form-control" rows="2"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Fungsi Aset</label>
                          <textarea name="fungsi" class="form-control" rows="2"></textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Deskripsi Product</label>
                          <textarea name="description" id="editor" ></textarea>
                        </div>
                      </div>                      
                    </div>
                    <div class="row">
                      <div class="col text-right">
                        <button type="submit" class="btn btn-success px-5">
                          Save Now
                        </button>
                      </div>
                    </div>
                </form>
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
        CKEDITOR.replace('editor');
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
