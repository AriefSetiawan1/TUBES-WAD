<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detail Catatan Konseling
            </h2>
            <a href="{{ route('catatan.index') }}" 
                class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition-colors duration-200">
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Informasi Utama -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Informasi Pasien</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Pasien:</label>
                                    <p class="text-gray-900 dark:text-gray-100">{{ $catatan->nama_pasien }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Penyakit:</label>
                                    <p class="text-gray-900 dark:text-gray-100">{{ $catatan->penyakit }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Dokter yang Menangani:</label>
                                    <p class="text-gray-900 dark:text-gray-100">{{ $catatan->nama_dokter }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Informasi Konseling</h3>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Tanggal Konseling:</label>
                                    <p class="text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($catatan->tanggal_konseling)->format('d F Y') }}
                                    </p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Judul Catatan:</label>
                                    <p class="text-gray-900 dark:text-gray-100">{{ $catatan->judul }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Isi Catatan -->
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Isi Catatan</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-line">{{ $catatan->isi }}</p>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('catatan.edit', $catatan->id) }}" 
                            class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition-colors duration-200">
                            Edit Catatan
                        </a>
                        <form action="{{ route('catatan.destroy', $catatan->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                Hapus Catatan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 