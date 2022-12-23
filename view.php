<!-- dit bestand bevat alle code voor de pagina die één product laat zien -->
<?php
include __DIR__ . "/header.php";
include "CartFuncties.php";

$StockItem = getStockItem($_GET['id'], $databaseConnection);
$StockItemImage = getStockItemImage($_GET['id'], $databaseConnection);
$StockGroups = getStockGroups($databaseConnection);
$StockItemTemp = getStockTemp($databaseConnection);
?>
<div class="content">

<div id="CenteredContent" class="rounded p-3">
    <?php
    if ($StockItem != null) {
        ?>
        <?php
        if (isset($StockItem['Video'])) {
            ?>
            <div id="VideoFrame">
                <?php print $StockItem['Video']; ?>
            </div>
        <?php }
        ?>


        <div id="ArticleHeader" class="p-3 row">
            <?php
            if (isset($StockItemImage)) {
                // één plaatje laten zien
                if (count($StockItemImage) == 1) {
                    ?>
                    <div id="ImageFrame"
                         style="background-image: url('Public/StockItemIMG/<?php print $StockItemImage[0]['ImagePath']; ?>'); background-size: 230px; background-repeat: no-repeat; background-position: center;"></div>
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
                     style="background-image: url('Public/StockGroupIMG/<?php print $StockItem['BackupImagePath']; ?>'); background-size: cover;"></div>
                <?php
            }
            if (isset($_GET["id"])) {
                $stockItemID = $_GET["id"];
            } else {
                $stockItemID = 0;
            }
            ?>


            <h1 class="StockItemID">Artikelnummer: <?php print $StockItem["StockItemID"]; ?></h1>
            <h2 class="StockItemNameViewSize StockItemName">
                <?php print $StockItem['StockItemName']; ?>
            </h2>
            <div id="StockItemHeaderLeft">
                <div class="CenterPriceLeft">
                    <form method="post" id="addToCart" class="py-2">
                        <input type="number" name="stockItemID" value="<?php print($stockItemID) ?>" hidden>
                        <input type="submit" name="submit" class="btn btn-primary" value="Voeg toe aan winkelmandje">
                    </form>
                    <!-- formulier via POST en niet GET om te zorgen dat refresh van pagina niet het artikel onbedoeld toevoegt-->
                    <?php
                        if (isset($_POST["submit"])) {              // zelfafhandelend formulier
                            $stockItemID = $_POST["stockItemID"];
                            addProductToCart($stockItemID);
                    ?>
                        <a href='cart.php'><button class="btn btn-primary" type="submit">Klik hier om naar de winkelwagen te gaan!</button></a>
                    <?php  
                        }
                    ?>

                    <div class="CenterPriceLeftChild">
                        <p class="StockItemPriceText" style="margin-bottom: -2px;"><b><?php print sprintf("€ %.2f", $StockItem['SellPrice']); ?></b></p>
                        <h6> Inclusief BTW </h6>
                        <?php
                        if($StockItem['IsChillerStock'] == 1){
                            foreach($StockItemTemp as $temp){?>
                            <h8> Magazijn temperatuur: </h8>
                            <?PHP
                                print($temp."˚C");
                            }
                        }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-10"></div>
            <div class="col-2">Voorraad: <?php print $StockItem['QuantityOnHand']; ?></div>
        </div>
        <div class="row mb-3">
            <div class="col-4" id="StockItemDescription">
                <h3>Artikel beschrijving</h3>
                <p><?php print $StockItem['SearchDetails']; ?></p>
            </div>
            <div class="col-6" id="StockItemSpecifications"> 
                <h3>Artikel specificaties</h3>
                <?php
                $CustomFields = json_decode($StockItem['CustomFields'], true);
                if (is_array($CustomFields)) { ?>
                    <table>
                    <thead>
                    <th>Naam</th>
                    <th>Data</th>
                    </thead>
                    <?php
                    foreach ($CustomFields as $SpecName => $SpecText) { ?>
                        <tr>
                            <td>
                                <?php print $SpecName; ?>
                            </td>
                            <td>
                                <?php
                                if (is_array($SpecText)) {
                                    foreach ($SpecText as $SubText) {
                                        print $SubText . " ";
                                    }
                                } else {
                                    print $SpecText;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </table><?php
                } else { ?>

                    <p><?php print $StockItem['CustomFields']; ?>.</p>
                    <?php
                }
                ?>
            </div>
        </div>
        
       
        <?php
    } else {
        ?><h2 id="ProductNotFound">Het opgevraagde product is niet gevonden.</h2><?php
    } ?>
</div>
