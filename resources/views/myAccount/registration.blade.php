@extends('layout.myAccount')
@section('page_content')
<!doctype html>
<html lang="en">
  <head>
  	<title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('myaccount/login/css/style.css')}}">
    <style>
    .ftco-section {
    padding: 2em 0;
}
</style>
	</head>
	<body class="img js-fullheight" style="background-image: url('form-v9.jpg');">
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Registration #10</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Create an account?</h3>
		      	<form action="{{route('registra')}}" class="signin-form" method="post">
					@csrf
		      		<div class="form-group">
                        
						<input type="text" name="name" id="full-name" class="form-control" placeholder="Your Name" required>		      		
                    </div>
                    <div class="form-group">
						<input type="emali" name="email" id="full-name" class="form-control" placeholder="Your Email" required>		      		
                    </div>  
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control" placeholder="Password" required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	              <input id="password-field" name="Comfirm Password" type="password" class="form-control" placeholder="Comfirm Password" required>
	              
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary" >Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								<div class="w-50 text-md-right">
									<a href="{{route('loginAdmin')}}" style="color: #fff">Login</a>
								</div>
	            </div>
	          </form>
	          
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('myaccount/login/js/jquery.min.js')}}"></script>
  <script src="{{asset('myaccount/login/js/popper.js')}}"></script>
  <script src="{{asset('myaccount/login/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('myaccount/login/js/main.js')}}"></script>

	</body>
</html>
@endsection
