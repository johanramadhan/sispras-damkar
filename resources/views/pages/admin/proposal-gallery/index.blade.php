@extends('layouts.admin')

@section('title')
    Pengajuan Gallery
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
  >
    <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">Pengajuan Gallery</h2>
          <p class="dashboard-subtitle">
              List of Pengajuan
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <a href="{{ route('proposal-gallery.create') }}" class="btn btn-primary mb-3">
                  + Gallery Pengajuan
                </a>
                <div class="table-responsive">
                  <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Pengajuan</th>
                        <th>Foto</th>
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
        { data: 'proposal.name', name: 'proposal.name' },
        { data: 'photos', name: 'image' },
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