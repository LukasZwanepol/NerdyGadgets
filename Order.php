<?php
    include "cartfuncties.php";
    include "orderFuncties.php";
    include __DIR__ . "/header.php";
    $StockGroups = getStockGroups($databaseConnection);
    $cart = getCart();
    $totalShoppingValue = 0;
    $total = 0;
?>
<div class="container">
    <div class="row justify-content-center">
        <!-- show overview of user data -->
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
                </div>
            </form>
        </div>
        <!-- show payment details -->
        <div class="col-5 border rounded m-2 p-0">
            <h4 class="text-center p-0 py-2 border bg-light text-dark">Betalings gegevens </h4>
            <form method="post" class="p-2">
                <div class="form-group">
                    <div class="form-group row px-5">
                        <input class="form-control w-50 text-center mb-2" disabled placeholder="Betaalwijze">
                        <select class="form-select w-100" id="floatingSelectGrid" name="BetaalOptie">
                            <option selected value="0" name="Select">Selecteer betaalwijze</option>
                            <option value="1" name="Ideal">Ideal</option>
                            <option value="2" disabled name="Credit card">Credit card</option>
                        </select>
                        <!dropdown menu met ideal en credit card ofzo>
                    </div>
                    <div class="form-group d-flex justify-content-end px-4">
                        <a href="https://www.ideal.nl/demo/qr/?app=ideal" class="button form-control w-25 h-100" type="submit">Bestellen</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Overview of your products -->
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
                    <!-- loop through each item in cart -->
                    <?php
                        foreach($cart as $key => $amount){
                            $Items = getStockItem($key, $databaseConnection);
                    ?>
                    <div class="form-group row">
                        <div class="form-group">
                            <?php
                            // check if item has image
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
                    <!-- on press button remove amount from stock -->
                    <?php
                            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                removeStockItemAmount($key, $amount, $databaseConnection);
                               // print '<meta http-equiv="refresh" content="0">';
                            }
                            // count total value of shopping cart items
                            $total += $amount * $Items['SellPrice'];
                        }

                    ?>
                </form>
            </div>
            <div class="col-6"></div>
            <!-- display total value of cart -->
            <div class="col-4 mx-4 mb-4 border rounded">
                <h4 > Prijs : <?php $totalShoppingValue += $total; print(round($totalShoppingValue, 2));?> </h4>
            </div>
            <div class="col-10"></div>
            <div class="form-group">
                <form method="post">

                </form>
            </div>
            <!-- ideal -->
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