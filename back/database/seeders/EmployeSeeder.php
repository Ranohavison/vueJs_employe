<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employes')->truncate();
        $faker = Faker::create();

        foreach (range(1, 25) as $i) {
            DB::table('employes')->insert([
                'numEmp' => 'EMP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nom' => $faker->lastName,
                'salaire' => $faker->numberBetween(500, 6000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
