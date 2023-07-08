<form action= "/forum/create" method="POST">
	<label>Заголовок темы</label>
	<label>
		<input type="text" name="header" required>
	</label>
	<label>Содержание темы</label>
	<label>
		<input type="text" name="content" required>
	</label>
    <label>Тэг</label>
    <label>
        <input type="text" name="tag" required>
    </label>
    <input class="button" type="submit" value="Опубликовать">
	<label class="report"><?php echo $data['message']['forum-create'] ?></label>
	<?php print_r($data['tag']) ?>
</form>