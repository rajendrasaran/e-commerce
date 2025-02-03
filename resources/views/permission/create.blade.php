@extends('layout.admin')


@section('page_content')

<form action="{{route('permission.store')}}" method="post">
  @csrf  
    <table class="Usertable">
        <tr>
            <td>name</td>
            <td class="td"><input type="text" name="name"></td>
        </tr>
        <!-- <tr>
            <td>guard_name</td>
            <td class="td"><input type="text" name="guard_name"></td>
        </tr> -->
        <tr>
            <td  class="td"><input type="submit" value="submit"></td>
        </tr>
    </table>
</form>

@endsection
