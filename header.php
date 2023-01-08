<!-- de inhoud van dit bestand wordt bovenaan elke pagina geplaatst -->
<?php
session_start();
include "database.php";
$databaseConnection = connectToDatabase();
header("X-Frame-Options: DENY");
if (isset($_POST['token'])){
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    //echo($token)."<br>".($_SESSION['token']);

    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }
}
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>NerdyGadgets</title>
    <!-- Javascript -->
    <script src="Public/JS/fontawesome.js"></script>
    <script src="Public/JS/jquery.min.js"></script>
    <script src="Public/JS/bootstrap.min.js"></script>
    <script src="Public/JS/popper.min.js"></script>
    <script src="Public/JS/resizer.js"></script>
    <script src="Public/js/mode.js"></script>
    <script src="Public/js/popup.js"></script>

    <!-- Style sheets-->
    <link rel="stylesheet" href="Public/CSS/style.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="Public/CSS/typekit.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body class="Background" id="Content">
    <nav class="navbar navbar-expand-lg mb-5" id='navbar'>
        <a class="navbar-brand" href="./">
            <img id="LogoImage">
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="categories.php" class="nav-item nav-link">Alle categorieën</a>
                </li>
                <?php
                    $HeaderStockGroups = getHeaderStockGroups($databaseConnection);
                    foreach ($HeaderStockGroups as $HeaderStockGroup) {
                ?>
                <li class="nav-item">
                    <a href="browse.php?category_id=<?php print $HeaderStockGroup['StockGroupID']; ?>"
                        class="nav-item nav-link"><?php print $HeaderStockGroup['StockGroupName']; ?>
                    </a>
                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">

                <?php 
                if($_SESSION["loggedin"] ){
                ?>
                    <li class="nav-item">
                        <a href="inlogPagina.php" class="nav-item nav-link" id="inlog">ingelogd</a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php" class="nav-item nav-link" id="winkelwagen">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="BekijkenOverzicht.php" class="nav-item nav-link" id="klanten">Klantoverzicht</a>
                    </li>
                <?php
                }else{
                ?>
                <li class="nav-item">
                    <a href="inlogPagina.php" class="nav-item nav-link" id="inlog">Inloggen</a>
                </li>
                <?php    
                }
                ?>

                <li class="nav-item">
                    <a href="cart.php" class="nav-item nav-link" id="winkelwagen">Winkelwagen</a>
                </li>
                <li class="nav-item" id="ul-class-navigation">
                    <a href="browse.php" class="nav-item nav-link HrefDecoration"><i class="fas fa-search search"></i> Zoeken</a>
                </li>
            </ul>
        </div>
    </nav>
<!-- code voor US3: zoeken -->

        

<!-- einde code voor US3 zoeken -->
    <div class="row" id="Content">
        <div class="col-12" id="SubContent">


