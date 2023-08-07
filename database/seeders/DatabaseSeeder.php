<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Whoops\Run;
use Database\Seeders\OrganizationsTableSeeder;
use Database\Seeders\RolesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrganizationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
