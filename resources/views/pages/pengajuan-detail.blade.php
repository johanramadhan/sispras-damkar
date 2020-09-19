@extends('layouts.app')

@section('title')
    Detail Pengajuan
@endsection

@section('content')
  <!-- Page Content -->
  <div class="page-content page-details">
    <!-- Breadcrumb -->
    <section
      class="damkar-breadcrumbs"
      data-aos="fade-down"
      data-aos-delay="100"
     >
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Detail Pengajuan
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery -->
    {{-- <section class="damkar-gallery mb-4" id="gallery">
      <div class="container">
        <div class="row">
          <div class="col-lg-8"
              data-aos="zoom-in">
            <transition name="slide-fade" made="out-in">
              <img
                :src="photos[activePhoto].url"
                :key="photos[activePhoto].id"
                class="mw-100"
                height="475px"
                alt=""
              />
            </transition>
          </div>
          <div class="col-lg-2">
            <div class="row">
              <div
                class="col-3 col-lg-12 mt-2 mt-lg-0"
                v-for="(photo, index) in photos"
                :key="photo.id"
                data-aos="zoom-in"
                data-aos-delay="100"
               >
                <a href="#" @click="changeActive(index)">
                  <img
                    :src="photo.url"
                    class="w-100 thumbnail-image"
                    height="105px"
                    :class="{active: index == activePhoto}"
                    alt=""
                  />
                </a>
              </div>
            </div>
          </div>
        </div>
    </section> --}}

    {{-- Xzoom --}}
    <section class="damkar-gallery mb-4" id="gallery">
      <div class="container">
        <div class="row">
          <div class="col-lg-8" data-aos="zoom-in">
            <transition name="slide-fade" made="out-in">
              @if ($item->galleries->count())
                  <img
                    src="{{ Storage::url($item->galleries->first()->photos) }}"
                    class="xzoom mw-100 main-image d-block" height="475px"
                    xoriginal="{{ Storage::url($item->galleries->first()->photos) }}"
                  />
                  @else 
                    Tidak ada Gambar
              @endif
            </transition>
          </div>
          <div class="col-lg-2">
            <div class="row">
              <div
                class="col-3 col-lg-12 mt-2 mt-lg-0"
                data-aos="zoom-in"
                data-aos-delay="100"
              >
                @foreach ($item->galleries as $items)
                  <a href="{{ Storage::url($items->photos) }}" class="d-block">
                    <img
                      src="{{ Storage::url($items->photos) }}"
                      class="xzoom-gallery w-100 thumbnail-image"  height="105px"
                      xpreview="{{ Storage::url($items->photos) }}"
                    />
                  </a>
                @endforeach  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Damkar-detail -->
    <div class="damkar-details-container" data-aos="fade-up">
      <section class="damkar-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <h1>{{ $item->name }} {{ $item->brand }}</h1>
              <div class="owner">By : {{ $item->user->name }}</div>
              <div class="owner">Kategori : {{ $item->category->name }}</div>
              <div class="owner">Waktu Pengajuan : {{ $item->created_at }}</div>
              <div class="owner">Status : {{ $item->proposal_status }}</div>
              <div class="owner">Catatan : {{ $item->note }}</div>
              <div class="price">Rp{{ number_format($item->total_price) }},00 <small><i>({{ $item->qty }} {{ $item->satuan }} x Rp{{ number_format($item->price) }})</i></small> </div>
            </div>
            
            <div class="col-lg-2" data-aos="zoom-in">
              @auth
                <form action="{{ route('detail-add', $item->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  {{-- <button
                    type="submit"
                    class="btn btn-success px-4 text-white btn-block mb-3"
                  >
                    Add to Cart
                  </button> --}}
                  <a
                    href="{{ route('pengajuans') }}"
                    class="btn btn-success px-4 text-white btn-block mb-3"
                  >
                    Back
                  </a>
                </form>
              @else
                <a
                  href="{{ route('login') }}"
                  class="btn btn-success px-4 text-white btn-block mb-3"
                >
                  Sign in to Add
                </a>
              @endauth
            </div>
          </div>
        </div>
      </section>
      <section
        class="damkar-description"
        data-aos="fade-down"
        data-aos-delay="200"
        >
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8">
              <p>Deskripsi Barang</p>
              <small class="owner">
                Kebutuhan Maksimum : {{ $item->max_requirement }} {{ $item->satuan }}
              </small> <br>
              <small>
                Manfaat : {!! $item->benefit !!}
              </small>
              <p>
                {!! $item->description !!}
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- Damkar-review -->
      {{-- <section
        class="damkar-review"
        data-aos="fade-down"
        data-aos-delay="100"
        >
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-8 mt-3 mb-3">
              <h5>Costumer Review (3)</h5>
            </div>
          </div>
          <div class="row">
            <div class="col-12 col-lg-8">
              <ul class="list-unstyled">
                <li class="media">
                  <img
                    src="/images/icon-testimonial-2.png"
                    alt=""
                    class="mr-3 rounded-circle"
                  />
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Johan Ramadhan</h5>
                    <p>
                      Lorem ipsum dolor sit amet consectetur, adipisicing
                      elit. Ullam illum alias, dolorum tempore voluptatum
                      iusto rem deserunt cum aut asperiores!
                    </p>
                  </div>
                </li>
                <li class="media">
                  <img
                    src="/images/icon-testimonial-3.png"
                    alt=""
                    class="mr-3 rounded-circle"
                  />
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Johan Ramadhan</h5>
                    <p>
                      Lorem ipsum dolor sit amet consectetur, adipisicing
                      elit. Ullam illum alias, dolorum tempore voluptatum
                      iusto rem deserunt cum aut asperiores!
                    </p>
                  </div>
                </li>
                <li class="media">
                  <img
                    src="/images/icon-testimonial-1.png"
                    alt=""
                    class="mr-3 rounded-circle"
                  />
                  <div class="media-body">
                    <h5 class="mt-2 mb-1">Johan Ramadhan</h5>
                    <p>
                      Lorem ipsum dolor sit amet consectetur, adipisicing
                      elit. Ullam illum alias, dolorum tempore voluptatum
                      iusto rem deserunt cum aut asperiores!
                    </p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section> --}}
    </div> 

  </div>
@endsection

@push('addon-script')
  <script src="/vendor/xzoom/xzoom.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".xzoom, .xzoom-gallery").xzoom({
        zoomWidth: 500,
        title: false,
        tint: "#333",
        Xoffset: 20,
      });
    });
  </script>

  {{-- <script src="/vendor/vue/vue.js"></script>
  <script>
    var gallery = new Vue({
      el: "#gallery",
      mounted() {
        AOS.init();
      },
      data: {
        activePhoto: 0,
        photos: [
          @foreach($item->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
          @endforeach
        ],
      },
      methods: {
        changeActive(id) {
          this.activePhoto = id;
        },
      },
    });
  </script>  --}}
@endpush