@extends('layout.admin')


@section('page_content')

<form action="{{route('role.store')}}" method="post">
  @csrf  
    <table class="Usertable">
        <tr>
            <td>name</td>
            <td class="td"><input type="text" name="name"></td>
        </tr>
        <tr>
          <td>permission</td>
<div class="overfull">
@foreach($permission as $_permission)
            
          <td><input type="checkbox" name="permissions[]" id="{{$_permission->name}}" value="{{$_permission->name}}"></td>
          <td><label for="{{ $_permission->name }}">{{ $_permission->name }}</label></td>
@endforeach      
</div>    
        </tr>
        <tr>
            <td  class="td"><input type="submit" value="submit"></td>
        </tr>
    </table>
</form>

@endsection


@section('style')
<style>
    td {
    width: 100%;
    float: left;
}
</style>


@endsection
