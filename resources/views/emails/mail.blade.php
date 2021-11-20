<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body>
<p>Вас запрошено до проходження голосування</p>
<a href="{{ KeyValues::getKeyValues()['root_path'].'/surveys/vote/'.$details['body'] }}">Посиляння для проходження</a>
</body>
</html>
