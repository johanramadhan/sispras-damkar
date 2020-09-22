@extends('layouts.app')

@section('title')
    Sispras - Halaman Pengajuan
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-home">
  <!-- Categories -->
  <section class="damkar-trend-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Semua Bidang</h5>
        </div>
      </div>
      <div class="row">
        @php $incrementCategory = 0 @endphp
        @forelse ($users as $user)
            <div
              class="col-6 col-md-3 col-lg-2 mb-4"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory+= 100 }}">
              <a href="{{ route('pengajuans-detail', $user->slug) }}" class="component-categories d-block w-100 h-100">
                <div class="categories-image text-center">
                  <img src="{{ Storage::url($user->photo) }}" alt="" class="w-50  {{ $incrementCategory+= 100 }}" />
                </div>
                <p class="categories-text">{{ $user->name }}</p>
              </a>
            </div>
        @empty
            <div class="col-12 text-center py-5" 
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory+= 100 }}">
              Tidak ada Kategori
            </div>
        @endforelse
        
      </div>
    </div>
  </section>
  <!-- Akhir Categories -->

  <!-- Products -->
  <section class="damkar-new-products mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Semua Pengajuan</h5>
        </div>
      </div>
      <div class="row">
        @php $incrementCategory = 0 @endphp
        @forelse ($proposals as $proposal)
            <div
              class="col-6 col-md-4 col-lg-3"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory+= 100 }}"
            >
              <a href="{{ route('pengajuan', $proposal->slug) }}" class="component-products d-block">
                <div class="products-thumbnail">
                  <div
                    class="products-image"
                    style="
                      @if($proposal->galleries->count())
                        background-image: url('{{ Storage::url($proposal->galleries->first()->photos) }}')
                      @else
                        background-color: #eee
                      @endif
                    "
                  ></div>
                </div>
                <div class="products-text">
                  {{ $proposal->name }} - {{ $proposal->brand }}
                </div>
                <div class="products-price">
                  {{-- {{ number_format($proposal->total_price) }} <small><i>({{ $proposal->qty }} {{ $proposal->satuan }} x {{ number_format($proposal->price) }})</i></small> --}}
                  {{ $proposal->proposal_status }}
                </div>
              </a>
            </div>
        @empty
            <div class="col-12 text-center py-5" 
                  data-aos="fade-up"
                  data-aos-delay="{{ $incrementCategory+= 100 }}">
            Tidak ada Pengajuan
            </div>
        @endforelse
      </div>
      <div class="row">
        <div class="col-12 mt-4">
          {{ $proposals->links() }}
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Products -->
</div>
@endsection