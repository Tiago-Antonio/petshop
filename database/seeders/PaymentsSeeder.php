<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payment::create([
            'payment_method' => 'Cartão de Crédito',
        ]);
        Payment::create([
            'payment_method' => 'Cartão de Débito',
        ]);
        Payment::create([
            'payment_method' => 'Pix',
        ]);
        Payment::create([
            'payment_method' => 'Dinheiro',
        ]);
    }

}
