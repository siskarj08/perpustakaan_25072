
@extends('layout.layoutnya')

@section('title', 'Ubah Buku')

@section('content')
<div class="min-h-screen bg-slate-100 px-4 py-12 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-3xl">

        {{-- HEADER --}}
        <div class="mb-8 text-center">
            <span class="inline-flex items-center rounded-full bg-indigo-100 px-4 py-2 text-sm font-semibold text-indigo-700">
                PERPUSTAKAAN DIGITAL 072
            </span>

            <h1 class="mt-4 text-3xl font-bold tracking-tight text-slate-800 sm:text-4xl">
                Ubah Informasi Buku
            </h1>

            <p class="mt-3 text-sm leading-relaxed text-slate-500 sm:text-base">
                Perbarui informasi koleksi buku perpustakaan dengan mudah.
            </p>
        </div>

        {{-- FORM CARD --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/60">

            {{-- CARD HEADER --}}
            <div class="bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-6 py-6 sm:px-8">
                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/20 text-white backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.67a4.5 4.5 0 01-1.897 1.13L6 18.5l.7-2.685a4.5 4.5 0 011.13-1.897L16.862 4.487z" />
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 7.125L16.875 4.5" />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-white">
                            Formulir Ubah Buku
                        </h2>
                        <p class="mt-1 text-sm text-white/80">
                            ID Buku: #{{ $buku->id }}
                        </p>
                    </div>

                </div>
            </div>

            {{-- FORM BODY --}}
            <div class="p-6 sm:p-8">

                <div class="mb-7 rounded-xl border border-blue-100 bg-blue-50 px-4 py-3">
                    <p class="text-sm leading-relaxed text-blue-700">
                        Silakan periksa kembali informasi buku sebelum menyimpan perubahan.
                    </p>
                </div>

                <form id="form-buku" class="space-y-6">
                    @csrf

                    {{-- KATEGORI --}}
                    <div>
                        <label for="kategori_id"
                            class="mb-2 block text-sm font-semibold text-slate-700">
                            Kategori Buku
                        </label>

                        <select name="kategori_id"
                            id="kategori_id"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">

                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- JUDUL --}}
                    <div>
                        <label for="judul"
                            class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Buku
                        </label>

                        <input type="text"
                            name="judul"
                            id="judul"
                            value="{{ $buku->judul }}"
                            placeholder="Masukkan judul buku"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    {{-- PENULIS --}}
                    <div>
                        <label for="penulis"
                            class="mb-2 block text-sm font-semibold text-slate-700">
                            Nama Penulis
                        </label>

                        <input type="text"
                            name="penulis"
                            id="penulis"
                            value="{{ $buku->penulis }}"
                            placeholder="Masukkan nama penulis"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    {{-- TAHUN TERBIT --}}
                    <div>
                        <label for="tahun_terbit"
                            class="mb-2 block text-sm font-semibold text-slate-700">
                            Tahun Terbit
                        </label>

                        <input type="number"
                            name="tahun_terbit"
                            id="tahun_terbit"
                            value="{{ $buku->tahun_terbit }}"
                            min="1000"
                            max="{{ date('Y') }}"
                            placeholder="Contoh: 2026"
                            required
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100">
                    </div>

                    {{-- PESAN --}}
                    <div id="pesan"
                        class="hidden rounded-xl px-4 py-3 text-sm font-medium"
                        role="alert">
                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-6 sm:flex-row sm:justify-end">

                        <a href="{{ route('buku.index') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                            Kembali
                        </a>

                        <button type="submit"
                            id="tombol-simpan"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-200 transition hover:-translate-y-0.5 hover:shadow-xl disabled:cursor-not-allowed disabled:opacity-60">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M5 13l4 4L19 7" />
                            </svg>

                            Simpan Perubahan
                        </button>

                    </div>
                </form>
            </div>
        </div>

        {{-- FOOTER --}}
        <p class="mt-8 text-center text-sm text-slate-400">
            © 2026 Perpustakaan Digital 250441100072
        </p>

    </div>
</div>

<script>
    const form = document.getElementById('form-buku');
    const pesan = document.getElementById('pesan');
    const tombol = document.getElementById('tombol-simpan');

    // URL update buku menggunakan route bersama admin dan petugas.
    const urlUpdate = @json(
        route('buku.update', ['id' => $buku->id])
    );
    const urlKembali = @json(route('buku.index'));

    form.addEventListener('submit', async function(event) {
        event.preventDefault();

        tombol.disabled = true;
        tombol.textContent = 'Menyimpan perubahan...';

        pesan.className = 'rounded-xl px-4 py-3 text-sm font-medium bg-blue-50 text-blue-700';
        pesan.textContent = 'Sedang memperbarui data buku...';

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

            pesan.className = 'rounded-xl px-4 py-3 text-sm font-medium bg-green-50 text-green-700';
            pesan.textContent = hasil.message || 'Buku berhasil diperbarui!';

            tombol.textContent = 'Berhasil Disimpan';

            setTimeout(() => {
                window.location.href = urlKembali;
            }, 1000);

        } catch (error) {
            console.error(error);

            pesan.className = 'rounded-xl px-4 py-3 text-sm font-medium bg-red-50 text-red-700';
            pesan.textContent = error.message;

            tombol.disabled = false;
            tombol.textContent = 'Simpan Perubahan';
        }
    });
</script>
@endsection
