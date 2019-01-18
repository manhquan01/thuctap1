<!------ Include the above in your HEAD tag ---------->
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="{{asset('assets/css/login_form.css')}}" rel="stylesheet" type="text/css">
<!------ Include the above in your HEAD tag ---------->

</head>
<body id="LoginForm">
<div class="container">
    <h1 class="form-heading"></h1>
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Admin Login</h2>
                <p>Please enter your email and password</p>
            </div>
            <form id="Login" method="post" action="{{asset(route('logged-in'))}}">
                {{csrf_field()}}
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                @endif
                <div class="form-group">
                    <input type="email" value="{{old('email')}}" name="email" class="form-control" id="inputEmail" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" required="" id="inputPassword" placeholder="Password">
                </div>
                <div class="forgot">
                    <a href="reset.html">Forgot password?</a>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>

            </form>
        </div>
        <p class="botto-text"> Designed by Sunil Rajput</p>
    </div>
</div>

</body>
</html>
