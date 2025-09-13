<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                🏫 {{ __('Data Sekolah') }}
            </h2>
            <a href="{{ route('sekolah.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                ➕ Tambah Sekolah
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($sekolah->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($sekolah as $item)
                                <div class="bg-gray-50 rounded-lg p-6 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="text-4xl">🏫</div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('sekolah.show', $item) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                👁️ Lihat
                                            </a>
                                            <a href="{{ route('sekolah.edit', $item) }}" 
                                               class="text-yellow-600 hover:text-yellow-900 text-sm">
                                                ✏️ Edit
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        {{ $item->nama_sekolah }}
                                    </h3>
                                    
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <span class="w-20">👨‍💼 Kepsek:</span>
                                            <span>{{ $item->kepala_sekolah }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-20">👥 Siswa:</span>
                                            <span>{{ number_format($item->jumlah_siswa) }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-20">📦 MBG:</span>
                                            <span>{{ $item->penerima_mbg_count ?? 0 }} penerima</span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t text-xs text-gray-500">
                                        📍 {{ Str::limit($item->alamat, 50) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            {{ $sekolah->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">🏫</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada data sekolah</h3>
                            <p class="text-gray-500 mb-6">Mulai dengan menambahkan data sekolah pertama.</p>
                            <a href="{{ route('sekolah.create') }}" 
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">
                                ➕ Tambah Sekolah Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>