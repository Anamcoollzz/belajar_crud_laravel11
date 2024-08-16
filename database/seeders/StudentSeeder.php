<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::truncate();
        $nim = 100;
        foreach (range(1, 100) as $i) {
            Student::create([
                'name'    => fake()->name,
                'nim'     => $nim++,
                'dob'     => fake()->dateTimeBetween('-30 years', '-20 years')->format('Y-m-d'),
                'gender'  => fake()->randomElement(['Laki-laki', 'Perempuan']),
                'avatar'  => fake()->imageUrl(),
            ]);
        }
    }
}
