<?php
include __DIR__ . "/header.php";
?>


<body>
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
            <button type="Inlog" class="btn btn-primary" name="Inlog">Log in</button>
        </form>
    </div>
</body>
<?php
$connection = connectToDatabase();
if (isset($_POST["Inlog"])) {
        $email = $_POST["InputEmail"];
        $password = hash("sha256" ,$_POST["InputPassword"]);
        login($connection, $email, $password);
    }
?>
