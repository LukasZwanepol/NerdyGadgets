<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant verwijderen</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["naam"] = isset($_GET["naam"]) ? $_GET["naam"] : "";
$gegevens["woonplaats"] = isset($_GET["woonplaats"]) ? $_GET["woonplaats"] : "";
$gegevens["nummer"] = isset($_GET["nummer"]) ? $_GET["nummer"] : "";

if (isset($_GET["verwijderen"])) {
//    print "hier komt die wel";
    $gegevens = klantGegevensVerwijderen($gegevens);
}
?>
<h1>Klant verwijderen</h1><br><br>
<h2>Wilt u <?php print($gegevens["naam"]);?> verwijderen?</h2>
<form method="get" action="verwijderenklant.php">
    <button type="submit" name="verwijderen" value="Verwijderen">Verwijderen</button>
</form>
<br><?php print_r($gegevens); ?><br>
<a href="BekijkenOverzicht.php">Terug naar het overzicht</a>
</body>
</html>