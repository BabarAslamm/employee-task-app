<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\EmployeeRoleOrganization;
use App\Models\Organization;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate(); // Clear existing records before seeding
        EmployeeRoleOrganization::truncate(); // Clear existing records before seeding



        $users = [];

        $organizations = Organization::all();

        foreach($organizations as $organization){

            $user = new User();
            $user->name = 'Leader of organization '.$organization->id;
            $user->email = 'org'.$organization->id.'@leader.com';
            $user->password = Hash::make('password');
            $user->save();

            $emp_role_org = new EmployeeRoleOrganization();
            $emp_role_org->user_id = $user->id;
            $emp_role_org->role_id = 1;
            $emp_role_org->organization_id = $organization->id;
            $emp_role_org->save();


            for($i=1; $i < 10; $i++)
            {
                $team_member = new User();
                $team_member->name = 'Member '.$i.' of org '.$organization->id;
                $team_member->email = 'org'.$organization->id.'@member'.$i.'.com';
                $team_member->password = Hash::make('password');
                $team_member->save();


                $emp_role_org = new EmployeeRoleOrganization();
                $emp_role_org->user_id = $team_member->id;
                $emp_role_org->role_id = 2;
                $emp_role_org->organization_id = $organization->id;
                $emp_role_org->save();

            }

        }






    }
}
