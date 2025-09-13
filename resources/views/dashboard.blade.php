<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📊 {{ __('Dashboard') }}
            </h2>
            <div class="flex items-center space-x-4">
                <select name="kendaraan_id" 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        onchange="window.location.href='{{ route('dashboard') }}?kendaraan_id=' + this.value">
                    <option value="">🚛 Semua Kendaraan</option>
                    @foreach($kendaraanOptions as $kendaraan)
                        <option value="{{ $kendaraan->id }}" {{ $kendaraanFilter == $kendaraan->id ? 'selected' : '' }}>
                            {{ $kendaraan->nama_kendaraan }}
                        </option>
                    @endforeach
                </select>
                <button onclick="location.reload()" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    🔄 Refresh
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="text-3xl mr-4">🏫</div>
                            <div>
                                <div class="text-2xl font-bold">{{ $stats['total_sekolah'] }}</div>
                                <div class="text-gray-600">Total Sekolah</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="text-3xl mr-4">👥</div>
                            <div>
                                <div class="text-2xl font-bold">{{ $stats['total_siswa'] }}</div>
                                <div class="text-gray-600">Penerima MBG</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="text-3xl mr-4">🚛</div>
                            <div>
                                <div class="text-2xl font-bold">{{ $stats['total_kendaraan'] }}</div>
                                <div class="text-gray-600">Kendaraan Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center">
                            <div class="text-3xl mr-4">📦</div>
                            <div>
                                <div class="text-2xl font-bold">{{ $stats['distribusi_hari_ini'] }}</div>
                                <div class="text-gray-600">Distribusi Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Weekly Distribution Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">📈 Distribusi 7 Hari Terakhir</h3>
                        <canvas id="weeklyChart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Status Distribution Pie Chart -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">🥧 Status Distribusi</h3>
                        <canvas id="statusChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Today's Distributions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Today's Distribution List -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">📅 Distribusi Hari Ini</h3>
                        @if($distribusiHariIni->count() > 0)
                            <div class="space-y-3">
                                @foreach($distribusiHariIni as $distribusi)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-medium">{{ $distribusi->sekolah->nama_sekolah }}</div>
                                            <div class="text-sm text-gray-600">
                                                🚛 {{ $distribusi->kendaraan->nama_kendaraan }} • 
                                                📦 {{ $distribusi->jumlah_porsi }} porsi
                                            </div>
                                        </div>
                                        <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $distribusi->status === 'sudah' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $distribusi->status === 'sudah' ? '✅ Selesai' : '⏳ Belum' }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                📅 Tidak ada distribusi hari ini
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Distributions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">🕒 Distribusi Terbaru</h3>
                        @if($recentDistribusi->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentDistribusi->take(10) as $distribusi)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <div class="font-medium">{{ $distribusi->sekolah->nama_sekolah }}</div>
                                            <div class="text-sm text-gray-600">
                                                📅 {{ $distribusi->tanggal_distribusi->format('d M Y') }} • 
                                                🚛 {{ $distribusi->kendaraan->nama_kendaraan }}
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-sm font-medium">{{ $distribusi->jumlah_porsi }} porsi</div>
                                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                                {{ $distribusi->status === 'sudah' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $distribusi->status === 'sudah' ? '✅' : '⏳' }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-gray-500">
                                📦 Belum ada data distribusi
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Weekly Distribution Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        const weeklyChart = new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_column($weeklyData, 'label')) !!},
                datasets: [
                    {
                        label: 'Selesai',
                        data: {!! json_encode(array_column($weeklyData, 'sudah')) !!},
                        backgroundColor: 'rgba(34, 197, 94, 0.8)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Belum Selesai',
                        data: {!! json_encode(array_column($weeklyData, 'belum')) !!},
                        backgroundColor: 'rgba(234, 179, 8, 0.8)',
                        borderColor: 'rgba(234, 179, 8, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Status Distribution Pie Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['✅ Selesai', '⏳ Belum Selesai'],
                datasets: [{
                    data: [{{ $statusData['sudah'] }}, {{ $statusData['belum'] }}],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(234, 179, 8, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(234, 179, 8, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                }
            }
        });
    </script>
</x-app-layout>