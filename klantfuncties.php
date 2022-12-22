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
        print("<td>".$klant["PhoneNumber"]."</td>");
        print("<td>".$klant["DeliveryAddressLine1"]."</td>");
        print("<td>".$klant["DeliveryAddressLine2"]."</td>");
        print("<td>".$klant["DeliveryPostalCode"]."</td>");
        print("<td>".$klant["PostalAddressLine1"]."</td>");
        print("<td>".$klant["PostalAddressLine2"]."</td>");
        print("<td style='display-none'>".$klant["PostalPostalCode"]."</td>");
        print("<td><a href=\"BewerkenKlant.php?CustomerID=".$klant["CustomerID"]."&CustomerName=".$klant["CustomerName"]."&PhoneNumber=".$klant["PhoneNumber"]."&DeliveryAddressLine1=".$klant["DeliveryAddressLine1"]."&DeliveryAddressLine2=".$klant["DeliveryAddressLine2"]."&DeliveryPostalCode=".$klant["DeliveryPostalCode"]."&PostalAddressLine1=".$klant["PostalAddressLine1"]."&PostalAddressLine2=".$klant["PostalAddressLine2"]."&PostalPostalCode=".$klant["PostalPostalCode"]."\">Bewerk</a></td>");
        print("<td><a href=\"VerwijderenKlant.php?CustomerName=".$klant["CustomerName"]."&CustomerID=".$klant["CustomerID"]."\">Verwijder</a></td>");
        print("</tr>");
    }
}

$gegevens = array("CustomerID" => "", "CustomerName" => "", "PhoneNumber" => "", "PhoneNumber2" => "", "DeliveryAddressLine1" => "", "DeliveryAddressLine2" => "", "DeliveryPostalCode" => "", "PostalAddressLine1" => "", "PostalAddressLine2" => "", "PostalPostalCode" => "", "melding" => "");

function klantGegevensToevoegen($gegevens) {
    $connection = connectToDatabase();
    if (voegKlantToe($connection, $gegevens["CustomerName"], $gegevens["PhoneNumber"], $gegevens["PhoneNumber2"], $gegevens["DeliveryAddressLine1"], $gegevens["DeliveryAddressLine2"], $gegevens["DeliveryPostalCode"], $gegevens["PostalAddressLine1"], $gegevens["PostalAddressLine2"], $gegevens["PostalPostalCode"]) == True) {
        $gegevens["melding"] = "De klant is toegevoegd";
    } else {
        $gegevens["melding"] = "Het toevoegen is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function voegKlantToe($connection, $customerName, $phoneNumber, $phoneNumber2, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2, $postalPostalCode) {
    $statement = mysqli_prepare($connection, "
        INSERT INTO customers
        values (NULL,
                ?, 
                (select count(*) + 399), 
                (select FLOOR(3 + RAND() * 5)), 
                '0',
                (select count(*) + 1598), 
                '0', 
                '3', 
                (select FLOOR(1 + RAND() * 37940)), 
                (select FLOOR(1 + RAND() * 37940)), 
                (select FLOOR(10 + RAND() * 31)), 
                (select current_date()), 
                '0,000', 
                '0', 
                '0', 
                '7', 
                ?, 
                ?, 
                NULL, 
                NULL, 
                'https://microsoft.com/', 
                ?,
                ?,
                ?,
                NULL, 
                ?,
                ?,
                ?,
                '1', 
                (select current_date()), 
                '9999-12-31 23:59:59'
                );
                ");
    mysqli_stmt_bind_param($statement, 'siissssss', $customerName, $phoneNumber, $phoneNumber2, $deliveryAddressLine1, $deliveryAddressLine2, $deliveryPostalCode, $postalAddressLine1, $postalAddressLine2, $postalPostalCode);
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
    if (verwijderenKlant($connection, $gegevens["CustomerID"]) == True) {
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