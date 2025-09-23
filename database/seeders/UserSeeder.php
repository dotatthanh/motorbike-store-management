<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Thêm admin
        User::create([
            'id' => 1,
            'code' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'name' => 'Đào Ngọc Bảo Trân',
            'birthday' => '2004-01-27',
            'phone_number' => '0949077041',
            'address' => '139a Điện Biên Phủ',
            'gender' => 'Nữ',
        ]);
    }
}
