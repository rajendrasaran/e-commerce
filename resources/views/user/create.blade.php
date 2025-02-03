@extends('layout.admin')

@section('page_content')
    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table class="Usertable">
            <tr>
                <td class="td">name</td>
                <td><input type="text" name="name" class="input"></td>
            </tr>
            <tr>
                <td class="td">email</td>
                <td><input type="email" name="email" class="input"></td>
            </tr>
            <tr>
                <td><label for="image">image</label></td>
                <td><input type="file" name="image" id="image" class="input"></td>
            </tr>
            <tr>
                <td class="td">password</td>
                <td><input type="password" name="password" class="input"></td>
            </tr>
            <tr>
                <td class="td">confirm password</td>
                <td><input type="password" name="confirm_password" class="input"></td>
            </tr>
            @foreach($roles as $_role)
            <tr>
            <td><label for="{{$_role->name}}">{{$_role->name}}</label></td>
                <td><input type="checkbox" value="{{$_role->name}}" name="roles[]" id="{{$_role->name}}"></td>
            </tr>
            @endforeach
            <tr>
                <td class="td"><input type="submit" value="Submit" class="input"></td>
                <td class="td"><input type="reset" value="Reset" class="input"></td>
            </tr>
        </table>
    </form>
@endsection    
