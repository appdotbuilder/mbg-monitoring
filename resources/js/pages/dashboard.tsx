import AppLayout from '@/layouts/app-layout'
import { Head } from '@inertiajs/react'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { router } from '@inertiajs/react'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard MBG',
        href: '/dashboard',
    },
]

interface Stats {
    total_sekolah: number
    total_siswa: number
    total_kendaraan: number
    distribusi_hari_ini: number
    distribusi_selesai_hari_ini: number
    distribusi_belum_selesai_hari_ini: number
}

interface WeeklyData {
    date: string
    label: string
    sudah: number
    belum: number
    total: number
}

interface Kendaraan {
    id: number
    nama_kendaraan: string
    plat_nomor: string
}

interface Distribusi {
    id: number
    tanggal_distribusi: string
    jumlah_porsi: number
    status: 'sudah' | 'belum'
    waktu_berangkat?: string
    waktu_tiba?: string
    sekolah: {
        nama_sekolah: string
    }
    kendaraan: {
        nama_kendaraan: string
        plat_nomor: string
    }
}

interface DashboardProps {
    stats: Stats
    weeklyData: WeeklyData[]
    recentDistribusi: Distribusi[]
    distribusiHariIni: Distribusi[]
    kendaraanOptions: Kendaraan[]
    selectedKendaraan?: number
    [key: string]: unknown
}

export default function Dashboard({ 
    stats, 
    weeklyData, 
    recentDistribusi, 
    distribusiHariIni,
    kendaraanOptions = [],
    selectedKendaraan 
}: DashboardProps) {
    const handleFilterChange = (kendaraanId?: number) => {
        const params = kendaraanId ? { kendaraan_id: kendaraanId } : {}
        router.get(route('dashboard'), params, {
            preserveState: true,
            preserveScroll: true
        })
    }

    const completionRate = stats?.distribusi_hari_ini > 0 
        ? Math.round((stats.distribusi_selesai_hari_ini / stats.distribusi_hari_ini) * 100)
        : 0

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard MBG" />
            <div className="space-y-8 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight text-gray-900">🍎 Dashboard MBG</h1>
                        <p className="text-gray-600 mt-1">Monitoring Distribusi Makan Bergizi Gratis</p>
                    </div>
                    <div className="flex items-center space-x-3">
                        <select 
                            value={selectedKendaraan || ''} 
                            onChange={(e) => handleFilterChange(e.target.value ? Number(e.target.value) : undefined)}
                            className="rounded-md border border-gray-300 px-3 py-2 text-sm"
                        >
                            <option value="">Semua Kendaraan</option>
                            {kendaraanOptions.map((kendaraan) => (
                                <option key={kendaraan.id} value={kendaraan.id}>
                                    {kendaraan.nama_kendaraan} - {kendaraan.plat_nomor}
                                </option>
                            ))}
                        </select>
                        <Button onClick={() => window.location.reload()} variant="outline" size="sm">
                            🔄 Refresh
                        </Button>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <Card className="border-l-4 border-l-blue-500">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Sekolah</CardTitle>
                            <span className="text-2xl">🏫</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-blue-600">{stats?.total_sekolah || 0}</div>
                            <p className="text-xs text-gray-600">Sekolah terdaftar</p>
                        </CardContent>
                    </Card>

                    <Card className="border-l-4 border-l-green-500">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Siswa</CardTitle>
                            <span className="text-2xl">👨‍🎓</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-green-600">{(stats?.total_siswa || 0).toLocaleString()}</div>
                            <p className="text-xs text-gray-600">Penerima MBG</p>
                        </CardContent>
                    </Card>

                    <Card className="border-l-4 border-l-orange-500">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Kendaraan Aktif</CardTitle>
                            <span className="text-2xl">🚛</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-orange-600">{stats?.total_kendaraan || 0}</div>
                            <p className="text-xs text-gray-600">Siap distribusi</p>
                        </CardContent>
                    </Card>

                    <Card className="border-l-4 border-l-purple-500">
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Completion Rate</CardTitle>
                            <span className="text-2xl">📊</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold text-purple-600">{completionRate}%</div>
                            <p className="text-xs text-gray-600">Hari ini</p>
                        </CardContent>
                    </Card>
                </div>

                {/* Today's Distribution Status */}
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            📅 Status Distribusi Hari Ini
                            <Badge variant="secondary" className="ml-2">
                                {new Date().toLocaleDateString('id-ID', { 
                                    weekday: 'long', 
                                    year: 'numeric', 
                                    month: 'long', 
                                    day: 'numeric' 
                                })}
                            </Badge>
                        </CardTitle>
                        <CardDescription>
                            {stats?.distribusi_selesai_hari_ini || 0} dari {stats?.distribusi_hari_ini || 0} distribusi telah selesai
                        </CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="grid grid-cols-1 gap-4 lg:grid-cols-3">
                            <div className="col-span-1 lg:col-span-2">
                                <div className="space-y-3">
                                    {distribusiHariIni && distribusiHariIni.length > 0 ? (
                                        distribusiHariIni.slice(0, 5).map((distribusi) => (
                                            <div key={distribusi.id} className="flex items-center justify-between p-3 border rounded-lg">
                                                <div className="flex-1">
                                                    <p className="font-medium text-sm">{distribusi.sekolah?.nama_sekolah}</p>
                                                    <p className="text-xs text-gray-600">
                                                        {distribusi.kendaraan?.nama_kendaraan} - {distribusi.jumlah_porsi} porsi
                                                    </p>
                                                </div>
                                                <div className="text-right">
                                                    <Badge variant={distribusi.status === 'sudah' ? 'default' : 'secondary'}>
                                                        {distribusi.status === 'sudah' ? '✅ Selesai' : '⏳ Pending'}
                                                    </Badge>
                                                    {distribusi.waktu_tiba && (
                                                        <p className="text-xs text-gray-600 mt-1">
                                                            Tiba: {distribusi.waktu_tiba}
                                                        </p>
                                                    )}
                                                </div>
                                            </div>
                                        ))
                                    ) : (
                                        <p className="text-gray-500 text-center py-8">
                                            Tidak ada distribusi hari ini
                                        </p>
                                    )}
                                </div>
                            </div>
                            <div className="space-y-4">
                                <div className="text-center p-4 bg-green-50 rounded-lg">
                                    <div className="text-2xl font-bold text-green-600">
                                        {stats?.distribusi_selesai_hari_ini || 0}
                                    </div>
                                    <p className="text-sm text-green-700">Selesai</p>
                                </div>
                                <div className="text-center p-4 bg-orange-50 rounded-lg">
                                    <div className="text-2xl font-bold text-orange-600">
                                        {stats?.distribusi_belum_selesai_hari_ini || 0}
                                    </div>
                                    <p className="text-sm text-orange-700">Pending</p>
                                </div>
                            </div>
                        </div>
                    </CardContent>
                </Card>

                {/* Weekly Overview & Quick Actions */}
                <div className="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <Card>
                        <CardHeader>
                            <CardTitle>📈 Distribusi 7 Hari Terakhir</CardTitle>
                            <CardDescription>Progress distribusi mingguan</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="space-y-3">
                                {weeklyData && weeklyData.length > 0 ? (
                                    weeklyData.map((day) => (
                                        <div key={day.date} className="flex items-center justify-between">
                                            <span className="text-sm font-medium">{day.label}</span>
                                            <div className="flex items-center space-x-2">
                                                <div className="flex space-x-1">
                                                    <div className="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                                                        ✅ {day.sudah}
                                                    </div>
                                                    <div className="text-xs bg-orange-100 text-orange-800 px-2 py-1 rounded">
                                                        ⏳ {day.belum}
                                                    </div>
                                                </div>
                                                <span className="text-sm font-bold text-gray-900">
                                                    {day.total}
                                                </span>
                                            </div>
                                        </div>
                                    ))
                                ) : (
                                    <p className="text-gray-500 text-center py-4">Tidak ada data mingguan</p>
                                )}
                            </div>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader>
                            <CardTitle>⚡ Menu Utama</CardTitle>
                            <CardDescription>Akses cepat ke fitur-fitur penting</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div className="grid grid-cols-2 gap-4">
                                {[
                                    { name: 'Data Sekolah', icon: '🏫', href: 'sekolah.index' },
                                    { name: 'Data Kendaraan', icon: '🚛', href: 'kendaraan.index' },
                                    { name: 'Distribusi', icon: '📦', href: 'distribusi.index' },
                                    { name: 'Laporan', icon: '📊', href: 'dashboard' },
                                ].map((action) => (
                                    <Button
                                        key={action.name}
                                        variant="outline"
                                        className="h-auto flex flex-col items-center p-4 text-center hover:bg-gray-50"
                                        onClick={() => router.get(route(action.href))}
                                    >
                                        <div className="text-2xl mb-2">{action.icon}</div>
                                        <span className="text-sm font-medium">{action.name}</span>
                                    </Button>
                                ))}
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* Recent Activities */}
                <Card>
                    <CardHeader>
                        <CardTitle>🕒 Aktivitas Terbaru</CardTitle>
                        <CardDescription>Log distribusi dan update sistem terbaru</CardDescription>
                    </CardHeader>
                    <CardContent>
                        <div className="space-y-4">
                            {recentDistribusi && recentDistribusi.length > 0 ? (
                                recentDistribusi.slice(0, 5).map((distribusi) => (
                                    <div key={distribusi.id} className="flex items-center space-x-4 p-3 border rounded-lg">
                                        <div className="text-2xl">
                                            {distribusi.status === 'sudah' ? '✅' : '📋'}
                                        </div>
                                        <div className="flex-1 space-y-1">
                                            <p className="text-sm font-medium">
                                                Distribusi ke {distribusi.sekolah?.nama_sekolah}
                                            </p>
                                            <p className="text-xs text-gray-600">
                                                {distribusi.kendaraan?.nama_kendaraan} • {distribusi.jumlah_porsi} porsi
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <Badge variant={distribusi.status === 'sudah' ? 'default' : 'secondary'}>
                                                {distribusi.status === 'sudah' ? 'Selesai' : 'Pending'}
                                            </Badge>
                                            <p className="text-xs text-gray-500 mt-1">
                                                {new Date(distribusi.tanggal_distribusi).toLocaleDateString('id-ID')}
                                            </p>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 text-center py-8">
                                    Belum ada aktivitas distribusi
                                </p>
                            )}
                        </div>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    )
}