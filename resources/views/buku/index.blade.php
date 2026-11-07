@extends('layout.layoutnya')

@section('title')
    Daftar Buku
@endsection

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 py-10 sm:px-6 lg:px-8">

        <div class="mx-auto max-w-7xl">

            <!-- HEADER -->
            <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">

                <div class="flex flex-col items-center justify-between gap-6 sm:flex-row">

                    <!-- BAGIAN TEKS (KIRI) -->
                    <div class="flex-1">

                        <p class="mb-2 text-sm font-medium text-white/80">
                            PERPUSTAKAAN 250441100072
                        </p>

                        <h2 class="text-3xl font-bold tracking-tight">
                            Daftar Buku
                        </h2>

                        <p class="mt-2 max-w-xl text-sm leading-relaxed text-white/90">
                            Temukan berbagai koleksi buku menarik dan perluas
                            wawasanmu melalui Perpustakaan Digital.
                        </p>

                        <!-- TOMBOL KEMBALI KE DASHBOARD -->

                        @role('admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                        @role('petugas')
                            <a href="{{ route('petugas.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                        @role('siswa')
                            <a href="{{ route('siswa.dashboard') }}"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl border border-white/40 bg-white/15 px-5 py-3 text-sm font-semibold text-white shadow-md backdrop-blur-sm transition duration-300 hover:-translate-y-1 hover:bg-white/25">
                                Kembali ke Dashboard
                            </a>
                        @endrole

                    </div>

                    <div class="flex h-40 w-40 shrink-0 items-center justify-center rounded-full border border-white/30 bg-white/15 shadow-xl backdrop-blur-sm md:h-52 md:w-52">

                        <img
                            src="{{ asset('image/read.png') }}"
                            alt="Logo Perpustakaan"
                            class="h-28 w-28 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-40 md:w-40">

                    </div>

                </div>
            </div>

            <!-- KONTEN DAFTAR BUKU -->
            <div class="rounded-2xl bg-white p-6 shadow-sm sm:p-8">

                <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">

                    <div>
                        <h3 class="text-xl font-bold text-gray-800">
                            Koleksi Buku
                        </h3>

                        <p class="mt-1 text-sm text-gray-500">
                            Daftar buku yang tersedia di perpustakaan.
                        </p>
                    </div>

                    @can("tambah buku")
                    <a href="{{ route('buku.form') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-5 py-3 text-sm font-semibold text-white shadow-md transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                        Tambah Buku
                    </a>
                    @endcan

                </div>

                <hr class="mb-6 border-gray-100">

                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 p-4 text-green-700">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- PESAN -->
                <p id="pesan"
                    class="mb-5 rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-600">
                    Memuat data buku...
                </p>

                <!-- DAFTAR BUKU -->
                <div id="daftar-buku"
                    class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                </div>

            </div>

            <!-- FOOTER -->
            <div class="mt-8 text-center text-sm text-gray-400">
                © 2026 Perpustakaan Digital 250441100072
            </div>

        </div>
    </div>

    <script>
        const daftar = document.getElementById('daftar-buku');
        const pesan = document.getElementById('pesan');

        // Pemeriksaan permission
        const bolehTambahBuku = @json(
            auth()->user()->can('tambah buku')
        );

        const bolehUbahBuku = @json(
            auth()->user()->can('ubah buku')
        );

        const bolehHapusBuku = @json(
            auth()->user()->can('hapus buku')
        );

        const bolehKelolaBuku =
            bolehTambahBuku || bolehUbahBuku || bolehHapusBuku;

        const bolehPinjamBuku = @json(
            auth()->user()->hasRole('siswa')
        );
        
        async function tampilkanBuku() {
            try {
                pesan.textContent = 'Memuat data buku...';
                pesan.className = 'mb-5 rounded-lg bg-blue-50 px-4 py-3 text-sm font-medium text-blue-600';

                const response = await fetch('/api/buku', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const hasil = await response.json();

                if (!response.ok) {
                    throw new Error(
                        hasil.message || 'Gagal mengambil data buku.'
                    );
                }

                const buku = Array.isArray(hasil)
                    ? hasil
                    : hasil?.data;

                if (!Array.isArray(buku)) {
                    throw new Error('Format data API tidak sesuai.');
                }

                daftar.replaceChildren();

                if (buku.length === 0) {
                    pesan.textContent = 'Data buku masih kosong.';
                    pesan.className = 'mb-5 rounded-lg bg-yellow-50 px-4 py-3 text-sm font-medium text-yellow-600';
                    return;
                }

                buku.forEach(item => {
                    const kartu = document.createElement('div');

                    kartu.className = 'group flex flex-col rounded-2xl border border-gray-100 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg';

                    const judul = document.createElement('h3');
                    judul.className = 'mb-3 text-lg font-bold text-gray-800 transition group-hover:text-blue-600';
                    judul.textContent = item.judul ?? '-';

                    const namaKategori =
                        typeof item.kategori === 'object'
                            ? (
                                item.kategori?.nama
                                ?? item.kategori?.nama_kategori
                                ?? '-'
                            )
                            : (item.kategori ?? '-');

                    const kategori = document.createElement('p');
                    kategori.className = 'mb-2 text-sm text-gray-500';
                    kategori.textContent = 'Kategori: ' + namaKategori;

                    const penulis = document.createElement('p');
                    penulis.className = 'mb-2 text-sm text-gray-500';
                    penulis.textContent =
                        'Penulis: ' + (item.penulis ?? '-');

                    const tahun = document.createElement('p');
                    tahun.className = 'mb-4 text-sm text-gray-500';
                    tahun.textContent =
                        'Tahun Terbit: ' + (item.tahun_terbit ?? '-');

                    // Tombol Detail bisa dilihat semua role
                    const tombolDetail = document.createElement('a');
                    tombolDetail.href = `/buku/${item.id}`;
                    tombolDetail.className = 'rounded-lg bg-gradient-to-r from-blue-600 to-indigo-500 px-3 py-2 text-center text-xs font-semibold text-white transition hover:opacity-90';
                    tombolDetail.textContent = 'Detail';

                    // Bagian tombol aksi
                    const aksi = document.createElement('div');
                    aksi.className = 'mt-auto flex flex-wrap gap-2 border-t border-gray-100 pt-4';

                    // Tombol Detail selalu ditampilkan
                    aksi.append(tombolDetail);

                    if (bolehPinjamBuku) {
                        const formPinjam = document.createElement('form');

                        formPinjam.method = 'POST';
                        formPinjam.action = `/siswa/peminjaman/${item.id}`;

                        const token = document.createElement('input');
                        token.type = 'hidden';
                        token.name = '_token';
                        token.value = @json(csrf_token());

                        const tombolPinjam = document.createElement('button');
                        tombolPinjam.type = 'submit';

                        tombolPinjam.className =
                            'rounded-lg bg-gradient-to-r from-blue-600 to-pink-500 px-4 py-2 text-xs font-semibold text-white shadow-md transition hover:-translate-y-0.5 hover:shadow-lg';

                        tombolPinjam.textContent = 'Pinjam';

                        // Konfirmasi sebelum meminjam
                        formPinjam.addEventListener('submit', function (event) {
                            const yakin = confirm(
                                `Apakah kamu yakin ingin meminjam buku "${item.judul}"?`
                            );

                            if (!yakin) {
                                event.preventDefault();
                            }
                        });

                        formPinjam.append(token, tombolPinjam);
                        aksi.append(formPinjam);
                    }

                    if (bolehKelolaBuku) {

                        if (bolehUbahBuku) {
                            const tombolUbah = document.createElement('a');

                            tombolUbah.href = `/buku/${item.id}/ubah`;

                            tombolUbah.className =
                                'rounded-lg bg-purple-100 px-3 py-2 text-center text-xs font-semibold text-purple-700 transition hover:bg-purple-200';

                            tombolUbah.textContent = 'Ubah';

                            aksi.append(tombolUbah);
                        }

                        // Tombol Hapus berdasarkan permission
                        if (bolehHapusBuku) {
                            const tombolHapus = document.createElement('button');

                            tombolHapus.type = 'button';

                            tombolHapus.className =
                                'rounded-lg bg-pink-100 px-3 py-2 text-xs font-semibold text-pink-700 transition hover:bg-pink-200';

                            tombolHapus.textContent = 'Hapus';

                            // Proses hapus buku
                            tombolHapus.addEventListener('click', async function () {
                                const yakin = confirm(
                                    `Apakah kamu yakin ingin menghapus buku "${item.judul}"?`
                                );

                                if (!yakin) {
                                    return;
                                }

                                tombolHapus.disabled = true;
                                tombolHapus.textContent = 'Menghapus...';

                                try {
                                    const responseHapus = await fetch(
                                        `/api/buku/${item.id}`,
                                        {
                                            method: 'DELETE',
                                            headers: {
                                                'Accept': 'application/json'
                                            }
                                        }
                                    );

                                    const hasilHapus = await responseHapus
                                        .json()
                                        .catch(() => ({}));

                                    if (!responseHapus.ok) {
                                        throw new Error(
                                            hasilHapus.message || 'Gagal menghapus buku.'
                                        );
                                    }

                                    kartu.remove();

                                    const jumlahKartu =
                                        daftar.querySelectorAll('.group').length;

                                    if (jumlahKartu === 0) {
                                        pesan.textContent = 'Data buku masih kosong.';
                                        pesan.className = 'mb-5 rounded-lg bg-yellow-50 px-4 py-3 text-sm font-medium text-yellow-600';
                                    } else {
                                        pesan.textContent = 'Buku berhasil dihapus!';
                                        pesan.className = 'mb-5 rounded-lg bg-green-50 px-4 py-3 text-sm font-medium text-green-600';
                                    }

                                } catch (error) {
                                    console.error('Kesalahan hapus:', error);

                                    pesan.textContent =
                                        'Terjadi kesalahan: ' + error.message;

                                    pesan.className = 'mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm font-medium text-red-600';

                                    tombolHapus.disabled = false;
                                    tombolHapus.textContent = 'Hapus';
                                }
                            });

                            aksi.append(tombolHapus);
                        }
                    }

                    kartu.append(
                        judul,
                        kategori,
                        penulis,
                        tahun,
                        aksi
                    );

                    daftar.appendChild(kartu);
                });

                pesan.textContent = 'Data buku berhasil dimuat!';
                pesan.className = 'mb-5 rounded-lg bg-green-50 px-4 py-3 text-sm font-medium text-green-600';

            } catch (error) {
                console.error('Kesalahan mengambil buku:', error);

                daftar.replaceChildren();

                pesan.textContent =
                    'Terjadi kesalahan: ' + error.message;

                pesan.className = 'mb-5 rounded-lg bg-red-50 px-4 py-3 text-sm font-medium text-red-600';
            }
        }

        tampilkanBuku();
    </script>
@endsection
