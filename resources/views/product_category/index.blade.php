@extends('layout.admin')

@section('page_content')
        
<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('product_category.create')}}"class="mb-4">+add product categories </a>
<table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>product_id</th>
                <th>category_id</th>
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
        ajax: "{{ route('permission.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'product_id', name: 'product_id'},
            {data: 'category_id', name: 'category_id'},
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