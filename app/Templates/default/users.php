<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li><?php echo $user->username; ?> <a href="<?php echo base_url("uyeler/sil/$user->uid"); ?>">Sil</a></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>