<?php

use Illuminate\Database\Seeder;
use App\Models\PostModel;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = PostModel::count();

        for ($i = 1; $i <= $limit; $i++) {
//            DB::table('post')->insert([
//                'title' => $faker->sentence($nbWords = 10, $variableNbWords = true),
//                'content' => $faker->realText($maxNbChars = 20000, $indexSize = 5),
//                'slug' => $faker->slug,
//                'thumbnail' => $faker->imageUrl($width = 640, $height = 480),
//                'status' => $faker->randomElement($array = array ('0','2')),
//                'author' => '1',
//                'category_id' => $faker->numberBetween($min = 1, $max = 6)
//            ]);

            DB::table('post')->where('id', $i)->update([
                'status' => $faker->randomElement($array = array ('0','2')),
                'featured' => $faker->randomElement($array = array ('0','1')),
                'category_id' => $faker->numberBetween($min = 1, $max = 5),
                'author' => $faker->numberBetween($min = 1, $max = 20),
//                'thumbnail' => $faker->imageUrl($width = 640, $height = 480),
//                'descript' => $faker->realText($maxNbChars = 255, $indexSize = 5),
            ]);
        }
    }
}
