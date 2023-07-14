<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Главная</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/header.css" />
</head>
<body>
<div class="page">
    <?php include_once "templates/header.php"?>
    <div>
        <?php
            echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        ?>
    </div>
</div>
</body>
</html>
