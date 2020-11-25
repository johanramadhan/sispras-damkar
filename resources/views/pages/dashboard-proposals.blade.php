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
                                    <th>Kode Pengajuan</th>
                                    <th>Nama Barang</th>
                                    <th>Merek</th>
                                    <th class="text-center">Kategori</th>
                                    <th class="text-center">Kebutuhan Maksimum</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Satuan</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Harga</th>
                                    <th class="text-center">Fungsi</th>
                                    <th class="text-center">Gambar</th>
                                    <th class="text-center">Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($proposals as $proposal)
                                    <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $proposal->code }}</td>
                                      <td>{{ $proposal->name }}</td>
                                      <td>{{ $proposal->brand }}</td>
                                      <td>{{ $proposal->category->name }}</td>
                                      <td class="text-center">{{ $proposal->max_requirement }}</td>
                                      <td class="text-center">{{ $proposal->qty }}</td>
                                      <td class="text-center">{{ $proposal->satuan }}</td>
                                      <td>Rp{{ number_format($proposal->price) }}</td>
                                      <td>Rp{{ number_format($proposal->total_price) }}</td>
                                      <td>{{ $proposal->benefit }}</td>
                                      <td>
                                        <img src="{{Storage::url($proposal->galleries->first()->photos ?? 'tidak ada foto')}}" style="max-height: 50px;">
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
                                              <a class="dropdown-item" href="{{ route('dashboard-proposal-edit', $proposal->id) }}">
                                                Edit
                                              </a>
                                              <a class="dropdown-item" href="{{ route('dashboard-proposal-detail', $proposal->id) }}">
                                                Detail
                                              </a>
                                              <button type="submit"  id="delete" href="{{ route('dashboard-proposal-delete', $proposal->id) }}" class="dropdown-item text-danger">
                                                    Hapus
                                              </button>
                                              <form action="" method="POST" id="deleteForm">
                                                @csrf
                                                @method("DELETE")
                                                <input type="submit" value="Hapus" style="display: none">
                                                
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                                 <tfoot>
                                    <tr>
                                      <td></td>
                                      <td colspan="8" class="font-weight-bold">Total</td>
                                      <td class="text-right font-weight-bold">Rp{{ number_format($proposaltotal) }}</td>
                                      <td colspan="3"></td>
                                    </tr>
                                  </tfoot>
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
                          <div class="col-md-2">{{ date('d-M-Y', strtotime($proposal->created_at)) }}</div>
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
<!-- Sweet alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@include('includes.alerts')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
 <script>
    $(function () {
      $('#dataTable').DataTable({
        
        
      });
    });
  </script>

  <script>
    $('button#delete').on('click', function(e){
      e.preventDefault();
      var href = $(this).attr('href');
    
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })

      swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "Data yang dihapus tidak bisa dikembalikan lagi!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Hapus Saja!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('deleteForm').action = href;
          document.getElementById('deleteForm').submit();
          
          swalWithBootstrapButtons.fire(
            'Terhapus!',
            'Data kelas berhasil dihapus.',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Data anda tidak jadi dihapus',
            'error'
          )
        }
      })
    })
  </script>
  
@endpush