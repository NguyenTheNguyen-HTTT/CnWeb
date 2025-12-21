<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SinhVien;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed SinhVien data
        SinhVien::create([
            'ten_sinh_vien' => 'Nguyen Van A',
            'email' => 'a@example.com',
        ]);

        SinhVien::create([
            'ten_sinh_vien' => 'Tran Thi B',
            'email' => 'b@example.com',
        ]);

        SinhVien::create([
            'ten_sinh_vien' => 'Le Van C',
            'email' => 'c@example.com',
        ]);

        // Thêm sinh viên với script để chứng minh chống XSS
        SinhVien::create([
            'ten_sinh_vien' => '<script>alert(\'Ban da bi XSS!\');</script>',
            'email' => 'xss@example.com',
        ]);
    }
}
