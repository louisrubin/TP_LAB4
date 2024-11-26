<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Commission;
use App\Models\Professor;

class CommissionProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commissions = Commission::all();
        $professors = Professor::pluck('id');

        foreach ($commissions as $commission) {
            $commission->professors()->attach($professors->random(rand(1, 3))); // Asocia de 1 a 3 profesores por comisión
        }
    }
}
