 <x-app-layout>
    <div class="min-h-screen bg-gray-100 px-4 py-10">

        <div class="mx-auto max-w-4xl">
            <div class="mb-8 rounded-2xl bg-gradient-to-r from-blue-600 via-indigo-500 to-pink-500 p-8 text-white shadow-lg">

                <h1 class="text-3xl font-bold">
                    Detail Peminjaman
                </h1>

                <p class="mt-2 text-white/90">
                    Informasi lengkap transaksi peminjaman buku.
                </p>

            </div>

            <!-- DETAIL -->
            <div class="rounded-2xl bg-white p-8 shadow-sm">

                <h2 class="mb-6 text-xl font-bold text-gray-800">
                    Informasi Peminjaman
                </h2>

                <div class="space-y-5">

                    <div>
                        <p class="text-sm text-gray-500">Nama Siswa</p>
                        <p class="font-semibold text-gray-800">
                            {{ auth()->user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Judul Buku</p>
                        <p class="font-semibold text-gray-800">
                            {{ $peminjaman->buku->judul ?? 'Buku tidak ditemukan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Pinjam</p>
                        <p class="font-semibold text-gray-800">
                            {{ $peminjaman->tanggal_pinjam
                                ? \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y')
                                : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Tanggal Kembali</p>
                        <p class="font-semibold text-gray-800">
                            {{ $peminjaman->tanggal_kembali
                                ? \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y')
                                : 'Belum dikembalikan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status Peminjaman</p>

                        @if($peminjaman->tanggal_kembali)
                            <span class="inline-block rounded-full bg-green-100 px-4 py-2 text-xs font-semibold text-green-700">
                                Selesai
                            </span>
                        @else
                            <span class="inline-block rounded-full bg-yellow-100 px-4 py-2 text-xs font-semibold text-yellow-700">
                                Dipinjam
                            </span>
                        @endif
                    </div>

                </div>

                <div class="mt-8 border-t border-gray-100 pt-6">

                    <a href="{{ route('siswa.peminjaman.index') }}"
                    class="rounded-lg bg-blue-600 px-4 py-2 text-xs font-semibold text-white hover:bg-blue-700">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>
</x-app-layout>