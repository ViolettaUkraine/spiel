<?php
require_once "datenbank.php";
include "class_Spieler.php";
include "class_Kampf.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kampfspiel</title>
    



    <style>
body {
    background-image: url("wp4049467.webp"), url("R.jfif");
    background-repeat: no-repeat, no-repeat;
    background-position: top left, top right;
    background-size: 750px auto, 750px auto;
    background-color:black;
    

    


}
@media screen and (max-width: 800px) {
  body {
    background-image: url("wp4049467.webp");
    background-color: lightgreen;
  }
}
        form, .result {
            background-color:rgb(25, 32, 131);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 0 20px white;
            width: 600px;
            margin: 20px auto;
            
        }
        h2, h3 {
            color:rgb(0, 132, 255);
            border-bottom: 1px solid #333;
            padding-bottom: 5px;
        }
        label {
            color:white;
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 7px;
            margin-top: 4px;
            border: none;
            border-radius: 10px;
            background-color: #333;
            color: white;
        }
        input[type="submit"] {
            margin-top: 25px;
            padding: 12px;
            width: 100%;
            background-color: rgb(0, 132, 255);
            color: #000;
            border: none;
            border-radius: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color:rgb(0, 163, 204);
        }
        .status-box, .birthday-box {
            background-color: #333;
            color: #fff;
            margin: 10px 0;
            padding: 15px;
            border-left: 5px solidrgb(0, 225, 255);
            border-radius: 15px;
        }
        .birthday-box {
            border-color:rgb(0, 225, 255);
        }
    </style>
</head>
<body>



<form method="POST">
    <h2>Spieler 1 eingeben</h2>
    <label>Name:</label>
    <input type="text" name="spieler1_name" required>
    <label>Lebenspunkte:</label>
    <input type="number" name="spieler1_lp" required>
    <label>Angriffswert:</label>
    <input type="number" name="spieler1_aw" required>

    <h2>Spieler 2 eingeben</h2>
    <label>Name:</label>
    <input type="text" name="spieler2_name" required>
    <label>Lebenspunkte:</label>
    <input type="number" name="spieler2_lp" required>
    <label>Angriffswert:</label>
    <input type="number" name="spieler2_aw" required>

    <input type="submit" value="Kampf starten">
</form>
<?php $db = new Datenbank('localhost', 'root', '', 'spiel_db'); ?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sp1 = new Spieler($_POST['spieler1_name'], $_POST['spieler1_lp'], $_POST['spieler1_aw']);
    $sp2 = new Spieler($_POST['spieler2_name'], $_POST['spieler2_lp'], $_POST['spieler2_aw']);

    echo "<div class='result'>";
    echo "<h2>Status der Spieler</h2>";
    $sp1->zeigeStatus();
    $sp2->zeigeStatus();

    echo "<h2>Geburtstag prüfen</h2>";
    $sp1->hatGeburtstag();
    $sp2->hatGeburtstag();
    echo "</div>";

    $kampf = new Kampf("Schwarze Arena");
    $kampf->kaempfe($sp1, $sp2);
    $gewinner=$kampf->kaempfe($sp1, $sp2);
    $spieler1_id = $db->savePlayer($sp1);
    $spieler2_id = $db->savePlayer($sp2);

    $db->saveFight($spieler1_id, $spieler2_id, $gewinner, $kampf->arena, $kampf->runden);}
?>





</body>
</html>