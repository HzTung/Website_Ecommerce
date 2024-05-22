<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    @include('sweetalert::alert')

</head>
<body>
    <form class="form-box" method="post" action="{{route('user.loginSubmit')}}">
        @csrf
        <div class="text">Login Here</div>
        <div class="form-field">
            <input type="text" class="form-input-1" name="email" placeholder=" ">
            <label for="name" class="form-label-1">Email:</label>
           
            <input type="password" class="form-input-2" name="password" placeholder=" ">
            <label for="password" class="form-label-2">Password:</label>
          
        </div>
        <button class="Login" type="submit" name="login" value="Đăng Nhập">Login</button>
        <div class="text-bottom">
            <p>Don't have an accuont?</p>
            <a href="{{route('user.signup')}}" class="sign-up">Sign up </a>
            <b>here</b>
            <div class="log-in">Log in With</div>
            @error('email')
                <span style="color: red"> {{$message}}</span>
                <br>
            @enderror
            @error('password')
                <span style="color: red"> {{$message}}</span>
             @enderror
        </div>
    </form>        
    
</body>
</html>


