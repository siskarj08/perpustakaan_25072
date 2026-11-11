
@extends('layout.layoutnya')

@section('title')
    Form Buku
@endsection

@section('content')

<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-pink-50 px-4 py-12 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-2xl">

        <!-- HEADER FORM -->
        <div class="mb-8 text-center">

            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 shadow-lg shadow-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-8 w-8 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                </svg>
            </div>

            <h1 id="judul-form"
                class="text-3xl font-extrabold tracking-tight text-gray-800 sm:text-4xl">
                Tambah Buku
            </h1>

            <p id="deskripsi-form"
                class="mt-3 text-sm leading-relaxed text-gray-500 sm:text-base">
                Lengkapi informasi buku yang ingin ditambahkan ke perpustakaan.
            </p>

        </div>

        <!-- CARD FORM -->
        <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl shadow-indigo-100/50">

            <!-- GARIS GRADIENT -->
            <div class="h-2 bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500"></div>

            <div class="p-6 sm:p-10">

                <form id="form-buku" class="space-y-6">
                    @csrf

                    <!-- KATEGORI -->
                    <div>
                        <label for="kategori_id"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Kategori Buku
                            <span class="text-pink-500">*</span>
                        </label>

                        <select
                            name="kategori_id"
                            id="kategori_id"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-700 outline-none transition duration-200 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">

                            <option value="">Pilih Kategori</option>
                            <option value="1">Trilogi</option>
                            <option value="2">Fantasi</option>
                            <option value="3">Fiksi</option>
                        </select>
                    </div>

                    <!-- JUDUL BUKU -->
                    <div>
                        <label for="judul"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Judul Buku
                            <span class="text-pink-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="judul"
                            id="judul"
                            placeholder="Masukkan judul buku"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-700 outline-none transition duration-200 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <!-- PENULIS -->
                    <div>
                        <label for="penulis"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Nama Penulis
                            <span class="text-pink-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="penulis"
                            id="penulis"
                            placeholder="Masukkan nama penulis"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-700 outline-none transition duration-200 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <!-- TAHUN TERBIT -->
                    <div>
                        <label for="tahun_terbit"
                            class="mb-2 block text-sm font-semibold text-gray-700">
                            Tahun Terbit
                            <span class="text-pink-500">*</span>
                        </label>

                        <input
                            type="number"
                            name="tahun_terbit"
                            id="tahun_terbit"
                            placeholder="Contoh: 2024"
                            min="1000"
                            max="{{ date('Y') }}"
                            required
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3.5 text-sm text-gray-700 outline-none transition duration-200 placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-100">
                    </div>

                    <!-- PESAN -->
                    <div id="pesan"
                        class="hidden rounded-xl px-4 py-3 text-sm"
                        role="status"
                        aria-live="polite">
                    </div>

                    <!-- TOMBOL SIMPAN -->
                    <button
                        type="submit"
                        id="tombol-simpan"
                        class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-6 py-4 text-sm font-bold text-white shadow-lg shadow-indigo-200 transition duration-300 hover:-translate-y-0.5 hover:shadow-xl hover:shadow-indigo-200 disabled:cursor-not-allowed disabled:opacity-60">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13l4 4L19 7" />
                        </svg>

                        Tambah Buku
                    </button>

                </form>

                <!-- KEMBALI -->
                <div class="mt-6 border-t border-gray-100 pt-6">

                    <a href="{{ route('buku.index') }}"
                        class="flex items-center justify-center gap-2 text-sm font-semibold text-gray-500 transition hover:text-indigo-600">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19l-7-7 7-7" />
                        </svg>

                        Kembali ke Daftar Buku
                    </a>

                </div>

            </div>
        </div>

        <!-- FOOTER -->
        <p class="mt-8 text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} Perpustakaan072. All rights reserved.
        </p>

    </div>
</div>

<script>
    const form = document.getElementById('form-buku');
    const pesan = document.getElementById('pesan');
    const tombol = document.getElementById('tombol-simpan');

    const judulForm = document.getElementById('judul-form');
    const deskripsiForm = document.getElementById('deskripsi-form');

    const idBuku = @json($id ?? null);

    // Menampilkan pesan
    function tampilkanPesan(teks, tipe) {
        pesan.className = 'rounded-xl px-4 py-3 text-sm';

        if (tipe === 'berhasil') {
            pesan.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-200');
        } else if (tipe === 'gagal') {
            pesan.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
        } else {
            pesan.classList.add('bg-blue-50', 'text-blue-700', 'border', 'border-blue-200');
        }

        pesan.textContent = teks;
    }

    // Mengambil data buku untuk proses edit
    async function tampilkanDataBuku() {
        if (!idBuku) return;

        judulForm.textContent = 'Ubah Buku';

        deskripsiForm.textContent =
            'Perbarui informasi buku yang dipilih.';

        tombol.textContent = 'Simpan Perubahan';

        tombol.disabled = true;

        tampilkanPesan('Memuat data buku...', 'proses');

        try {
            const response = await fetch(
                `/api/buku/${encodeURIComponent(idBuku)}`,
                {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            const hasil = await response.json();

            if (!response.ok) {
                throw new Error(
                    hasil.message || 'Gagal mengambil data buku.'
                );
            }

            const buku = hasil.data ?? hasil;

            document.getElementById('kategori_id').value =
                buku.kategori_id ?? '';

            document.getElementById('judul').value =
                buku.judul ?? '';

            document.getElementById('penulis').value =
                buku.penulis ?? '';

            document.getElementById('tahun_terbit').value =
                buku.tahun_terbit ?? '';

            tampilkanPesan('Data buku berhasil dimuat.', 'berhasil');

        } catch (error) {
            tampilkanPesan(error.message, 'gagal');

        } finally {
            tombol.disabled = false;
        }
    }

    // Proses tambah dan ubah buku
    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        tombol.disabled = true;

        tampilkanPesan('Menyimpan data buku...', 'proses');

        try {
            const data = {
                kategori_id: Number(form.kategori_id.value),
                judul: form.judul.value.trim(),
                penulis: form.penulis.value.trim(),
                tahun_terbit: Number(form.tahun_terbit.value)
            };

            const sedangMengubah = Boolean(idBuku);

            const url = sedangMengubah
                ? `/api/buku/${encodeURIComponent(idBuku)}`
                : '/api/buku';

            const response = await fetch(url, {
                method: sedangMengubah ? 'PUT' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value
                },
                body: JSON.stringify(data)
            });

            const statusCode = response.status;

            const hasil = await response.json().catch(() => ({}));

            if (!response.ok) {
                const detail = hasil.errors
                    ? Object.values(hasil.errors).flat().join(' ')
                    : hasil.message;

                throw new Error(
                    'HTTP ' + statusCode + ': ' +
                    (detail || 'Gagal menyimpan data buku.')
                );
            }

            tampilkanPesan(
                sedangMengubah
                    ? 'Buku berhasil diperbarui!'
                    : 'Buku berhasil ditambahkan!',
                'berhasil'
            );

            form.reset();

            setTimeout(() => {
                window.location.href = "{{ route('buku.index') }}";
            }, 1000);

        } catch (error) {
            console.error(error);

            tampilkanPesan(error.message, 'gagal');

        } finally {
            tombol.disabled = false;
        }
    });

    // Jalankan saat halaman dibuka
    tampilkanDataBuku();
</script>

@endsection
