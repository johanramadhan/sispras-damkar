<html>
<head>
	<title>Rekapitulasi Pengajuan Perbidang</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<style>
  .cover {
    margin-top: 100px;
  }
  .table {
    width: 100%;
    font-size: 12px;
    border: 5px;
  }

  .page-break {
    page-break-after: always;
  }
</style>


<body>

  <div class="text-center" style="margin-top: 200px">
    <img src="{{ public_path('images/logo-sidebar.png') }}" width="200px" >
  </div>
  <div class="position-relative">
    <h5 class="text-center cover">PENGAJUAN BARANG PERBIDANG <br> DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA PEKANBARU <br> TAHUN ANGGARAN 2021</h5>
  </div>

  <div class="page-break"></div>

  <table class="table table-bordered table-sm">
    <thead class="thead-dark bg-primary">
      <tr>
        <th class="text-center">No</th>
        <th class="text-center">Bidang Pengusul</th>
        <th class="text-center">Nama Barang</th>
        <th class="text-center">Kategori</th>
        <th class="text-center">Kebutuhan Maksimum</th>
        <th class="text-center">Jumlah Yg Diajukan</th>
        <th class="text-center">Satuan</th>
        <th class="text-center">Harga Satuan</th>
        <th class="text-center">Total Harga</th>
        <th class="text-center">Fungsi</th>
        <th class="text-center">Spesifikasi</th>
        <th class="text-center">Gambar</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($proposals as $proposal)
        <tr>
          <td class="text-center">{{ $loop->iteration }}</td>
          <td>{{ $proposal->user->name }}</td>
          <td>{{ $proposal->name }}</td>
          <td >{{ $proposal->category->name }}</td>
          <td class="text-center">{{ $proposal->max_requirement }}</td>
          <td class="text-center">{{ $proposal->qty }}</td>
          <td class="text-center">{{ $proposal->satuan }}</td>
          <td class="text-center">Rp{{ number_format($proposal->price) }}</td>
          <td class="text-center">Rp{{ number_format($proposal->total_price) }}</td>
          <td>{{ $proposal->benefit }}</td>
          <td>{!! Str::limit($proposal->description, 500) !!}</td>
          <td>
            <img src="{{ public_path("storage/".$proposal->galleries->first()->photos) }}" style="width: 100px; margin-top:10px;">
          </td>
        </tr>
      @endforeach
    </tbody>

    <tfoot>
      <tr>
        <td colspan="8"><b>Total</b></td>
        <td><b>Rp{{ number_format($total ?? '') }}</b></td>
        <td colspan="3"></td>
      </tr>
    </tfoot>
  </table>

  
</body>
</html>