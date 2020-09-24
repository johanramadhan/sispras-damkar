@extends('layouts.admin')

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endpush

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
                  <a href="{{ route('proposalexport') }}" class="btn btn-success mb-3">
                  Export Excel
                  </a>
                  <div class="table-responsive">
                    <table class="table table-hover scroll-horizontal-vertical w-100" id="dataTable">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Kode Pengajuan</th>
                          <th>Nama Barang</th>
                          <th class="text-center">User Pengaju</th>
                          <th class="text-center">Kategori</th>
                          <th>Jumlah</th>
                          <th class="text-center">Harga Satuan</th>
                          <th>Total Harga</th>
                          <th class="text-center">Fungsi</th>
                          <th>Gambar</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($proposals as $proposal)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $proposal->code }}</td>
                            <td>{{ $proposal->name }}</td>
                            <td>{{ $proposal->user->name }}</td>
                            <td>{{ $proposal->category->name }}</td>
                            <td class="text-center">{{ $proposal->qty }}</td>
                            <td>Rp{{ number_format($proposal->price) }}</td>
                            <td>Rp{{ number_format($proposal->total_price) }}</td>
                            <td>{{ $proposal->benefit }}</td>
                            <td>
                              <img src="{{Storage::url($proposal->galleries->first()->photos)}}" style="max-height: 50px;">
                            </td>
                            <td>
                              <div class="btn-group">
                                <div class="dropdown">
                                  <button class="btn btn-primary dropdown-toggle mr-1 mb-1"        
                                    type="button"
                                    data-toggle="dropdown">
                                    Aksi
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('proposal.edit', $proposal->id) }}">
                                      Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboard-proposal-details', $proposal->id) }}">
                                      Detail
                                    </a>
                                    <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST">
                                      {{method_field('delete')}} {{  csrf_field()}}
                                      <button type="submit" class="dropdown-item text-danger">
                                        Hapus
                                      </button>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </td>
                        @endforeach
                      </tbody>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
 <script>
    $(function () {
      $('#dataTable').DataTable({
        
        
      });
    });
  </script>

  {{-- <script>
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
  </script> --}}
@endpush