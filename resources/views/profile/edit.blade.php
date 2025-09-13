<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">👤 Informasi Profil</h3>
                    
                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="name" id="name" 
                                   value="{{ old('name', $user->name) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" 
                                   value="{{ old('email', $user->email) }}" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-gray-800">
                                        Alamat email Anda belum diverifikasi.
                                        <a href="{{ route('verification.send') }}" 
                                           class="underline text-sm text-gray-600 hover:text-gray-900">
                                            Klik di sini untuk mengirim ulang email verifikasi.
                                        </a>
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" 
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
                                💾 Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">🗑️ Hapus Akun</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen.
                    </p>
                    
                    <button onclick="document.getElementById('delete-account-modal').style.display='block'"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        🗑️ Hapus Akun
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="delete-account-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Konfirmasi Hapus Akun</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Apakah Anda yakin ingin menghapus akun? Masukkan password untuk konfirmasi.
                    </p>
                    
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" required
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500">
                        </div>
                        
                        <div class="flex justify-end space-x-3">
                            <button type="button" 
                                    onclick="document.getElementById('delete-account-modal').style.display='none'"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                                Hapus Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>