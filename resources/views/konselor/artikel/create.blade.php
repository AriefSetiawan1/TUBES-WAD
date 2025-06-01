<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Artikel
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow sm:rounded-lg">
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error) 
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block font-medium">Author</label>
                    <input type="text" name="author" class="form-input w-full" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Isi Artikel</label>
                    <textarea name="content" class="form-textarea w-full" rows="4" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Gambar (Opsional)</label>
                    <input type="file" name="image" class="form-input w-full">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Tahun Terbit</label>
                    <input type="number" name="publication_year" class="form-input w-full" required min="1900" max="{{ date('Y') }}">
                </div>
                <div class="flex space-x-2">
                    <button class="btn btn-success bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-secondary text-gray-600">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
