<?php
include "cartfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
?>


<div class="container">
    <div class="row justify-content-center">
        <!-- show overview of user data -->
        <div class="col-5 border rounded p-0 m-2">
            <h4 class="text-center p-0 py-2 border bg-light text-dark">Admin</h4>
            <form class="p-2" method="post">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text col-9" style="margin: 2px">Conversiemaatregel 1</span>
                        <div class="col-2" style="alignment: right;">
                            <input type="checkbox" name="Conversie1" <?php if (isset($_POST['Conversie1'])) { print ("Checked");} ?>>
                        </div>
                            <span class="input-group-text col-9" style="margin: 2px" >Conversiemaatregel 2</span>
                            <div class="col-2" style="alignment: right;">
                                <input type="checkbox" name="Conversie2" <?php if (isset($_POST['Conversie2'])) { print ("Checked");} ?>>
                        </div>
                        <span class="input-group-text col-9" style="margin: 2px" >Conversiemaatregel 3</span>
                        <div class="col-2" style="alignment: right;">
                            <input type="checkbox" name="Conversie3" <?php if (isset($_POST['Conversie3'])) { print ("Checked");} ?>>
                        </div>
                    </div>
                </div>

            </form>
            <input type="submit" value="Ik wil niet meer">
        </div>
    </div>
</div>



