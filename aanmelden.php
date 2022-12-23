<?php
include __DIR__ . "/header.php";
?>


<body>
<div class="col-4">
    <h1>aanmelden</h1>
    <form method="post">
        <div class="mb-3">
            <label for="InputEmail1" class="form-label">Email address</label>
            <input type="text" class="form-control" name="InputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="InputPassword1" class="form-label">Wachtwoord</label>
            <input type="password" class="form-control" name="InputPassword">
        </div>
        <div class="mb-3">
            <label for="IPassword2" class="form-label">Herhaal wachtwoord</label>
            <input type="password" class="form-control" name="InputPassword2">
        </div>
        <button type="Inlog" class="btn btn-primary" name="Aanmelden">Aanmelden</button>
    </form>
</div>
</body>
<?php
$connection = connectToDatabase();
if (isset($_POST["Aanmelden"])) {
    $email = $_POST["InputEmail"];
    $password = hash("sha256" ,$_POST["InputPassword"]);
    $passwordHerhaal = hash("sha256" ,$_POST["InputPassword2"]);
    aanmelden($connection, $email, $password, $passwordHerhaal);
}
?>