@extends('admin.layout.app')
@section('content')

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0">Assign Task</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Employee Task Portal</li>
                    </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    <div class="card p-3 table-card">

            <div class="row">
                <div>
                    <b>Task Title : </b>
                    <p>{{ $task->title }}</p>
                </div>

                <div>
                    <b>Task Description : </b>
                    <p>{{ $task->description }}</p>
                </div>

                <form action="{{ route('task.assigned') }}" method="POST">
                    @csrf
                    <input type="hidden" name="task_id" id="" value="{{ $task->id }}">
                    <div class="col-md-6">
                        <div class="input-group-md">
                            <b for="">Team Member *</b>
                            <select required id="user_id" name="user_id" class="form-control form-select">
                                <option selected disabled >Select Team Member</option>
                                @foreach ($users as $user)
                                <option  value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_id')
                            <span class="text-danger" role="">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>
                </form>

            </div>


    </div>
@endsection
