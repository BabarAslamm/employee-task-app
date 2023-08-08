<?php

namespace App\Http\Controllers\TeamMember;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Acl;

class MyTaskController extends Controller
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
       return view('admin.team-member.index');
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
            4 =>'time-supended',
            5 =>'action',


        );

                $user =  Auth::user();
                $data = Task::where('user_id', $user->id)->get();


                $totalData = $data->count();

                $totalFiltered = $totalData;

                $limit = $request->input('length');
                $start = $request->input('start');
                $order = $columns[$request->input('order.0.column')];
                $dir = $request->input('order.0.dir');

                if(empty($request->input('search.value')))
                {

                    $tasks = Task::where('user_id', $user->id)
                    ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                }
                else {
                    $search = $request->input('search.value');

                    $tasks =  Task::where('user_id', $user->id)
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

                    $totalFiltered =  Task::where('user_id', $user->id)
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

                    if($task->status == 'Completed'){

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

                    }else{
                        $taskStartTime = $task->start_time;
                        $timezone = new DateTimeZone('Asia/Karachi');

                        // Get the current time in the specified timezone
                        $currentDateTime = new DateTime('now', $timezone);

                        // // Convert the task start time to a DateTime object with the same timezone
                        $taskStartDateTime = new DateTime($taskStartTime, $timezone);

                        // Calculate the time difference
                        $timeDifference = $currentDateTime->diff($taskStartDateTime);

                        // Extract hours and minutes from the time difference
                        $hours = $timeDifference->h;
                        $minutes = $timeDifference->i;

                        $time_spended = $hours.' hours and '.$minutes.' minutes';
                    }






                $nestedData['id'] = $srNo;
                $nestedData['title'] = $task->title;
                $nestedData['description'] = substr($task->description, 0, 30) . '...';
                $nestedData['status'] = $task->status;
                $nestedData['time-supended'] = $time_spended;

                if($task->status == 'Pending'){
                    $nestedData['action'] = '

                    <td class="button-action">
                        <a href="javascript:0" class="btn btn-sm btn-warning m-1  task-completed" data-id='.$task->id.' >Mark As Completed</a>
                    </td>';
                }else{
                    $nestedData['action'] = '

                    <td class="button-action">
                        Completed
                    </td>';
                }


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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function completed($id)
    {
        $task = Task::where('id', $id)->first();
        $task->status = 'Completed';
        $task->end_time = now()->timezone('Asia/Karachi');
        $task->save();

        return true;
    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
