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
                        <input form="reg" type="number" min="0" max="99" name="experience" id="nameexperience" required="required" placeholder="Стаж"/>
                    </label>
                </div>
                <form id="reg" class="data" method="POST" enctype="multipart/form-data" action="/reg/signup">
                    <!--label>
                        <input name="File" type="file" class="Addfile"/>
                    </label-->
                    <label>
                        <input type="text" name="name" id="name" required="required" placeholder="ФИО"/>
                    </label>
                    <br>
                    <label>
                        <input type="text" name="nickname" id="namelogin" required="required" placeholder="Логин"/>
                        <br>
                    </label>
                    <label>
                        <input type="password" name="password" id="namepassword" required="required" placeholder="Пароль"/>
                    </label>
                    <br>
                    <label>
                        <input type="password" name="password2" id="namepassword" placeholder="Повторите пароль"/>
                    </label>
                    <br>
                    <label>
                        <input type="text" name="email" id="namecontacts" required="required" placeholder="Контакты"/>
                    </label>
                    <br>
                    <label>
                        <input type="text" name="motorbike" id="namemoto" placeholder="Мотоцикл"/>
                    </label>
                </form>
            </div>
        </div>
    </div>
    <div class="enters-windows">
        <div class="signups">
            <label>
                <input form="reg" class="signUp" type="submit" value="Применить">
            </label>
        </div>
    </div>
</div>
</body>
</html>