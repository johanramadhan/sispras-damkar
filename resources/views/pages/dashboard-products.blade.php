@extends('layouts.dashboard')

@section('title')
    Sispras Dashboard Product
@endsection

@section('content')
    <!-- Section Content -->
    <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
        <div class="container-fluid">
          <div class="dashboard-heading">
            <h2 class="dashboard-title">Data Aset</h2>
            <p class="dashboard-subtitle">
              List Aset yang ada di {{ Auth::user()->name }}
            </p>
          </div>
          <div class="dashboard-content">
            <div class="row">
              {{-- <div class="col-12">
                <a
                  href="{{ route('dashboard-product-create') }}"
                  class="btn btn-success"
                >
                  Add New Product</a
                >
              </div> --}}
            </div>

            <div class="row mt-4">
              {{-- @foreach ($products  as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <a
                    href="{{ route('dashboard-product-details', $product->id) }}"
                    class="card card-dashboard-product d-block"
                   >
                    <div class="card-body">
                      <img
                        src="{{ Storage::url($product->galleries->first()->photos ?? '') }}"
                        alt=""
                        class="w-75 mb-2"
                      />
                      <div class="product-title">{{ $product->name }}</div>
                      <div class="product-category">{{ $product->category->name }}</div>
                    </div>
                  </a>
                </div>
              @endforeach --}}
              @php $incrementProduct = 0 @endphp
              @forelse ($products as $product)
                <div
                  class="col-12 col-sm-6 col-md-4 col-lg-3"
                  data-aos="fade-up"
                  data-aos-delay="{{ $incrementProduct+= 100 }}"
                 >
                  <a href="{{ route('dashboard-product-details', $product->id) }}" class="component-products d-block">
                    <div class="products-thumbnail">
                      <div
                        class="products-image"
                        style="
                          @if($product->galleries->count())
                            background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                          @else
                            background-color: #eee
                          @endif
                        "
                      ></div>
                    </div>
                    <div class="products-text">
                      {{ $product->name }}
                    </div>
                    <div class="products-price">
                      Rp{{ number_format($product->price) }}
                    </div>
                  </a>
                </div>
              @empty
                <div class="col-12 text-center py-5" 
                  data-aos="fade-up"
                  data-aos-delay="{{ $incrementProduct+= 100 }}">
                  Tidak ada Aset
                </div>
              @endforelse

            </div>
          </div>
        </div>
    </div>
@endsection