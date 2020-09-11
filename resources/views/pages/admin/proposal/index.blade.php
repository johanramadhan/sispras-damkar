@extends('layouts.admin')

@section('title')
    Pengajuan
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
              List Pengajuan
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('proposal.create') }}" class="btn btn-primary mb-3">
                  + Pengajuan Baru
                  </a>
                  <div class="table-responsive">
                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Kode Pengajuan</th>
                          <th>Nama Barang</th>
                          <th>User Pengaju</th>
                          <th>Kategori</th>
                          <th>Jumlah</th>
                          <th>Harga Satuan</th>
                          <th>Total Harga</th>
                          <th>Fungsi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
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
  <script>
    var datatable = $('#crudTable').DataTable({
      processing: true,
      serverside: true,
      ordering: true,
      ajax: {
        url: '{!! url()->current() !!}',
      },
      columns: [
        { data: 'id', name: 'id' },
        { data: 'code', name: 'code' },
        { data: 'name', name: 'name' },
        { data: 'user.name', name: 'user.name' },
        { data: 'category.name', name: 'category.name' },
        { data: 'qty', name: 'qty' },
        { data: 'price', name: 'price' },
        { data: 'total_price', name: 'total_price' },
        { data: 'benefit', name: 'benefit' },
        { 
          data: 'action', 
          name: 'action',
          orderable: false,
          searcable: false,
          width: '15%'
        },

      ]
    })
  </script>
@endpush