<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👁️ {{ __('Detail Penerima MBG') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('penerima-mbg.edit', $penerimaMbg) }}" 
                   class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                    ✏️ Edit
                </a>
                <a href="{{ route('penerima-mbg.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Student Photo/Avatar -->
                        <div class="flex flex-col items-center">
                            <div class="w-48 h-48 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <span class="text-8xl">
                                    {{ $penerimaMbg->jenis_kelamin === 'Laki-laki' ? '👦' : '👧' }}
                                </span>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 text-center">{{ $penerimaMbg->nama_siswa }}</h1>
                            <p class="text-gray-600">{{ $penerimaMbg->nis }}</p>
                        </div>

                        <!-- Student Details -->
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">📋 Informasi Siswa</h3>
                                
                                <dl class="space-y-4">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">🏫 Sekolah</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->sekolah->nama_sekolah }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">📚 Kelas</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->kelas }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">📅 Tanggal Lahir</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            {{ $penerimaMbg->tanggal_lahir->format('d F Y') }}
                                            <span class="text-gray-500">({{ $penerimaMbg->tanggal_lahir->diffForHumans() }})</span>
                                        </dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">👤 Jenis Kelamin</dt>
                                        <dd class="mt-1">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $penerimaMbg->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                {{ $penerimaMbg->jenis_kelamin === 'Laki-laki' ? '👦 Laki-laki' : '👧 Perempuan' }}
                                            </span>
                                        </dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">👪 Nama Orang Tua/Wali</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->nama_orang_tua }}</dd>
                                    </div>
                                    
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">📍 Alamat</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->alamat }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <!-- School Information -->
                    <div class="mt-8 pt-8 border-t">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">🏫 Informasi Sekolah</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nama Sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->sekolah->nama_sekolah }}</dd>
                                </div>
                                
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Kepala Sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->sekolah->kepala_sekolah }}</dd>
                                </div>
                                
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">📍 Alamat Sekolah</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $penerimaMbg->sekolah->alamat }}</dd>
                                </div>
                                
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">📞 Kontak</dt>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        @if($penerimaMbg->sekolah->telepon)
                                            <div>📞 {{ $penerimaMbg->sekolah->telepon }}</div>
                                        @endif
                                        @if($penerimaMbg->sekolah->email)
                                            <div>📧 {{ $penerimaMbg->sekolah->email }}</div>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Metadata -->
                    <div class="mt-8 pt-8 border-t">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">📊 Metadata</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                            <div>
                                <dt class="font-medium text-gray-500">Dibuat pada</dt>
                                <dd class="mt-1 text-gray-900">
                                    📅 {{ $penerimaMbg->created_at->format('d F Y H:i') }}
                                    <span class="text-gray-500">({{ $penerimaMbg->created_at->diffForHumans() }})</span>
                                </dd>
                            </div>
                            
                            <div>
                                <dt class="font-medium text-gray-500">Terakhir diupdate</dt>
                                <dd class="mt-1 text-gray-900">
                                    🔄 {{ $penerimaMbg->updated_at->format('d F Y H:i') }}
                                    <span class="text-gray-500">({{ $penerimaMbg->updated_at->diffForHumans() }})</span>
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 pt-8 border-t flex justify-end space-x-3">
                        <form action="{{ route('penerima-mbg.destroy', $penerimaMbg) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus data {{ $penerimaMbg->nama_siswa }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                🗑️ Hapus Data
                            </button>
                        </form>
                        
                        <a href="{{ route('penerima-mbg.edit', $penerimaMbg) }}" 
                           class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg">
                            ✏️ Edit Data
                        </a>
                        
                        <a href="{{ route('penerima-mbg.index') }}" 
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                            📋 Lihat Semua Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>