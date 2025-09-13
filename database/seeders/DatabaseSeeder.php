<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kendaraan;
use App\Models\Sekolah;
use App\Models\PenerimaMbg;
use App\Models\Distribusi;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'MBG Admin',
            'email' => 'admin@mbg.test',
        ]);

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create vehicles
        $kendaraan1 = Kendaraan::factory()->create([
            'nama_kendaraan' => 'Truck MBG 01',
            'plat_nomor' => 'B 1234 MBG',
            'driver_name' => 'Budi Santoso',
            'driver_phone' => '081234567890',
            'status' => 'aktif',
        ]);

        $kendaraan2 = Kendaraan::factory()->create([
            'nama_kendaraan' => 'Truck MBG 02',
            'plat_nomor' => 'B 5678 MBG',
            'driver_name' => 'Andi Wijaya',
            'driver_phone' => '081234567891',
            'status' => 'aktif',
        ]);

        // Create schools
        $sekolah1 = Sekolah::factory()->create([
            'nama_sekolah' => 'SD Negeri 01 Jakarta Pusat',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta Pusat',
            'kepala_sekolah' => 'Dra. Siti Nurhaliza',
            'telepon' => '021-12345678',
            'email' => 'sdn01@jakarta.sch.id',
            'jumlah_siswa' => 450,
        ]);

        $sekolah2 = Sekolah::factory()->create([
            'nama_sekolah' => 'SD Negeri 05 Jakarta Utara',
            'alamat' => 'Jl. Pantai Indah No. 456, Jakarta Utara',
            'kepala_sekolah' => 'Drs. Bambang Sutrisno',
            'telepon' => '021-87654321',
            'email' => 'sdn05@jakarta.sch.id',
            'jumlah_siswa' => 380,
        ]);

        $sekolah3 = Sekolah::factory()->create([
            'nama_sekolah' => 'SD Swasta Harapan Bangsa',
            'alamat' => 'Jl. Pendidikan Raya No. 789, Jakarta Selatan',
            'kepala_sekolah' => 'Dr. Indah Permatasari',
            'telepon' => '021-11223344',
            'email' => 'harapanbangsa@school.id',
            'jumlah_siswa' => 320,
        ]);

        $sekolah4 = Sekolah::factory()->create([
            'nama_sekolah' => 'MI Al-Hidayah',
            'alamat' => 'Jl. Masjid Raya No. 321, Jakarta Timur',
            'kepala_sekolah' => 'Ustadz Ahmad Fauzi',
            'telepon' => '021-99887766',
            'email' => 'alhidayah@mi.sch.id',
            'jumlah_siswa' => 280,
        ]);

        $sekolah5 = Sekolah::factory()->create([
            'nama_sekolah' => 'SD Negeri 12 Jakarta Barat',
            'alamat' => 'Jl. Kemanggisan No. 654, Jakarta Barat',
            'kepala_sekolah' => 'Dra. Ratna Sari',
            'telepon' => '021-55443322',
            'email' => 'sdn12@jakarta.sch.id',
            'jumlah_siswa' => 520,
        ]);

        $sekolahList = [$sekolah1, $sekolah2, $sekolah3, $sekolah4, $sekolah5];
        $kendaraanList = [$kendaraan1, $kendaraan2];

        // Create students for each school
        foreach ($sekolahList as $sekolah) {
            PenerimaMbg::factory()->count(random_int(20, 50))->create([
                'sekolah_id' => $sekolah->id,
            ]);
        }

        // Create distribution records
        foreach ($sekolahList as $sekolah) {
            // Past distributions (completed)
            for ($i = 0; $i < 5; $i++) {
                Distribusi::factory()->create([
                    'sekolah_id' => $sekolah->id,
                    'kendaraan_id' => fake()->randomElement($kendaraanList)->id,
                    'tanggal_distribusi' => now()->subDays(random_int(1, 30)),
                    'jumlah_porsi' => random_int(100, $sekolah->jumlah_siswa),
                    'status' => 'sudah',
                ]);
            }

            // Today's distributions (some completed, some pending)
            Distribusi::factory()->create([
                'sekolah_id' => $sekolah->id,
                'kendaraan_id' => fake()->randomElement($kendaraanList)->id,
                'tanggal_distribusi' => today(),
                'jumlah_porsi' => random_int(100, $sekolah->jumlah_siswa),
                'status' => fake()->randomElement(['sudah', 'belum']),
            ]);

            // Future distributions (pending)
            for ($i = 1; $i <= 7; $i++) {
                Distribusi::factory()->create([
                    'sekolah_id' => $sekolah->id,
                    'kendaraan_id' => fake()->randomElement($kendaraanList)->id,
                    'tanggal_distribusi' => today()->addDays($i),
                    'jumlah_porsi' => random_int(100, $sekolah->jumlah_siswa),
                    'status' => 'belum',
                ]);
            }
        }
    }
}
