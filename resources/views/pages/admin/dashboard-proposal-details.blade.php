@extends('layouts.admin')

@section('title')
    Sispras Dashboard Pengajuan Detail
@endsection

@section('content')
    <!-- Section Content -->
    <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
    >
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">#{{ $transaction->code }}</h2>
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
                          src="{{ Storage::url($transaction->galleries->first()->photos ?? '') }}"
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
                            {{ $transaction->user->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Nama Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $transaction->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kategori Barang
                          </div>
                          <div class="product-subtitle">
                            {{ $transaction->category->name }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Kebutuhan Maksimum
                          </div>
                          <div class="product-subtitle">
                            {{$transaction->max_requirement }} {{$transaction->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Status Barang
                          </div>
                          <div class="product-subtitle text-danger">
                            {{ $transaction->proposal_status }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Jumlah Barang
                          </div>
                          <div class="product-subtitle">
                            {{$transaction->qty }} {{$transaction->satuan }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Date of Transaction
                          </div>
                          <div class="product-subtitle">
                            {{ $transaction->created_at }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Harga Satuan
                          </div>
                          <div class="product-subtitle">
                            RP{{ number_format($transaction->price) }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Fungsi
                          </div>
                          <div class="product-subtitle">
                            {{ $transaction->benefit }}
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <div class="product-title">
                            Total Harga
                          </div>
                          <div class="product-subtitle">
                            RP{{ number_format($transaction->total_price) }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 mt-4">
                      <h5>Spesifikasi Barang</h5>
                    </div>
                    <div class="col-12">
                      <div class="product-title">
                        {!! $transaction->description !!}
                      </div>
                    </div>
                  </div>

                  <form action="{{ route('dashboard-proposal-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-12 mt-4">
                        <h5>
                          Informasi Status Pengajuan
                        </h5>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12 col-md-3">
                            <div class="product-title">
                              Status Pengajuan
                            </div>
                            <select
                              name="proposal_status"
                              id="status"
                              class="form-control"
                              v-model="status"
                             >
                                <option value="PENDING">PENDING</option>
                                <option value="DITOLAK">DITOLAK</option>
                                <option value="MASUK RKBMD">MASUK RKBMD</option>
                                <option value="DISETUJUI">DISETUJUI</option>
                            </select>
                          </div>
                          <template v-if="status == 'DITOLAK'">
                            <div class="col-md-6">
                              <div class="product-title">
                                Catatan
                              </div>
                              <input
                                type="text"
                                class="form-control"
                                name="note"
                                v-model="resi"
                              />
                            </div>
                            <div class="col-md-2">
                              <button
                                type="submit"
                                class="btn btn-success btn-block mt-4"
                               >
                                Update Status
                              </button>
                            </div>
                          </template>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-right">
                          <a
                            href="{{ route('proposal.index') }}"
                            type="submit"
                            class="btn btn-primary btn-md mt-4"
                            >
                              Kembali
                          </a>
                          <button
                            type="submit"
                            class="btn btn-success btn-md mt-4"
                            >
                              Save Now
                          </button>
                        </div>
                    </div>
                  </form>

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
          {!! $transaction->link !!}
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
                status: "{{ $transaction->proposal_status }}",
                resi: "{{ $transaction->note }}"
            }
        });
    </script>
@endpush