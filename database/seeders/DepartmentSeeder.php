<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            Department::insert([
                ['name' => 'Cobranzas', 'company_id' => $company->id],
                ['name' => 'Control de calidad', 'company_id' => $company->id],
                ['name' => 'Sistemas', 'company_id' => $company->id],
                ['name' => 'Auditoría', 'company_id' => $company->id],
                ['name' => 'Talento Humano', 'company_id' => $company->id],
            ]);
        }
    }
}
