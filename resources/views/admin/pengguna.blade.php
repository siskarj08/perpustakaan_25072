<x-app-layout>
    <div class="min-h-screen bg-blue-100 px-4 py-10 sm:px-6 lg:px-10">

        <div class="mx-auto max-w-7xl">

            {{-- Header --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-pink-600 p-8 text-white shadow-xl">

                <div class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center">

                    <div>
                        <p class="mb-2 text-sm font-semibold uppercase tracking-widest text-blue-100">
                            Perpustakaan 250441100072
                        </p>

                        <h1 class="text-3xl font-bold md:text-4xl">
                            Kelola Pengguna
                        </h1>

                        <p class="mt-3 max-w-xl text-sm text-blue-100 md:text-base">
                            Lihat dan pantau seluruh pengguna yang terdaftar
                            dalam sistem perpustakaan.
                        </p>
                    </div>

                    <div class="flex items-center justify-center">
                        <img
                            src="{{ asset('image/read.png') }}"
                            alt="Logo Perpustakaan"
                            class="h-24 w-24 object-contain drop-shadow-lg transition duration-500 hover:scale-110 md:h-40 md:w-40">
                    </div>

                </div>
            </div>

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Ringkasan --}}
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-3">

                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Total Pengguna</p>
                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $pengguna->total() }}
                            </h2>
                        </div>

                        <div class="flex h-28 w-28 shrink-0 items-center justify-center rounded-full bg-purple-100 p-2 md:h-20 md:w-20">
                        <img
                            src="{{ asset('image/group.png') }}"
                            alt="Ikon Tumpukan Buku"
                            class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                    </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Admin</p>
                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ \App\Models\User::where('role', 'admin')->count() }}
                            </h2>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-purple-100 p-2 md:h-20 md:w-20">
                        <img
                            src="{{ asset('image/admin.png') }}"
                            alt="Ikon Tumpukan Buku"
                            class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                    </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-100 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Siswa</p>
                            <h2 class="mt-2 text-3xl font-bold text-slate-800">
                                {{ \App\Models\User::where('role', 'siswa')->count() }}
                            </h2>
                        </div>

                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-purple-100 p-2 md:h-20 md:w-20">
                        <img
                            src="{{ asset('image/students.png') }}"
                            alt="Ikon Tumpukan Buku"
                            class="h-full w-full object-contain drop-shadow-sm transition duration-300 hover:scale-110">
                    </div>
                    </div>
                </div>

            </div>

            {{-- Tabel Pengguna --}}
            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">

                <div class="flex flex-col justify-between gap-3 border-b border-slate-100 p-6 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">
                            Daftar Pengguna
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Informasi akun yang terdaftar di sistem.
                        </p>
                    </div>

                    <a href="{{ route('admin.dashboard') }}"
                       class="rounded-xl bg-slate-100 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-200">
                        Kembali ke Dashboard
                    </a>
                </div>

                <div class="overflow-x-auto">

                    <table class="w-full text-left text-sm">

                        <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Pengguna</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Tanggal Bergabung</th>
                                <th class="px-6 py-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse ($pengguna as $index => $user)

                                <tr class="transition hover:bg-slate-50">

                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $pengguna->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-slate-800">
                                        {{ $user->name }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if ($user->role === 'admin')
                                            <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                                Admin
                                            </span>
                                        @elseif ($user->role === 'petugas')
                                            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700">
                                                Petugas
                                            </span>
                                        @else
                                            <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Siswa
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $user->created_at?->format('d M Y') ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($user->id !== auth()->id())

                                            <form action="{{ route('admin.pengguna.updateRole', $user->id) }}"
                                                method="POST"
                                                class="flex flex-col gap-2 sm:flex-row sm:items-center">

                                                @csrf
                                                @method('PATCH')

                                                <select name="role"
                                                        class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 focus:border-indigo-500 focus:ring-indigo-500">

                                                    <option value="siswa" {{ $user->role === 'siswa' ? 'selected' : '' }}>
                                                        Siswa
                                                    </option>

                                                    <option value="petugas" {{ $user->role === 'petugas' ? 'selected' : '' }}>
                                                        Petugas
                                                    </option>

                                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                        Admin
                                                    </option>

                                                </select>

                                                <button type="submit"
                                                        onclick="return confirm('Apakah kamu yakin ingin mengubah role pengguna ini?')"
                                                        class="rounded-lg bg-indigo-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-indigo-700">
                                                    Simpan
                                                </button>

                                            </form>

                                        @else

                                            <span class="text-xs font-medium text-slate-400">
                                                Akun Anda
                                            </span>

                                        @endif
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        Belum ada pengguna yang terdaftar.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                <div class="border-t border-slate-100 p-6">
                    {{ $pengguna->links() }}
                </div>

            </div>

        </div>
    </div>
</x-app-layout>