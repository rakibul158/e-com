<?php

namespace Database\Seeders;

use App\Models\Sections;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederRecords = [
            [
              'id' => 1,
              'name' => 'Man',
              'status' => 1
            ],
            [
                'id' => 2,
                'name' => 'Women',
                'status' => 1
            ],
            [
                'id' => 3,
                'name' => 'Kids',
                'status' => 1
            ]
        ];

        Sections::insert($seederRecords);
    }
}
