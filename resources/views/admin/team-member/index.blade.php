@extends('admin.layout.app')
@section('content')

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1 class="m-0">My Tasks</h1>
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
        <table class="table table-hover" id="my-tasks-data-table" width="100%">
            <thead class="bg-dark text-white header-border text-center">
              <tr>
                <th scope="col">#</th>
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

    var table =  $('#my-tasks-data-table').DataTable({

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
                "url": "{{ route('my.tasks.data') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },

        "columns": [

            { "data": "id"  },
            { "data": "title"  , orderable: false},
            { "data": "description" , orderable: false },
            { "data": "status" , orderable: false },
            { "data": "time-supended" , orderable: false },
            { "data": "action" , orderable: false, searchable: false }
        ]

    });

});



// Mark Task As Completed
$(document).on('click', '.task-completed', function(){
    var id = $(this).data('id');
    var url = "{{ route('my.tasks.completed',':id') }}";
    url = url.replace(':id', id);
    var token = "{{ csrf_token() }}";

         swal({
            title: "Are you sure?",
            text: "Once Completed, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                        url: url,
                        data: {'_token': token, '_method': 'GET'},
                        success: function (response) {
                            if(response == true)
                            {
                                $('#my-tasks-data-table').DataTable().ajax.reload();
                                swal("Congrats! Task has been Completed!", {
                                    icon: "success",
                                    timer: 1000,
                                });

                            }else{
                                alert('Erorr')
                            }
                        }
                });
            } else {
                swal("Your Task in Pending!");
            }
        });

})





</script>

@endsection
