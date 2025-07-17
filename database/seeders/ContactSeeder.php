<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $companies = ['TechNova', 'Inovasi Digital', 'CreativeNest', 'GoRemote', 'DataSmart'];
        $roles = ['frontend_developer', 'backend_developer', 'project_manager', 'qa_engineer', 'ux_designer'];

        $contacts = [];

        for ($i = 1; $i <= 30; $i++) {
            $contacts[] = [
                'name' => fake()->name(),
                'phone' => '+62 8' . rand(11, 29) . '-' . rand(1000, 9999) . '-' . rand(1000, 9999),
                'company' => $companies[array_rand($companies)],
                'role' => $roles[array_rand($roles)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('contacts')->insert($contacts);
    }
}
