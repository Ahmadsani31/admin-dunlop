<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>My Login Page &mdash; Bootstrap 4 Login Page Snippet</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/login/css/my-login.css') }}">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<img src="{{ asset('assets/login/img/logo.png') }}" alt="bootstrap 4 login page">
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title text-center"><strong>REGISTER</strong></h4>
                            <form method="POST" action="{{ route('register') }}" class="my-login-validation" novalidate="">
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
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                                    <div class="invalid-feedback">
										Your email is invalid
									</div>

								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" required>
									<div class="invalid-feedback">
										Your email is invalid
									</div>
								</div>
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username">
									<div class="invalid-feedback">
										Your username is invalid
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>
								<div class="form-group">
									<label for="password">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" data-eye>
									<div class="invalid-feedback">
										Password is required
									</div>
								</div>

								<div class="form-group">
									<div class="custom-checkbox custom-control">
										<input type="checkbox" name="agree" id="agree" class="custom-control-input" required="">
										<label for="agree" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label>
										<div class="invalid-feedback">
											You must agree with our Terms and Conditions
										</div>
									</div>
								</div>

								<div class="form-group m-0">
									<button type="submit" class="btn btn-primary btn-block">
										Register
									</button>
								</div>
								<div class="mt-4 text-center">
									Already have an account? <a href="{{ route('login') }}">Login</a>
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
	<script src="{{ asset('assets/login/js/jquery-3.3.1.slim.min.js') }}"></script>
	<script src="{{ asset('assets/login/js/my-login.js') }}"></script>
	<script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
</body>
</html>
