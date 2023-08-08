<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'title' => 'Task 1',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                           Lorem Ipsum has been the industrys ',
                'created_at' => now()->timezone('Asia/Karachi'),
                'updated_at' => now()->timezone('Asia/Karachi'),
            ],
            [
                'title' => 'Task 2',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                  Lorem Ipsum has been the industrys ',
                'created_at' => now()->timezone('Asia/Karachi'),
                'updated_at' => now()->timezone('Asia/Karachi'),
            ]


        ];

        DB::table('tasks')->insert($tasks);
    }
}
