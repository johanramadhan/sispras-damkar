@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
  <!-- Section Content -->
  <div
      class="section-content section-dashboard-home"
      data-aos="fade-up"
  >
    <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class="dashboard-title">User</h2>
          <p class="dashboard-subtitle">
              Edit User
          </p>
        </div>
        <div class="dashboard-content">
          <div class="row">
            <div class="col-md-12">
              @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
              @endif
              <div class="card">
                <div class="card-body">
                  <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama User</label>
                          <input type="text" name="name" class="form-control" value="{{ $item->name }}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Bidang/Subbag</label>
                          <input type="text" name="address_one" class="form-control" value="{{ $item->address_one }}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Nama Kepala Bidang/Subbag</label>
                          <input type="text" name="address_two" class="form-control" value="{{ $item->address_two }}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>NIP</label>
                          <input type="text" name="sispras_name" class="form-control" value="{{ $item->sispras_name }}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Email User</label>
                          <input type="email" name="email" class="form-control" value="{{ $item->email }}" required>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Password User</label>
                          <input type="password" name="password" class="form-control">
                          <small>Kosongkan jika tidak ingin mengganti password</small>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Roles</label>
                          <select name="roles" required class="form-control">
                            <option value="{{ $item->roles }}" selected>Tidak diganti</option>
                            <option value="ADMIN">Admin</option>
                            <option value="USER">User</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Foto</label>
                          <input type="file" name="photo" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col text-right">
                        <button type="submit" class="btn btn-success px-5">
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
