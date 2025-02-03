@extends('layout.admin')


@section('page_content')



<section class="Usertable">
  <a href="{{route('user.create')}}">+Add User</a>
    <table border="1" cellspacing="0">
       <tr> 
          <th>Sr.No</th>
          <th>name</th>
          <th>email</th>
          <th>Action</th>
       </tr> 
    </table>
 </section>



@endsection