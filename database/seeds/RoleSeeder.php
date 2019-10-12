<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
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
                'name' => 'superadministrator',
                'display_name' => 'Superadministrator',
                'description' => 'Superadministrator'
            ],
            [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'Administrator'
            ],
            [
                'name' => 'editor',
                'display_name' => 'Editor',
                'description' => 'Editor'
            ],
            [
                'name' => 'moderator',
                'display_name' => 'Moderator',
                'description' => 'Moderator'
            ],
            [
                'name' => 'user',
                'display_name' => 'User',
                'description' => 'User'
            ],

        ];

        \Illuminate\Support\Facades\DB::table('roles')->insert($data);
        \Illuminate\Support\Facades\DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1, 'user_type' => 'App\User']);
    }
}
