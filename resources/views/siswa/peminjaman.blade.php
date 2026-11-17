<h1>Halaman Riwayat Peminjaman</h1>

<p>Nama: {{ auth()->user()->name }}</p>

<p>Total peminjaman: {{ $peminjamans->count() }}</p>

@foreach ($peminjamans as $peminjaman)
    <p>{{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}</p>
@endforeach