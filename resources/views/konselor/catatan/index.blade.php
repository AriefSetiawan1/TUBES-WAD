<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Catatan Konseling
            </h2>
            <a href="{{ route('konselor.catatan.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                + Tambah Catatan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($catatan->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">Belum ada catatan konseling.</p>
                            <a href="{{ route('catatan.create') }}" class="mt-4 text-indigo-600 hover:text-indigo-500">
                                Buat catatan pertama
                            </a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nama Pasien
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Penyakit
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Dokter
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Judul
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach($catatan as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ \Carbon\Carbon::parse($item->tanggal_konseling)->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->nama_pasien }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->penyakit }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->nama_dokter }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                {{ $item->judul }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-2">
                                                    <button type="button" onclick="showDetail({{ $item->id }})" 
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                        Detail
                                                    </button>
                                                    <a href="{{ route('konselor.catatan.edit', $item->id) }}" 
                                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('konselor.catatan.destroy', $item->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus catatan ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white dark:bg-gray-800">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Detail Catatan Konseling</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            
            <div id="modalContent" class="mt-4">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function showDetail(id) {
            // Tampilkan modal
            document.getElementById('detailModal').classList.remove('hidden');
            
            // Tampilkan loading state
            document.getElementById('modalContent').innerHTML = `
                <div class="flex justify-center items-center py-8">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                </div>
            `;
            
            // Ambil data menggunakan fetch dengan header yang benar
            fetch(`/konselor/catatan/${id}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const modalContent = document.getElementById('modalContent');
                
                // Format tanggal
                const tanggal = new Date(data.tanggal_konseling).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                // Render konten
                modalContent.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Informasi Pasien</h4>
                            <div class="space-y-2">
                                <p class="text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Nama Pasien:</span>
                                    <span class="text-gray-900 dark:text-gray-100">${data.nama_pasien}</span>
                                </p>
                                <p class="text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Penyakit:</span>
                                    <span class="text-gray-900 dark:text-gray-100">${data.penyakit}</span>
                                </p>
                                <p class="text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Dokter:</span>
                                    <span class="text-gray-900 dark:text-gray-100">${data.nama_dokter}</span>
                                </p>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Informasi Konseling</h4>
                            <div class="space-y-2">
                                <p class="text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Tanggal:</span>
                                    <span class="text-gray-900 dark:text-gray-100">${tanggal}</span>
                                </p>
                                <p class="text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Judul:</span>
                                    <span class="text-gray-900 dark:text-gray-100">${data.judul}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Isi Catatan</h4>
                        <p class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-line">${data.isi}</p>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('modalContent').innerHTML = `
                    <div class="bg-red-50 dark:bg-red-900/50 p-4 rounded-lg text-center">
                        <svg class="h-8 w-8 text-red-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-red-600 dark:text-red-400">
                            Terjadi kesalahan saat memuat data. Silakan coba lagi.
                        </p>
                    </div>
                `;
            });
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
            // Reset modal content when closing
            document.getElementById('modalContent').innerHTML = '';
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('detailModal').classList.contains('hidden')) {
                closeModal();
            }
        });
    </script>
    @endpush
</x-app-layout>
