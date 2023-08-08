@extends('admin.layout.app')
@section('content')

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0">Pending Tasks</h1>
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

       <div class="table-responsive">
        <table class="table table-hover" id="pending-tasks-data-table" width="100%">
            <thead class="bg-dark text-white header-border text-center">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Team Member Name</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Time Spended</th>
                <th scope="col" width="25%">Action</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>

              </tr>
            </tbody>
          </table>
       </div>
    </div>


<script>
$(document).ready(function () {

    var table =  $('#pending-tasks-data-table').DataTable({

        "bSort": true,
        "paging": true,
        "bInfo" : true,
        "bLengthChange": true,
        "scrollCollapse": true,
        "lengthChange": true,
        "pageLength": 20,
        "responsive": true,
        "processing": false,
        "serverSide": true,
        "lengthMenu": [ 5, 10, 20, 30, 50 ],
        "order": [[ 0, "asc" ]],


        "ajax":{
                "url": "{{ route('pending.tasks.data') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },

        "columns": [

            { "data": "id"  },
            { "data": "team-member"  , orderable: false},
            { "data": "title"  , orderable: false},
            { "data": "description" , orderable: false },
            { "data": "status" , orderable: false },
            { "data": "time-supended" , orderable: false },
            { "data": "action" , orderable: false, searchable: false }
        ]

    });

});





</script>

@endsection
