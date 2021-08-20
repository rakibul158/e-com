<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        $adminsRecords = [
            [
                'id' => 1,
                'name' => "Md Rakibul Hasan",
                'email' => 'admin@gmail.com',
                'type' => 'admin',
                'mobile' => '01917000804',
                'password' => '$2y$10$YIqRZ1mwMitYM7hiQj2G7u.c3rAU1vWO2Fm3IXFrujUwVkr6g9Im6',
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 2,
                'name' => "Md Tipu Farazi",
                'email' => 'tipu@gmail.com',
                'type' => 'subadmin',
                'mobile' => '01768005939',
                'password' => '$2y$10$YIqRZ1mwMitYM7hiQj2G7u.c3rAU1vWO2Fm3IXFrujUwVkr6g9Im6',
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => "Sajib",
                'email' => 'sajib@gmail.com',
                'type' => 'subadmin',
                'mobile' => '01756000065',
                'password' => '$2y$10$YIqRZ1mwMitYM7hiQj2G7u.c3rAU1vWO2Fm3IXFrujUwVkr6g9Im6',
                'image' => '',
                'status' => 1
            ],
            [
                'id' => 4,
                'name' => "Humayra Kabir",
                'email' => 'suma@gmail.com',
                'type' => 'admin',
                'mobile' => '01317707041',
                'password' => '$2y$10$YIqRZ1mwMitYM7hiQj2G7u.c3rAU1vWO2Fm3IXFrujUwVkr6g9Im6',
                'image' => '',
                'status' => 1
            ],
        ];

        DB::table('admins')->insert($adminsRecords);

        /*foreach ($adminsRecords as $key => $record)
        {
            Admin::create($record);
        }*/
    }
}
