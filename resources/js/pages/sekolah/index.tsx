import AppLayout from '@/layouts/app-layout'
import { Head, Link, router } from '@inertiajs/react'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Sekolah', href: '/sekolah' },
]

interface Sekolah {
    id: number
    nama_sekolah: string
    alamat: string
    kepala_sekolah: string
    telepon?: string
    email?: string
    jumlah_siswa: number
    penerima_mbg_count: number
    distribusi_count: number
}

interface PaginationLink {
    url?: string
    label: string
    active: boolean
}

interface SekolahIndexProps {
    sekolah: {
        data: Sekolah[]
        links: PaginationLink[]
        current_page: number
        last_page: number
        per_page: number
        total: number
    }
    [key: string]: unknown
}

export default function SekolahIndex({ sekolah }: SekolahIndexProps) {
    const handleDelete = (id: number, nama: string) => {
        if (confirm(`Apakah Anda yakin ingin menghapus data sekolah "${nama}"?`)) {
            router.delete(route('sekolah.destroy', id))
        }
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Data Sekolah" />
            <div className="space-y-6 p-6">
                {/* Header */}
                <div className="flex items-center justify-between">
                    <div>
                        <h1 className="text-2xl font-bold text-gray-900">🏫 Data Sekolah</h1>
                        <p className="text-gray-600 mt-1">Kelola data sekolah penerima program MBG</p>
                    </div>
                    <Link href={route('sekolah.create')}>
                        <Button>
                            ➕ Tambah Sekolah
                        </Button>
                    </Link>
                </div>

                {/* Stats */}
                <div className="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <span className="text-2xl">🏫</span>
                                <div>
                                    <p className="text-2xl font-bold text-blue-600">{sekolah.total}</p>
                                    <p className="text-sm text-gray-600">Total Sekolah</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <span className="text-2xl">👨‍🎓</span>
                                <div>
                                    <p className="text-2xl font-bold text-green-600">
                                        {sekolah.data.reduce((sum, s) => sum + s.jumlah_siswa, 0).toLocaleString()}
                                    </p>
                                    <p className="text-sm text-gray-600">Total Siswa</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                    <Card>
                        <CardContent className="p-4">
                            <div className="flex items-center space-x-2">
                                <span className="text-2xl">🍎</span>
                                <div>
                                    <p className="text-2xl font-bold text-orange-600">
                                        {sekolah.data.reduce((sum, s) => sum + s.penerima_mbg_count, 0)}
                                    </p>
                                    <p className="text-sm text-gray-600">Penerima MBG</p>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                {/* School List */}
                <Card>
                    <CardHeader>
                        <CardTitle>Daftar Sekolah</CardTitle>
                    </CardHeader>
                    <CardContent>
                        {sekolah.data.length > 0 ? (
                            <div className="space-y-4">
                                {sekolah.data.map((school) => (
                                    <div key={school.id} className="border rounded-lg p-4 hover:bg-gray-50 transition-colors">
                                        <div className="flex items-start justify-between">
                                            <div className="flex-1">
                                                <h3 className="font-semibold text-lg text-gray-900">
                                                    {school.nama_sekolah}
                                                </h3>
                                                <p className="text-gray-600 text-sm mb-2">{school.alamat}</p>
                                                <div className="flex flex-wrap gap-2 mb-3">
                                                    <Badge variant="outline">
                                                        👨‍💼 {school.kepala_sekolah}
                                                    </Badge>
                                                    <Badge variant="secondary">
                                                        👨‍🎓 {school.jumlah_siswa} siswa
                                                    </Badge>
                                                    <Badge variant="secondary">
                                                        🍎 {school.penerima_mbg_count} penerima MBG
                                                    </Badge>
                                                    {school.distribusi_count > 0 && (
                                                        <Badge>
                                                            📦 {school.distribusi_count} distribusi
                                                        </Badge>
                                                    )}
                                                </div>
                                                {(school.telepon || school.email) && (
                                                    <div className="text-sm text-gray-600 space-y-1">
                                                        {school.telepon && (
                                                            <p>📞 {school.telepon}</p>
                                                        )}
                                                        {school.email && (
                                                            <p>✉️ {school.email}</p>
                                                        )}
                                                    </div>
                                                )}
                                            </div>
                                            <div className="flex space-x-2">
                                                <Link href={route('sekolah.show', school.id)}>
                                                    <Button variant="outline" size="sm">
                                                        👁️ Detail
                                                    </Button>
                                                </Link>
                                                <Link href={route('sekolah.edit', school.id)}>
                                                    <Button variant="outline" size="sm">
                                                        ✏️ Edit
                                                    </Button>
                                                </Link>
                                                <Button 
                                                    variant="destructive" 
                                                    size="sm"
                                                    onClick={() => handleDelete(school.id, school.nama_sekolah)}
                                                >
                                                    🗑️ Hapus
                                                </Button>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ) : (
                            <div className="text-center py-8 text-gray-500">
                                <div className="text-6xl mb-4">🏫</div>
                                <p className="text-lg">Belum ada data sekolah</p>
                                <p className="text-sm mb-4">Tambahkan sekolah pertama untuk memulai program MBG</p>
                                <Link href={route('sekolah.create')}>
                                    <Button>
                                        ➕ Tambah Sekolah Pertama
                                    </Button>
                                </Link>
                            </div>
                        )}

                        {/* Pagination */}
                        {sekolah.links.length > 3 && (
                            <div className="flex items-center justify-center space-x-2 mt-6">
                                {sekolah.links.map((link, index) => (
                                    <button
                                        key={index}
                                        onClick={() => link.url && router.get(link.url)}
                                        disabled={!link.url}
                                        className={`px-3 py-2 text-sm rounded-md transition-colors ${
                                            link.active
                                                ? 'bg-blue-600 text-white'
                                                : link.url
                                                ? 'border border-gray-300 hover:bg-gray-50'
                                                : 'text-gray-400 cursor-not-allowed'
                                        }`}
                                        dangerouslySetInnerHTML={{ __html: link.label }}
                                    />
                                ))}
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    )
}