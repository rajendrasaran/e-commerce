@extends('layout.admin')


@section('page_content')

    <form action="{{route('role.update', $role->id)}}" method="post">
        @csrf
        @method('PUT')
        <table class="Usertable">

         <tr>
            <td><input type="text" name="name" value="{{$role->name}}"></td>
         </tr>
         <tr>
         @foreach($permission as $_role)
            
            <td><input type="checkbox" name="permissions[]" id="{{$_role->name}}" value="{{$_role->name}}"{{($role->hasPermissionTo($_role->name))? 'checked': ''}}></td>
            <td><label for="{{ $_role->name }}">{{ $_role->name }}</label></td>
         @endforeach  
         </tr>
         <tr>
            <td><input type="submit" value="Submit"></td>
         </tr>
        </table>
    </form>

@endsection


@section('style')
<style>
    td,input{
        width: 100%;
        float: left;
    }
</style>

@andsection