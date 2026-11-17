
@extends('layout.layoutnya')

@section('title', 'Ubah Buku')

@section('content')
<div class="halaman-form">
    <div class="form-container">
        <h2>Ubah Buku</h2>
        <p class="deskripsi-form">
            Perbarui informasi buku yang dipilih.
        </p>

        <form id="form-buku" class="form-buku">
            @csrf

            <div class="form-group">
                <label for="kategori_id">Kategori</label>
                <select name="kategori_id" id="kategori_id" required>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}"
                            {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text"
                    name="judul"
                    id="judul"
                    value="{{ $buku->judul }}"
                    required>
            </div>

            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text"
                    name="penulis"
                    id="penulis"
                    value="{{ $buku->penulis }}"
                    required>
            </div>

            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number"
                    name="tahun_terbit"
                    id="tahun_terbit"
                    value="{{ $buku->tahun_terbit }}"
                    min="1000"
                    max="{{ date('Y') }}"
                    required>
            </div>

            <button type="submit" id="tombol-simpan">
                Simpan Perubahan
            </button>
        </form>

        <p id="pesan" class="pesan-form"></p>

        <nav class="nav-form nav-form-bawah">
            <a href="{{ request()->routeIs('petugas.*')
                ? route('petugas.buku.index')
                : route('buku.index') }}"
                class="btn-kembali">
                &larr; Kembali ke Daftar Buku
            </a>
        </nav>
    </div>
</div>

<script>
    const form = document.getElementById('form-buku');
    const pesan = document.getElementById('pesan');
    const tombol = document.getElementById('tombol-simpan');

    // URL update berdasarkan role
    const urlUpdate = @json(
        request()->routeIs('petugas.*')
            ? route('petugas.buku.update', ['id' => $buku->id])
            : route('buku.update', ['id' => $buku->id])
    );

    // URL kembali berdasarkan role
    const urlKembali = @json(
        request()->routeIs('petugas.*')
            ? route('petugas.buku.index')
            : route('buku.index')
    );

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        tombol.disabled = true;
        pesan.className = 'pesan-form proses';
        pesan.textContent = 'Menyimpan perubahan...';

        try {
            const data = {
                kategori_id: Number(form.elements['kategori_id'].value),
                judul: form.elements['judul'].value.trim(),
                penulis: form.elements['penulis'].value.trim(),
                tahun_terbit: Number(form.elements['tahun_terbit'].value)
            };

            const response = await fetch(urlUpdate, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
                },
                body: JSON.stringify(data)
            });

            const hasil = await response.json();

            if (!response.ok) {
                const detail = hasil.errors
                    ? Object.values(hasil.errors).flat().join(' ')
                    : hasil.message;

                throw new Error(detail || 'Gagal memperbarui buku.');
            }

            pesan.className = 'pesan-form berhasil';
            pesan.textContent = hasil.message || 'Buku berhasil diperbarui!';

            setTimeout(() => {
                window.location.href = urlKembali;
            }, 800);

        } catch (error) {
            console.error(error);

            pesan.className = 'pesan-form gagal';
            pesan.textContent = error.message;

        } finally {
            tombol.disabled = false;
        }
    });
</script>
@endsection
