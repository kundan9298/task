<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Teacher::create([
        'name'    => 'kundan',
        'email'    => 'kundan@gmail.com',
        'password'   =>  Hash::make('Kundan123'),
       ]);
    }
}
