<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lead\TaskController;
use App\Http\Controllers\TeamMember\MyTaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/app', function () {
    return view('admin.layout.app');
});


### Lead Tasks  ####

### Waiting Tasks
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('tasks-data', [TaskController::class, 'data'])->name('tasks.data');

### Assign Tasks
Route::get('/assign-task/{id}', [TaskController::class, 'assign_task'])->name('assign.task');
Route::post('/task-assigned-to-member', [TaskController::class, 'task_assigned_to_member'])->name('task.assigned');


### Pending Tasks
Route::get('/pending-tasks', [TaskController::class, 'pending_tasks'])->name('pending.tasks');
Route::post('pending-tasks-data', [TaskController::class, 'pending_tasks_data'])->name('pending.tasks.data');


### Completed Tasks
Route::get('/completed-tasks', [TaskController::class, 'completed_tasks'])->name('completed.tasks');
Route::post('completed-tasks-data', [TaskController::class, 'completed_tasks_data'])->name('completed.tasks.data');

########################################################################

### Team Member Tasks  ####

### My tasks
Route::get('/my-tasks', [MyTaskController::class, 'index'])->name('my.tasks.index');
Route::get('/my-tasks-completed/{id}', [MyTaskController::class, 'completed'])->name('my.tasks.completed');
Route::post('my-tasks-data', [MyTaskController::class, 'data'])->name('my.tasks.data');
