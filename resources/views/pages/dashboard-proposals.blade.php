@extends('layouts.dashboard')

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endpush

@section('title')
    Sispras Dashboard Proposal
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
            Silahkan input barang yang ingin kamu ajukan
        </p>
        </div>
        <div class="dashboard-content">
          <!-- Recent Transactions -->
          <div class="row">
            <div class="col-12 mt-2">
              <ul
                class="nav nav-pills mb-3"
                id="pills-tab"
                role="tablist"
               >
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link active"
                    id="pills-home-tab"
                    data-toggle="pill"
                    href="#pills-home"
                    role="tab"
                    aria-controls="pills-home"
                    aria-selected="true"
                    >Tabel Pengajuan</a
                  >
                </li>
                <li class="nav-item" role="presentation">
                  <a
                    class="nav-link"
                    id="pills-profile-tab"
                    data-toggle="pill"
                    href="#pills-profile"
                    role="tab"
                    aria-controls="pills-profile"
                    aria-selected="false"
                    >Galeri Pengajuan</a
                  >
                </li>
              </ul>
              <div class="tab-content" id="pills-tabContent">
                <div
                  class="tab-pane fade show active"
                  id="pills-home"
                  role="tabpanel"
                  aria-labelledby="pills-home-tab"
                  >
                  
                  <div class="dashboard-content">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card">
                          <div class="card-body">
                            <a href="{{ route('dashboard-proposal-create') }}" class="btn btn-primary mb-3">
                            + Pengajuan Baru
                            </a>
                            <div class="table-responsive">
                              <table class="table table-hover scroll-horizontal-vertical w-100" id="dataTable">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th class="text-center">Fungsi</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($proposals as $proposal)
                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $proposal->name }}</td>
                                      <td>{{ $proposal->category->name }}</td>
                                      <td class="text-center">{{ $proposal->qty }}</td>
                                      <td class="text-center">{{ $proposal->satuan }}</td>
                                      <td>Rp{{ number_format($proposal->price) }}</td>
                                      <td>Rp{{ number_format($proposal->total_price) }}</td>
                                      <td>{{ $proposal->benefit }}</td>
                                      <td>
                                        <div class="btn-group">
                                          <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle mr-1 mb-1"        
                                              type="button"
                                              data-toggle="dropdown">
                                              Aksi
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{ route('dashboard-proposal-edit', $proposal->id) }}">
                                                Edit
                                              </a>
                                              <a class="dropdown-item" href="{{ route('dashboard-proposal-detail', $proposal->id) }}">
                                                Detail
                                              </a>
                                              <form action="{{ route('dashboard-proposal-delete', $proposal->id) }}" method="POST">
                                                {{method_field('delete')}} {{  csrf_field()}}
                                                <button type="submit" class="dropdown-item text-danger">
                                                  Hapus
                                                </button>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
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

                <div
                  class="tab-pane fade"
                  id="pills-profile"
                  role="tabpanel"
                  aria-labelledby="pills-profile-tab"
                  >

                  @foreach ($proposals as $proposal)
                    <a
                      href="{{ route('dashboard-proposal-detail', $proposal->id) }}"
                      class="card card-list d-block"
                      >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="{{ Storage::url($proposal->galleries->first()->photos ?? '') }}"
                              class="w-50"
                            />
                          </div>
                          <div class="col-md-3">{{ $proposal->name }} - {{ $proposal->brand }}</div>
                          <div class="col-md-1">{{ $proposal->qty }} {{ $proposal->satuan }}</div>
                          <div class="col-md-2">Rp{{ number_format($proposal->total_price) }}</div>
                          <div class="col-md-2">{{ $proposal->proposal_status }}</div>
                          <div class="col-md-2">{{ $proposal->created_at }}</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img
                              src="/images/dashboard-arrow-right.svg"
                              alt=""
                            />
                          </div>
                        </div>
                      </div>
                    </a>
                  @endforeach
                
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
      // columns: [
      //   { data: 'id', name: 'id' },
      //   { data: 'name', name: 'name' },
      //   { data: 'category.name', name: 'category.name' },
      //   { data: 'qty', name: 'qty' },
      //   { data: 'price', name: 'price' },
      //   { data: 'total_price', name: 'total_price' },
      //   { data: 'benefit', name: 'benefit' },
      //   { 
      //     data: 'action', 
      //     name: 'action',
      //     orderable: false,
      //     searcable: false,
      //     width: '15%'
      //   },

      ]
    })
  </script> --}}
@endpush