@extends('layout.admin')
@section('page_content')
<div class="container mt-5">
    @can('attribute_create')
<a href="{{route('attribute.create')}}"class="mb-4">+add Attribute</a>
@endcan
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>name_key</th>
                <th>is_variant</th>
                <th>status</th>
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
        ajax: "{{ route('attribute.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'name_key', name: 'name_key'},
            {data: 'is_variant', name: 'is_variant'},
            {data: 'status', name: 'status'},
           
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
@section('style')
<style>
    input[type="submit"] {
    background: none;
    border: none;
    color: white;
}
.delete.btn-success {
    color: #fff;
    background-color: red;
    border-color: red;
}
</style>

@endsection