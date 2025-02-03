@extends('layout.myAccount')

@section('page_content')
<style>
	.order-table {
		width: 100%;
		border-collapse: collapse;
		border-color: #ccc;
		border: 1px;
	}

	.order-table th,
	.order-table td {
		padding: 8px;
		text-align: left;
		border-bottom: 1px solid #ddd;
	}

	.order-table th {
		background-color: #f2f2f2;
	}
</style>
@if(Session::has('success'))
<span>{{Session::get('success')}}</span>
@endif
<section class="py-5 my-5">
	<div class="container">
		<h1 class="mb-5">Account Settings</h1>
		<div class="bg-white shadow rounded-lg d-block d-sm-flex">
			<div class="profile-tab-nav border-right">
				<div class="p-4">
					<div class="img-circle text-center mb-3">
						<img src="{{asset('myaccount/img/user2.jpg')}}" alt="Image" class="shadow">
					</div>
					<h4 class="text-center">Kiran Acharya</h4>
				</div>
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
						<i class="fa fa-home text-center mr-1"></i>
						Account
					</a>
					<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
						<i class="fa fa-key text-center mr-1"></i>
						Password
					</a>
					<a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
						<i class="fa fa-user text-center mr-1"></i>
						Security
					</a>
					<a class="nav-link" id="application-tab" data-toggle="pill" href="#application" role="tab" aria-controls="application" aria-selected="false">
						<i class="fa fa-tv text-center mr-1"></i>
						My Order
					</a>
					<a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab" aria-controls="notification" aria-selected="false">
						<i class="fa fa-bell text-center mr-1"></i>
						My Wishlist
					</a>
					<a class="nav-link" id="notification-tab" href="{{route('Customerlogout')}}">
						<i class="fa fa-bell text-center mr-1"></i>
						logout
					</a>
				</div>
			</div>
			<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
				<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
					<h3 class="mb-4">Account Settings</h3>
					<form action="{{route('account-update')}}" method="post">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First Name</label>
									<input type="text" class="form-control" value="{{$user->name}}" name="name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input type="text" class="form-control" value="{{$user->email}}" readonly name="email">
								</div>
							</div>
							<!-- <div class="col-md-6">
							<div class="form-group">
								<label>Phone number</label>
								<input type="text" class="form-control" value="+91 9876543215">
							</div>
						</div> -->
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</form>
				</div>

				<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
					<h3 class="mb-4">Password Settings</h3>
					<form action="{{route('new-password')}}" method="post">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Old password</label>
									<input type="password" class="form-control" name="password">
								</div>
								@error('password')
								<span>{{$message}}</span>
								@enderror
								@if(session('error'))
								<span style="color: red;">Old password does not match.</span>
								@endif
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>New password</label>
									<input type="password" class="form-control" name="new_password">
									@error('new_password')
									<span>{{$message}}</span>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Confirm new password</label>
									<input type="password" class="form-control" name="confirm_password">
									@error('confirm_password')
									<span>{{$message}}</span>
									@enderror

								</div>
							</div>
						</div>
						<div>
							<button class="btn btn-primary">Update</button>
							<button class="btn btn-light">Cancel</button>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
					<h3 class="mb-4">Security Settings</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Login</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Two-factor auth</label>
								<input type="text" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="recovery">
									<label class="form-check-label" for="recovery">
										Recovery
									</label>
								</div>
							</div>
						</div>
					</div>
					<div>
						<button class="btn btn-primary">Update</button>
						<button class="btn btn-light">Cancel</button>
					</div>
				</div>
				<div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
					<h3 class="mb-4">My Order</h3>
					<div>
						<table class="order-table" border="1">
							<tr>
								<th>Order Id</th>
								<th>Ship to</th>
								<th>Date</th>
								<th>Total Order</th>
								<th>Status</th>
								<th>View Detail</th>
							</tr>
							@foreach(order() as $order)
							<tr>
								<td>{{$order->order_increment_id}}</td>
								<td>{{$order->name}}</td>
								<td>{{$order->order_increment_id}}</td>
								<td>1</td>
								<td>1</td>

								<td class="edit btn-success btn-sm">		
										<a href="{{route('detail',($order->product->url_key??''))}}">View</a>	
									</td>
								
							</tr>
							@endforeach
							<a  data-toggle="pill" href="#id" role="tab" aria-controls="application" aria-selected="false">View</a>
						</table>
						<button class="btn btn-primary">Update</button>
						<button class="btn btn-light">Cancel</button>
					</div>
				</div>


				<div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
					<h3 class="mb-4">Wishlist</h3>
					<table id="wishlist-table">
						<tbody>
							@foreach(wishlistshow() as $wishlist)
							<tr>
								<td>
									<img src="{{$wishlist->product->getFirstMediaUrl('image')}}" alt="" width="50">
								</td>
								<td>{{$wishlist->product->name}}</td>
								<td>
									<form action="{{route('deletewishlist', $wishlist->id)}}" method="post">
										@csrf
										<button class="btn-remove" data-id="{{$wishlist->id}}">Remove</button>
									</form>
								</td>

							</tr>
							@endforeach
						</tbody>
					</table>
					<div>
						<button class="btn btn-primary">Update</button>
						<button class="btn btn-light">Cancel</button>
					</div>
				</div>
				<div class="tab-pane fade" id="id" role="tabpanel" aria-labelledby="application-tab">
					hgvnctfjmgyukfty	
			
			</div>
			</div>
		</div>
	</div>
</section>

@endsection
@section('style')
<style>
	td.edit.btn-success.btn-sm {
		padding: 0 41px !important;
	}

	#wishlist-table {
		width: 100%;
		border-collapse: collapse;
	}

	#wishlist-table td {
		padding: 10px;
		border: 1px solid #ccc;
	}

	.btn-remove {
		background-color: #dc3545;
		color: #fff;
		border: none;
		padding: 5px 10px;
		cursor: pointer;
	}
</style>

@endsection