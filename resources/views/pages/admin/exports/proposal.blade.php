<table style="border: 1px solid black">
    <thead style="border: 1px solid black">
        <tr>
            <th colspan="13" style="text-align: center; font-size: 18px"><strong>PENGAJUAN PERBIDANG</strong></th>
        </tr>
        <tr>
            <th colspan="13" style="text-align: center; font-size: 18px"><strong>DINAS PEMADAM KEBAKARAN DAN PENYELAMATAN KOTA PEKANBARU</strong></th>
        </tr>
        <tr>
            <th colspan="13" style="text-align: center; font-size: 18px"><strong>TAHUN ANGGARAN 2021</strong></th>
        </tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">No</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Kode Pengajuan</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">User Pengaju</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Kategori</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Nama Barang</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Kebutuhan Maksimum</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Jumlah Yang Diajukan</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Satuan</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Harga Satuan</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Total Harga</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Fungsi</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Status Pengajuan</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Spesifikasi</th>
            <th style="text-align: center; font-weight: bold; border: 1px solid black">Gambar</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid black">
    @foreach($proposals as $proposal)
        <tr>
          <td style="text-align: center; border: 1px solid black">{{ $loop->iteration }}</td>
          <td style="border: 1px solid black">{{ $proposal->code }}</td>
          <td style="border: 1px solid black">{{ $proposal->user->name }}</td>
          <td style="border: 1px solid black">{{ $proposal->category->name }}</td>
          <td style="border: 1px solid black">{{ $proposal->name }}</td>
          <td style="text-align: center; border: 1px solid black">{{ $proposal->max_requirement }}</td>
          <td style="text-align: center; border: 1px solid black">{{ $proposal->qty }}</td>
          <td style="text-align: center; border: 1px solid black">{{ $proposal->satuan }}</td>
          <td style="border: 1px solid black; text-align: right;">{{ number_format($proposal->price) }}</td>
          <td style="border: 1px solid black; text-align: right;">{{ number_format($proposal->total_price) }}</td>
          <td style="border: 1px solid black">{{ $proposal->benefit }}</td>
          <td style="border: 1px solid black">{{ $proposal->proposal_status }}</td>
          <td style="border: 1px solid black; width: 80px">{!! $proposal->description !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>