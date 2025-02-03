@extends('layout.admin')

@section('page_content')

<div  class="container mt-5">
<!-- <h2 class="mb-4">user</h2> -->
<a href="{{route('product.create')}}"class="mb-4">+add Page</a>
<table class="table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>name</th>
                <!-- <th>status</th>  -->
                <th>sku</th>
                <th>qty</th>
                <!-- <th>stock_status</th> -->
                <th>weight</th>
                <th>price</th>
                <th>special_price</th>
                <!-- <th>special_price_from</th>
                <th>special_price_to</th> -->
                <!-- <th>short_description</th>
                <th>description</th>-->
                <th>image</th> 
                <th>url_key</th>
                <!-- <th>related_product</th>
                <th>meta_title</th>
                <th>meta_keyword</th>
                <th>meta_description</th> -->
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
        ajax: "{{ route('product.index')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            // {data: 'status', name: 'status'},
            {data: 'sku', name: 'sku'},
            {data: 'qty', name: 'qty'},
            // {data: 'stock_status', name: 'stock_status'},
            {data: 'weight', name: 'weight'},
            {data: 'price', name: 'price'},
            {data: 'special_price', name: 'special_price'},
            // {data: 'special_price_form', name: 'special_price_form'},
            // {data: 'special_price_to', name: 'special_price_to'},
            // {data: 'short_description', name: 'short_description'},
            // {data: 'description', name: 'description'},
            {data: 'image', name: 'image'},
            {data: 'url_key', name: 'url_key'},
            // {data: 'related_product', name: 'related_product'},
            // {data: 'meta_title', name: 'meta_title'},
            // {data: 'meta_keyword', name: 'meta_keyword'},
            // {data: 'meta_description', name: 'meta_description'},

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