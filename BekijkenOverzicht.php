
<!DOCTYPE html>
<html>
    <head><meta charset="UTF-8"><title>Klantenoverzicht</title></head>
    <body>
        <?php
        include __DIR__ . "/header.php";
        include 'klantfuncties.php';
        $klanten = alleKlantenOpvragen();
        ?>
        <h1>Klanten overzicht</h1>
        <br>
        <p><a href="toevoegenklant.php">Klant toevoegen</a></p>
        <table>
            <thead>
                <tr><th>Nr</th><th>Naam</th><th>Telefoonnummer</th><th></th><th>Adres</th><th>Postcode</th><th></th><th>Woonplaats</th></tr>
            </thead>
            <tbody>
                <?php toonKlantenOpHetScherm($klanten); ?>
            </tbody>
        </table>
    </body>
</html>
