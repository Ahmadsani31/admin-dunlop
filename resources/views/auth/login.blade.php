<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/my-login.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/bootstrap.min.css') }}">
    <style>
        .login100-form-title {
  display: block;
  font-family: Poppins-Bold;
  font-size: 30px;
  color: #333333;
  line-height: 1.2;
  text-align: center;
}
    </style>
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="{{ asset('assets/login/img/logo.png') }}" alt="logo">
					</div>
					<div class="card fat">
						<div class="card-body">

							<h3 class="card-title text-center"><strong>WELCOME</strong></h3>
							<form class="my-login-validation" action="{{ route('login') }}" method="POST">
									@csrf
										@if(session('errors'))
											<div class="alert alert-danger alert-dismissible" role="alert">
												<strong>Something it's wrong!</strong> You should check in on some of those fields below.
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
												<ul>
												@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
												@endforeach
												</ul>
											</div>
										@endif
										@if (Session::has('success'))
											<div class="alert alert-success">
												{{ Session::get('success') }}
											</div>
										@endif
										@if (Session::has('error'))
											<div class="alert alert-danger">
												{{ Session::get('error') }}
											</div>
										@endif
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="username" class="form-control" @error('username') is-invalid @enderror" name="username" required autofocus>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
										<a href="forgot.html" class="float-right">
											Forgot Password?
										</a>
									</label>
									<input id="password" type="password" class="form-control" @error('password') is-invalid @enderror" name="password" required data-eye>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="remember" id="remember" class="custom-control-input">
										<label for="remember" class="custom-control-label">Remember Me</label>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Login
									</button>
								</div>
								<div class="mt-4 text-center">
									Don't have an account? <a href="{{ route('register') }}">Create One</a>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2017 &mdash; Your Company
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="{{ asset('assets/login/js/my-login.js') }}"></script>
	<script src="{{ asset('assets/login/js/jquery-3.3.1.slim.min.js') }}"></script>
	<script src="{{ asset('assets/login/js/popper-1.14.7.min-.js') }}"></script>
	<script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
</body>
</html>
