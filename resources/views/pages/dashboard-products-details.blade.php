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
          <h2 class="dashboard-title">Data Barang</h2>
          <p class="dashboard-subtitle">
              Detail Barang {{ $product->name }}
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
                          src="{{ Storage::url($product->galleries->first()->photos ?? '') }}"
                          alt=""
                          class="w-100 mb-3"
                        />
                      </button>
                    </div>
                    <div class="col-12 col-md-8">
                      <div class="row">
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Nama Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $product->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Penanggungjawab Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $product->user->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title" name="category" id="categories_id" v-model="categories_id">
                            Kategori Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $product->category->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Status Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $product->status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kondisi Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $product->kondisi }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Fungsi
                          </div>
                          <div class="product-subtitle">
                            {{ $product->fungsi }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kebutuhan Maksimum
                          </div>
                          <div class="product-subtitle">
                            {{$product->qty }} {{$product->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Jumlah Barang
                          </div>
                          <div class="product-subtitle">
                            {{$product->qty }} {{$product->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Harga Satuan
                          </div>
                          <div class="product-subtitle">
                            RP{{ number_format($product->price) }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Total Harga
                          </div>
                          <div class="product-subtitle">
                            RP{{ number_format($product->total_price) }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <template v-if="categories_id == 'Mobil Pemadam'">
                    <div class="row mt-3">
                      <div class="col-12 col-md-2">
                        <div class="product-title" v-model="resi">
                          Nomor MPK
                        </div>
                        <div class="product-subtitle" v-model="resi">
                          05
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Nomor Polisi
                        </div>
                        <div class="product-subtitle">
                          BM 8470 AP
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Tahun Pembelian
                        </div>
                        <div class="product-subtitle">
                          1971
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Umur
                        </div>
                        <div class="product-subtitle">
                          49
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Jenis Mobil
                        </div>
                        <div class="product-subtitle">
                          FUSO
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Kapasitas Tangki
                        </div>
                        <div class="product-subtitle">
                          4000
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Jumlah Ban
                        </div>
                        <div class="product-subtitle">
                          6
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Ukuran Ban
                        </div>
                        <div class="product-subtitle">
                          8,25 x 20
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Jumlah Baterai
                        </div>
                        <div class="product-subtitle">
                          2
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Ukuran Baterai
                        </div>
                        <div class="product-subtitle">
                          N70
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          BPKB
                        </div>
                        <div class="product-subtitle">
                          Tidak ada
                        </div>
                      </div>
                      <div class="col-12 col-md-2">
                        <div class="product-title">
                          Ada
                        </div>
                        <div class="product-subtitle">
                          {{ $product->name }}
                        </div>
                      </div>
                    </div>
                  </template>
                  <div class="row mt-3">
                    <div class="col-12 col-md-6">
                      <div class="product-title">
                        Deskripsi Barang
                      </div>
                      <div class="product-subtitle">
                        {!! $product->description !!}
                      </div>
                    </div>
                  </div>
                  <div class="row mt-4">
                    <div class="col-12 text-right">
                      <a
                        href="{{ route('dashboard-product') }}"
                        type="submit"
                        class="btn btn-success btn-lg mt-4"
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
        <h5 class="modal-title" id="exampleModalLabel">Video {{ $product->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
          {!! $product->link !!}
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
                category: "{{ $product->shipping_status }}",
                resi: "{{ $product->resi }}"
            }
        });
    </script>
@endpush