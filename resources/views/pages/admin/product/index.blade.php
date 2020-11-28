@extends('layouts.admin')

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endpush

@section('title')
    Aset
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
              List Aset
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                  + Aset Baru
                </a>
                <div class="table-responsive">
                  <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Pemilik</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->user->name }}</td>
                          <td>{{ $product->category->name }}</td>
                          <td>{{ $product->qty }}</td>
                          <td>{{ $product->satuan }}</td>
                          <td>Rp{{ number_format($product->price) }}</td>
                          <td>Rp{{ number_format($product->total_price) }}</td>
                          <td>
                            <div class="btn-group">
                              <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button"
                                    data-toggle="dropdown">Aksi</button>
                                <div class="dropdown-menu">
                                  <a href="{{ route('product.edit', $product->id) }}" class="dropdown-item">Edit</a>
                                  <button type="submit" id="delete" href="{{ route('product.destroy', $product->id) }}" 
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
  </div>
@endsection

@push('addon-script')
  <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  @include('includes.alerts')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
  <script>
    $(function () {
      $('#crudTable').DataTable({
        
        
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
        { data: 'name', name: 'name' },
        { data: 'user.name', name: 'user.name' },
        { data: 'category.name', name: 'category.name' },
        { data: 'qty', name: 'qty' },
        { data: 'satuan', name: 'satuan' },
        { data: 'price', name: 'price' },
        { data: 'total_price', name: 'total_price' },
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