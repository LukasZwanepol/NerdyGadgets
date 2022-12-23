<?php
include "cartfuncties.php";
include "orderFuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
$cart = getCart();
$korting = getKorting();
$totalShoppingValue = 0;
$total = 0;
?>
<?php
if(!isset($_POST["Voornaam"])){
    header("Location: ./");
    die();
}else{
?>
<div class="container">
    <div class="row justify-content-center">
        <!-- show overview of user data -->
        <div class="orderForm col-5 border rounded p-0 m-2">
            <h4 class="text-center p-0 py-2 border bg-light text-dark">Persoonsgegevens </h4>
            <form class="p-2">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Naam</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Voornaam"])) {
                                print ($_POST["Voornaam"] . " " . $_POST["Achternaam"]);
                            } ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Adres</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Adres"])) {
                                print ($_POST["Adres"] . " " . $_POST["Nummer"]);
                            } ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Postcode</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Postcode"])) {
                                print ($_POST["Postcode"]);
                            } ?></p>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Woonplaats</span>
                        <p type="text" class="form-control"><?php if (isset($_POST["Woonplaats"])) {
                                print ($_POST["Woonplaats"]);
                            } ?></p>
                    </div>
                </div>
            </form>
        </div>
        <!-- show payment details -->
        <div class="orderForm col-5 border rounded m-2 p-0">
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
                        <a href="https://www.ideal.nl/demo/qr/?app=ideal" class="button form-control w-25 h-100"
                           type="submit">Bestellen</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Overview of your products -->
    <div class="orderForm row mb-4">
            <div class="col-12 text-center border rounded bg-light text-dark"><h2>Bestelling</h2></div>
            <div class="col-2"></div>
            <div class="col-8 py-4">
                <h3 class="px-5">Producten: </h3>
            </div>
            <div class="col-2"></div>
            <div class="col-12 d-flex justify-content-center p-3">
                <form>
                    <!-- loop through each item in cart -->
                    <?php
                        foreach($cart as $key => $amount){
                            $Items = getStockItem($key, $databaseConnection);
                    ?>
                    <div class="row formItems text-center align-middle">
                        <div class="col-5 p-0">
                            <?php
                            // check if item has image
                            if (isset($StockItemImage)) {
                                // één plaatje laten zien
                                if (count($StockItemImage) == 1) {
                                    ?>
                                    <div id="ImageFrame" class="form-control" style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-repeat: no-repeat; background-position: center;"></div>
<<<<<<< HEAD
                                    <?php
                                } else {
                                    ?>
                                    <div id="ImageFrame" class="form-control h-100"
                                         style="background-image: url('Public/StockGroupIMG/<?php print $Items['BackupImagePath']; ?>'); background-size: cover;"></div>
=======
>>>>>>> 95f7e78 (update styling toggle dark/light mode)
                                    <?php
                                }
                                ?>
                            }
                            ?>
                        </div>
                        <div class="col-3 p-0">
                            <p class="form-control h-100"><?php print($Items['StockItemName'])?></p>
                        </div>
                        <div class="col-2 p-0">
                            <label class="form-control h-100 align-self-center">Aantal : <?php print($amount) ?></label>
                        </div>
                        <div class="col-2 p-0">
                            <label class="form-control h-100 align-self-center"><?php print(round($Items['SellPrice'], 2))?></label>
                        </div>
                    </div>
                    <!-- on press button remove amount from stock -->
                    <?php
                            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                removeStockItemAmount($key, $amount, $databaseConnection);
                            }
                            // count total value of shopping cart items
                            $total += $amount * $Items['SellPrice'];
                        }
                        // count total value of shopping cart items
                        $total += $amount * $Items['SellPrice'];
                    }
                    $cartItem = getStockItem($key, $databaseConnection);
                    if ($total > 60.00) {
                        $verzendkosten = 0;
                    } else {
                        $verzendkosten = ($cartItem['SendCosts']);
                    }
                    ?>
                </form>
            </div>
            <div class="col-4"></div>
            <!-- display sendCosts of cart -->
            <div class="col-6 mx-4 mb-4 border rounded">
                <h4> Verzendkosten : <p class="text-right"> <?php print(round($verzendkosten, 2)); ?></p></h4>
                <h4> Korting: <p class="text-right"> <?php
                            $totalShoppingValue += $total;
                            if ($korting) {
                                foreach ($korting as $Kortingscode => $waarde) {
                                    print(number_format(round((1 - $waarde) * $totalShoppingValue, 2), 2));
                            }
                        } else { print ("0.00");}
                        ?></p></h4>
                <h4> Totaal : <p class="text-right">
                        <?php
                            if ($korting) {
                                foreach ($korting as $Kortingscode => $waarde) {
                                    print(number_format(round($totalShoppingValue * $waarde, 2) + $verzendkosten, 2));
                            }
                        } else { print (number_format(round($totalShoppingValue, 2) + $verzendkosten, 2));}
                        ?> </p></h4>
            </div>
            <!-- display total value of cart -->
            <div class="col-10"></div>
            <div class="form-group">
                <form method="post">

                </form>
            </div>
            <!-- ideal -->
            <?php
            $betaalSelected = false;
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Ideal'])) {
                echo '<script>console.log("Optie ingevuld!"); </script>';
                $betaalSelected = true;
            }
            if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['Bestellen'])) {

                echo '<script>console.log("Bestellen ingedrukt"); </script>';
                if (isset($_POST['BetaalOptie']) != "0") {
                    echo '<script>console.log("Optie ingevuld!"); </script>';
                }

            }
            ?>
        </div>
    </div>
</div>
<?php
}
?>