<!-- dit is het bestand dat wordt geladen zodra je naar de website gaat -->
<?php
include __DIR__ . "/header.php";
?>
<script>
    document.getElementById("popup-window").style.visibility = "visible";

    function closePopup() {
        document.getElementById("popup-window").style.visibility = "hidden";
    }
</script>
<div id="overlay"></div>
<div class="IndexStyle">
    <div class="col-11">
        <div class="TextPrice">
            <a href="view.php?id=93">
                <div class="TextMain">
                    "The Gu" red shirt XML tag t-shirt (Black) M
                </div>
                <ul id="ul-class-price">
                    <li class="HomePagePrice">€30.95</li>
                </ul>
        </div>
        </a>
        <div class="HomePageStockItemPicture"></div>
    </div>
</div>
<div id="popup-window">
    <div class="TextMain">
        Nieuw binnen!
    </div>
    <a href="http://localhost/NerdyGadgets/view.php?id=16">
        <img src="Public/ProductIMGHighRes/mug.png" alt="Foto">
    </a>
    <button id="button" onclick="closePopup()">Sluiten</button>
</div>
<?php
include __DIR__ . "/footer.php";
?>

