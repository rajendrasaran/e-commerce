@extends('layout.admin')

@section('page_content')


    
    <form action="{{route('product_category.store')}}" method="post">
        @csrf
        <label for="">product_id</label>
        @foreach($product as $_product)
        <input type="checkbox" name="product_id[]" id="{{$_product->id}}"> 
        <label for="{{$_product->id}}">{{$_product->name}}</label>
        @endforeach
        <label for="">category_id</label>
        @foreach($category as $_product)
        <input type="checkbox" name="product_id[]" id="{{$_product->id}}"> 
        <label for="{{$_product->id}}">{{$_product->name}}</label>
        @endforeach



        <input type="submit" value="save" style="width: 100%;padding:10px;">
    </form>
@endsection










@section('style')

<style>
 

  label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }

  input[type="checkbox"],
  select {
    width: 11%;
    padding: 10px;
    border: 1;
    float: left;
  }

  form {
    max-width: 50%;
    background-color: burlywood;
    margin: auto;
    border-radius: 27px;
    padding: 55px;
    margin-top: 8%;
  }


</style>

@endsection
