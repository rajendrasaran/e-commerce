@extends('layout.admin')



@section('page_content')

<form action="{{route('category.update', $category->id)}}" method="post"  enctype="multipart/form-data">
   @csrf 
   @method('PUT')
    <table class="Usertable">
        <tr>
            <td>parent_id</td>
            <!-- <td><input type="number" name="parent_id" value="{{$category->parent_id}}"></td> -->
         <td>
            <select name="parent_id" id="">
            <option value="0">select</option>
                @foreach($data as $_data)    
                    <option value="{{$_data->id}}"{{$category->parent_id == $_data->id? 'selected': ''}}>{{$_data->name}}</option>
                @endforeach  
            </select>
         </td>
        </tr>
        <tr>
            <td>name</td>
            <td><input type="text" name="name" value="{{$category->name}}"></td>
        </tr>                                       
        <tr>
            <td>show_in_menu</td>
            <td><select name="show_in_menu" id="">
                    <option value="1"{{(($category->show_in_menu)== 1)? 'selected': ''}}>Yes</option>
                    <option value="2"{{(($category->show_in_menu)== 2)? 'selected': ''}}>No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Status</td>
            <td><select name="status" id="">
                    <option value="1"{{(($category->status)== 1)? 'selected': ''}}>Enable</option>
                    <option value="2"{{(($category->status)== 2)? 'selected': ''}}>Dsable</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>short_description</td>
            <td><input type="text" name="short_description" value="{{$category->short_description}}"></td>
        </tr>
        <tr>
            <td class="width1"><label for="">Description</label></td>
            <td class="width">
            <textarea name="description" id="editor" rows="10" cols="80">
               {{$category->description}}
            </textarea>
            </td>
        </tr>
        <tr>
            <td><label for="">thumbnail</label></td>
            <td><input type="file" name="thumbnail"></td>
        </tr>
        <tr>
            <td><label for="">banner_image</label></td>
            <td><input type="file" name="banner_image"></td>
        </tr>
        <tr>
            <td><input type="submit"></td>
        </tr>
    </table>
</form>

@endsection


@section('style')
<style>
    select {
    width: 100%;
    float: left;
    padding: 12px;
    border-radius: 10px;
}
td, input{
    width: 100%;
    float: left;
}
</style>

@endsection