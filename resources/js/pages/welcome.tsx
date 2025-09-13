import { type SharedData } from '@/types'
import { Head, Link, usePage } from '@inertiajs/react'

export default function Welcome() {
    const { auth } = usePage<SharedData>().props

    const features = [
        {
            title: '🍎 Manajemen Sekolah',
            description: 'Kelola data sekolah, siswa penerima MBG, dan jadwal distribusi dengan mudah',
            icon: '🏫',
        },
        {
            title: '🚛 Tracking Kendaraan',
            description: 'Pantau kendaraan distribusi, driver, dan status pengiriman secara real-time',
            icon: '🚚',
        },
        {
            title: '📊 Dashboard Real-time',
            description: 'Monitor progress distribusi dengan chart dan statistik yang update langsung',
            icon: '📈',
        },
        {
            title: '📄 Laporan PDF',
            description: 'Generate laporan distribusi detail berdasarkan sekolah dan kendaraan',
            icon: '📋',
        },
    ]

    const mockStats = [
        { label: 'Sekolah Terdaftar', value: '127', color: 'bg-blue-500' },
        { label: 'Siswa Fed Hari Ini', value: '3,450', color: 'bg-green-500' },
        { label: 'Kendaraan Aktif', value: '12', color: 'bg-orange-500' },
        { label: 'Completion Rate', value: '94%', color: 'bg-purple-500' },
    ]

    return (
        <>
            <Head title="MBG Distribution Monitoring System">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
            </Head>
            <div className="min-h-screen bg-gradient-to-b from-white to-gray-50">
                {/* Navigation */}
                <nav className="relative z-10 flex items-center justify-between p-6">
                    <div className="flex items-center space-x-3">
                        <div className="h-10 w-10 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 flex items-center justify-center">
                            <span className="text-white text-lg font-bold">🍎</span>
                        </div>
                        <div>
                            <span className="text-xl font-bold text-gray-900">MBG Monitor</span>
                            <p className="text-xs text-gray-500">Makan Bergizi Gratis</p>
                        </div>
                    </div>
                    <div className="flex items-center space-x-4">
                        {auth.user ? (
                            <Link
                                href={route('dashboard')}
                                className="inline-block rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition-colors"
                            >
                                Dashboard
                            </Link>
                        ) : (
                            <>
                                <Link
                                    href={route('login')}
                                    className="inline-block rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                                >
                                    Masuk
                                </Link>
                                <Link
                                    href={route('register')}
                                    className="inline-block rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700 transition-colors"
                                >
                                    Daftar Sekarang
                                </Link>
                            </>
                        )}
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="relative z-10 px-6 pb-20 pt-10">
                    <div className="mx-auto max-w-5xl text-center">
                        <div className="mb-4 inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                            🚀 Sistem Monitoring Terpercaya
                        </div>
                        <h1 className="text-5xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                            Monitoring Distribusi{' '}
                            <span className="bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                Makan Bergizi Gratis
                            </span>
                        </h1>
                        <p className="mx-auto mt-6 max-w-3xl text-lg leading-8 text-gray-600">
                            Sistem monitoring real-time untuk distribusi program Makan Bergizi Gratis (MBG) ke sekolah-sekolah.
                            Pantau status pengiriman, kelola data sekolah, dan generate laporan distribusi dengan mudah.
                        </p>
                        <div className="mt-10 flex items-center justify-center gap-x-6">
                            <Link
                                href={auth.user ? route('dashboard') : route('login')}
                                className="rounded-md bg-green-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-green-700 transition-colors"
                            >
                                Mulai Monitor
                                <span className="ml-2" aria-hidden="true">→</span>
                            </Link>
                            <a
                                href="#features"
                                className="rounded-md border border-gray-300 px-8 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 transition-colors"
                            >
                                Lihat Fitur
                            </a>
                        </div>
                    </div>
                </div>

                {/* Live Stats Section */}
                <div className="py-16 bg-white">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:text-center mb-12">
                            <h2 className="text-base font-semibold leading-7 text-green-600">📈 Live Statistics</h2>
                            <p className="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                                Monitoring Distribusi Hari Ini
                            </p>
                        </div>
                        <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {mockStats.map((stat, index) => (
                                <div key={index} className="bg-white rounded-lg border border-gray-200 p-6 text-center shadow-sm">
                                    <div className={`mx-auto h-12 w-12 rounded-full ${stat.color} flex items-center justify-center mb-4`}>
                                        <span className="text-white font-bold text-lg">{stat.value}</span>
                                    </div>
                                    <p className="text-2xl font-bold text-gray-900 mb-1">{stat.value}</p>
                                    <p className="text-sm text-gray-600">{stat.label}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Features Section */}
                <div id="features" className="py-24 sm:py-32 bg-gray-50">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:text-center">
                            <h2 className="text-base font-semibold leading-7 text-green-600">🎯 Fitur Utama</h2>
                            <p className="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                Semua yang Anda Butuhkan untuk Monitoring MBG
                            </p>
                            <p className="mt-6 text-lg leading-8 text-gray-600">
                                Sistem lengkap untuk mengelola dan memantau distribusi makanan bergizi gratis 
                                ke sekolah-sekolah dengan real-time dashboard dan laporan detail.
                            </p>
                        </div>
                        <div className="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                            <div className="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-2">
                                {features.map((feature) => (
                                    <div key={feature.title} className="bg-white rounded-lg border border-gray-200 p-8 shadow-sm hover:shadow-lg transition-shadow">
                                        <div className="mb-4 text-4xl">{feature.icon}</div>
                                        <h3 className="text-lg font-semibold leading-7 text-gray-900 mb-3">
                                            {feature.title}
                                        </h3>
                                        <p className="text-base leading-7 text-gray-600">
                                            {feature.description}
                                        </p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Dashboard Preview */}
                <div className="py-24 sm:py-32 bg-white">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl lg:text-center">
                            <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                📊 Dashboard Real-time
                            </h2>
                            <p className="mt-6 text-lg leading-8 text-gray-600">
                                Pantau status distribusi, kelola data sekolah dan kendaraan, serta generate laporan 
                                dalam satu platform yang mudah digunakan.
                            </p>
                        </div>
                        <div className="mt-16">
                            <div className="overflow-hidden mx-auto max-w-4xl bg-white rounded-lg border border-gray-200 shadow-xl">
                                <div className="h-96 bg-gradient-to-br from-green-500 to-emerald-600 relative">
                                    <div className="absolute inset-0 flex items-center justify-center">
                                        <div className="text-center text-white">
                                            <div className="text-6xl mb-4">📊</div>
                                            <h3 className="text-2xl font-bold mb-2">Dashboard MBG</h3>
                                            <p className="text-green-100">Real-time monitoring & analytics</p>
                                        </div>
                                    </div>
                                    {/* Floating cards */}
                                    <div className="absolute top-4 left-4">
                                        <div className="bg-white/90 backdrop-blur-sm rounded-lg p-3 shadow-lg">
                                            <p className="text-xs text-gray-600">Distribusi Hari Ini</p>
                                            <p className="text-lg font-bold text-green-600">94% Selesai</p>
                                        </div>
                                    </div>
                                    <div className="absolute top-4 right-4">
                                        <div className="bg-white/90 backdrop-blur-sm rounded-lg p-3 shadow-lg">
                                            <p className="text-xs text-gray-600">Total Sekolah</p>
                                            <p className="text-lg font-bold text-blue-600">127</p>
                                        </div>
                                    </div>
                                    <div className="absolute bottom-4 left-4">
                                        <div className="bg-white/90 backdrop-blur-sm rounded-lg p-3 shadow-lg">
                                            <p className="text-xs text-gray-600">Kendaraan Aktif</p>
                                            <p className="text-lg font-bold text-orange-600">12 Unit</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* CTA Section */}
                <div className="py-24 sm:py-32 bg-green-50">
                    <div className="mx-auto max-w-7xl px-6 lg:px-8">
                        <div className="mx-auto max-w-2xl text-center">
                            <h2 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                🚀 Siap Memulai Monitoring?
                            </h2>
                            <p className="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">
                                Bergabunglah dengan program Makan Bergizi Gratis dan pastikan setiap anak 
                                mendapatkan nutrisi terbaik untuk masa depan yang lebih cerah.
                            </p>
                            <div className="mt-10 flex items-center justify-center gap-x-6">
                                <Link
                                    href={route('register')}
                                    className="rounded-md bg-green-600 px-8 py-3 text-base font-semibold text-white shadow-sm hover:bg-green-700 transition-colors"
                                >
                                    Mulai Sekarang
                                </Link>
                                <Link
                                    href={route('login')}
                                    className="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700"
                                >
                                    Sudah punya akun? Masuk <span aria-hidden="true">→</span>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="border-t bg-white">
                    <div className="mx-auto max-w-7xl px-6 py-12 lg:px-8">
                        <div className="flex items-center justify-center">
                            <p className="text-sm leading-5 text-gray-500">
                                &copy; 2024 MBG Monitor - Sistem Monitoring Makan Bergizi Gratis. 
                                Dikembangkan dengan ❤️ untuk pendidikan Indonesia.
                            </p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    )
}