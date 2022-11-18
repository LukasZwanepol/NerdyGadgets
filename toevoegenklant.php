<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant toevoegen</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';
if (isset($_GET["toevoegen"])) {
    $gegevens["naam"] = isset($_GET["naam"]) ? $_GET["naam"] : "";
    $gegevens["woonplaats"] = isset($_GET["woonplaats"]) ? $_GET["woonplaats"] : "";
    $gegevens = klantGegevensToevoegen($gegevens);
}
?>

<h1>Klant toevoegen</h1><br><br>
<form method="get" action="toevoegenklant.php">
    <label>Naam</label>
    <input type="text" name="naam" value="<?php print($gegevens["naam"]); ?>" />
    <label>Woonplaats</label>
    <input type="text" name="woonplaats" value="<?php print($gegevens["woonplaats"]); ?>" />
    <input type="submit" name="toevoegen" value="Toevoegen" />
</form>
<br><?php print($gegevens["melding"]); ?><br>
<a href="bekijkenoverzicht.php">Terug naar het overzicht</a>
</body>
</html>