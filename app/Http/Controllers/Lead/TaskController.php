<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Middleware\Acl;
use App\Models\Organization;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct()
    {

        $this->middleware(['auth']);
        $this->middleware(Acl::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tasks.index');
    }

     /** Pending Tasks*/
    public function pending_tasks()
    {
        return view('admin.tasks.pending-tasks');
    }

     /** completed Tasks*/
     public function completed_tasks()
     {
        return view('admin.tasks.completed-tasks');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data(Request $request)
    {


        $columns = array(
            0 =>'id',
            1 =>'title',
            2 =>'description',
            3 => 'status',
            4 =>'action',


        );

                $user =  Auth::user();
                $user = User::with('employeeRoleOrganization.organization')->find($user->id);
                $organization = $user->employeeRoleOrganization->organization;

                $data = Task::where('status', 'Waiting')->where('organization_id', $organization->id)->get();

                $totalData = $data->count();

                $totalFiltered = $totalData;

                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                if(empty($request->input('search.value')))
                {

                    $tasks = Task::where('organization_id', $organization->id)->where('status', 'Waiting')
                    ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                }
                else {
                    $search = $request->input('search.value');

                    $tasks =  Task::where('status', 'Waiting')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%");
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                    $totalFiltered =  Task::where('status', 'Waiting')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%");
                            })
                            ->count();

                }

                $data = array();
                if(!empty($tasks))
                {
                foreach ($tasks as $index => $task)
                {

                    $srNo = $start + $index + 1;

                $nestedData['id'] = $srNo;
                $nestedData['title'] = $task->title;
                $nestedData['description'] = substr($task->description, 0, 30) . '...';
                $nestedData['status'] = $task->status;
                $nestedData['action'] = '

                <td class="button-action">
                    <a href="'. route('assign.task', $task->id) .'" class="btn btn-sm btn-warning m-1  task-asign" data-id='.$task->id.' >Assign Task To Member</a>
                </td>';

                $data[] = $nestedData;




                }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

                echo json_encode($json_data);
    }



    /** Pending Task data */
    public function pending_tasks_data(Request $request)
    {


        $columns = array(
            0 =>'id',
            1 =>'team-member',
            2 =>'title',
            3 =>'description',
            4 =>'status',
            5 =>'time-supended'


        );

                $user =  Auth::user();
                $user = User::with('employeeRoleOrganization.organization')->find($user->id);
                $organization = $user->employeeRoleOrganization->organization;

                $data = Task::with('user')->where('status', 'Pending')->where('organization_id', $organization->id)->get();

                $totalData = $data->count();

                $totalFiltered = $totalData;

                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                if(empty($request->input('search.value')))
                {

                    $tasks = Task::with('user')->where('organization_id', $organization->id)->where('status', 'Pending')
                    ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                }
                else {
                    $search = $request->input('search.value');

                    $tasks =  Task::where('status', 'Pending')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhereHas('user', function($q2) use($search){
                                $q2->where('name', 'LIKE',"%{$search}%");
                            });
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                    $totalFiltered =  Task::where('status', 'Pending')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhereHas('user', function($q2) use($search){
                                $q2->where('name', 'LIKE',"%{$search}%");
                            });
                            })
                            ->count();

                }

                $data = array();
                if(!empty($tasks))
                {
                foreach ($tasks as $index => $task)
                {


                    $taskStartTime = $task->start_time;
                    $timezone = new DateTimeZone('Asia/Karachi');

                    // Get the current time in the specified timezone
                    $currentDateTime = new DateTime('now', $timezone);

                    // Convert the task start time to a DateTime object with the same timezone
                    $taskStartDateTime = new DateTime($taskStartTime, $timezone);

                    // Calculate the time difference
                    $timeDifference = $currentDateTime->diff($taskStartDateTime);

                    // Extract hours and minutes from the time difference
                    $hours = $timeDifference->h;
                    $minutes = $timeDifference->i;

                    $time_spended = $hours.' hours and '.$minutes.' minutes';


                    $srNo = $start + $index + 1;

                    $nestedData['id'] = $srNo;
                    $nestedData['team-member'] = $task->user->name;
                    $nestedData['title'] = $task->title;
                    $nestedData['description'] = substr($task->description, 0, 30) . '...';
                    $nestedData['status'] = $task->status;
                    $nestedData['time-supended'] = $time_spended;

                    $data[] = $nestedData;




                }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

                echo json_encode($json_data);
    }

    /** Completed Task data */
    public function completed_tasks_data(Request $request)
    {


        $columns = array(
            0 =>'id',
            1 =>'team-member',
            2 =>'title',
            3 =>'description',
            4 =>'status',
            5 =>'time-supended',

        );

                $user =  Auth::user();
                $user = User::with('employeeRoleOrganization.organization')->find($user->id);
                $organization = $user->employeeRoleOrganization->organization;

                $data = Task::with('user')->where('status', 'Completed')->where('organization_id', $organization->id)->get();

                $totalData = $data->count();

                $totalFiltered = $totalData;

                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                if(empty($request->input('search.value')))
                {

                    $tasks = Task::with('user')->where('organization_id', $organization->id)->where('status', 'Completed')
                    ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                }
                else {
                    $search = $request->input('search.value');

                    $tasks =  Task::where('status', 'Completed')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhereHas('user', function($q2) use($search){
                                $q2->where('name', 'LIKE',"%{$search}%");
                            });
                            })
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                    $totalFiltered =  Task::where('status', 'Completed')->where('organization_id', $organization->id)
                            ->where(function($q) use($search){
                            $q->orWhere('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('description', 'LIKE',"%{$search}%")
                            ->orWhere('status', 'LIKE',"%{$search}%")
                            ->orWhereHas('user', function($q2) use($search){
                                $q2->where('name', 'LIKE',"%{$search}%");
                            });
                            })
                            ->count();

                }

                $data = array();
                if(!empty($tasks))
                {
                foreach ($tasks as $index => $task)
                {

                    $taskStartTime = $task->start_time;
                    $taskEndTime = $task->end_time;

                    $taskStartTime = $task->start_time;
                    $taskEndTime = $task->end_time;
                    $timezone = new DateTimeZone('Asia/Karachi');

                    // Convert the task start and end times to DateTime objects with the same timezone
                    $startDateTime = new DateTime($taskStartTime, $timezone);
                    $endDateTime = new DateTime($taskEndTime, $timezone);

                    // Calculate the time difference
                    $timeDifference = $startDateTime->diff($endDateTime);

                    // Extract hours and minutes from the time difference
                    $hours = $timeDifference->h;
                    $minutes = $timeDifference->i;

                    // echo "Time difference: $hours hours and $minutes minutes";
                    $time_spended = $hours.' hours and '.$minutes.' minutes';



                    $srNo = $start + $index + 1;

                    $nestedData['id'] = $srNo;
                    $nestedData['team-member'] = $task->user->name;
                    $nestedData['title'] = $task->title;
                    $nestedData['description'] = substr($task->description, 0, 30) . '...';
                    $nestedData['status'] = $task->status;
                    $nestedData['time-supended'] = $time_spended;

                    $data[] = $nestedData;




                }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

                echo json_encode($json_data);
    }





    public function assign_task($id)
    {
        $task = Task::where('id', $id)->first();

        $user =  Auth::user();
       
        $user = User::with('employeeRoleOrganization.organization')->find($user->id);
        $organization = $user->employeeRoleOrganization->organization;

        $users = Organization::with('employeeWithTeamMemberRole')->find($organization->id);
        $users = $users->employeeWithTeamMemberRole;

        return view('admin.tasks.assign-task', compact('task', 'users'));
    }


    public function task_assigned_to_member(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
        ], [
            'user_id.required' => 'Please Select Any Team Member',
        ]);


        $task = Task::where('id', $request->task_id)->first();
        $task->user_id = $request->user_id;
        $task->status = 'Pending';
        $task->start_time = now()->timezone('Asia/Karachi');
        $task->save();

        return redirect()->route('tasks.index');


    }




}
