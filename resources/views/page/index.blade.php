@extends('layout.admin')

@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('page.create')}}"class="mb-4">+add Page</a>
<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>title</th>
                <th>heading</th>
                <th>Status</th>
                <th>description</th>
                <th>url_key</th>
                <th>banner</th>
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
        ajax: "{{ route('page.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title', name: 'title'},
            {data: 'heading', name: 'heading'},
            {data: 'status', name: 'status'},
            {data: 'description', name: 'description'},
            {data: 'url_key', name: 'url_key'},
            {data: 'banner', name: 'banner'},

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