@extends('layout.admin')


@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
@can('user_create')
<a href="{{route('user.create')}}"class="mb-4">+add User</a>
@endcan
@can('user_index')
<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>image</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
@endcan    
</div>

@endsection

@section('script')

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('user.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'image', name: 'image'},
            {data: 'email', name: 'email'},
            {data: 'roles', name: 'roles'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
    });
    
  });
</script>

@endsection
