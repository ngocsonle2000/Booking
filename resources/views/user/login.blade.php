<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{url('public/ad')}}/dist/css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Arizonia&display=swap" rel="stylesheet">


	<link rel="stylesheet" href="{{ url('public/site') }}/css/animate.css">

	<link rel="stylesheet" href="{{ url('public/site') }}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{ url('public/site') }}/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="{{ url('public/site') }}/css/magnific-popup.css">

	<link rel="stylesheet" href="{{ url('public/site') }}/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="{{ url('public/site') }}/css/jquery.timepicker.css">


	<link rel="stylesheet" href="{{ url('public/site') }}/css/flaticon.css ">

</head>
<body>
    @if (Session::has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('error') }}
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('success') }}
        </div>
    @endif

<div class="container" id="container">

	<div class="form-container sign-up-container">

		<form action="{{ route('login.store') }}" method="POST" role="form" >
            @csrf
			<h1>Create Account</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your email for registration</span>
			<input type="text" placeholder="Name" name="UserName"/>
			<input type="email" placeholder="Email" name="Email"/>
			<input type="password" placeholder="Password" name="Password"/>
            <input type="text" placeholder="Phone" name="Phone"/>
            <input type="text" placeholder="Adrress" name="Adrress"/>
			<button type="submit" >Sign Up</button>
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="{{ route('login') }}" method="POST">
            @csrf
			<h1>Sign in</h1>
			<div class="social-container">
				<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
				<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
				<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
			</div>
			<span>or use your account</span>
			<input type="text" placeholder="Email" name="email" />
            @error('email')
                <small class="help-block">{{ $message }}</small>
            @enderror
			<input type="password" placeholder="Password" name="password"  />
            @error('password')
                <small class="help-block">{{ $message }}</small>
            @enderror
			<a href="#">Forgot your password?</a>
			<button>Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Hello, Friend!</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>


<script src="{{ url('public/site') }}/js/jquery.min.js"></script>
			<script src="{{ url('public/site') }}/js/jquery-migrate-3.0.1.min.js"></script>
			<script src="{{ url('public/site') }}/js/popper.min.js"></script>
			<script src="{{ url('public/site') }}/js/bootstrap.min.js"></script>
			<script src="{{ url('public/site') }}/js/jquery.easing.1.3.js"></script>
			<script src="{{ url('public/site') }}/js/jquery.waypoints.min.js"></script>
			<script src="{{ url('public/site') }}/js/jquery.stellar.min.js"></script>
			<script src="{{ url('public/site') }}/js/owl.carousel.min.js"></script>
			<script src="{{ url('public/site') }}/js/jquery.magnific-popup.min.js"></script>
			<script src="{{ url('public/site') }}/js/jquery.animateNumber.min.js"></script>
			<script src="{{ url('public/site') }}/js/bootstrap-datepicker.js"></script>
			<script src="{{ url('public/site') }}/js/scrollax.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
			<script src="{{ url('public/site') }}/js/google-map.js"></script>
			<script src="{{ url('public/site') }}/js/main.js"></script>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</body>
</html>
