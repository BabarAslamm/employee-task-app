<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Task;
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

        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industrys ',
            ],
            [
                'title' => 'Task 2',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys ',
            ],
            [
                'title' => 'Task 3',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys ',
            ],
            [
                'title' => 'Task 4',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.  Lorem Ipsum has been the industrys ',
            ],
            [
                'title' => 'Task 5',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.  Lorem Ipsum has been the industrys ',
            ]


        ];


            // echo '<pre>'; print_r();






        foreach($organizations as $organization_name){

            $organization= new Organization();
            $organization->name = $organization_name;
            $organization->save();

            foreach($tasks as $task)
            {
                // echo '<pre>'; print_r($task['title']. ' '. $organization->name);
                // echo '<pre>'; print_r($task['description']); exit;
                // echo '<pre>'; print_r($task->title); exit;
                $organization_task =  new Task();
                $organization_task->organization_id = $organization->id;
                $organization_task->title = $task['title']. ' '. $organization->name;
                $organization_task->description = $task['description'];
                $organization_task->save();
            }



        }


    }
}
