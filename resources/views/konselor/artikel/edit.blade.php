<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Artikel
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

            <form action="{{ route('artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium">Author</label>
                    <input type="text" name="author" class="form-input w-full" value="{{ $artikel->author }}" required>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Isi Artikel</label>
                    <textarea name="content" class="form-textarea w-full" rows="4" required>{{ $artikel->content }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Gambar Saat Ini</label><br>
                    @if($artikel->image)
                        <img src="{{ asset('storage/' . $artikel->image) }}" width="100" class="mb-2">
                    @else
                        <p>Tidak ada gambar</p>
                    @endif
                    <input type="file" name="image" class="form-input w-full">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Tahun Terbit</label>
                    <input type="number" name="publication_year" class="form-input w-full" value="{{ $artikel->publication_year }}" required min="1900" max="{{ date('Y') }}">
                </div>
                <div class="flex space-x-2">
                    <button class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('artikel.index') }}" class="btn btn-secondary text-gray-600">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
