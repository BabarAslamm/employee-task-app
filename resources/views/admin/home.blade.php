@extends('admin.layout.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
        <center>
            <h3>Welcome</h3>
            <p>
                {{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }}
            </p>
        </center>
    </div>
@endsection
