<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            foreach ($company->departments as $department) {
                // Jefe
                User::create([
                    'firstname' => fake()->firstName(),
                    'lastname' => fake()->lastName(),
                    'email' => fake()->unique()->safeEmail(),
                    'email_verified_at' => now(),
                    'password' => bcrypt('123456'),
                    'remember_token' => Str::random(10),
                    'company_id' => $company->id,
                    'department_id' => $department->id,
                    'position_id' => Position::query()
                        ->where('name', 'Jefe de departamento')
                        ->where('company_id', $company->id)
                        ->first()
                        ->id
                ]);

                // Empleados
                for ($i = 0; $i < 4; $i++) {
                    User::create([
                        'firstname' => fake()->firstName(),
                        'lastname' => fake()->lastName(),
                        'email' => fake()->unique()->safeEmail(),
                        'email_verified_at' => now(),
                        'password' => bcrypt('123456'),
                        'remember_token' => Str::random(10),
                        'company_id' => $company->id,
                        'department_id' => $department->id,
                        'position_id' => Position::query()
                            ->where('name', 'Empleado')
                            ->where('company_id', $company->id)
                            ->first()
                            ->id
                    ]);
                }
            }
        }
    }
}
