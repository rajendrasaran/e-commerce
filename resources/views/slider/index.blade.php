@extends('layout.admin')

@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('slider.create')}}"class="mb-4">+add Page</a>
<table class="table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>slider_image</th>
                <th>title</th>
                <th>Status</th>
                <th>description</th>
                <th>link</th>
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
        ajax: "{{ route('slider.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'slider_image', name: 'slider_image'},
            {data: 'title', name: 'title'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {data: 'link', name: 'link'},

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