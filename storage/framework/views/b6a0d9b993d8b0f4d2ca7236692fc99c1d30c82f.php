<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
</head>
<body style="width: 100%; text-align: center;">
<p>Вас запрошено до проходження голосування,</p>
<p>що буде проходити з&nbsp;<?php echo e($details['datetime_of_start']); ?>&nbsp;по&nbsp;<?php echo e($details['datetime_of_finish']); ?>.</p>
<p>віддати свій голос ви можете за <a href="<?php echo e(KeyValues::getKeyValues()['root_path'].'/surveys/vote/'.$details['token']); ?>">посиланням</a>.</p>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\voting_service\resources\views/emails/newVoteMail.blade.php ENDPATH**/ ?>
