<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant verwijderen</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["naam"] = isset($_POST["naam"]) ? $_POST["naam"] : "";
$gegevens["woonplaats"] = isset($_POST["woonplaats"]) ? $_POST["woonplaats"] : "";
$gegevens["nummer"] = isset($_POST["nummer"]) ? $_POST["nummer"] : "";

if (isset($_POST["verwijderen"])) {
    $gegevens = klantGegevensVerwijderen($gegevens);
}
?>
<h1>Klant verwijderen</h1><br><br>

<?php if($gegevens["naam"] !== "") {        //Hier wordt gecheckt of de naam bestaat (isset werkt niet)
    print '<h2>Wilt u ';
    print($gegevens["naam"]);
    print ' verwijderen?</h2>';             //Hier wordt gevraagd of de bezoeker de klant wil verwijderen

    print '<form method="POST" action="verwijderenklant.php">
    <button type="submit" name="verwijderen" value="Verwijderen">Verwijderen</button>
    <input type="hidden" name="nummer" value="';
    print($gegevens["nummer"]);
    print '" />
    </form>';                               //Hier wordt de knop verwijderen geprint

} else {
    print $gegevens['melding'];             //Hier wordt de melding geprint
}
?>

<a href="BekijkenOverzicht.php">Terug naar het overzicht</a>
</body>
</html>