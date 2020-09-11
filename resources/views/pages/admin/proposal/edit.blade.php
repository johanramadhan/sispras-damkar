@extends('layouts.admin')

@section('title')
    Proposal
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Pengajuan</h2>
        <p class="dashboard-subtitle">
          Edit Pengajuan
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
                <form action="{{ route('proposal.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                  <input type="hidden" value="PENDING" name="proposal_status">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>User Pengaju</label>
                        <select name="users_id" class="form-control">
                          <option value="{{ $item->users_id }}" selected>Tidak diganti ({{ $item->user->name }})</option>
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
                          <option value="{{ $item->categories_id }}" selected>Tidak diganti ({{ $item->category->name }})</option>
                          @foreach ($categories as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Merek Barang</label>
                        <input type="text" name="brand" class="form-control" value="{{ $item->brand }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah Barang Yang Diajukan</label>
                        <input type="number" name="qty" id="qty" onkeyup="sum()" class="form-control" value="{{ $item->qty }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jumlah Kebutuhan Maksimum</label>
                        <input type="number" name="max_requirement" class="form-control" value="{{ $item->max_requirement }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Satuan</label>
                        <select name="satuan" class="form-control">
                          <option value="{{ $item->satuan }}" selected>{{ $item->satuan }}</option>
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
                        <input type="number" name="price" id="price" onkeyup="sum()" class="form-control" value="{{ $item->price }}" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Total Harga</label>
                        <input type="number" name="total_price" id="total_price" class="form-control" value="{{ $item->total_price }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Manfaat Barang</label>
                        <input type="text" name="benefit" class="form-control" value="{{ $item->benefit }}" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Deskripsi Barang</label>
                        <textarea name="description" id="editor" >{!! $item->description !!}</textarea>
                      </div>
                    </div>                      
                  </div>
                  <div class="row">
                    <div class="col text-right">
                      <button type="submit" class="btn btn-success btn-block px-5">
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

