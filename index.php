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
        <h1 style="background-color: #a71d2a; color: black; height: 110px; text-align: center">Gebruik nu de kortingscode "KORTING" voor 10% korting! <br> Log in om 20% korting te krijgen!</h1>
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
    <a href="./view.php?id=16">
        <img src="Public/ProductIMGHighRes/mug.png" alt="Foto">
    </a>
    <h1 class="TextMain"><a href="./view.php?id=16">Nieuw binnen!</a></h1>
    <ul id="ul-class-price">
        <p class="HomePagePrice">22,36</p>
    </ul>

    <button id="button" onclick="closePopup()">X</button>
</div>
<?php
include __DIR__ . "/footer.php";
?>

