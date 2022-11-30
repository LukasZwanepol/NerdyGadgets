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
        <div class="col-5 border rounded p-0 m-2">
            <h4 class="text-center p-0 py-2 border bg-light text-dark">Persoonsgegevens </h4>
            <form class="p-2">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Naam</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Voornaam"])) {print ($_POST["Voornaam"]." ".$_POST["Achternaam"]);} ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Adres</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Adres"])) {print ($_POST["Adres"]. " ".$_POST["Nummer"]);} ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Postcode</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Postcode"])) {print ($_POST["Postcode"]);} ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Woonplaats</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Woonplaats"])) {print ($_POST["Woonplaats"]);} ?></p>
                    </div>
                    <!--
                    <div class="form-group row px-3">
                        <input class="form-control w-25" disabled placeholder="Naam">
                        <input class="form-control w-75">
                    </div>
                    <div class="form-group row px-3">
                        <input class="form-control w-25" disabled placeholder="Adress">
                        <input class="form-control w-75">
                    </div>
                    <div class="form-group row px-3">
                        <input class="form-control w-25" disabled placeholder="Postcode">
                        <input class="form-control w-75">
                    </div>
                    <div class="form-group row px-3">
                        <input class="form-control w-25" disabled placeholder="Woonplaats">
                        <input class="form-control w-75">
                    </div>-->
                </div>
            </form>
        </div>
        <div class="col-5 border rounded m-2 p-0">
            <h4 class="text-center p-0 py-2 border bg-light text-dark">Betalings gegevens </h4>
            <form class="p-2" method="post">
                <div class="form-group">
                    <!--<div class="form-group row px-5">
                        <input class="form-control w-50 text-center mb-2" disabled placeholder="Bestelgegevens">
                        <input class="form-control w-100">
                    </div> -->
                    <div class="form-group row px-5">
                        <input class="form-control w-50 text-center mb-2" disabled placeholder="Betaalwijze">
                        <select class="form-select w-100" id="floatingSelectGrid" name="BetaalOptie">
                            <option selected value="0" name="Select">Selecteer betaalwijze</option>
                            <option value="1" name="Ideal">Ideal</option>
                            <option value="2" disabled name="Credit card">Credit card</option>
                        </select>
                        <!dropdown menu met ideal en credit card ofzo>
                    </div>
                    <!--<div class="form-group d-flex justify-content-end px-4">
                        <button class="form-control w-25 h-100">Bestellen</button>
                    </div>
                    -->
                </div>
            </form>
        </div>
    </div>
    <div class="orderProduct m-4 rounded border">
        <div class="row">
            <div class="col-12 text-center pt-3"><h2>Bestelling</h2></div>
            <div class="col-1"></div>
            <div class="col-10">
                <h3 class="px-5">Producten: </h3>
            </div>
            <div class="col-1"></div>
            <div class="col-12 d-flex justify-content-center">
                <form>
                    <?php
                        foreach($cart as $key => $amount){
                            $Items = getStockItem($key, $databaseConnection);
                    ?>
                    <div class="form-group row">
                        <div class="form-group">
                            <?php
                        if (isset($StockItemImage)) {
                            // één plaatje laten zien
                            if (count($StockItemImage) == 1) {
                                ?>
                                <div id="ImageFrame" class="form-control h-100" style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-repeat: no-repeat; background-position: center;"></div>
                                <?php
                            }
                        } else {
                            ?>
                            <div id="ImageFrame" class="form-control h-100"
                                style="background-image: url('Public/StockGroupIMG/<?php print $Items['BackupImagePath']; ?>'); background-size: cover;"></div>
                            <?php
                        }
                        ?>
                            <!-- <img src="..." alt="..." class="form-control h-100"> -->
                        </div>
                        <div class="form-group w-25 ">
                            <label class="form-control h-100"><?php print($Items['StockItemName'])?></label>
                        </div>
                        <div class="form-group">
                            <label class="form-control h-100 align-middle text-center">Aantal : <?php print($amount) ?></label>
                        </div>
                        <div class="form-group">
                            <button class="form-control h-100">Verwijder</button>
                        </div>
                        <div class="form-group">
                            <label class="form-control h-100"><?php print(round($Items['SellPrice'], 2))?></label>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </form>
            </div>
            <!--
            <div class="col-2"></div>
            <div class="col-4 mx-2 mb-4 border rounded">
                <h4>Verzendkosten : </h4>
            </div>
            -->
            <div class="col-6"></div>
            <div class="col-4 mx-4 mb-4 border rounded">
                <h4 > Prijs : <?php $total = $amount * $Items['SellPrice']; $totalShoppingValue += $total; print(round($totalShoppingValue, 2));?> </h4>
            </div>
            <div class="col-10"></div>
            <div class="form-group">
                <form method="post">
                <button type="submit" name="Bestellen" class="btn btn-primary" tabindex="-1">Bestellen</button>
                </form>
            </div>
            <?php
            $betaalSelected = false;
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Ideal'])){
                echo '<script>console.log("Optie ingevuld!"); </script>';
                $betaalSelected = true;
            }
            if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Bestellen'])){

                echo '<script>console.log("Bestellen ingedrukt"); </script>';
                if (isset($_POST['BetaalOptie']) != "0"){
                    echo '<script>console.log("Optie ingevuld!"); </script>';
                }

            }
            ?>
        </div>
    </div>
</div>