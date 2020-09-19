@extends('layouts.dashboard')

@section('title')
    Sispras Dashboard Proposal Detail
@endsection

@section('content')
    <!-- Section Content -->
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">#{{ $item->code }}</h2>
          <p class="dashboard-subtitle">
              Detail Pengajuan
          </p>
        </div>
        <!-- Dashbord Content -->
        
        <div
          class="dashboard-content"
          id="transactionDetails"
          >
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 col-md-4">
                      <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                        <img
                          src="{{ Storage::url($item->galleries->first()->photos ?? '') }}"
                          alt=""
                          class="w-100 mb-3"
                        />
                      </button>
                    </div>
                    <div class="col-12 col-md-8">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Yang Mengajukan
                          </div>
                          <div class="product-subtitle">
                            {{ $item->user->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Nama Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $item->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kategori Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $item->category->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kebutuhan Maksimum
                          </div>
                          <div class="product-subtitle">
                            {{$item->max_requirement }} {{$item->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Manfaat Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $item->benefit }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Jumlah Pengajuan
                          </div>
                          <div class="product-subtitle">
                            {{$item->qty }} {{$item->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Tanggal Pengajuan
                          </div>
                          <div class="product-subtitle">
                            {{ $item->created_at }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Harga Satuan
                          </div>
                          <div class="product-subtitle">
                            Rp{{ number_format($item->price) }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Status Pengajuan
                          </div>
                          <div class="product-subtitle text-danger">
                            {{ $item->proposal_status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Total Harga
                          </div>
                          <div class="product-subtitle">
                            Rp{{ number_format($item->total_price) }}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Catatan
                          </div>
                          <div class="product-subtitle">
                            {{ $item->note }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Spesifikasi Barang
                          </div>
                          <div class="product-subtitle">
                            {!! $item->description !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-12 text-right">
                      <a
                      href="{{ route('dashboard-proposal') }}"
                        type="submit"
                        class="btn btn-success btn-md mt-4"
                        >
                          Kembali
                      </a>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video Pengajuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
          {!! $item->link !!}
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: "#transactionDetails",
            data: {
                status: "{{ $item->shipping_status }}",
                resi: "{{ $item->resi }}"
            }
        });
    </script>
@endpush