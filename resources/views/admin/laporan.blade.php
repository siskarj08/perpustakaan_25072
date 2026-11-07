
<x-app-layout>
    <div class="min-h-screen bg-blue-100 px-4 py-10 sm:px-6 lg:px-10">
        <div class="mx-auto max-w-7xl">

            {{-- Header --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-pink-600 p-8 text-white shadow-xl print:bg-indigo-600 print:shadow-none">

                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                    <div>
                        <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-blue-100">
                            Perpustakaan 250441100072
                        </p>

                        <h1 class="text-3xl font-bold md:text-4xl">
                            Laporan Perpustakaan
                        </h1>

                        <p class="mt-3 max-w-xl text-sm text-blue-100 md:text-base">
                            Ringkasan data dan aktivitas peminjaman buku
                            pada sistem perpustakaan.
                        </p>
                    </div>

                    <div class="flex shrink-0 items-center justify-center">
                        <div class="flex h-24 w-24 items-center justify-center rounded-full border border-white/30 bg-white/15 p-3 shadow-lg backdrop-blur-sm md:h-40 md:w-40 md:p-4">
                            <img
                                src="{{ asset('image/read.png') }}"
                                alt="Logo Perpustakaan"
                                class="h-full w-full object-contain drop-shadow-lg transition duration-500 hover:scale-110">
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-6 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">
                        Ringkasan Data Perpustakaan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Tanggal laporan: {{ now()->translatedFormat('d F Y') }}
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 print:hidden">
                    <a href="{{ auth()->user()->role === 'petugas'
                        ? route('petugas.dashboard')
                        : route('admin.dashboard') }}"
                    class="rounded-xl bg-slate-100 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-200">
                        Kembali ke Dashboard
                    </a>

                    <button onclick="window.print()"
                            class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                        🖨️ Cetak Laporan
                    </button>
                </div>
            </div>

            {{-- Statistik --}}
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Total Buku --}}
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <p class="text-sm text-slate-500">
                                Total Buku
                            </p>

                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $totalBuku }}
                            </h2>

                            <p class="mt-1 text-xs text-slate-400">
                                Koleksi buku perpustakaan
                            </p>
                        </div>

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-blue-100 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/tumpukan.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>

                    </div>
                </div>

                {{-- Total Pengguna --}}
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Total Pengguna
                            </p>

                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $totalPengguna }}
                            </h2>

                            <p class="mt-1 text-xs text-slate-400">
                                Akun terdaftar
                            </p>
                        </div>

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-blue-100 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/group.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>
                    </div>
                </div>

                {{-- Total Peminjaman --}}
                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">
                                Total Peminjaman
                            </p>

                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $totalPeminjaman }}
                            </h2>

                            <p class="mt-1 text-xs text-slate-400">
                                Seluruh transaksi
                            </p>
                        </div>

                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-blue-100 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/pencil.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>
                    </div>
                </div>

            </div>

            {{-- Rekap Status --}}
            <div class="mb-8 rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">

                <h2 class="text-xl font-bold text-slate-800">
                    Rekap Status Peminjaman
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Perbandingan transaksi berdasarkan status pengembalian.
                </p>

                <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">

                    <div class="rounded-xl border border-amber-100 bg-amber-50 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-amber-700">
                                    Sedang Dipinjam
                                </p>

                                <h3 class="mt-2 text-3xl font-bold text-amber-800">
                                    {{ $sedangDipinjam }}
                                </h3>
                            </div>

                           <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-yellow-200 p-2 md:h-20 md:w-20">
                            <img
                                src="{{ asset('image/pinjam.png') }}"
                                alt="Ikon Tumpukan Buku"
                                class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                        </div>
                        </div>
                    </div>

                    <div class="rounded-xl border border-green-100 bg-green-50 p-5">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-green-700">
                                    Sudah Dikembalikan
                                </p>

                                <h3 class="mt-2 text-3xl font-bold text-green-800">
                                    {{ $sudahDikembalikan }}
                                </h3>
                            </div>

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-green-200 p-2 md:h-20 md:w-20">
                                <img
                                    src="{{ asset('image/ok.png') }}"
                                    alt="Ikon Tumpukan Buku"
                                    class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Tabel Laporan --}}
            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-6">
                    <h2 class="text-xl font-bold text-slate-800">
                        Riwayat Transaksi Peminjaman
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Daftar 10 transaksi terbaru pada setiap halaman.
                    </p>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Anggota</th>
                                <th class="px-6 py-4">Judul Buku</th>
                                <th class="px-6 py-4">Tanggal Pinjam</th>
                                <th class="px-6 py-4">Tanggal Kembali</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse ($laporan as $index => $item)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $laporan->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        {{ $item->anggota->nama ?? 'Anggota tidak ditemukan' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-700">
                                        {{ $item->buku->judul ?? 'Buku tidak ditemukan' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $item->tanggal_pinjam
                                            ? \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y')
                                            : '-' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $item->tanggal_kembali
                                            ? \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y')
                                            : '-' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($item->tanggal_kembali)
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Dikembalikan
                                            </span>
                                        @else
                                            <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700">
                                                Dipinjam
                                            </span>
                                        @endif
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada data transaksi peminjaman.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="border-t border-slate-100 p-6 print:hidden">
                    {{ $laporan->links() }}
                </div>

            </div>

            {{-- Footer Laporan --}}
            <div class="mt-8 text-center text-xs text-slate-400">
                <p>© {{ date('Y') }} Perpustakaan 250441100072</p>
                <p class="mt-1">Laporan dibuat secara otomatis oleh sistem perpustakaan.</p>
            </div>

        </div>
    </div>

    {{-- Pengaturan Cetak --}}
    <style>
        @media print {
            body {
                background: white !important;
            }

            nav, footer {
                display: none !important;
            }

            .min-h-screen {
                min-height: auto !important;
            }

            table {
                font-size: 10px !important;
            }

            th, td {
                padding: 10px !important;
            }

            @page {
                size: landscape;
                margin: 15mm;
            }
        }
    </style>
</x-app-layout>
