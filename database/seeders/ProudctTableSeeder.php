<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProudctTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecord = [
            'id'=>'02',
            'section_id'=>'01',
            'category_id'=>'31',
            'product_name'=>'Red Casual T-Shirt',
            'product_code'=>'RT001',
            'product_color'=>'Red',
            'product_price'=>'500',
            'product_discount'=>'10',
            'product_weight'=>'200',
            'product_video'=>'',
            'main_image'=>'',
            'product_description'=>'product description will be go here',
            'wash_care'=>'',
            'fabric'=>'',
            'pattern'=>'',
            'sleeve'=>'',
            'fit'=>'',
            'meta_title'=>'',
            'meta_description'=>'',
            'meta_keywords'=>'',
            'is_featured'=>'Yes',
            'status'=>'1',

        ];
        Product::insert($productRecord);
    }
}
