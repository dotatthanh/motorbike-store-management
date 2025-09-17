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
            'name' => 'Nguyễn Thành Công',
            'birthday' => '2003-03-27',
            'phone_number' => '0902946403',
            'address' => 'Long An',
            'gender' => 'Nam',
        ]);
    }
}
