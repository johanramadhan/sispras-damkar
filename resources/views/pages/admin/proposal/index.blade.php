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
                  <a href="{{ route('proposalexportPdf') }}" class="btn btn-danger mb-3">
                  Export PDF
                  </a>
                  <a href="{{ route('proposalexportPdftable') }}" class="btn btn-warning mb-3">
                  Export PDF Table
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
                          <th class="text-center">Kebutuhan Maksimum</th>
                          <th>Jumlah</th>
                          <th>Satuan</th>
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
                            <td class="text-center">{{ $proposal->max_requirement }}</td>
                            <td class="text-center">{{ $proposal->qty }}</td>
                            <td>{{ $proposal->satuan }}</td>
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
                                    <button type="submit" id="delete" href="{{ route('proposal.destroy', $proposal->id) }}" 
                                      class="dropdown-item text-danger">
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
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td colspan="8" class="font-weight-bold">Total</td>
                          <td class="text-right font-weight-bold">Rp{{ number_format($pengajuan ?? '') }}</td>
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