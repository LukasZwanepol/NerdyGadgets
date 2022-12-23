<?php
include __DIR__ . "/header.php";
include 'klantfuncties.php';
$klanten = alleKlantenOpvragen();
?>
<div class="container">
    <h1>Klanten overzicht</h1>
    <br>
    <p><a href="toevoegenklant.php">Klant toevoegen</a></p>
    <table class="table">
        <thead>
            <tr>
                <th>Nr</th>
                <th>Naam</th>
                <th></th>
                <th>Adres</th>
                <th>Postcode</th>
                <th></th>
                <th>Woonplaats</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php toonKlantenOpHetScherm($klanten); ?>
        </tbody>
    </table>
</div>
