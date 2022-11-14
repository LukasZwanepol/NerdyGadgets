<!-- dit bestand bevat alle code voor de pagina die categorieën laat zien -->
<?php
    include "cartfuncties.php";
    include __DIR__ . "/header.php";
    $StockGroups = getStockGroups($databaseConnection);

?>
<div id="Wrap">
    <h1>Inhoud Winkelwagen</h1>
    <?php
    $cart = getCart();
    print_r($cart);
    //gegevens per artikelen in $cart (naam, prijs, etc.) uit database halen
    //totaal prijs berekenen
    //mooi weergeven in html
    //etc.

    ?>
    <p><a href='view.php?id=0'>Naar artikelpagina van artikel 0</a></p>
</div>