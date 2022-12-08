<?php

function alleKlantenOpvragen() {
    $connection = connectToDatabase();
    $klanten = selecteerKlanten($connection);
    sluitVerbinding($connection);
    return $klanten;
}

function toonKlantenOpHetScherm($klanten) {
    foreach ($klanten as $klant) {
        print("<tr>");
        print("<td>".$klant["CustomerID"]."</td>");
        print("<td>".$klant["CustomerName"]."</td>");
        print("<td>".$klant["DeliveryAddressLine1"]."</td>");
        print("<td>".$klant["DeliveryAddressLine2"]."</td>");
        print("<td>".$klant["DeliveryPostalCode"]."</td>");
        print("<td>".$klant["PostalAddressLine1"]."</td>");
        print("<td>".$klant["PostalAddressLine2"]."</td>");
        print("<td><a href=\"BewerkenKlant.php?CustomerID=".$klant["CustomerID"]."&CustomerName=".$klant["CustomerName"]."&DeliveryAddressLine1=".$klant["DeliveryAddressLine1"]."&DeliveryAddressLine2=".$klant["DeliveryAddressLine2"]."&DeliveryPostalCode=".$klant["DeliveryPostalCode"]."&PostalAddressLine1=".$klant["PostalAddressLine1"]."&PostalAddressLine2=".$klant["PostalAddressLine2"]."\">Bewerk</a></td>");
        print("<td><a href=\"VerwijderenKlant.php?CustomerName=".$klant["CustomerName"]."&CustomerID=".$klant["CustomerID"]."\">Verwijder</a></td>");
        print("</tr>");
    }
}

$gegevens = array("CustomerID" => "", "CustomerName" => "", "DeliveryAddressLine1" => "", "DeliveryAddressLine2" => "", "DeliveryPostalCode" => "", "PostalAddressLine1" => "", "PostalAddressLine2" => "", "melding" => "");

function klantGegevensToevoegen($gegevens) {
    $connection = connectToDatabase();
    if (voegKlantToe($connection, $gegevens["CustomerName"], $gegevens["DeliveryAddressLine1"], $gegevens["DeliveryAddressLine2"], $gegevens["DeliveryPostalCode"], $gegevens["PostalAddressLine1"], $gegevens["PostalAddressLine2"]) == True) {
        $gegevens["melding"] = "De klant is toegevoegd";
    } else {
        $gegevens["melding"] = "Het toevoegen is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function voegKlantToe($connection, $customerName, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2) {
    $statement = mysqli_prepare($connection, "
        INSERT INTO customers(customerName, deliveryAddressLine1, deliveryAddressLine2, deliveryPostalCode, postalAddressLine1, postalAddressLine2) 
        values (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, 'ssssss', $customerName, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function klantGegevensBewerken($gegevens) {
    $connection = connectToDatabase();
    if (bewerkenKlant($connection, $gegevens["CustomerName"], $gegevens["DeliveryAddressLine1"], $gegevens["DeliveryAddressLine2"], $gegevens["DeliveryPostalCode"], $gegevens["PostalAddressLine1"], $gegevens["PostalAddressLine2"], $gegevens["CustomerID"]) == True) {
        $gegevens["melding"] = "De klant is bewerkt";
    } else {
        $gegevens["melding"] = "Het bewerken is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function bewerkenKlant($connection, $customerName, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2, $customerID) {
    $statement = mysqli_prepare($connection, "UPDATE customers SET customerName = ?, deliveryAddressLine1 = ?, deliveryAddressLine2 = ?, deliveryPostalCode = ?, postalAddressLine1 = ?, postalAddressLine2 = ? WHERE customerID = ?");
    mysqli_stmt_bind_param($statement, 'sssssss', $customerName, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2, $customerID);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function klantGegevensVerwijderen($gegevens) {
    $connection = connectToDatabase();
    if (verwijderenKlant($connection,$gegevens["CustomerID"]) == True) {
        $gegevens["melding"] = "<h2>De klant is verwijderd</h2>";
    } else {
        $gegevens["melding"] = "<h2>Het verwijderen is mislukt</h2>";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function verwijderenKlant($connection, $customerID) {
    $statement = mysqli_prepare($connection, "DELETE FROM customers WHERE customerID = ?");
    mysqli_stmt_bind_param($statement, 'i', $customerID);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}