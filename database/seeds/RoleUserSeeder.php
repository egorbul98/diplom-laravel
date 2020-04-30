<?php

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [];

        $roles[] = [
            "user_id" => 3,
            "role_id" => 2,
        ];
        $roles[] = [
            "user_id" => 1,
            "role_id" => 1,
        ];
        $roles[] = [
            "user_id" => 2,
            "role_id" => 3,
        ];

        for ($i=4; $i < 20; $i++) { 
            $role_id = rand(1,3);
            $user_id =  $i;

            $roles[] = [
                "user_id" => $user_id,
                "role_id" => $role_id,
            ];
        }
        DB::table('role_user')->insert($roles);
    }
}
