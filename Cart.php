<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php
    include "cartfuncties.php";
    include __DIR__ . "/header.php";
    $StockGroups = getStockGroups($databaseConnection);
?>
<div class="row">
    <div class="col-1"></div>
    <div id="Wrap" class="col-10">
        <h1>Inhoud Winkelwagen</h1>
        <?php
        $cart = getCart();
        $totalShoppingValue = 0;
        // $StockItem = getStockItem($_GET['id'], $databaseConnection);

        foreach( $cart as $key => $StockItem){
            $Items = getStockItem($key, $databaseConnection);
            $id = $Items["StockItemID"];
            $amount = $cart[$id];
            ?>
            <div class="row">
                <div id="ArticleHeader" class="col-10">
                    <?php
                    if (isset($StockItemImage)) {
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
                            style="background-image: url('Public/StockGroupIMG/<?php print $Items['BackupImagePath']; ?>'); background-size: cover; width:300px;"></div>
                        <?php
                    }
                    ?>


                    <h1 class="StockItemID">Artikelnummer: <?php print $id; ?></h1>
                    <h2 class="StockItemNameViewSize StockItemName">
                        <?php print $Items['StockItemName']; ?>
                    </h2>
                    <div class="QuantityText"><?php print $Items['QuantityOnHand']; ?></div>
                    <div id="StockItemHeaderLeft">
                        <div class="CenterPriceLeft">
                            <div class="CenterPriceLeftChild">
                                <p class="StockItemPriceText"><b><?php print sprintf("€ %.2f", $Items['SellPrice']); ?></b></p>
                                <h6> Inclusief BTW </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2 text-center">
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['increaseItem'])) {
                            increaseAmountOfCart($_POST['increaseItem']);
                            print '<meta http-equiv="refresh" content="0">';
                        }
                        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['decreaseItem'])) {
                            decreaseAmountOfCart($_POST['decreaseItem']);
                            print '<meta http-equiv="refresh" content="0">';
                        }
                        if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['deleteItem'])) {
                            deleteCartItem($_POST['deleteItem']);
                            print '<meta http-equiv="refresh" content="0">';
                        }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div> <button type="submit" name="increaseItem" value="<?php print($id) ?>">+</button></div>
                        <div>
                            <?php 
                                print($amount);
                            ?>
                        </div>
                        <div> <button type="submit" name="decreaseItem" value="<?php print($id) ?>">-</button></div>
                        <div>
                            <?php 
                                if($amount == 1){
                                    ?>
                                    <button type="submit" name="deleteItem" value="<?php print($id) ?>">Wilt u het product verwijderen?</button>
                                    <?php
                                }
                            ?>
                        </div>
                    </form>
                    <div>
                        <p> Totaal is: <?php
                            $total = $amount * $Items['SellPrice'];
                            print round($total, 2); ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php
            $totalShoppingValue += $total;
        };
        ?>
        <p><a> De totale waarde van uw winkelwagen is: <?php print(round($totalShoppingValue, 2)); ?></a></p>
                
        <p><a href='order.php'>Bestellen</a></p>
    </div>
    <div class="col-1"></div>
</div>