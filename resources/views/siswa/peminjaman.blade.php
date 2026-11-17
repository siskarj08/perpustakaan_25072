
<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">
                <h1 class="text-3xl font-bold">
                    Riwayat Peminjaman
                </h1>

                <p class="mt-2 text-white/90">
                    Halo, {{ Auth::user()->name }}!
                </p>

                <p class="mt-1 text-sm text-white/80">
                    Berikut adalah daftar buku yang pernah kamu pinjam.
                </p>
            </div>

            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a href="{{ route('siswa.dashboard') }}"
                   class="inline-flex items-center rounded-lg bg-white px-5 py-3 text-sm font-semibold text-blue-600 shadow-sm transition hover:bg-blue-50">
                    Kembali ke Dashboard
                </a>
            </div>

            <!-- Daftar Peminjaman -->
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm">

                <div class="border-b border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-800">
                        Daftar Peminjaman Saya
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Total peminjaman: {{ $peminjamans->count() }} transaksi
                    </p>
                </div>

                @if($peminjamans->isEmpty())

                    <div class="px-6 py-16 text-center">
                        <div class="mb-4 text-5xl">📚</div>

                        <h3 class="text-lg font-bold text-gray-700">
                            Belum Ada Peminjaman
                        </h3>

                        <p class="mt-2 text-sm text-gray-500">
                            Kamu belum memiliki riwayat peminjaman buku.
                        </p>

                        <a href="{{ route('buku.index') }}"
                           class="mt-6 inline-block rounded-lg bg-gradient-to-r from-blue-600 to-pink-500 px-6 py-3 text-sm font-semibold text-white hover:opacity-90">
                            Jelajahi Buku
                        </a>
                    </div>

                @else

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">

                            <thead class="bg-gray-50 text-gray-600">
                                <tr>
                                    <th class="px-6 py-4">No.</th>
                                    <th class="px-6 py-4">Judul Buku</th>
                                    <th class="px-6 py-4">Tanggal Pinjam</th>
                                    <th class="px-6 py-4">Tanggal Kembali</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach($peminjamans as $index => $peminjaman)

                                    <tr class="transition hover:bg-blue-50/50">

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $index + 1 }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold text-gray-800">
                                            {{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $peminjaman->tanggal_pinjam
                                                ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                                                : '-' }}
                                        </td>

                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $peminjaman->tanggal_kembali
                                                ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                                                : 'Belum dikembalikan' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($peminjaman->tanggal_kembali)
                                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                                    Dipinjam
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            <a href="{{ route('peminjaman.show', $peminjaman->id) }}"
                                                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-blue-700">
                                                Detail
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>
