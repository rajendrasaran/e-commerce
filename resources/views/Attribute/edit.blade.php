@extends('layout.admin')


@section('page_content')

<form action="{{route('attribute.update', $data->id)}}" method="post" class="">
    @csrf
    @method('PUT')
    <table class="Usertable">
        <tr>
            <td>name</td>
            <td class="td"><input type="text" name="name" value="{{$data->name}}"></td>
        </tr>
        <tr>
            <td>Name_key</td>
           <td> <input class="td" type="text" name="name_key" value="{{$data->name_key}}"></td> 
        <tr>
        <tr>
            <td>is_variant</td>
            <td><select name="is_variant" id="">
                <option value="1"{{(($data->is_variant)==1)? 'selected': ''}}>Yes</option>
                <option value="2"{{(($data->is_variant)==2)? 'selected': ''}}>No</option>
            </select>
            </td>
        </tr>
        <tr>
            <td>status</td>
           <td> <select name="status" id="">
                <option value="1"{{(($data->status)==1)? 'selected': ''}}>Enable</option>
                <option value="2"{{(($data->status)==2)? 'selected': ''}}>Dsable</option>
            </select></td>
        </tr>
        <td class="td"><input type="submit" value="submit"></td>
        </tr>
    </table>
</form>

@endsection


@section('style')
<style>
    
    .td {
        width: 100%;
        float: left;
    }
    select{
        width: 100%;
        float: left;
        padding: 15px;
    }
    
</style>


@endsection