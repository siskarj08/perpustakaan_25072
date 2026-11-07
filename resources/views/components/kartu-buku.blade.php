<div>
    <div class="kartu-buku">
        @props(['judul', 'id'])
        <h3>{{ $judul }}</h3>
        <p>ID: {{ $id }}</p>
        {{ $tambahan }}

        <a href="{{ route('lihat.buku', $id) }}" class="btn">
            Lihat Detail
        </a>
        <form action="/siswa/peminjaman/${item.id}" method="POST">
            @csrf
            <button type="submit"
                class="mt-3 w-full rounded-lg bg-gradient-to-r from-blue-600 to-pink-500 px-4 py-2 text-sm font-semibold text-white transition hover:opacity-90">
                Pinjam Buku
            </button>
        </form>
        <hr>
    </div>
</div>