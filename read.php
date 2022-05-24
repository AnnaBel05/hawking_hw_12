<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
</head>
<body>

<?php
if (isset($_GET["id"]) && !empty( $_GET['id'] ) ) {
    $link = mysqli_connect('localhost', 'belphie', 'B_26_foreva','genshin_characters');
        if (!$link) { echo('Ошибка соединения'); }
        else { echo('Успешно установлено'); }

    $id_db = mysqli_real_escape_string($link,$_GET['id']);
    $res = mysqli_query($link,"SELECT Characters.id, Characters.character_name, Characters.character_rarity, weapons.weapon_type, weapons.weapon_name, elements.element_name FROM `Characters` JOIN `weapons` ON weapons.id = Characters.character_weapon JOIN `elements` ON elements.id = Characters.character_element WHERE Characters.id=$id_db;");  

    if($res) {
        $row = mysqli_fetch_assoc($res);
        // echo '<label>Character name</label>';
        // echo $row['character_name'];
        // echo $row['character_rarity'];
        // echo $row['weapon_type'];
        // echo $row['weapon_name'];
        // echo $row['element_name'];
        $character_name = $row['character_name'];
        $character_rarity = $row['character_rarity'];
        $weapon_type = $row['weapon_type'];
        $weapon_name = $row['weapon_name'];
        $element_name = $row['element_name'];

        mysqli_free_result($res);
    }

    mysqli_close($link);
}
else {
    // header("location: hw_12.php");
    // exit();
}
?>

    <h1>View Record</h1>
        <div class="form-group">
            <label>Character name</label>
            <p><b><?php echo $character_name ?></b></p>
        </div>
        <div class="form-group">
            <label>Character rarity</label>
            <p><b><?php echo $character_rarity ?></b></p>
        </div>
        <div class="form-group">
            <label>Weapon type</label>
            <p><b><?php echo $weapon_type ?></b></p>
        </div>
        <div class="form-group">
            <label>Weapon name</label>
            <p><b><?php echo $weapon_name ?></b></p>
        </div>
        <div class="form-group">
            <label>Element name</label>
            <p><b><?php echo $element_name ?></b></p>
        </div>
    <p><a href="hw_12.php" class="btn btn-primary">Back</a></p>

</body>
</html>