<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN for development -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased">
    <div class="relative bg-white">
        <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
            <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <div class="hidden sm:mt-32 sm:flex lg:mt-16">
                        <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-500 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                            Sistem Manajemen Distribusi Makanan Bergizi Gratis 🍎
                        </div>
                    </div>
                    <h1 class="mt-24 text-4xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">
                        🚛 Sistem <span class="text-indigo-600">MBG</span> Distribution
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Platform terpadu untuk mengelola distribusi Makanan Bergizi Gratis kepada siswa-siswi di seluruh sekolah. 
                        Pantau, kelola, dan laporkan semua aktivitas distribusi dengan mudah dan efisien.
                    </p>
                    
                    <div class="mt-10 flex items-center gap-x-6">
                        @auth
                            <a href="{{ route('dashboard') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                📊 Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                🔐 Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-gray-900">
                                    Daftar <span aria-hidden="true">→</span>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
            
            <div class="relative lg:col-span-5 lg:-mr-8 xl:col-span-6">
                <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full" src="data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='%23333' stroke-width='3' stroke-dasharray='6%2c 14' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e" alt="">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-100/50 to-purple-100/50 flex items-center justify-center">
                    <div class="text-center">
                        <div class="text-8xl mb-4">🚛</div>
                        <div class="text-2xl font-semibold text-gray-700">Sistem MBG</div>
                        <div class="text-lg text-gray-600">Distribution Management</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">🌟 Fitur Lengkap</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Semua yang Anda butuhkan dalam satu platform
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Kelola data siswa penerima MBG, pantau kendaraan distribusi, dan buat laporan lengkap dengan mudah.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="h-10 w-10 flex-none rounded-lg bg-indigo-600 flex items-center justify-center">
                                <span class="text-white text-lg">👥</span>
                            </div>
                            Manajemen Penerima MBG
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Kelola data siswa penerima MBG dengan mudah. Tambah, edit, dan hapus data siswa beserta informasi sekolahnya.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="h-10 w-10 flex-none rounded-lg bg-indigo-600 flex items-center justify-center">
                                <span class="text-white text-lg">🚛</span>
                            </div>
                            Monitoring Kendaraan
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Pantau status kendaraan distribusi, driver, dan jadwal pengiriman makanan ke sekolah-sekolah.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <div class="h-10 w-10 flex-none rounded-lg bg-indigo-600 flex items-center justify-center">
                                <span class="text-white text-lg">📊</span>
                            </div>
                            Dashboard & Laporan
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Visualisasi data real-time dan generate laporan PDF distribusi berdasarkan sekolah atau kendaraan.</p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">📈 Statistik Sistem</h2>
                    <p class="mt-4 text-lg leading-8 text-gray-600">Data real-time dari sistem distribusi MBG</p>
                </div>
                <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col bg-white p-8">
                        <dt class="text-sm font-semibold leading-6 text-gray-600">🏫 Total Sekolah</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">{{ App\Models\Sekolah::count() }}</dd>
                    </div>
                    <div class="flex flex-col bg-white p-8">
                        <dt class="text-sm font-semibold leading-6 text-gray-600">👥 Siswa Penerima MBG</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">{{ App\Models\PenerimaMbg::count() }}</dd>
                    </div>
                    <div class="flex flex-col bg-white p-8">
                        <dt class="text-sm font-semibold leading-6 text-gray-600">🚛 Kendaraan Aktif</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">{{ App\Models\Kendaraan::where('status', 'aktif')->count() }}</dd>
                    </div>
                    <div class="flex flex-col bg-white p-8">
                        <dt class="text-sm font-semibold leading-6 text-gray-600">📦 Total Distribusi</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">{{ App\Models\Distribusi::count() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-600">
        <div class="px-6 py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">🚀 Siap untuk memulai?</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-indigo-200">
                    Bergabunglah dengan sistem manajemen distribusi MBG terbaik untuk memastikan makanan bergizi sampai ke tangan siswa-siswi yang membutuhkan.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    @guest
                        <a href="{{ route('login') }}" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            🔐 Masuk Sekarang
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-white">
                                Daftar Akun Baru <span aria-hidden="true">→</span>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                            📊 Ke Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</body>
</html>