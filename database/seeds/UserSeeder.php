<?php

use Illuminate\Database\Seeder;
use Laratrust\Traits\LaratrustUserTrait;

class UserSeeder extends Seeder
{
    use LaratrustUserTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
           'name' => 'Administrator',
           'email' => 'admin@gmail.com',
           'password' => bcrypt('123123'),
           'activated' => '1',
           'phone_number' => '0339080976',
        ]);

//       for ($i = 0; $i < 20; $i++){
//           DB::table('users')->insert([
//               'name' => $faker->name,
//               'email' => $faker->unique()->email,
//               'password' => bcrypt('123123'),
//               'activated' => '1',
//               'phone_number' => $faker->phoneNumber,
//           ]);
//       }
        for ($j = 0; $j < 3246; $j++){
            $data = [
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123123'),
                'activated' => '1',
                'phone_number' => $faker->phoneNumber,
            ];
            DB::table('users')->insert($data);
        }


    }
}
