<?php
include __DIR__ . "/header.php";

if(!$_SESSION["loggedin"] ){
?>
<div class="container">
    <div class="col-4">
        <h1>Inloggen</h1>
        <form method="post">
            <div class="mb-3">
                <label for="InputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" name="InputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Wachtwoord</label>
                <input type="password" class="form-control" name="InputPassword">
            </div>
            <button type="Inlog" class="btn btn-primary m-5" name="Inlog">Log in</button>
        </form>
    </div>
    <button href="aanmelden.php" type="button" class="btn btn-primary m-5" id="aanmelden">registreren</button>

</div>
<?php
}else{
?>
<div class="container">
    <div class="col-4">
        <h1>uitloggen</h1>
        <form method="post">
            <button type="logout" class="btn btn-primary" name="logout">Uit loggen</button>
        </form>
    </div>
</div>
<?php
}
?>
<?php
$connection = connectToDatabase();
if (isset($_POST["Inlog"])) {
        $email = $_POST["InputEmail"];
        $password = hash("sha256" ,$_POST["InputPassword"]);
        login($connection, $email, $password);
        print '<meta http-equiv="refresh" content="0">';
    }
if (isset($_POST["logout"])) {
    logout();
    print '<meta http-equiv="refresh" content="0">';
}
?>
