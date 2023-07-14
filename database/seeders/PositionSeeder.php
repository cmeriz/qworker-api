<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            Position::insert([
                ['name' => 'Jefe de departamento', 'company_id' => $company->id],
                ['name' => 'Empleado', 'company_id' => $company->id],
            ]);
        }
    }
}
