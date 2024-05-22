<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('assets/css/signup.css')}}">
</head>
<body>
    <form class="form-box" method="post" action="{{route('user.signupSubmit')}}">
        @csrf
        <div class="text">Create Accuont</div>
        <div class="form-field">
         
            <input type="text" class="form-input-1" placeholder=" " value ="{{old('fullname')}}"  name="fullname">
            <label for="fullname" class="form-label-1">Họ và Tên:</label>
            <input type="password" class="form-input-3" placeholder=" " value ="{{old('password')}}" name="password">
            <label for="password" class="form-label-3">Mật Khẩu</label>
            <input type="text" class="form-input-4" placeholder=" " value ="{{old('email')}}" name="email">
            <label for="Email" class="form-label-4">Email:</label>
           
        </div>
        <button class="Login" type="submit" name="btn-reg">Sign Up</button>
        @error('fullname')
            <h4>{{$message}}</h4>
        @enderror
        @error('password')
            <h4>{{$message}}</h4>
        @enderror   
        @error('email')
            <h4>{{$message}}</h4>
        @enderror

    </form>
</body>
</html>