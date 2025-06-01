<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Artikel
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('artikel.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Artikel</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <table class="table-auto w-full text-left">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Tahun</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($artikels as $artikel)
                        <tr class="border-b">
                            <td>{{ $artikel->id }}</td>
                            <td>{{ $artikel->author }}</td>
                            <td>{{ $artikel->publication_year }}</td>
                            <td>
                                @if($artikel->image)
                                    <img src="{{ asset('storage/' . $artikel->image) }}" width="100">
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('artikel.edit', $artikel->id) }}" class="text-blue-600">Edit</a> |
                                <form action="{{ route('artikel.destroy', $artikel->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('Hapus artikel ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
