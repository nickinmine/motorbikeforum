<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Войти</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/header.css" />
    <link rel="stylesheet" href="../../css/auth.css" />
</head>
<body>
<div class="page">
    <?php include_once "templates/header.php"?>
    <div class="Enter-window">
        <div class="window">
            <div class="window-text">
                <h2 class="Enter">Вход</h2>
                <form class="data" action= "/auth/signin" method="POST">
                    <label>
                        <input type="text" name="login" id="login" placeholder="Логин" required/>
                    </label>
                    <br/>
                    <label>
                        <input type="password" name="password" id="password" placeholder="Пароль"/>
                    </label>
                    <div class="mes"><?php echo $data['message']['auth'] ?></div>
                    <div class="mes">Нет аккаунта? <a class="mess" href="/reg">Зарегистрируйтесь</a></div>
                    <div class="signin">
                        <input class="sign" type="submit" value="Войти" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>