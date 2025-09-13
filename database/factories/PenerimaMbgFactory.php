<?php

namespace Database\Factories;

use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenerimaMbg>
 */
class PenerimaMbgFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $kelas = fake()->randomElement(['1A', '1B', '2A', '2B', '3A', '3B', '4A', '4B', '5A', '5B', '6A', '6B']);
        
        return [
            'sekolah_id' => Sekolah::factory(),
            'nama_siswa' => fake()->name(),
            'nis' => fake()->unique()->numberBetween(10000000, 99999999),
            'kelas' => $kelas,
            'tanggal_lahir' => fake()->dateTimeBetween('2010-01-01', '2018-12-31'),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'alamat' => fake()->address(),
            'nama_orang_tua' => fake()->name(),
        ];
    }

    /**
     * Indicate that the penerima is laki-laki.
     */
    public function lakiLaki(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis_kelamin' => 'L',
        ]);
    }

    /**
     * Indicate that the penerima is perempuan.
     */
    public function perempuan(): static
    {
        return $this->state(fn (array $attributes) => [
            'jenis_kelamin' => 'P',
        ]);
    }
}