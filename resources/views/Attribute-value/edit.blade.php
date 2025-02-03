@extends('layout.admin')


@section('page_content')

<form action="{{route('attribute-value.update', $data->id)}}" method="post" class="">
    @csrf
    @method('PUT')
    <table class="Usertable">
        <tr>
            <td>attribute_id</td>
            <td>
                <select name="attribute_id" id="attribute-select">
                   
                    @foreach($attribute as $_attribute)
                    <option value="{{$_attribute->id}}">{{$_attribute->name}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>name</td>
            <td class="td"><input type="text" name="name" value="{{$data->name}}"></td>
        </tr>
        <tr>
            <td>status</td>
            <td> <select name="status" id="">
                    <option value="1" {{(($data->status)==1)? 'selected': ''}}>Enable</option>
                    <option value="2" {{(($data->status)==2)? 'selected': ''}}>Dsable</option>
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

    select {
        width: 100%;
        float: left;
        padding: 15px;
    }
</style>


@endsection