<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📋 {{ __('Laporan Distribusi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Report by School -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="text-4xl mr-4">🏫</div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Laporan per Sekolah</h3>
                                <p class="text-gray-600">Generate laporan distribusi berdasarkan sekolah</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('reports.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="report_type" value="sekolah">
                            
                            <div>
                                <label for="sekolah_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Sekolah <span class="text-red-500">*</span>
                                </label>
                                <select name="sekolah_id" id="sekolah_id" required
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="">Pilih Sekolah</option>
                                    @foreach($sekolahList as $sekolah)
                                        <option value="{{ $sekolah->id }}">{{ $sekolah->nama_sekolah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="start_date_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                                        Dari Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="start_date" id="start_date_sekolah" required
                                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                </div>
                                
                                <div>
                                    <label for="end_date_sekolah" class="block text-sm font-medium text-gray-700 mb-2">
                                        Sampai Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="end_date" id="end_date_sekolah" required
                                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg">
                                📄 Generate Laporan PDF
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Report by Vehicle -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="text-4xl mr-4">🚛</div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-900">Laporan per Kendaraan</h3>
                                <p class="text-gray-600">Generate laporan distribusi berdasarkan kendaraan</p>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('reports.store') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="report_type" value="kendaraan">
                            
                            <div>
                                <label for="kendaraan_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pilih Kendaraan <span class="text-red-500">*</span>
                                </label>
                                <select name="kendaraan_id" id="kendaraan_id" required
                                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach($kendaraanList as $kendaraan)
                                        <option value="{{ $kendaraan->id }}">
                                            {{ $kendaraan->nama_kendaraan }} ({{ $kendaraan->plat_nomor }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="start_date_kendaraan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Dari Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="start_date" id="start_date_kendaraan" required
                                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                </div>
                                
                                <div>
                                    <label for="end_date_kendaraan" class="block text-sm font-medium text-gray-700 mb-2">
                                        Sampai Tanggal <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="end_date" id="end_date_kendaraan" required
                                           class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg">
                                📄 Generate Laporan PDF
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Report Templates Info -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-400 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">📊 Informasi Laporan</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Laporan akan berisi informasi berikut:</p>
                            <ul class="list-disc list-inside mt-1 space-y-1">
                                <li>📈 Statistik distribusi dalam periode yang dipilih</li>
                                <li>📋 Detail setiap distribusi dengan status dan jumlah porsi</li>
                                <li>📊 Ringkasan total porsi dan presentase keberhasilan</li>
                                <li>📅 Tanggal dan waktu pembuatan laporan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set default dates (last 30 days)
        const today = new Date();
        const lastMonth = new Date();
        lastMonth.setMonth(today.getMonth() - 1);

        const formatDate = (date) => {
            return date.toISOString().split('T')[0];
        };

        document.getElementById('start_date_sekolah').value = formatDate(lastMonth);
        document.getElementById('end_date_sekolah').value = formatDate(today);
        document.getElementById('start_date_kendaraan').value = formatDate(lastMonth);
        document.getElementById('end_date_kendaraan').value = formatDate(today);
    </script>
</x-app-layout>