<form action= "/auth/signin" method="POST">
	<label>Никнейм</label>
	<label>
		<input type="text" name="login" placeholder="Введите никнейм" required>
	</label>
	<label>Пароль</label>
	<label>
		<input type="password" name="password" placeholder="Введите пароль" required>
	</label>
	<input class="button" type="submit" value="Вход в систему">
	<label class="report"><?php echo $data['message']['auth'] ?></label>
</form>