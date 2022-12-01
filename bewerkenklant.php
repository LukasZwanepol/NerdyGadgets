<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant bewerken</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["nummer"] = isset($_POST["nummer"]) ? $_POST["nummer"] : "";
$gegevens["voornaam"] = isset($_POST["voornaam"]) ? $_POST["voornaam"] : "";
$gegevens["achternaam"] = isset($_POST["achternaam"]) ? $_POST["achternaam"] : "";
$gegevens["straatnaam"] = isset($_POST["straatnaam"]) ? $_POST["straatnaam"] : "";
$gegevens["huisnummer"] = isset($_POST["huisnummer"]) ? $_POST["huisnummer"] : "";
$gegevens["postcode"] = isset($_POST["postcode"]) ? $_POST["postcode"] : "";
$gegevens["woonplaats"] = isset($_POST["woonplaats"]) ? $_POST["woonplaats"] : "";

if (isset($_POST["bewerken"])) {
    $gegevens = klantGegevensBewerken($gegevens);
}
?>
<h1>Klant bewerken</h1><br><br>
<form method="POST" action="bewerkenklant.php">
    <label>Nummer</label>
    <input type="text" name="nummer" value="<?php print($gegevens["nummer"]); ?>" disabled/>
    <label>Voornaam</label>
    <input type="text" name="voornaam" value="<?php print($gegevens["voornaam"]); ?>" />
    <label>Achternaam</label>
    <input type="text" name="achternaam" value="<?php print($gegevens["achternaam"]); ?>" />
    <label>Straatnaam</label>
    <input type="text" name="straatnaam" value="<?php print($gegevens["straatnaam"]); ?>" />
    <label>Huisnummer</label>
    <input type="text" name="huisnummer" value="<?php print($gegevens["huisnummer"]); ?>" />
    <label>Postcode</label>
    <input type="text" name="postcode" value="<?php print($gegevens["postcode"]); ?>" />
    <label>Woonplaats</label>
    <input type="text" name="woonplaats" value="<?php print($gegevens["woonplaats"]); ?>" />
    <input type="submit" name="bewerken" value="Bewerken" />
</form>
<br><?php print $gegevens["melding"]; print_r($_POST);?><br>
<a href="bekijkenoverzicht.php">Terug naar het overzicht</a>
</body>
</html>