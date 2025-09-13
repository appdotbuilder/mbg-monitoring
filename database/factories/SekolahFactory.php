<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sekolah>
 */
class SekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $schoolTypes = ['SD Negeri', 'SD Swasta', 'MI', 'SDS'];
        $schoolType = fake()->randomElement($schoolTypes);
        $schoolNumber = fake()->numberBetween(1, 999);
        
        return [
            'nama_sekolah' => $schoolType . ' ' . $schoolNumber . ' ' . fake()->city(),
            'alamat' => fake()->address(),
            'kepala_sekolah' => fake()->name(),
            'telepon' => '021-' . fake()->randomNumber(8),
            'email' => fake()->safeEmail(),
            'jumlah_siswa' => fake()->numberBetween(100, 800),
        ];
    }

    /**
     * Indicate that the sekolah is a large school.
     */
    public function large(): static
    {
        return $this->state(fn (array $attributes) => [
            'jumlah_siswa' => fake()->numberBetween(500, 1000),
        ]);
    }

    /**
     * Indicate that the sekolah is a small school.
     */
    public function small(): static
    {
        return $this->state(fn (array $attributes) => [
            'jumlah_siswa' => fake()->numberBetween(50, 200),
        ]);
    }
}