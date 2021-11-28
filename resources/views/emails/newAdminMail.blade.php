<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body style="width: 100%; text-align: center; font-size: 2rem;">
<p>Вам надано права адміністратора в додатку <a href="{{ env('APP_URL') }}">{{env('APP_NAME')}}</a></p>
<p>Ваші облікові дані:
    <br>
    <table style="margin: auto">
        <tr><td style="text-align: right;">Логін:</td><td style="text-align: left;">{{ $details['email'] }}</td></tr>
        <tr><td style="text-align: right;">Пароль:</td><td style="text-align: left;">{{ $details['password'] }}</td></tr>
    </table>
</p>
</body>
</html>
