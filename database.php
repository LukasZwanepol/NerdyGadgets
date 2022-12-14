<!-- dit bestand bevat alle code die verbinding maakt met de database -->
<?php

function connectToDatabase() {
    $Connection = null;

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Set MySQLi to throw exceptions
    try {
        $Connection = mysqli_connect("localhost", "root", "", "nerdygadgets");
        mysqli_set_charset($Connection, 'latin1');
        $DatabaseAvailable = true;
    } catch (mysqli_sql_exception $e) {
        $DatabaseAvailable = false;
    }
    if (!$DatabaseAvailable) {
        ?><h2>Website wordt op dit moment onderhouden.</h2><?php
        die();
    }

    return $Connection;
}

function getHeaderStockGroups($databaseConnection) {
    $Query = "
                SELECT StockGroupID, StockGroupName, ImagePath
                FROM stockgroups 
                WHERE StockGroupID IN (
                                        SELECT StockGroupID 
                                        FROM stockitemstockgroups
                                        ) AND ImagePath IS NOT NULL
                ORDER BY StockGroupID ASC";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $HeaderStockGroups = mysqli_stmt_get_result($Statement);
    return $HeaderStockGroups;
}

function getStockGroups($databaseConnection) {
    $Query = "
            SELECT StockGroupID, StockGroupName, ImagePath
            FROM stockgroups 
            WHERE StockGroupID IN (
                                    SELECT StockGroupID 
                                    FROM stockitemstockgroups
                                    ) AND ImagePath IS NOT NULL
            ORDER BY StockGroupID ASC";
    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $Result = mysqli_stmt_get_result($Statement);
    $StockGroups = mysqli_fetch_all($Result, MYSQLI_ASSOC);
    return $StockGroups;
}

function getStockItem($id, $databaseConnection) {
    $Result = null;

    $Query = " 
           SELECT SI.StockItemID, 
            (RecommendedRetailPrice*(1+(TaxRate/100))) AS SellPrice, 
            StockItemName,
            QuantityOnHand,
            SearchDetails, 
            IsChillerStock, 
            (CASE WHEN (RecommendedRetailPrice*(1+(TaxRate/100))) > 50 THEN 0 ELSE 6.95 END) AS SendCosts, MarketingComments, CustomFields, SI.Video,
            (SELECT ImagePath FROM stockgroups JOIN stockitemstockgroups USING(StockGroupID) WHERE StockItemID = SI.StockItemID LIMIT 1) as BackupImagePath   
            FROM stockitems SI 
            JOIN stockitemholdings SIH USING(stockitemid)
            JOIN stockitemstockgroups ON SI.StockItemID = stockitemstockgroups.StockItemID
            JOIN stockgroups USING(StockGroupID)
            WHERE SI.stockitemid = ?
            GROUP BY StockItemID";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $ReturnableResult = mysqli_stmt_get_result($Statement);
    if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
        $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
    }

    return $Result;
}

function getStockTemp($databaseConnection) {
    $Query = " 
           SELECT round(avg(temperature),1)
            FROM coldroomtemperatures";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_execute($Statement);
    $ReturnableResult = mysqli_stmt_get_result($Statement);
    if ($ReturnableResult && mysqli_num_rows($ReturnableResult) == 1) {
        $Result = mysqli_fetch_all($ReturnableResult, MYSQLI_ASSOC)[0];
    }

    return $Result;
}
// remove items from stock function
function removeStockItemAmount($id, $amount, $databaseConnection) {
    // get all the items from database
    $Query = "
                SELECT SI.StockItemID, QuantityOnHand
                FROM stockitems SI 
                JOIN stockitemholdings SIH USING(stockitemid)
                WHERE StockItemID = ?";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);
    // loop trough every item and remove amount thats in cart
    foreach($R as $item) {
        $result = $item['QuantityOnHand'] - $amount;

        $Querys = "
                UPDATE stockitemholdings 
                SET QuantityOnHand=$result 
                WHERE StockItemID = ?";

        $Statements = mysqli_prepare($databaseConnection, $Querys);
        mysqli_stmt_bind_param($Statements, "i", $id);
        mysqli_stmt_execute($Statements);
        $Rs = mysqli_stmt_get_result($Statements);
    };
    return $R;
}

function getStockItemImage($id, $databaseConnection) {

    $Query = "
                SELECT ImagePath
                FROM stockitemimages 
                WHERE StockItemID = ?";

    $Statement = mysqli_prepare($databaseConnection, $Query);
    mysqli_stmt_bind_param($Statement, "i", $id);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $R = mysqli_fetch_all($R, MYSQLI_ASSOC);

    return $R;
}

function selecteerKlanten($connection) {
    $sql = "SELECT * FROM customers ORDER BY customerID";
    $result = mysqli_fetch_all(mysqli_query($connection, $sql),MYSQLI_ASSOC);
    return $result;
}


function login ($connection, $email, $password){

    $passwordCheck = false;
    $query = "  SELECT HashedPassword
                    FROM people
                    WHERE LogonName = '$email'";

    $Statement = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($Statement);
    $R = mysqli_stmt_get_result($Statement);
    $result = mysqli_fetch_all($R, MYSQLI_ASSOC);

    error_reporting(E_ERROR | E_PARSE);
    if ($password == $result[0]['HashedPassword']){
        $query = "SELECT PersonID
                    FROM people
                    WHERE LogonName = '$email'";

        $Statement = mysqli_prepare($connection, $query);
        mysqli_stmt_execute($Statement);
        $R = mysqli_stmt_get_result($Statement);
        $result = mysqli_fetch_all($R, MYSQLI_ASSOC);
        
        $id = $result[0]['PersonID'];
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $id;
        $_SESSION["mail"] = $email;
        print("Gelukt!");
    } else {
        error_reporting(E_ERROR | E_PARSE);
        print("Het wachtwoord of de email is onjuist. Probeer het nog een keer");
    }
}

function logout (){    
    $_SESSION["loggedin"] = false;
    $_SESSION["userid"] = 0;
    $_SESSION["mail"] = 0;
}

function aanmelden($connection, $email, $password_1, $password_2)
{
    //controleren of email al in gebruik is
    $mailcheck = FALSE;

    $result = mysqli_query($connection, "SELECT LogonName FROM people WHERE LogonName = '$email'LIMIT 1");
    while ($row = mysqli_fetch_array($result)) {
        $mailcheck = $row['LogonName'];
    }

    if ($email == $mailcheck) {
        print "<h5 style='text-align:center;color:darkred'>Dit mail adres is al in gebruik!</h5>";
    } elseif ($password_1 == $password_2) {
        $statement = mysqli_prepare($connection, "INSERT INTO people (LogonName, HashedPassword, FullName, IsPermittedToLogon) VALUES('$email','$password_1', 'test', 1);");
        mysqli_stmt_execute($statement);
        print "<h5 style='text-align:center;color:darkgreen'>Account aangemaakt!</h5>";
        mysqli_stmt_affected_rows($statement) == 1;
        echo "<script>window.location = 'index.php';</script>";
    } else {
        print "<h5 style='text-align:center;color:darkred'>Uw wachtwoorden komen niet overeen!</h5>";
    }
}
function sluitVerbinding($connection) {
    mysqli_close($connection);
}