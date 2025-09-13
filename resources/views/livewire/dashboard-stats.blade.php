<div wire:poll.30s="loadStats">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex items-center">
                    <div class="text-3xl mr-4">🏫</div>
                    <div>
                        <div class="text-2xl font-bold">{{ $totalSekolah }}</div>
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
                        <div class="text-2xl font-bold">{{ $totalPenerima }}</div>
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
                        <div class="text-2xl font-bold">{{ $totalKendaraan }}</div>
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
                        <div class="text-2xl font-bold">{{ $distribusiHariIni }}</div>
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
                <canvas id="weeklyChart-{{ uniqid() }}" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Status Distribution Pie Chart -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">🥧 Status Distribusi</h3>
                <canvas id="statusChart-{{ uniqid() }}" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Distributions -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold mb-4">🕒 Distribusi Terbaru</h3>
            @if($distribusiTerbaru->count() > 0)
                <div class="space-y-3">
                    @foreach($distribusiTerbaru as $distribusi)
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

            <div class="mt-4 text-center">
                <button wire:click="refreshStats" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    🔄 Refresh Data
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:update', function() {
            // Reinitialize charts when Livewire updates
            initializeCharts();
        });

        function initializeCharts() {
            // Weekly Distribution Chart
            const weeklyCanvases = document.querySelectorAll('[id^="weeklyChart-"]');
            weeklyCanvases.forEach(canvas => {
                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData['labels']) !!},
                        datasets: [{
                            label: 'Distribusi',
                            data: {!! json_encode($chartData['data']) !!},
                            backgroundColor: 'rgba(59, 130, 246, 0.8)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });

            // Status Distribution Pie Chart
            const statusCanvases = document.querySelectorAll('[id^="statusChart-"]');
            statusCanvases.forEach(canvas => {
                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['✅ Selesai', '⏳ Belum Selesai'],
                        datasets: [{
                            data: [{{ $distribusiSelesai }}, {{ $distribusiBelum }}],
                            backgroundColor: [
                                'rgba(34, 197, 94, 0.8)',
                                'rgba(234, 179, 8, 0.8)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeCharts);
    </script>
</div>