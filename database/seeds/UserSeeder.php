<?php

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
        $faker = Faker\Factory::create();

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123'),
            'role' => 0,
            'activated' => '1',
            'phone_number' => '0339080976',
        ]);

        for ($i = 0; $i < 20; $i++){
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123123'),
                'role' => $faker->numberBetween($min = 0, $max = 2),
                'activated' => '1',
                'phone_number' => $faker->phoneNumber,
            ]);
        }
        $data = Array();
        for ($j = 0; $j < 200000; $j++){
//            DB::table('users')->insert(
                $data = [
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('123123'),
                'role' => 3,
                'activated' => '1',
                'phone_number' => $faker->phoneNumber,
            ];
//            );
        }

        DB::table('users')->insert($data);
    }
}
