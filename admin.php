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

If (isset($_POST['ConversieImre'])) {
    addConvImre($_POST['ConversieImre']);
    print '<meta http-equiv="refresh" content="0">';
}

If (isset($_POST['UndoConversieImre'])) {
    error_reporting(E_ERROR | E_PARSE);
    deleteConvImre($_POST['ConversieImre']);
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
                <div class="form-group">
                    <div class="input-group mb-3">
                        <span class="input-group-text col-9" style="margin: 2px">Conversiemaatregel 1</span>
                            <form method="post" action="admin.php">
                            <input type="submit" name="ConversieMirre" value="Conversie aan">
                            <input type="submit" name="UndoConversieMirre"  value="Conversie uit">


                                <?php if ($ConversieMirre) { print ("<h5>Conversie staat aan</h5>"); }
                                else { print ("<h5>Conversie staat uit</h5>"); }
                                ?>
                            </form>


                        </div>
                            <span class="input-group-text col-9" style="margin: 2px" >Conversiemaatregel 2</span>
                    <input type="submit" name="ConversieImre" value="Conversie aan">
                    <input type="submit" name="UndoConversieImre"  value="Conversie uit">
                    <?php if ($ConversieImre) { print (" <h5> Conversie staat aan </h5>"); } else {print (" <h5> Conversie staat uit </h5>");} ?>


                                </form>
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



