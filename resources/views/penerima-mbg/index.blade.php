<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                👥 {{ __('Data Penerima MBG') }}
            </h2>
            <a href="{{ route('penerima-mbg.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                ➕ Tambah Penerima MBG
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">🔍 Pencarian</label>
                            <input type="text" name="search" id="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Nama siswa, NIS, kelas..."
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        </div>
                        
                        <div>
                            <label for="sekolah_id" class="block text-sm font-medium text-gray-700 mb-2">🏫 Sekolah</label>
                            <select name="sekolah_id" id="sekolah_id" 
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="">Semua Sekolah</option>
                                @foreach($sekolahList as $sekolah)
                                    <option value="{{ $sekolah->id }}" {{ request('sekolah_id') == $sekolah->id ? 'selected' : '' }}>
                                        {{ $sekolah->nama_sekolah }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">👤 Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" 
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="">Semua</option>
                                <option value="Laki-laki" {{ request('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ request('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        
                        <div class="flex items-end space-x-2">
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                                🔍 Cari
                            </button>
                            <a href="{{ route('penerima-mbg.index') }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                                🔄 Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($penerimaMbg->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Siswa
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            NIS & Kelas
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Sekolah
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis Kelamin
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Orang Tua
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($penerimaMbg as $penerima)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-3xl mr-3">
                                                        {{ $penerima->jenis_kelamin === 'Laki-laki' ? '👦' : '👧' }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $penerima->nama_siswa }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            📅 {{ $penerima->tanggal_lahir->format('d M Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $penerima->nis }}</div>
                                                <div class="text-sm text-gray-500">📚 Kelas {{ $penerima->kelas }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    🏫 {{ $penerima->sekolah->nama_sekolah }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $penerima->jenis_kelamin === 'Laki-laki' ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">
                                                    {{ $penerima->jenis_kelamin === 'Laki-laki' ? '👦 Laki-laki' : '👧 Perempuan' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">👪 {{ $penerima->nama_orang_tua }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('penerima-mbg.show', $penerima) }}" 
                                                       class="text-indigo-600 hover:text-indigo-900">
                                                        👁️ Lihat
                                                    </a>
                                                    <a href="{{ route('penerima-mbg.edit', $penerima) }}" 
                                                       class="text-yellow-600 hover:text-yellow-900">
                                                        ✏️ Edit
                                                    </a>
                                                    <form action="{{ route('penerima-mbg.destroy', $penerima) }}" 
                                                          method="POST" 
                                                          class="inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="text-red-600 hover:text-red-900">
                                                            🗑️ Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $penerimaMbg->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-6xl mb-4">👥</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data penerima MBG</h3>
                            <p class="text-gray-500 mb-6">
                                {{ request()->hasAny(['search', 'sekolah_id', 'jenis_kelamin']) ? 'Tidak ada data yang sesuai dengan kriteria pencarian.' : 'Belum ada data penerima MBG yang terdaftar.' }}
                            </p>
                            @if(!request()->hasAny(['search', 'sekolah_id', 'jenis_kelamin']))
                                <a href="{{ route('penerima-mbg.create') }}" 
                                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg">
                                    ➕ Tambah Penerima MBG Pertama
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>