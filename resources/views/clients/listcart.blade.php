<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach (session()->get('cart') as $item)
        <h4>{{$item['name']}}</h4>
        <h4>{{$item['quantity']}}</h4>
        <h4>{{$item['id']}}</h4>

        <a href="{{route('delCart',$item['id'])}}" >X</a>
        <hr>
    @endforeach

</body>
</html>