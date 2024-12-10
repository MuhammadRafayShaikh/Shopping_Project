<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>{{ $subject }}</h2>
    <h3>Your Order History: </h3>
    <ul>
        @foreach ($productNames as $productName)
            <li>{{ $productName }}</li>
        @endforeach
    </ul>
</body>

</html>
