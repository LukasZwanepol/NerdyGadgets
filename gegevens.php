<?php

include "cartfuncties.php";
include "orderFuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);

$cart = getCart();
$totalShoppingValue = 0;

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 bg-transparent rounded p-0 m-2">
            <h1 class="text-left p-0 py-2 bg-transparent" style="color: #676EFF;">Persoonsgegevens:</h1>
            <form class="p-2" method="post" action="Order.php">
                <br>
                <div class="form-group">
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Voornaam:</h5></div>
                        <input class="form-control w-75" name="Voornaam" required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Achternaam:</h5></div>
                        <input class="form-control w-75" name="Achternaam" required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h6>Adres + huisnummer:</h6></div>
                        <input class="form-control w-50" name="Adres" required>
                        <input class="form-control w-25" name="Nummer" required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Postcode:</h5></div>
                        <input class="form-control w-75" name="Postcode" required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Woonplaats:</h5></div>
                        <input class="form-control w-75" name="Woonplaats" required>
                    </div>
                </div>
                <br>
                <input style="margin-left: 65%; background-color: #676EFF; border-radius: 12px; width: 220px; height: 50px; border: 1px rgba(35, 40, 47, 0.8);" type="submit" value="Naar bestellingsoverzicht">
            </form>
        </div>
    </div>
</div>