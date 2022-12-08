<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Klant bewerken</title></head>
<body>
<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';

$gegevens["CustomerID"] = isset($_GET["CustomerID"]) ? $_GET["CustomerID"] : "";
$gegevens["CustomerName"] = isset($_GET["CustomerName"]) ? $_GET["CustomerName"] : "";
$gegevens["DeliveryAddressLine1"] = isset($_GET["DeliveryAddressLine1"]) ? $_GET["DeliveryAddressLine1"] : "";
$gegevens["DeliveryAddressLine2"] = isset($_GET["DeliveryAddressLine2"]) ? $_GET["DeliveryAddressLine2"] : "";
$gegevens["DeliveryPostalCode"] = isset($_GET["DeliveryPostalCode"]) ? $_GET["DeliveryPostalCode"] : "";
$gegevens["PostalAddressLine1"] = isset($_GET["PostalAddressLine1"]) ? $_GET["PostalAddressLine1"] : "";
$gegevens["PostalAddressLine2"] = isset($_GET["PostalAddressLine2"]) ? $_GET["PostalAddressLine2"] : "";

if (isset($_GET["bewerken"])) {
    $gegevens = klantGegevensBewerken($gegevens);
}
?>
<h1>Klant bewerken</h1><br><br>
<form method="get" action="bewerkenklant.php">
    <label>Customer Name</label>
    <input type="text" name="CustomerName" value="<?php print($gegevens["CustomerName"]); ?>" />
    <label>Delivery Address Line 1</label>
    <input type="text" name="DeliveryAddressLine1" value="<?php print($gegevens["DeliveryAddressLine1"]); ?>" />
    <label>Delivery Address Line 2</label>
    <input type="text" name="DeliveryAddressLine2" value="<?php print($gegevens["DeliveryAddressLine2"]); ?>" />
    <label>Delivery Postal Code</label>
    <input type="text" name="DeliveryPostalCode" value="<?php print($gegevens["DeliveryPostalCode"]); ?>" />
    <label>Postal Address Line 1</label>
    <input type="text" name="PostalAddressLine1" value="<?php print($gegevens["PostalAddressLine1"]); ?>" />
    <label>Postal Address Line 2</label>
    <input type="text" name="PostalAddressLine2" value="<?php print($gegevens["PostalAddressLine2"]); ?>" />
    <input type="hidden" name="CustomerID" value="<?php print($gegevens["CustomerID"]); ?>" />
    <br><br>
    <input type="submit" name="bewerken" value="Bewerken" />
</form>
<br><?php print $gegevens["melding"]; ?><br>
<a href="bekijkenoverzicht.php">Terug naar het overzicht</a>
</body>
</html>