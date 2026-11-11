@props(['judul', 'id'])

<div class="kartu-buku">
    <h3 class="text-lg font-bold text-gray-800">
        {{  $judul  }}
    </h3>

    <p class="mt-2 text-sm text-gray-500">
        ID: {{ $id }}
    </p>

    {{ $tambahan }}

    <a href="{{ route('lihat.buku', $id) }}"
        class="mt-4 inline-block rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white">
        Lihat Detail
    </a>

</div>