<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Форум</title>
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/header.css" />
</head>
<body>
<div class="page">
    <?php include_once "templates/header.php"?>
    <div class="base">
        <div class="container">
            <div class="block">
                <div class="header-lines">
                    <div class="left-group">
                        <span class="News">Форум</span>
                        <a href="/" class="NEWtopic">Создать тему<img class="edit" src="../../images/editing.png" alt=""/></a>
                        <div>
                            <form method="POST" action="">
                                <label for="search">
                                    <input class="NEWtopic search-in" type="text" name="search" id="search" placeholder="Поиск по форуму">
                                </label>
                            </form>
                        </div>
                    </div>
                    <div class="right-group">
                        <a href="/" class="btn-main"><img class="arrow" src="../../images/main.png" alt="" /> На главную</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>