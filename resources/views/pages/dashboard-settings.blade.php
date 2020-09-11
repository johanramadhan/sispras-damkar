@extends('layouts.dashboard')

@section('title')
    Sispras Setting
@endsection

@section('content')
  <!-- Section Content -->
  <div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
  >
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Sispras Settings</h2>
        <p class="dashboard-subtitle">
          Make store that profitable
        </p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <form action="{{ route('dashboard-settings-redirect', 'dashboard-settings-sispras' ) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card">
                <div class="card-body">
                  <!-- card -->
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" name="sispras_name" class="form-control" value="{{ $user->sispras_name }}" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kategori</label>
                        <select name="categories_id" class="form-control">
                          <option value="{{ $user->categories_id }}">Tidak Diganti</option>
                          @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Store Status</label>
                        <p class="text-muted">
                          Apakah asaat ini toko Anda buka?
                        </p>
                        <div
                          class="custom-control custom-radio custom-control-inline"
                        >
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="store_status"
                            id="openDamkarTrue"
                            value="1"
                            {{ $user->store_status == 1 ? 'checked' : '' }}
                          />
                          <label
                            for="openDamkarTrue"
                            class="custom-control-label"
                          >
                            Buka
                          </label>
                        </div>
                        <div
                          class="custom-control custom-radio custom-control-inline"
                        >
                          <input
                            type="radio"
                            class="custom-control-input"
                            name="store_status"
                            id="openDamkarFalse"
                            value="0"
                             {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                          />
                          <label
                            for="openDamkarFalse"
                            class="custom-control-label"
                          >
                            Sementara Tutup
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- button -->
                  <div class="row">
                    <div class="col text-right">
                      <button
                        type="submit"
                        class="btn btn-success px-5"
                      >
                        Save Now
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection