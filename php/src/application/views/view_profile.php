<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Профиль</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/header.css" />
    <link rel="stylesheet" href="../../css/reg.css" />
</head>
<body>
<div class="page">
    <?php include_once "templates/header.php"?>
    <div class="Enters-window">
        <h1>Редактирование профиля</h1>
        <div class="window">
            <div class="signup-window">
                <div class="addfile">
                    <div class="adfile">
                        <img src="../../images/appfile.png" alt="" />
                    </div>
                    <div class="take">Выберите фото</div>
                    <label>
                        <input form="edit" type="number" min="0" max="99" name="experience" id="nameexperience"
                               required="required" placeholder="Стаж"
                               value="<?php echo $data['user']['experience'] ?>"
                        />
                    </label>
                </div>
                <form id="edit" class="data" method="POST" enctype="multipart/form-data" action="/profile/edit">
                    <!--label>
                        <input name="File" type="file" class="Addfile"/>
                    </label-->
                    <label>
                        <input type="text" name="name" id="name" required="required" placeholder="ФИО"
                            value="<?php echo $data['user']['name'] ?>"
                        />
                    </label>
                    <br>
                    <label>
                        <input type="text" name="nickname" id="namelogin" required="required" placeholder="Логин"
                               value="<?php echo $data['user']['nickname'] ?>"
                        />
                        <br>
                    </label>
                    <label>
                        <input type="password" name="password" id="namepassword" placeholder="Пароль"/>
                    </label>
                    <br>
                    <label>
                        <input type="password" name="password2" id="namepassword" placeholder="Повторите пароль"/>
                    </label>
                    <br>
                    <label>
                        <input type="text" name="email" id="namecontacts" required="required" placeholder="Контакты"
                            value="<?php echo $data['user']['email'] ?>"
                        />
                    </label>
                    <br>
                    <label>
                        <input type="text" name="motorbike" id="namemoto" placeholder="Мотоцикл"
                               value="<?php echo $data['user']['motorbike'] ?>"
                        />
                    </label>
                </form>
            </div>
        </div>
    </div>
    <?php
    if ($data['message']['profile']) {
        echo '<div class="mes">' . $data['message']['profile'] . '</div>';
    }
    ?>
    <div class="enters-windows">
        <div class="signups">
            <label>
                <input form="edit" class="signUp" type="submit" value="Применить">
            </label>
        </div>
    </div>
</div>
</body>
</html>