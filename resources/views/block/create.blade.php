@extends('layout.admin')



@section('page_content')

<form action="{{route('block.store')}}" method="post"  enctype="multipart/form-data">
   @csrf 
    <table class="Usertable">
        <tr>
            <td>title</td>
            <td><input type="text" name="title" placeholder="title"></td>
        </tr>
        <tr>
            <td>heading</td>
            <td><input type="text" name="heading" placeholder="heading"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><select name="status" id="">
                    <option value="1">Enable</option>
                    <option value="2">Dsable</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="url_key"></td>
        </tr>
        <tr>
            <td class="width1"><label for="">Description</label></td>
            <td class="width">
            <textarea name="description" id="editor" rows="10" cols="80">
               
            </textarea>
            </td>
        </tr>
        <tr>
            <td><input type="file" name="image"></td>
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