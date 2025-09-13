<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ✏️ {{ __('Edit Penerima MBG') }} - {{ $penerimaMbg->nama_siswa }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('penerima-mbg.show', $penerimaMbg) }}" 
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                    👁️ Lihat Detail
                </a>
                <a href="{{ route('penerima-mbg.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                    ← Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('penerima-mbg.update', $penerimaMbg) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Sekolah -->
                        <div>
                            <label for="sekolah_id" class="block text-sm font-medium text-gray-700 mb-2">
                                🏫 Sekolah <span class="text-red-500">*</span>
                            </label>
                            <select name="sekolah_id" id="sekolah_id" required
                                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                                <option value="">Pilih Sekolah</option>
                                @foreach($sekolahList as $sekolah)
                                    <option value="{{ $sekolah->id }}" 
                                            {{ (old('sekolah_id', $penerimaMbg->sekolah_id) == $sekolah->id) ? 'selected' : '' }}>
                                        {{ $sekolah->nama_sekolah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sekolah_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Siswa -->
                        <div>
                            <label for="nama_siswa" class="block text-sm font-medium text-gray-700 mb-2">
                                👤 Nama Siswa <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_siswa" id="nama_siswa" 
                                   value="{{ old('nama_siswa', $penerimaMbg->nama_siswa) }}" required
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                   placeholder="Masukkan nama lengkap siswa">
                            @error('nama_siswa')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIS -->
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">
                                🆔 NIS (Nomor Induk Siswa) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nis" id="nis" 
                                   value="{{ old('nis', $penerimaMbg->nis) }}" required
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                   placeholder="Masukkan NIS siswa">
                            @error('nis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">
                                📚 Kelas <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="kelas" id="kelas" 
                                   value="{{ old('kelas', $penerimaMbg->kelas) }}" required
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                   placeholder="Contoh: 1A, 2B, 3C">
                            @error('kelas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">
                                📅 Tanggal Lahir <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir', $penerimaMbg->tanggal_lahir->format('Y-m-d')) }}" required
                                   max="{{ date('Y-m-d') }}"
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                            @error('tanggal_lahir')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                👤 Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="flex space-x-6">
                                <label class="flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" 
                                           {{ old('jenis_kelamin', $penerimaMbg->jenis_kelamin) === 'Laki-laki' ? 'checked' : '' }} required
                                           class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2">👦 Laki-laki</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" 
                                           {{ old('jenis_kelamin', $penerimaMbg->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }} required
                                           class="border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2">👧 Perempuan</span>
                                </label>
                            </div>
                            @error('jenis_kelamin')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                                📍 Alamat <span class="text-red-500">*</span>
                            </label>
                            <textarea name="alamat" id="alamat" rows="3" required
                                      class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                      placeholder="Masukkan alamat lengkap siswa">{{ old('alamat', $penerimaMbg->alamat) }}</textarea>
                            @error('alamat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Orang Tua -->
                        <div>
                            <label for="nama_orang_tua" class="block text-sm font-medium text-gray-700 mb-2">
                                👪 Nama Orang Tua/Wali <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_orang_tua" id="nama_orang_tua" 
                                   value="{{ old('nama_orang_tua', $penerimaMbg->nama_orang_tua) }}" required
                                   class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                   placeholder="Masukkan nama orang tua atau wali">
                            @error('nama_orang_tua')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-3 pt-6 border-t">
                            <a href="{{ route('penerima-mbg.show', $penerimaMbg) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg">
                                ❌ Batal
                            </a>
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg">
                                💾 Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Data Preview -->
            <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">📋 Data Saat Ini</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Nama:</span>
                            <span class="ml-2">{{ $penerimaMbg->nama_siswa }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">NIS:</span>
                            <span class="ml-2">{{ $penerimaMbg->nis }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Kelas:</span>
                            <span class="ml-2">{{ $penerimaMbg->kelas }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Jenis Kelamin:</span>
                            <span class="ml-2">{{ $penerimaMbg->jenis_kelamin }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="font-medium text-gray-600">Sekolah:</span>
                            <span class="ml-2">{{ $penerimaMbg->sekolah->nama_sekolah }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>