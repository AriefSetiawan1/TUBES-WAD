<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Catatan Konseling Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('catatan.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Nama Pasien -->
                            <div>
                                <label for="nama_pasien" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Pasien
                                </label>
                                <input type="text" name="nama_pasien" id="nama_pasien" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('nama_pasien') }}" required>
                            </div>

                            <!-- Penyakit -->
                            <div>
                                <label for="penyakit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Penyakit yang Diderita
                                </label>
                                <input type="text" name="penyakit" id="penyakit" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('penyakit') }}" required>
                            </div>

                            <!-- Nama Dokter -->
                            <div>
                                <label for="nama_dokter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Nama Dokter yang Menangani
                                </label>
                                <input type="text" name="nama_dokter" id="nama_dokter" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('nama_dokter') }}" required>
                            </div>

                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Judul Catatan
                                </label>
                                <input type="text" name="judul" id="judul" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('judul') }}" required>
                            </div>

                            <!-- Isi Catatan -->
                            <div>
                                <label for="isi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Isi Catatan
                                </label>
                                <textarea name="isi" id="isi" rows="5" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    required>{{ old('isi') }}</textarea>
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="tanggal_konseling" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Tanggal Konseling
                                </label>
                                <input type="date" name="tanggal_konseling" id="tanggal_konseling" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                    value="{{ old('tanggal_konseling') ?? date('Y-m-d') }}" required>
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
                            <!-- Tombol Kembali -->
                            <a href="{{ route('catatan.index') }}" 
                                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-200">
                                Kembali
                            </a>

                            <!-- Tombol Submit -->
                            <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Catatan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
