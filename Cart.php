<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php
include "cartfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
$ConversieMirre = getConv();
$ConversieImre = getConvImre();

?>

<div class="row">
    <div class="col-1"></div>
    <div id="Wrap" class="col-10">
        <h1 style="font-size:160%;color:#676EFF;">Inhoud Winkelwagen</h1>
        <!-- functions shopping cart, Increase/ Decrease / Delete -->
        <?php
        $cart = getCart();
        $korting = getKorting();
        $totalShoppingValue = 0;
        $cartItem = [];

        if (isset($_POST['DeleteKorting'])) {
            deletekorting($_POST['Kortingscode']);
            print '<meta http-equiv="refresh" content="0">';
        }
        if (isset($_POST['Kortingscode'])) {
            error_reporting(E_ERROR | E_PARSE);
            addkorting($_POST['Kortingscode']);
            print '<meta http-equiv="refresh" content="0">';
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['increaseItem'])) {
            increaseAmountOfCart($_POST['increaseItem']);
            print '<meta http-equiv="refresh" content="0">';
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['decreaseItem'])) {
            decreaseAmountOfCart($_POST['decreaseItem']);
            print '<meta http-equiv="refresh" content="0">';
        }
        if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['deleteItem'])) {
            deleteCartItem($_POST['deleteItem']);
            print '<meta http-equiv="refresh" content="0">';
        }
        $aantalArtikelen = null;
        // loop trough every item in cart
        foreach ($cart as $key => $StockItem) {
            $aantalArtikelen++;
            $cartItem = getStockItem($key, $databaseConnection);
            $id = $cartItem["StockItemID"];
            $StockItemImage = getStockItemImage($id, $databaseConnection);
            $orderAmount = $cart[$id];
            ?>
            <div class="row">
                <div class="col-10 border-bottom border-primary p-2">
                    <?php
                    if ($StockItemImage != null) {
                        // één plaatje laten zien
                        if (count($StockItemImage) == 1) {
                            ?>
                            <div id="ImageFrame"
                                 style="width:300px; background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 300px; background-repeat: no-repeat; background-position: center;"></div>
                            <?php
                        } else if (count($StockItemImage) >= 2) { ?>
                            <!-- meerdere plaatjes laten zien -->
                            <div id="ImageFrame">
                                <div id="ImageCarousel" class="carousel slide" data-interval="false">
                                    <!-- Indicators -->
                                    <ul class="carousel-indicators">
                                        <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                            ?>
                                            <li data-target="#ImageCarousel"
                                                data-slide-to="<?php print $i ?>" <?php print (($i == 0) ? 'class="active"' : ''); ?>></li>
                                            <?php
                                        } ?>
                                    </ul>

                                    <!-- slideshow -->
                                    <div class="carousel-inner">
                                        <?php for ($i = 0; $i < count($StockItemImage); $i++) {
                                            ?>
                                            <div class="carousel-item <?php print ($i == 0) ? 'active' : ''; ?>">
                                                <img src="Public/StockItemIMG/<?php print $StockItemImage[$i]['ImagePath'] ?>">
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <!-- knoppen 'vorige' en 'volgende' -->
                                    <a class="carousel-control-prev" href="#ImageCarousel" data-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </a>
                                    <a class="carousel-control-next" href="#ImageCarousel" data-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div id="ImageFrame"
                             style="background-image: url('Public/StockGroupIMG/<?php print $cartItem['BackupImagePath']; ?>'); background-size: cover; width:300px;"></div>
                        <?php
                    }
                    ?>
                    <h1 class="StockItemName" ; style=font-size:160%>
                        <?php print $cartItem['StockItemName']; ?>
                    </h1>
                    <h2 class="StockItemIDa"
                        style="font-size:80%; margin-top:2%"> <?php print ("Artikelnummer: $id"); ?>
                    </h2>
                    <div style="margin-top: 5%;">Voorraad: <?php print $cartItem['QuantityOnHand']; ?></div>
                    <div id="StockItemHeaderLeft">
                        <div class="CenterPriceLeft">
                            <div class="CenterPriceLeftChild">
                                <p class="StockItemPriceText"
                                   style="margin-top: -60px;font-family:pt-sans, sans-serif;">
                                    <b><?php print sprintf("€ %.2f", $cartItem['SellPrice']); ?></b></p>
                                <h6 style="margin-top: -5%; font-size: 70%"> Inclusief BTW </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div>
                            <button style="background-color:#676EFF; border-radius: 12px; width: 30px; border: 1px rgba(35, 40, 47, 0.8); margin-top: 40px;"
                                    type="submit" name="increaseItem" value="<?php print($id) ?>">+
                            </button>
                        </div>
                        <div>
                            <?php
                            print($orderAmount);
                            ?>
                        </div>
                        <div>
                            <button style="background-color: #676EFF; border-radius: 12px;width: 30px;border: 1px rgba(35, 40, 47, 0.8);"
                                    type="submit" name="decreaseItem" value="<?php print($id) ?>">-
                            </button>
                        </div>
                        <div>
                            <button style="background-color: #676EFF; border-radius: 12px;width: 40px;border: 1px rgba(35, 40, 47, 0.8); margin: 30px;"
                                    type="submit" name="deleteItem" value="<?php print($id) ?>" class="btn btn-light">
                                <span class="bi bi-trash"></span>
                            </button>
                        </div>
                    </form>
                    <div>
                        <p> Subtotaal: <?php
                            $total = $orderAmount * $cartItem['SellPrice'];
                            print round($total, 2); ?>
                        </p>
                    </div>
                </div>
            </div>

            <?php
            $totalShoppingValue += $total;
        };
        // if ($_SESSION["loggedin"] == 1) {
        //     $loggedIn = true;
        // } else {
        //     $loggedIn = false;
        // } && $loggedIn && !$loggedIn
        if ($ConversieImre) {
            if ($aantalArtikelen > 0 && $totalShoppingValue > 60.00) {
                $verzendkosten = 0;
            } else {
                error_reporting(E_ERROR | E_PARSE);
                $verzendkosten = $cartItem['SendCosts'];
            }
        } else {
            error_reporting(E_ERROR | E_PARSE);
            $verzendkosten = $cartItem['SendCosts'];
        }
        ?>
        <p style="text-left">
            <?php if ($ConversieImre) { ?>
    <p class="text-danger"<a><?php if ($aantalArtikelen > 0) {
            print ("Bestellingen boven de 60 euro geen verzendkosten!");
        } ?> </a></p> <?php } ?>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col-7"></div>
                <div class="col"><p style="text-align: right">
                        <a>Verzendkosten: <?php print (number_format(round($verzendkosten, 2), 2)); ?></a>

                    </p>
                </div>
            </div>
        </div>
        <?php if ($totalShoppingValue != 0) {
            if ($ConversieMirre) { ?>
                <form method='post' action="Cart.php">
                    <div class='form-group row px-3'>
                        <div class="container">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-7"><h5 class="form-group" style="text-align: right">Kortingscode:</h5>
                                </div>
                                <div class="col">
                                    <input class="form-control"
                                           style="float: right; border: 1px rgba(35, 40, 47, 0.8); color: black; width: 120px; <?php if (isset($_POST['Kortingscode'])) {
                                               if ($_POST['Kortingscode'] == "KORTING" || $_POST['Kortingscode'] == 'ACCOUNT') {
                                                   print ("background-color: #28a745");
                                               }
                                           } ?>" class='form-control col-2' name='Kortingscode' value="<?php
                                    if (isset($_POST['Kortingscode'])) {

                                        print ($_POST['Kortingscode']);
                                    }


                                    ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <?php foreach ($korting as $Kortingscode => $waarde) {
                                    if (isset($korting[$Kortingscode])) {
                                        print ("
                            <button style=\" margin-right: -80px; background-color: #676EFF; border-radius: 12px;width: 40px;border: 1px rgba(35, 40, 47, 0.8);\"
                                    type=\"submit\" name=\"DeleteKorting\" class=\"btn btn-light\">
                                <span class=\"bi bi-trash\"></span>
                            </button>");
                                    }
                                }
                                ?>
                                <input style=" float: right; border-radius: 12px; background-color: #676EFF; border: 1px rgba(35, 40, 47, 0.8);"
                                       class='col-7' type='submit' value='Kortingscode toepassen'>
                            </div>
                        </div>
                    </div>
                </form>
            <?php } ?>
            <a class=p-9 style="<?php error_reporting(E_ERROR | E_PARSE);
            if (isset($korting["KORTING"])) {
                print ("margin-left: 78%; color:green");

            } ?> ;"> <?php
                $Kortingscode = ($_POST['Kortingscode']);
                if (isset($korting["KORTING"])) {
                    print ("Kortingscode is toegepast!");
                }
                ?></a>
            <?php
        }
        ?>

        <div class="container">
            <div class="row">
                <div class="col-7"></div>
                <div class="col">
                    <?php if ($ConversieMirre) { ?>
                        <p style=" text-align: right;"><a>Korting: <?php
                                if ($korting) {
                                    foreach ($korting as $Kortingscode => $waarde) {
                                        print(number_format(round((1 - $waarde) * $totalShoppingValue, 2), 2));
                                    }
                                } else {
                                    print ("0.00");
                                } ?></a></p> <?php } ?>
                    <p style=" text-align: right;"><a>Totaal: <?php
                            error_reporting(E_ERROR | E_PARSE);
                            if (array_key_exists($Kortingscode, $korting)) {
                                print (number_format($verzendkosten + round($totalShoppingValue * ($korting[$Kortingscode]), 2), 2));
                            } else {
                                print (number_format($verzendkosten + round($totalShoppingValue, 2), 2));
                            }
                            ?> </a></p>
                </div>
            </div>
        </div>
        <?php if ($totalShoppingValue != 0) {
            print ("<form action='gegevens.php'> <input type='submit' style=\"background-color: #676EFF; font-size: large; border-radius: 12px;width: 150px; height: 40px; border: 1px rgba(35, 40, 47, 0.8); margin-left: 81%;\" value='Naar checkout'></form>");
        }
        ?>
        <p style=" margin-bottom: 5%;"><a href='view.php?id=<?php $rand = (rand(1, 200));
            if ($rand != NULL) {
                print $rand;
            } else {
                print 1;
            } ?>'>Naar willekeurige artikelpagina</a></p>

    </div>
</div>