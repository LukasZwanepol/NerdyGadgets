<?php

function checkPersonID($personID) {
    $connection = connectToDatabase();
    $klanten = selecteerGegevens($connection, $personID);
    sluitVerbinding($connection);
    return $klanten;
}

function selecteerGegevens($connection, $personID) {
    $sql = "SELECT * FROM customers WHERE PrimaryContactPersonID = $personID ORDER BY customerID";
    $result = mysqli_fetch_all(mysqli_query($connection, $sql),MYSQLI_ASSOC);
    return $result;
}

function addCustomerData($adresgegevens) {
    $connection = connectToDatabase();
    addCustomer($connection, $adresgegevens["naam"], $adresgegevens["persoonID"], $adresgegevens["telefoonnummer"], $adresgegevens["telefoonnummer2"], $adresgegevens["huisnummer"], $adresgegevens["adres"], $adresgegevens["postcode"], $adresgegevens["adres2"], $adresgegevens["woonplaats"], $adresgegevens["postcode2"]);
    sluitVerbinding($connection);
    return $adresgegevens;
}

function addCustomer($connection, $naam, $persoonID, $telefoonnummer, $telefoonnummer2, $huisnummer, $adres, $postcode, $adres2, $woonplaats, $postcode2) {
    $statement = mysqli_prepare($connection, "
    
    INSERT INTO customers
    values (NULL,
            ?,
            (select count(*) + 399),
            (select FLOOR(3 + RAND() * 5)),
            '0',
            ?,
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
    mysqli_stmt_bind_param($statement, 'siiiissssss', $naam, $persoonID, $telefoonnummer, $telefoonnummer2, $huisnummer, $adres, $postcode, $adres2, $woonplaats, $postcode2);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}