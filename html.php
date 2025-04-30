<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Spieler</h1>
    <?php include 'spiel.php';
    $spieler1 = new Spieler("Violeetta", 10, 10);
    $spieler1->zeigeStatus();
    $spieler1->hatGeburtstag();
    $spieler2 = new Spieler("Wolf", 10, 15);
    $spieler2->zeigeStatus();
    ?>
    </body>
</html>