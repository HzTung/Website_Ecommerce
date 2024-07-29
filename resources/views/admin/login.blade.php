<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <section class="">
        <div class="container-fluid h-custom w-100 d-flex justify-content-center align-items-center ">
            <div class="col-md-8 col-lg-6 col-xl-4 bg-light rounded shadow-lg justify-content-center row">
                <div class="bg-info rounded w-50 h-40 btn mt-3">LOGIN</div>
                <form action="{{route('admin.loginSubmit')}}" method="post" class="w-100 p-3 row justify-content-center">
                    @csrf
                    <div class="form-outline my-2">
                        <label for="">Email:</label>
                        <input type="email" class="form-control" name="email" id="" aria-describedby="emailHelpId"
                            placeholder="">
                    </div>
                    <div class="form-group my-2">
                        <label for="">Mật Khẩu:</label>
                        <input type="password" class="form-control" name="password" id="" aria-describedby="helpId"
                            placeholder="">
                    </div>

                    <button type="submit" class="btn btn-primary rounded w-75 p-2 my-3">submit</button>
                    <div class="form-group d-flex flex-row">
                        <div class="">Don't Have an account?</div>
                        <a href="./signup.html" class="text-decoration-none">
                            <div class="text-danger">register</div>
                        </a>
                    </div>

                </form>
            </div>
        </div>
            
        @if (session('msg'))
            <span class="">{{session('msg')}}</span>
        @endif()
       
    </section>


</body>


</html>