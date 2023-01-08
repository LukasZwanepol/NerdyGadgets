<?php

include "cartfuncties.php";
include "orderFuncties.php";
include "adresfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);

$cart = getCart();
$totalShoppingValue = 0;

$adresgegevens = array("naam" => "", "persoonID" => "", "telefoonnummer" => "", "telefoonnummer2" => "", "adres" => "",  "adres2" => "", "huisnummer" => "", "postcode" => "", "postcode2" => "", "woonplaats" => "");


if($_SESSION["loggedin"] ) {
//    print "hoi1";
    if (empty(checkPersonID($_SESSION["userid"]))) {
//        print "hoi2";
        if (isset($_POST["submit"])) {
            $adresgegevens["naam"] = $_POST["naam"] ?? "";
            $adresgegevens["persoonID"] = $_SESSION["userid"] ?? "";
            $adresgegevens["telefoonnummer"] = $_POST["telefoonnnummer"] ?? "";
            $adresgegevens["telefoonnummer2"] = $_POST["telefoonnnummer"] ?? "";
            $adresgegevens["adres"] = $_POST["adres"] ?? "";
            $adresgegevens["adres2"] = $_POST["adres"] ?? "";
            $adresgegevens["huisnummer"] = $_POST["huisnummer"] ?? "";
            $adresgegevens["postcode"] = $_POST["postcode"] ?? "";
            $adresgegevens["postcode2"] = $_POST["postcode"] ?? "";
            $adresgegevens["woonplaats"] = $_POST["woonplaats"] ?? "";
//            print "hoi3";
//            addCustomerData($adresgegevens);
//            print_r($adresgegevens);
        }
    }
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-7 rounded p-4 m-2" id="CheckoutData">
            <h1 class="text-center p-0 py-2 bg-transparent" style="color: #676EFF;">Persoonsgegevens</h1>
            <form class="p-2" method="post" action="Order.php">
                <br>
                <div class="form-group">
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Voornaam + Achternaam:</h5></div>
                        <input class="form-control w-75" name="Naam" value="<?php print($adresgegevens["naam"]) ?>" required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Telefoonnummer:</h5></div>
                        <input class="form-control w-75" name="Telefoonnummer" value="<?php print($adresgegevens["telefoonnummer"]) ?>"required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h6>Adres + huisnummer:</h6></div>
                        <input class="form-control w-50" name="Adres" value="<?php print($adresgegevens["adres"]) ?>"required>
                        <input class="form-control w-25" name="Nummer" value="<?php print($adresgegevens["huisnummer"]) ?>"required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Postcode:</h5></div>
                        <input class="form-control w-75" name="Postcode" pattern="[0-9]{4}[A-Z]{2}" value="<?php print($adresgegevens["postcode"]) ?>"required>
                    </div>
                    <div class="form-group row px-3">
                        <div class="w-25 bg-transparent"><h5>Woonplaats:</h5></div>
                        <input class="form-control w-75" name="Woonplaats" value="<?php print($adresgegevens["woonplaats"]) ?>"required>
                    </div>
                </div>
                <br>
                <input style="margin-left: 65%; background-color: #676EFF; border-radius: 12px; width: 220px; height: 50px; border: 1px rgba(35, 40, 47, 0.8);" type="submit" name="submit" value="Naar bestellingsoverzicht">
            </form>
        </div>
    </div>
</div>