<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php
include "cartfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
?>

<div class="row">
    <div class="col-1"></div>
    <div id="Wrap" class="col-10">
        <h1 style="font-size:160%;color:#676EFF;">Inhoud Winkelwagen</h1>
        <!-- functions shopping cart, Increase/ Decrease / Delete -->
        <?php
        $cart = getCart();
        $totalShoppingValue = 0;
        $cartItem =[];
        $verzendkosten = 0;

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
        // loop trough every item in cart
        if($cart){
            foreach ($cart as $key => $StockItem) {
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
                                            type="submit" name="deleteItem" value="<?php print($id) ?>" class="btn btn-light"><span class="bi bi-trash"></span>
                                    </button>
                            </div>
                        </form>
                        <div>
                            <p>
                                <?php
                                $verzendkosten = ($cartItem['SendCosts']);
                                print round($verzendkosten, 2);
                                ?>
                            </p>
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
            $verzendkosten = $cartItem['SendCosts'];
        }else{ 
        ?>
            <h1>uw winkelwagen is leeg</h1>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <p class="text-center">Verzendkosten: <?php print (round($verzendkosten, 2)); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <p class="text-center">Totaal: <?php print (round($totalShoppingValue , 2) + $verzendkosten ); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2 text-center">
                <?php if ($totalShoppingValue != 0) { ?>
                    <a href="gegevens.php" class="btn btn-primary btn-lg">Naar checkout</a>
                <?php 
                } 
                ?>
            </div>
        </div>


    </div>

</div>

