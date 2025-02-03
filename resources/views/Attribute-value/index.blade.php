@extends('layout.admin')
@section('page_content')
<div class="container mt-5">
<a href="{{route('attribute-value.create')}}"class="mb-4">+add Attribute</a>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>attribute_id</th>
                <th>Name</th>
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
        ajax: "{{ route('attribute-value.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'attribute_id', name: 'attribute_id'},
            {data: 'attribute_name', name: 'attribute_name'},
            {data: 'attribute_status', name: 'attribute_status'},
           
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