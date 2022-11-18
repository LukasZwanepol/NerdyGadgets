<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant bewerken</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["naam"] = isset($_GET["naam"]) ? $_GET["naam"] : "";
$gegevens["woonplaats"] = isset($_GET["woonplaats"]) ? $_GET["woonplaats"] : "";
$gegevens["nummer"] = isset($_GET["nummer"]) ? $_GET["nummer"] : "";

if (isset($_GET["bewerken"])) {
    $gegevens = klantGegevensBewerken($gegevens);
}
?>
<h1>Klant bewerken</h1><br><br>
<form method="get" action="bewerkenklant.php">
    <label>Nummer</label>
    <input type="text" name="nummer" value="<?php print($gegevens["nummer"]); ?>" />
    <label>Naam</label>
    <input type="text" name="naam" value="<?php print($gegevens["naam"]); ?>" />
    <label>Woonplaats</label>
    <input type="text" name="woonplaats" value="<?php print($gegevens["woonplaats"]); ?>" />
    <input type="submit" name="bewerken" value="Bewerken" />
</form>
<br><?php print $gegevens["melding"]; ?><br>
<a href="bekijkenoverzicht.php">Terug naar het overzicht</a>
</body>
</html>