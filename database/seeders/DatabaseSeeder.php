<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'User',
            'email' => 'test@mail.com',
            'password' => Hash::make('admin'),
            'role' => 'applicant',
            'birth_date' => date("Y/m/d"),
            'address' => 'Jl. Jamrud IV Blok A. 25 No. 4 Perumahan Permata Balaraja Kec. Balaraja, Kab. Tangerang, Banten',
            'phone' => '082117416500',
            'education_level' => 'bachelor',
            'majors' =>  "Teknik Informatika"
        ]);
        \App\Models\User::factory()->create([
            'firstName' => 'Applicants',
            'lastName' => 'First',
            'email' => 'applicants1@mail.com',
            'password' => Hash::make('applicant'),
            'role' => 'applicant',
            'birth_date' => date("Y/m/d"),
            'address' => 'Jl. Jamrud IV Blok A. 25 No. 4 Perumahan Permata Balaraja Kec. Balaraja, Kab. Tangerang, Banten',
            'phone' => '082117416500',
            'education_level' => 'bachelor',
            'majors' =>  "Teknik Informatika"
        ]);

        // $this->call([
        //     MessageSeeder::class
        // ]);
    }
}
