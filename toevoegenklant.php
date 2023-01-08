<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant toevoegen</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';
if (isset($_GET["toevoegen"])) {
    $gegevens["CustomerName"] = $_GET["CustomerName"] ?? "";
    $gegevens["PhoneNumber"] = $_GET["PhoneNumber"] ?? "";
    $gegevens["PhoneNumber2"] = $_GET["PhoneNumber"] ?? "";
    $gegevens["DeliveryAddressLine1"] = $_GET["DeliveryAddressLine1"] ?? "";
    $gegevens["DeliveryAddressLine2"] = $_GET["DeliveryAddressLine2"] ?? "";
    $gegevens["DeliveryPostalCode"] = $_GET["DeliveryPostalCode"] ?? "";
    $gegevens["PostalAddressLine1"] = $_GET["DeliveryAddressLine2"] ?? "";
    $gegevens["PostalAddressLine2"] = $_GET["PostalAddressLine2"] ?? "";
    $gegevens["PostalPostalCode"] = $_GET["DeliveryPostalCode"] ?? "";
    $gegevens = klantGegevensToevoegen($gegevens);
}
?>

<h1>Klant toevoegen</h1><br>
<form method="get" action="toevoegenklant.php">
    <label>Klantnaam</label>
    <input type="text" name="CustomerName" value="<?php print($gegevens["CustomerName"]); ?>" />
    <label>Telefoonnummer</label>
    <input type="text" name="PhoneNumber" value="<?php print($gegevens["PhoneNumber"]); ?>" />
    <label>Huisnummer</label>
    <input type="text" name="DeliveryAddressLine1" value="<?php print($gegevens["DeliveryAddressLine1"]); ?>" />
    <label>Adres</label>
    <input type="text" name="DeliveryAddressLine2" value="<?php print($gegevens["DeliveryAddressLine2"]); ?>" />
    <label>Postcode</label>
    <input type="text" name="DeliveryPostalCode" value="<?php print($gegevens["DeliveryPostalCode"]); ?>" />
    <label>Woonplaats</label>
    <input type="text" name="PostalAddressLine2" value="<?php print($gegevens["PostalAddressLine2"]); ?>" />
    <br><br>
    <input type="submit" name="toevoegen" value="Toevoegen"/>
</form>
<br><?php print($gegevens["melding"]); ?><br>
<a href="bekijkenoverzicht.php">Terug naar het overzicht</a>
</body>
</html>