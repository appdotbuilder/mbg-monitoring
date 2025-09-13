<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kendaraan' => 'Truck MBG ' . fake()->numberBetween(1, 10),
            'plat_nomor' => 'B ' . fake()->randomNumber(4) . ' ' . fake()->randomLetter() . fake()->randomLetter() . fake()->randomLetter(),
            'driver_name' => fake()->name(),
            'driver_phone' => '08' . fake()->randomNumber(9, true),
            'status' => fake()->randomElement(['aktif', 'tidak_aktif']),
            'keterangan' => fake()->sentence(),
        ];
    }

    /**
     * Indicate that the kendaraan is aktif.
     */
    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }

    /**
     * Indicate that the kendaraan is tidak aktif.
     */
    public function tidakAktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'tidak_aktif',
        ]);
    }
}