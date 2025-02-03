@extends('layout.admin')

@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('block.create')}}"class="mb-4">+add Block</a>
<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>title</th>
                <th>heading</th>
                <th>Status</th>
                <th>description</th>
                <th>url_key</th>
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
        ajax: "{{ route('block.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'heading', name: 'heading'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {data: 'url_key', name: 'url_key'},
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