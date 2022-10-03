<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			'name'=> 'Sam Arteaga',
			'email'=>'samarteaga@gmail.com',
			'password'=> bcrypt(123456),
			'number_id'=> '1114238176'
		]);
    }
}
