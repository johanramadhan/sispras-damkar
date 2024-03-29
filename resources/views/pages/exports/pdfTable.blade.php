<html>
<head>
	<title>Rekapitulasi Pengajuan Perbidang</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<style>
  table, th, td {
    border: 1px solid black;
  }

  th {
    padding: 3px;
    background-color: #2c2e92;
    color: white;
  }

  td {
    padding: 5px;
    vertical-align: top;
  }
  .cover {
    margin-top: 70px;
    font-size: 18px;
  }
  .table {
    width: 100%;
    font-size: 12px;
    
  }

  .page-break {
    page-break-after: always;
  }
</style>


<body>

  <div class="text-center" style="margin-top: 100px">
    <img src="{{ public_path('images/logo-sidebar.png') }}" width="200px" >
  </div>
  <div class="position-relative">
    <h5 class="text-center cover">RENCANA KEBUTUHAN BARANG MILIK DAERAH (RKBMD) DARI <br> <div style="color: red;" class="text-uppercase">{{ $judul->user->address_one ?? '' }}</div>PADA DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA PEKANBARU <br> TAHUN ANGGARAN 2021</h5>
  </div>

  <div class="page-break"></div>

  <h6 class="text-center" style="font-size: 14px;">RENCANA KEBUTUHAN BARANG MILIK DAERAH (RKBMD) DARI <br> <div style="color: red;" class="text-uppercase">{{ $judul->user->address_one ?? '' }}</div> PADA DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA PEKANBARU <br> TAHUN ANGGARAN 2021</h6>

  <table style="border: 1px solid black; font-size: 12px;">
    <thead>
      <tr>
        <th class="text-center">No</th>
        <th class="text-center">Kategori</th>
        <th class="text-center">Nama Barang</th>
        <th class="text-center">Merek</th>
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
        <tr style="line-height: 12px;">
          <td class="text-center">{{ $loop->iteration }}</td>
          <td >{{ $proposal->category->name }}</td>
          <td>{{ $proposal->name }}</td>
          <td>{{ $proposal->brand }}</td>
          <td class="text-center">{{ $proposal->max_requirement }}</td>
          <td class="text-center">{{ $proposal->qty }}</td>
          <td class="text-center">{{ $proposal->satuan }}</td>
          <td class="text-left">Rp{{ number_format($proposal->price) }}</td>
          <td class="text-left">Rp{{ number_format($proposal->total_price) }}</td>
          <td>{{ $proposal->benefit }}</td>
          <td>{!! Str::limit($proposal->description, 500) !!}</td>
          <td>
            <img src="{{ public_path("storage/".$proposal->galleries->first()->photos) }}" style="width: 80px; margin-top: 10px; margin-left: 7px;">
          </td>
        </tr>
      @endforeach
    
      <tr>
        <td colspan="8"><b>Total</b></td>
        <td><b>Rp{{ number_format($total) }}</b></td>
        <td colspan="3"></td>
      </tr>
    </tbody>

  </table>

  <table class="table" style="border: 1px solid black; font-size: 12px;">
    <tr>
      <td class="w-75"></td>
      <td colspan="2" class="w-25">
        <p class="mb-0">Pekanbaru, {{ date("d M Y") }}</p>
        <b class="text-uppercase">KEPALA {{ $proposal->user->address_one }} DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA PEKANBARU <br><br><br><br> <u>{{ $proposal->user->address_two }}</u> <br>NIP: {{ $proposal->user->sispras_name }}</b>
      </td>
    </tr>
  </table>

  
</body>
</html>