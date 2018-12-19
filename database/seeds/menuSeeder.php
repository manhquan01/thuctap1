<?php

use Illuminate\Database\Seeder;

class menuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'cate_name' => 'home',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'TV Show',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Fashion',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Sport',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Ciné',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Musik',
                'cate_parent' => '0',
            ],
        ];
        DB::table('categories')->insert($data);
//        DB::table('categories')->insert([
//            'cate_name' => 'star',
//            'cate_parent' => '0',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'star-1',
//            'cate_parent' => '2',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'star-2',
//            'cate_parent' => '2',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'star-2-1',
//            'cate_parent' => '4',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'contact',
//            'cate_parent' => '0',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'contact-1',
//            'cate_parent' => '6',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'contact-1-1',
//            'cate_parent' => '7',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'contact-1-1.1',
//            'cate_parent' => '8',
//        ]);
//        DB::table('categories')->insert([
//            'cate_name' => 'contact-1-1.2',
//            'cate_parent' => '8',
//        ]);

    }
}
