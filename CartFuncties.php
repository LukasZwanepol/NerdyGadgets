<?php
function getCart(){
    if(isset($_SESSION['cart'])){               //controleren of winkelmandje (=cart) al bestaat
        $cart = $_SESSION['cart'];                  //zo ja:  ophalen
    } else{
        $cart = array();                            //zo nee: dan een nieuwe (nog lege) array
    }
    return $cart;                               // resulterend winkelmandje terug naar aanroeper functie
}

function saveCart($cart){
    $_SESSION["cart"] = $cart;                  // werk de "gedeelde" $_SESSION["cart"] bij met de meegestuurde gegevens
}

function addProductToCart($stockItemID){
    $cart = getCart();                          // eerst de huidige cart ophalen

    if(array_key_exists($stockItemID, $cart)){  //controleren of $stockItemID(=key!) al in array staat
        $cart[$stockItemID] += 1;                   //zo ja:  aantal met 1 verhogen
    }else{
        $cart[$stockItemID] = 1;                    //zo nee: key toevoegen en aantal op 1 zetten.
    }

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}
function deleteCartItem($id){
    $cart = getCart();                          // eerst de huidige cart ophalen

    unset($cart[$id]);                              //zo ja:  aantal met 1 verhogen
    header("Refresh:0");
    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function increaseAmountOfCart($id){
    $cart = getCart();                          // eerst de huidige cart ophalen
    $cart[$id]= $cart[$id] + 1 ;

    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}
function decreaseAmountOfCart($id){
    $cart = getCart();                          // eerst de huidige cart ophalen
    $amount = $cart[$id];
    if($amount == 1){
        print "Hoeveelheid kan niet minder zijn dan 0";
    }else{
        $cart[$id]= $cart[$id] - 1;
    }
    saveCart($cart);                            // werk de "gedeelde" $_SESSION["cart"] bij met de bijgewerkte cart
}

function getKorting()
{
    if (isset($_SESSION['Kortingscode'])) {               //controleren of winkelmandje (=cart) al bestaat
        $korting = $_SESSION['Kortingscode'];                  //zo ja:  ophalen
    } else {
        $korting = array();                            //zo nee: dan een nieuwe (nog lege) array
    }
    return $korting;
}

function saveKorting($korting)
{
    $_SESSION["Kortingscode"] = $korting;
}

function addkorting($Kortingscode)
{
    $korting = getKorting();

    if (array_key_exists($Kortingscode, $korting)) {
        if ($Kortingscode == "KORTING") {
            $korting[$Kortingscode] = 0.9;
        }
    }
    if (!array_key_exists($Kortingscode, $korting)) {
        if ($Kortingscode == "KORTING") {
            $korting[$Kortingscode] = 0.9;
        }
    }

    saveKorting($korting);
}
function deletekorting($Kortingscode){
    $korting = getKorting();
    foreach ($korting as $Kortingscode => $waarde) {
        unset($korting[$Kortingscode]);
    }
    saveKorting($korting);

}
function getConv()
{
    if (isset($_SESSION['ConversieMirre'])) {               //controleren of winkelmandje (=cart) al bestaat
        $ConversieMirre = $_SESSION['ConversieMirre'];                  //zo ja:  ophalen
    } else {
        $ConversieMirre = array();                            //zo nee: dan een nieuwe (nog lege) array
    }
    return $ConversieMirre;
}

function saveConv($ConversieMirre)
{
    $_SESSION['ConversieMirre'] = $ConversieMirre;
}

function addConv($key)
{
    $ConversieMirre = getConv();

    if (array_key_exists($key, $ConversieMirre)) {
        if ($key) {
            $ConversieMirre[$key] = 2;
        }
    }
    if (!array_key_exists($key, $ConversieMirre)) {
        if ($key) {
            $ConversieMirre[$key] = 2;
        }
    }
    saveConv($ConversieMirre);
}

function deleteConv($key){
    $ConversieMirre = getConv();
    foreach ($ConversieMirre as $key => $value) {
        unset($ConversieMirre[$key]);
    }
    saveConv($ConversieMirre);

}

function getConvImre()
{
    if (isset($_SESSION['ConversieImre'])) {               //controleren of winkelmandje (=cart) al bestaat
        $ConversieImre = $_SESSION['ConversieImre'];                  //zo ja:  ophalen
    } else {
        $ConversieImre = array();                            //zo nee: dan een nieuwe (nog lege) array
    }
    return $ConversieImre;
}

function saveConvImre($ConversieImre)
{
    $_SESSION['ConversieImre'] = $ConversieImre;
}

function addConvImre($key)
{
    $ConversieImre = getConvImre();

    if (array_key_exists($key, $ConversieImre)) {
        if ($key) {
            $ConversieImre[$key] = 2;
        }
    }
    if (!array_key_exists($key, $ConversieImre)) {
        if ($key) {
            $ConversieImre[$key] = 2;
        }
    }
    saveConvImre($ConversieImre);
}

function deleteConvImre($key){
    $ConversieImre= getConvImre();
    foreach ($ConversieImre as $key => $value) {
        unset($ConversieImre[$key]);
    }
    saveConvImre($ConversieImre);

}