@extends('layout.admin')



@section('page_content')

<form action="{{route('slider.update', $slider->id)}}" method="post"  enctype="multipart/form-data">
   @csrf 
   @method('PUT')
    <table class="Usertable">
        <tr>
            <td>title</td>
            <td><input type="text" name="title" placeholder="title" value="{{$slider->title}}"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><select name="status" id="">
                    <option value="1"{{(($slider->status)== 1)? 'selected': ''}}>Enable</option>
                    <option value="2"{{(($slider->status)== 2)? 'selected': ''}}>Dsable</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>link</td>
            <td><input type="text" name="link" value="{{$slider->link}}"></td>
        </tr>
        <tr>
            <td class="width1"><label for="">Description</label></td>
            <td class="width">
            <textarea name="description" id="editor" rows="10" cols="80">
               {{$slider->description}}
            </textarea>
            </td>
        </tr>
        <tr>
            <td>slider_image</td>
            <td><input type="file" name="slider_image" value="{{$slider->slider_image}}"></td>
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