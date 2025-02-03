@extends('layout.admin')

@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('category.create')}}"class="mb-4">+add Category</a>
<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>parent_id</th>
                <th>name</th>
                <th>show_in_menu</th>
                <!-- <th>short_description</th>
                <th>description</th> -->
                <th>Status</th>
                <th>thumbnail</th>
                <th>banner_image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>


@endsection
@section('script')

<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('category.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'parent_id', name: 'parent_id'},
            {data: 'name', name: 'name'},
            {data: 'show_in_menu', name: 'show_in_menu'},
            // {data: 'short_description', name: 'short_description'},
            // {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {data: 'thumbnail', name: 'thumbnail'},
            {data: 'banner_image', name: 'banner_image'},

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