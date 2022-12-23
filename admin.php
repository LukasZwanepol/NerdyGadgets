<?php
include "cartfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                Admin
            </div>
            <div class="card-body">
                <button onclick=Mode()>Toggle mode</button>
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
            </div>
        </div>
        <!-- show overview of user data -->
    </div>
</div>



