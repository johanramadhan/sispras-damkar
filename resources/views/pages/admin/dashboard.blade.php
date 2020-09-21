@extends('layouts.admin')

@section('title')
    Admin - Sispras Dashboard
@endsection

@section('content')
  <!-- Section Content -->
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
   >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Admin Dashboard</h2>
        <p class="dashboard-subtitle">
            Selamat datang Admin SISPRAS DAMKAR
        </p>
      </div>
      <div class="dashboard-content">
        <!-- card -->
        <div class="row">
          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  User
                </div>
                <div class="dashboard-card-subtitle">
                  {{ $user }}
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Jumlah Aset
                </div>
                <div class="dashboard-card-subtitle" >
                  {{ $product }}
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Jumlah Pengajuan
                </div>
                <div class="dashboard-card-subtitle">
                  {{ $proposal }}
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mt-2">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Total Aset
                </div>
                <div class="dashboard-card-subtitle">
                  Rp{{number_format ($transaction) }}
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 mt-2">
            <div class="card mb-2">
              <div class="card-body">
                <div class="dashboard-card-title">
                  Total Pengajuan
                </div>
                <div class="dashboard-card-subtitle">
                  Rp{{number_format ($pengajuan) }}
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Recent Transactions -->
        <div class="row mt-3">
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
                  >Data Pengajuan</a
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
                  >Data Aset</a
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
                  @foreach ($pengajuan_data as $pengajuan)
                    <a
                      href="{{ route('dashboard-proposal-details', $pengajuan->id) }}"
                      class="card card-list d-block"
                      >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="{{ Storage::url($pengajuan->galleries->first()->photos ?? '') }}"
                              class="w-50"
                            />
                          </div>
                          <div class="col-md-2">{{ $pengajuan->name }} - {{ $pengajuan->brand }}</div>
                          <div class="col-md-2">{{ $pengajuan->user->name }}</div>
                          <div class="col-md-2">Rp{{ number_format($pengajuan->total_price) }}</div>
                          <div class="col-md-2">{{ Str::limit($pengajuan->benefit, 30 ?? '') }}</div>
                          <div class="col-md-1">{{ $pengajuan->proposal_status }}</div>
                          <div class="col-md-2">{{ date('d-M-Y', strtotime($pengajuan->created_at)) }}</div>
                          {{-- <div class="col-md-1 d-none d-md-block">
                            <img
                              src="/images/dashboard-arrow-right.svg"
                              alt=""
                            />
                          </div> --}}
                        </div>
                      </div>
                    </a>
                  @endforeach
                </div>

                <div
                  class="tab-pane fade"
                  id="pills-profile"
                  role="tabpanel"
                  aria-labelledby="pills-profile-tab"
                  >
                  @foreach ($product_data as $product)
                    <a
                      href="{{ route('product.edit', $product->id) }}"
                      class="card card-list d-block"
                      >
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img
                              src="{{ Storage::url($product->galleries->first()->photos ?? '') }}"
                              class="w-50"
                            />
                          </div>
                          <div class="col-md-3">{{ $product->name }}</div>
                          <div class="col-md-3">{{ $product->user->name }}</div>
                          <div class="col-md-2">{{ str::limit($product->fungsi, 20 ?? '') }}</div>
                          <div class="col-md-2">Rp{{ number_format($product->price) }}</div>
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