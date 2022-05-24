<html>

<!--  -->

<?php
	
	<!-- строка соединения с БД -->

	$link = mysqli_connect('localhost', 'belphie', 'B_26_foreva','genshin_characters');

	if (!$link) { echo('Ошибка соединения'); }
	else { 

	<!-- отрисовка шапки таблицы для вывода данных -->

	echo '<table border="1">';
	echo '<thead>';
	echo '<tr>';
	echo '<th>No</th>';
	echo '<th>Имя персонажа</th>';
	echo '<th>Редкость</th>';
	echo '<th>Вид оружия</th>';
	echo '<th>Название оружия</th>';
	echo '<th>Элемент</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

	<!-- метод обработки пост-запроса на добавление новой записи в БД -->

	if(isset($_POST['name']) && isset($_POST['element']) && isset($_POST['weapon']) && isset($_POST['rarity'])) {
	$link = mysqli_connect('localhost', 'belphie', 'B_26_foreva','genshin_characters');
		if (!$link) { echo('Ошибка соединения'); }
		else { echo('Успешно установлено'); }

		$name = mysqli_real_escape_string($link,$_POST['name']);
		$element = mysqli_real_escape_string($link,$_POST['element']);
		$weapon = mysqli_real_escape_string($link,$_POST['weapon']);
		$rarity = mysqli_real_escape_string($link,$_POST['rarity']);

		$insertQuery = mysqli_query($link, "INSERT INTO Characters (character_name,character_element,character_weapon,character_rarity) VALUES ('$name',$element,$weapon,$rarity);");
		if (!mysqli_query($link,$insertQuery)) {
			header("Location: hw_12.php");
			echo "Success!";
		}
		else {
			echo "Error";
		}

		mysqli_close($link);
	}

	<!-- метод обработки гет-запроса на удаление записи из БД -->

	if(isset($_GET['id'])) {
		$link = mysqli_connect('localhost', 'belphie', 'B_26_foreva','genshin_characters');
		if (!$link) { echo('Ошибка соединения'); }
		else { echo('Успешно установлено'); }

		$id_db = mysqli_real_escape_string($link,$_GET['id']);
		$deleteQuery = mysqli_query($link, "DELETE FROM `Characters` WHERE id = $id_db");
		if (!mysqli_query($link,$deleteQuery)) {
			header("Location: hw_12.php");
		}
		else {
			echo "Error";
		}

		mysqli_close($link);
	}

	<!-- селект-запрос на выборку данных из таблицы Characters с учетом внешних ключей -->

	$res = mysqli_query($link,"SELECT Characters.id, character_name, character_rarity, weapons.weapon_type, weapons.weapon_name, elements.element_name FROM `Characters` JOIN `weapons` ON weapons.id = Characters.character_weapon JOIN `elements` ON elements.id = Characters.character_element;");

	<!-- вывод данных из БД -->

	if($res) {
	while($row = mysqli_fetch_assoc($res)) {
		echo '<form action="" method="GET">';
		echo '<tr>';
		echo '<td> <input name="id" value=' . $row["id"] . ' readonly></td>';
		echo '<td>' . $row['character_name'] . '</td>';
		echo '<td>' . $row['character_rarity'] . '</td>';
		echo '<td>' . $row['weapon_type'] . '</td>';
		echo '<td>' . $row['weapon_name'] . '</td>';
		echo '<td>' . $row['element_name'] . '</td>';
		echo '<td><input type="submit" value="Delete"> </form></td>';
		echo '<td><a href="read.php?id=' . $row['id'] . '" title="View Record"><input type="submit" name="View"></a></td>';
 		echo '</tr>';
	}
	echo '</tbody>';
	echo '</table>';

	mysqli_free_result($res); }

	mysqli_close($link);
}

?>

<!-- форма для создания новой записи в БД -->
<br>
<body>
	<form action="" method="POST">
	<p> Name:
	<input type="text" name="name"/></p>
	<p> Element:
	<input type="number" name="element"/></p>
	<p> Weapon:
	<input type="number" name="weapon"/></p>
	<p> Rarity:
	<input type="number" name="rarity"/></p>
	<input type="submit" value="Add"/>
</form>
</body>
</html>
