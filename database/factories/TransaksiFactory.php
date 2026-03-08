<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode_transaksi' => 'TRX-' . $this->faker->unique()->numerify('######'),
            'subtotal' => 0,
            'metode_pembayaran' => 'cash',
            'uang_customer' => 0,
            'kembalian' => 0
        ];
    }
}
