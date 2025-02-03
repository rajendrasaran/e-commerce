@extends('layout.admin')

@section('page_content')
    <form action="{{route('user.update',$user->id)}}" method="post">
    @csrf
    @method('PUT')
        <table class="Usertable">
            <tr>
                <td class="td">name</td>
                <td><input type="text" name="name" class="input"  value="{{$user->name}}"></td>
            </tr>
            <tr>
                <td class="td">email</td>
                <td><input type="email" name="email" class="input" value="{{$user->email}}"></td>
            </tr>
            @foreach($roles as $_role)
            <tr>
            <td><label for="{{$_role->name}}">{{$_role->name}}</label></td>
                <td><input type="checkbox" value="{{$_role->name}}" name="roles[]" id="{{$_role->name}}"{{($user->hasRole($_role->name))? 'checked': ''}}></td>
            </tr>
            @endforeach
            <tr>
                <td class="td"><input type="submit" value="Submit" class="input"></td>
                <td class="td"><input type="reset" value="Reset" class="input"></td>
            </tr>
        </table>
    </form>
@endsection    
