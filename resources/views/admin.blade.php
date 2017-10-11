@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('admin.created.form') }}" class="btn btn-sm btn-primary">ADD</a>
                    Admin Dashboard
                </div>
                <div class="panel-body">
                    <table class="table table-striped" id="users-table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>NAME</td>
                                <td>EMAIL</td>
                                <td>CREATED AT</td>
                                <td>UPDATED AT</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td><input></td>
                                <td><input></td>
                                <td><input></td>
                                <td><input></td>
                                <td><input></td>
                                <td class="non_searchable"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var columnClass = column.footer().className;
                if(columnClass != 'non_searchable'){
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                }
            });
        },
    });
});

// function adminDeleted(id) {
//     swal({
//         title: "Are you sure?",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//         })
//     .then((willDelete) => {
//         if (willDelete) {
//             $.ajax({
//                 url: '/admin/delete/' + id,
//                 type: 'DELETE',
//                 data: {
//                     id: id,
//                 },
//                 success:function(result){
//                     if(result.status === 200){
//                         swal(
//                             "Poof! Your imaginary file has been deleted!", 
//                             {
//                                 icon: "success",
//                             }
//                         ).then(()=>{
//                             window.location.href = window.location.href;
//                         });
//                     }
//                 }
//             })
//         }
//     });
// }
</script>
@endpush
