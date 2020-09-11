@extends('layouts.dashboard')

@section('title')
    Sispras Dashboard
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
   >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dashboard</h2>
            <p class="dashboard-subtitle">
                Rekap Aset dan Pengajuan Yang Dimiliki
            </p>
        </div>
        <div class="dashboard-content">
          <!-- card -->
          <div class="row">
            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Jumlah Aset
                  </div>
                  <div class="dashboard-card-subtitle">
                    {{ $asets }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Jumlah Pengajuan
                  </div>
                  <div class="dashboard-card-subtitle">
                    {{ $proposals }}
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Total Aset
                  </div>
                  <div class="dashboard-card-subtitle">
                    Rp{{ number_format($producttotal) }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card mb-2">
                <div class="card-body">
                  <div class="dashboard-card-title">
                    Total Pengajuan
                  </div>
                  <div class="dashboard-card-subtitle">
                    Rp{{ number_format($proposaltotal) }}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pengajuan -->
          <div class="row mt-3">
            <div class="col-12 mt-2">
              <h5 class="mb-3">
                Pengajuan Terbaru
              </h5>
              @foreach ($proposal as $proposals)
                <a
                    href="{{ route('dashboard-proposal-detail', $proposals->id) }}"
                    class="card card-list d-block"
                  >
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img
                          src="{{ Storage::url($proposals->galleries->first()->photos ?? '') }}"
                          class="w-75"
                        />
                      </div>
                      <div class="col-md-3">
                        {{ $proposals->name ?? '' }}
                      </div>
                      <div class="col-md-3">
                          {{ $proposals->category->name ?? '' }}
                      </div>
                      <div class="col-md-2">
                          Rp{{ number_format($proposals->total_price) ?? '' }}
                      </div>
                      <div class="col-md-2">
                          {{ $proposals->created_at ?? '' }}
                      </div>
                      <div
                          class="col-md-1 d-none d-md-block"
                      >
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
@endsection