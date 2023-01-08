<?php
include "Cartfuncties.php";
include __DIR__ . "/header.php";
$StockGroups = getStockGroups($databaseConnection);
$ConversieMirre = getConv();
$ConversieImre = getConvImre();
?>

<?php
If (isset($_POST['ConversieMirre'])) {
    addConv($_POST['ConversieMirre']);
    print '<meta http-equiv="refresh" content="0">';
}

If (isset($_POST['UndoConversieMirre'])) {
    error_reporting(E_ERROR | E_PARSE);
    deleteConv($_POST['ConversieMirre']);
    print '<meta http-equiv="refresh" content="0">';

}
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                Admin
            </div>
            <div class="card-body">

                <button onclick=Mode()>Toggle mode</button>
                <br>

                <?php if ($ConversieMirre) { print ("<h5 style='color: #34ce57'>'Kortingscode' = aan</h5>"); }
                else { print ("<h5 style='color: coral'>'Kortingscode' = uit</h5>"); }
                ?>
                <?php if ($ConversieImre) { print (" <h5 style='color: #34ce57'> 'Verzendkosten' = aan</h5>"); } else { print (" <h5 style='color: coral'> 'Verzendkosten' = uit</h5>");} ?>
                <br>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <span class="input-group-text" style="margin: 2px">Kortingscode</span></div>
                            <div class="col-3">
                                <form method="post" action="admin.php">
                                <input style="border-radius: 12px; background-color: #34ce57" type="submit" name="ConversieMirre" value="Aan"></div>
                                <div class="col-3">
                                <input style="border-radius: 12px; background-color: coral" type="submit" name="UndoConversieMirre"  value="Uit"></div>
                            </form>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="row">
                            <div class="col-6">
                                <span class="input-group-text" style="margin: 2px" >Verzendkosten</span></div>
                                <div class="col-3">
                                    <form method="post" action="admin.php">
                                        <input style="border-radius: 12px;background-color: #34ce57" type="submit" name="ConversieImre" value="Aan"></div>
                            <div class="col-3">
                                <input style="border-radius: 12px;background-color: coral" type="submit" name="UndoConversieImre"  value="Uit"></div>
                        </form>
                        </div>
                    </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- show overview of user data -->
    </div>
</div>



