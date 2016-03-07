<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
            'name' => 'Super Admin',
            'description' => 'Super Admin',
        ]);
         DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => 'Admin',
        ]);
         DB::table('roles')->insert([
            'name' => 'Washroom User',
            'description' => 'Users that belongs to washing room',
        ]);
         DB::table('roles')->insert([
            'name' => 'Finishing User',
            'description' => 'Users that belongs to finishing',
        ]);
    }
}
