<!-- //test -->
<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php
    include "cartfuncties.php";
    include __DIR__ . "/header.php";
    $StockGroups = getStockGroups($databaseConnection);

?>
<div id="Wrap">
    <?php
        //?id=1 handmatig meegeven via de URL (gebeurt normaal gesproken als je via overzicht op artikelpagina terechtkomt)
        if (isset($_GET["id"])) {
            $stockItemID = $_GET["id"];
        } else {
            $stockItemID = 0;
        }
    ?>
    <h1>Product <?php print($stockItemID) ?></h1>
    <!-- formulier via POST en niet GET om te zorgen dat refresh van pagina niet het artikel onbedoeld toevoegt-->
    <form method="post">
        <input type="number" name="stockItemID" value="<?php print($stockItemID) ?>" hidden>
        <input type="submit" name="submit" value="Voeg toe aan winkelmandje">
    </form>

    <?php
        if (isset($_POST["submit"])) {              // zelfafhandelend formulier
            $stockItemID = $_POST["stockItemID"];
            addProductToCart($stockItemID);         // maak gebruik van geïmporteerde functie uit cartfuncties.php
            print("Product toegevoegd aan <a href='cart.php'> winkelmandje!</a>");
        }
    ?>
</div>