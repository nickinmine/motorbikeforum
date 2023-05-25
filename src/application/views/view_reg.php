<form action= "/reg/signup" method="POST">
    <label>ФИО</label>
    <label>
        <input type="text" required="required" name="name" placeholder="Иванов Иван Иванович">
    </label>
    <label>Никнейм</label>
    <label>
        <input type="text" required="required" name="nickname" placeholder="Ник">
    </label>
    <label>Опыт заездов</label>
    <label>
        <input type="number" required="required" name="experience" placeholder="Количество">
    </label>
    <label>Электронная почта</label>
    <label>
        <input type="text" required="required" name="email" placeholder="email@example.com">
    </label>
    <label>Мотоцикл</label>
    <label>
        <input type="text" required="required" name="motorbike" placeholder="Модель">
    </label>
    <label>Пароль</label>
    <label>
        <input type="password" name="password" placeholder="Введите пароль" required>
    </label>
    <input class="button" type="submit" value="Регистрация">
    <label class="report"><?php echo $data['message']['reg'] ?></label>
</form>