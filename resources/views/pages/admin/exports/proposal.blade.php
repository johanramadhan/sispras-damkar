<h2 colspan="12" class="text-center">List Pengajuan</h2>
<table class="table" style="border: 1px solid rgb(0, 0, 0)">
    <thead>
    <tr>
        <th class="text-center">No</th>
        <th class="text-center">Kode Pengajuan</th>
        <th class="text-center">Nama Barang</th>
        <th class="text-center">User Pengaju</th>
        <th class="text-center">Kategori</th>
        <th class="text-center">Jumlah</th>
        <th class="text-center">Harga Satuan</th>
        <th class="text-center">Total Harga</th>
        <th class="text-center">Fungsi</th>
        <th class="text-center">Spesifikasi</th>
        <th class="text-center">Status Pengajuan</th>
        <th class="text-center">Gambar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($proposals as $proposal)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $proposal->code }}</td>
          <td>{{ $proposal->name }}</td>
          <td>{{ $proposal->user->name }}</td>
          <td>{{ $proposal->category->name }}</td>
          <td class="text-center">{{ $proposal->qty }}</td>
          <td>Rp{{ number_format($proposal->price) }}</td>
          <td>Rp{{ number_format($proposal->total_price) }}</td>
          <td>{{ $proposal->benefit }}</td>
          <td>{!! $proposal->description !!}</td>
          <td>{{ $proposal->proposal_status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>