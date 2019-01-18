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
                'cate_name' => 'TV Show',
                'cate_slug' => 'show',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Fashion',
                'cate_slug' => 'fashion',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Sport',
                'cate_slug' => 'sport',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Ciné',
                'cate_slug' => 'cine',
                'cate_parent' => '0',
            ],
            [
                'cate_name' => 'Musik',
                'cate_slug' => 'music',
                'cate_parent' => '0',
            ],
        ];
        DB::table('categories')->insert($data);

    }
}
