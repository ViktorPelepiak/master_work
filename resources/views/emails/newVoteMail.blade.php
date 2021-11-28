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
<p>Вас запрошено до проходження голосування,</p>
<p>що буде проходити з&nbsp;{{ $details['datetime_of_start'] }}&nbsp;по&nbsp;{{ $details['datetime_of_finish'] }}.</p>
<p>Віддати свій голос ви можете за <a href="{{ env('APP_URL').'/surveys/vote/'.$details['token'] }}">посиланням</a>.</p>
</body>
</html>
