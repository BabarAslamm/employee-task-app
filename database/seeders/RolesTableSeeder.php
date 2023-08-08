<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::truncate(); // Clear existing records before seeding

        $roles = [
            [
                'name' => 'Lead',
                'slug' => 'lead',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Team Member',
                'slug' => 'team-member',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('roles')->insert($roles);


    }
}
