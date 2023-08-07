<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [
            'Organization 1', 'Organization 2', 'Organization 3',
            'Organization 4', 'Organization 5', 'Organization 6',
            'Organization 7', 'Organization 8', 'Organization 9',
            'Organization 10',
        ];

        foreach($organizations as $organization_name){

            $organization= new Organization();
            $organization->name = $organization_name;
            $organization->save();
        }


    }
}
