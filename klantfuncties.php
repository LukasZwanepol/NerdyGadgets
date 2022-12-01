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
        print("<td>".$klant["straatnaam"]."</td>");
        print("<td>".$klant["huisnummer"]."</td>");
        print("<td>".$klant["postcode"]."</td>");
        print("<td>".$klant["woonplaats"]."</td>");
        print("<td>
        <form method='post' action='bewerkenklant.php' class='inline'>");
        print("<input type='hidden' name='nummer' value='");
        print($klant["nummer"]);        //Hier wordt met POST het nummer doorgegeven
        print("'>");
        print("<input type='hidden' name='voornaam' value='");
        print($klant["voornaam"]);        //Hier wordt met POST de voornaam doorgegeven
        print("'>");
        print("<input type='hidden' name='achternaam' value='");
        print($klant["achternaam"]);        //Hier wordt met POST de achternaam doorgegeven
        print("'>");
        print("<input type='hidden' name='straatnaam' value='");
        print($klant["straatnaam"]);        //Hier wordt met POST de achternaam doorgegeven
        print("'>");
        print("<input type='hidden' name='huisnummer' value='");
        print($klant["huisnummer"]);        //Hier wordt met POST de achternaam doorgegeven
        print("'>");
        print("<input type='hidden' name='postcode' value='");
        print($klant["postcode"]);        //Hier wordt met POST de achternaam doorgegeven
        print("'>");
        print("<input type='hidden' name='woonplaats' value='");
        print($klant["woonplaats"]);        //Hier wordt met POST de achternaam doorgegeven
        print("'>");
        print("<button type='submit' class='link-button'>
        Bewerken
        </button>                   
        </form>
        </td>");
        print("<td><a href=\"verwijderenklant.php\">Verwijder</a></td>");
        print("</tr>");
    }
}

$gegevens = array("nummer" => "", "voornaam" => "", "achternaam" => "", "straatnaam" => "", "huisnummer" => "", "postcode" => "", "woonplaats" => "", "melding" => "");

function klantGegevensToevoegen($gegevens) {
    $connection = maakVerbinding();
    if (voegKlantToe($connection, $gegevens["voornaam"], $gegevens["woonplaats"])) {
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
    if (bewerkenKlant($connection, $gegevens["nummer"], $gegevens["voornaam"], $gegevens["achternaam"], $gegevens["straatnaam"], $gegevens["huisnummer"], $gegevens["postcode"], $gegevens["woonplaats"])) {
        $gegevens["melding"] = "De klant is bewerkt";
    } else {
        $gegevens["melding"] = "Het bewerken is mislukt";
    }
    sluitVerbinding($connection);
    return $gegevens;
}

function bewerkenKlant($connection, $voornaam, $achternaam, $straatnaam, $huisnummer, $postcode, $woonplaats, $nummer) {
    $statement = mysqli_prepare($connection, "UPDATE klant SET voornaam = ?, achternaam = ?, straatnaam = ?, huisnummer = ?, postcode = ?, woonplaats = ? WHERE nummer = ?");
    mysqli_stmt_bind_param($statement, 'sssssss', $nummer, $voornaam, $achternaam, $straatnaam, $huisnummer, $postcode, $woonplaats);
    mysqli_stmt_execute($statement);
    return mysqli_stmt_affected_rows($statement) == 1;
}

function klantGegevensVerwijderen($gegevens) {
    $connection = maakVerbinding();
    if (verwijderenKlant($connection, $gegevens["nummer"])) {
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