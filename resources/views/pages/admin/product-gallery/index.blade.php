@extends('layouts.admin')

@push('addon-style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
@endpush

@section('title')
    Product Gallery
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
  >
    <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Product Gallery</h2>
          <p class="dashboard-subtitle">
              List of Gallery
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('product-gallery.create') }}" class="btn btn-primary mb-3">
                  + Gallery Baru
                </a>
                <div class="table-responsive">
                  <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Produk</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($productgalleries as $item)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>
                              <img src="{{Storage::url($item->photos)}}" style="max-height: 50px;">
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
                                    
                                    <button type="submit" id="delete" href="{{ route('product-gallery.destroy', $item->id) }}" 
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
        { data: 'product.name', name: 'product.name' },
        { data: 'photos', name: 'photos' },
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