<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/test" method="post">
        @csrf
        <input type="text" name="commande" id="">
        <input class="btn btn info" type="submit" value="valider">
    </form>
</body>
</html>