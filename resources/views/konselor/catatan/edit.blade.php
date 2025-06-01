<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Catatan Konseling
            </h2>
            <a href="{{ route('konselor.catatan.index') }}" 
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-200">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('konselor.catatan.update', $catatan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Nama Pasien -->
                            <div>
                                <label for="nama_pasien" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Pasien
                                </label>
                                <input type="text" name="nama_pasien" id="nama_pasien" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('nama_pasien', $catatan->nama_pasien) }}" required>
                                @error('nama_pasien')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Penyakit -->
                            <div>
                                <label for="penyakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Penyakit yang Diderita
                                </label>
                                <input type="text" name="penyakit" id="penyakit" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('penyakit', $catatan->penyakit) }}" required>
                                @error('penyakit')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nama Dokter -->
                            <div>
                                <label for="nama_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Dokter yang Menangani
                                </label>
                                <input type="text" name="nama_dokter" id="nama_dokter" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('nama_dokter', $catatan->nama_dokter) }}" required>
                                @error('nama_dokter')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Judul Catatan
                                </label>
                                <input type="text" name="judul" id="judul" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('judul', $catatan->judul) }}" required>
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Isi Catatan -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Isi Catatan
                                </label>
                                <textarea name="isi" id="isi" rows="5" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    required>{{ old('isi', $catatan->isi) }}</textarea>
                                @error('isi')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="tanggal_konseling" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tanggal Konseling
                                </label>
                                <input type="date" name="tanggal_konseling" id="tanggal_konseling" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('tanggal_konseling', $catatan->tanggal_konseling) }}" required>
                                @error('tanggal_konseling')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Error Messages -->
                        @if ($errors->any())
                            <div class="mt-4 bg-red-50 dark:bg-red-900/50 p-4 rounded-md">
                                <div class="font-medium text-red-600 dark:text-red-400">
                                    Oops! Ada beberapa masalah:
                                </div>
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4 mt-6">
                            <a href="{{ route('konselor.catatan.index') }}" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-200">
                                Batal
                            </a>
                            <button type="submit" 
                                class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
