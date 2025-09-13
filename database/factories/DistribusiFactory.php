<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Distribusi>
 */
class DistribusiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['sudah', 'belum']);
        $tanggalDistribusi = fake()->dateTimeBetween('-30 days', '+7 days');
        
        return [
            'sekolah_id' => Sekolah::factory(),
            'kendaraan_id' => Kendaraan::factory(),
            'tanggal_distribusi' => $tanggalDistribusi,
            'jumlah_porsi' => fake()->numberBetween(50, 500),
            'status' => $status,
            'waktu_berangkat' => $status === 'sudah' ? fake()->time() : null,
            'waktu_tiba' => $status === 'sudah' ? fake()->time() : null,
            'catatan' => fake()->sentence(),
            'foto_distribusi' => $status === 'sudah' ? 'distribusi_' . fake()->uuid() . '.jpg' : null,
        ];
    }

    /**
     * Indicate that the distribusi is completed.
     */
    public function sudah(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'sudah',
            'waktu_berangkat' => fake()->time('08:00:00', '09:00:00'),
            'waktu_tiba' => fake()->time('09:30:00', '11:00:00'),
            'foto_distribusi' => 'distribusi_' . fake()->uuid() . '.jpg',
        ]);
    }

    /**
     * Indicate that the distribusi is pending.
     */
    public function belum(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'belum',
            'waktu_berangkat' => null,
            'waktu_tiba' => null,
            'foto_distribusi' => null,
        ]);
    }

    /**
     * Indicate that the distribusi is for today.
     */
    public function today(): static
    {
        return $this->state(fn (array $attributes) => [
            'tanggal_distribusi' => today(),
        ]);
    }
}