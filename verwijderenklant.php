<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant verwijderen</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["CustomerName"] = isset($_GET["CustomerName"]) ? $_GET["CustomerName"] : "";
$gegevens["CustomerID"] = isset($_GET["CustomerID"]) ? $_GET["CustomerID"] : "";

if (isset($_GET["verwijderen"])) {
    $gegevens = klantGegevensVerwijderen($gegevens);
}
?>
<h1>Klant verwijderen</h1><br><br>

<?php if($gegevens["CustomerName"] !== "") {        //Hier wordt gecheckt of de naam bestaat (isset werkt niet)
    print '<h2>Wilt u ';
    print($gegevens["CustomerName"]);
    print ' verwijderen?</h2>';             //Hier wordt gevraagd of de bezoeker de klant wil verwijderen

    print '<form method="get" action="verwijderenklant.php">
    <button type="submit" name="verwijderen" value="Verwijderen">Verwijderen</button>
    <input type="hidden" name="CustomerID" value="';
    print($gegevens["CustomerID"]);
    print '" />
    </form>';                               //Hier wordt de knop verwijderen geprint

} else {
    print $gegevens['melding'];             //Hier wordt de melding geprint
}
?>

<a href="BekijkenOverzicht.php">Terug naar het overzicht</a>
</body>
</html>