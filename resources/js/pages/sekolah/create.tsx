import AppLayout from '@/layouts/app-layout'
import { Head, useForm } from '@inertiajs/react'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Data Sekolah', href: '/sekolah' },
    { title: 'Tambah Sekolah', href: '/sekolah/create' },
]

export default function CreateSekolah() {
    const { data, setData, post, processing, errors } = useForm({
        nama_sekolah: '',
        alamat: '',
        kepala_sekolah: '',
        telepon: '',
        email: '',
        jumlah_siswa: 0,
    })

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault()
        post(route('sekolah.store'))
    }

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Tambah Sekolah" />
            <div className="max-w-2xl mx-auto p-6">
                <Card>
                    <CardHeader>
                        <CardTitle className="flex items-center">
                            🏫 Tambah Sekolah Baru
                        </CardTitle>
                        <p className="text-gray-600">Tambahkan sekolah baru ke dalam program MBG</p>
                    </CardHeader>
                    <CardContent>
                        <form onSubmit={handleSubmit} className="space-y-6">
                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Sekolah <span className="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    value={data.nama_sekolah}
                                    onChange={(e) => setData('nama_sekolah', e.target.value)}
                                    placeholder="contoh: SD Negeri 01 Jakarta Pusat"
                                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                                {errors.nama_sekolah && (
                                    <p className="text-red-500 text-xs mt-1">{errors.nama_sekolah}</p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat <span className="text-red-500">*</span>
                                </label>
                                <textarea
                                    value={data.alamat}
                                    onChange={(e) => setData('alamat', e.target.value)}
                                    placeholder="Alamat lengkap sekolah"
                                    rows={3}
                                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                                {errors.alamat && (
                                    <p className="text-red-500 text-xs mt-1">{errors.alamat}</p>
                                )}
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                    Kepala Sekolah <span className="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    value={data.kepala_sekolah}
                                    onChange={(e) => setData('kepala_sekolah', e.target.value)}
                                    placeholder="Nama lengkap kepala sekolah"
                                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                                {errors.kepala_sekolah && (
                                    <p className="text-red-500 text-xs mt-1">{errors.kepala_sekolah}</p>
                                )}
                            </div>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-2">
                                        Telepon
                                    </label>
                                    <input
                                        type="text"
                                        value={data.telepon}
                                        onChange={(e) => setData('telepon', e.target.value)}
                                        placeholder="021-12345678"
                                        className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                    {errors.telepon && (
                                        <p className="text-red-500 text-xs mt-1">{errors.telepon}</p>
                                    )}
                                </div>

                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-2">
                                        Email
                                    </label>
                                    <input
                                        type="email"
                                        value={data.email}
                                        onChange={(e) => setData('email', e.target.value)}
                                        placeholder="sekolah@email.com"
                                        className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                    {errors.email && (
                                        <p className="text-red-500 text-xs mt-1">{errors.email}</p>
                                    )}
                                </div>
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-gray-700 mb-2">
                                    Jumlah Siswa <span className="text-red-500">*</span>
                                </label>
                                <input
                                    type="number"
                                    value={data.jumlah_siswa}
                                    onChange={(e) => setData('jumlah_siswa', Number(e.target.value))}
                                    placeholder="0"
                                    min="0"
                                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required
                                />
                                {errors.jumlah_siswa && (
                                    <p className="text-red-500 text-xs mt-1">{errors.jumlah_siswa}</p>
                                )}
                            </div>

                            <div className="flex items-center justify-end space-x-3 pt-4">
                                <Button
                                    type="button"
                                    variant="outline"
                                    onClick={() => window.history.back()}
                                >
                                    ↩️ Batal
                                </Button>
                                <Button type="submit" disabled={processing}>
                                    {processing ? 'Menyimpan...' : '💾 Simpan'}
                                </Button>
                            </div>
                        </form>
                    </CardContent>
                </Card>
            </div>
        </AppLayout>
    )
}