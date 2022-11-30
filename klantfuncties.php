<?php

function alleKlantenOpvragen() {
    $connection = maakVerbinding();
    $klanten = selecteerKlanten($connection);
    sluitVerbinding($connection);
    return $klanten;
}

function toonKlantenOpHetScherm($klanten) {
    foreach ($klanten as $klant) {
        print("<tr>");
        print("<td>".$klant["nummer"]."</td>");
        print("<td>".$klant["voornaam"]."</td>");
        print("<td>".$klant["achternaam"]."</td>");
        print("<td>".$klant["woonplaats"]."</td>");
        print("<td><a href=\"BewerkenKlant.php?nummer=".$klant["nummer"]."&voornaam=".$klant["voornaam"]."&woonplaats=".$klant["woonplaats"]."\">Bewerk</a></td>");
        print("<td><a href=\"VerwijderenKlant.php?nummer=".$klant["nummer"]."&voornaam=".$klant["voornaam"]."&woonplaats=".$klant["woonplaats"]."\">Verwijder</a></td>");
        print("</tr>");
    }
}

$gegevens = array("nummer" => "", "voornaam" => "", "woonplaats" => "", "melding" => "");

function klantGegevensToevoegen($gegevens) {
    $connection = maakVerbinding();
    if (voegKlantToe($connection, $gegevens["voornaam"], $gegevens["woonplaats"]) == True) {
        $gegevens["melding"] = "De klant is toegevoegd";
    } else {
        $gegevens["melding"] = "Het toevoegen is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function voegKlantToe($connection, $voornaam, $woonplaats) {
    $statement = mysqli_prepare($connection, "INSERT INTO klant (voornaam, woonplaats) VALUES(?,?)");
    mysqli_stmt_bind_param($statement, 'ss', $voornaam, $woonplaats);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function klantGegevensBewerken($gegevens) {
    $connection = maakVerbinding();
    if (bewerkenKlant($connection, $gegevens["voornaam"], $gegevens["woonplaats"], $gegevens["nummer"]) == True) {
        $gegevens["melding"] = "De klant is bewerkt";
    } else {
        $gegevens["melding"] = "Het bewerken is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function bewerkenKlant($connection, $voornaam, $woonplaats, $nummer) {
    $statement = mysqli_prepare($connection, "UPDATE klant SET voornaam = ?, woonplaats = ? WHERE nummer = ?");
    mysqli_stmt_bind_param($statement, 'sss', $voornaam, $woonplaats, $nummer);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function klantGegevensVerwijderen($gegevens) {
    $connection = maakVerbinding();
    if (verwijderenKlant($connection,$gegevens["nummer"]) == True) {
        $gegevens["melding"] = "<h2>De klant is verwijderd</h2>";
    } else {
        $gegevens["melding"] = "<h2>Het verwijderen is mislukt</h2>";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function verwijderenKlant($connection, $nummer) {
    $statement = mysqli_prepare($connection, "DELETE FROM klant WHERE nummer = ?");
    mysqli_stmt_bind_param($statement, 'i', $nummer);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}