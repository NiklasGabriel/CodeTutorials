<?php
session_start();

// Standart Variablen
$errorMessage = "";

// Verbindung zur Datenbank
$db_name = 'db.db';
$server = "sqlite:$db_name";
$verbindung = new PDO($server);

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    
    $sql_befehl = "SELECT * FROM users WHERE email = '$email'";
    $statement = $verbindung->prepare($sql_befehl);
    $statement->execute();
    $user = $statement->fetch();
    
    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
    //$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
    //if ($user !== false && $passwort_hash = $user['passwort']) {
        $_SESSION['userid'] = $user['username'];
        echo "<script>window.location.href='dashboard.php'</script>";
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig.";
    }
    
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("extra/head.php");?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
        <div class="center_view">
            <br>
            <h1>REGISTRIERUNG</h1>
            <br>
            <?php echo("<p class='center_view_error_msg'>" . $errorMessage . "</p>")?>
            <br>
            <form action="?register=1" method="post">
                <input class="center_view_input" type="text" name="username" placeholder="Benutzername"><br><br>
                <input class="center_view_input" type="email" name="email" placeholder="E-Mail"><br><br><br>
                <input class="center_view_input" type="password" name="password1" placeholder="Passwort"><br><br>
                <input class="center_view_input" type="password" name="password2" placeholder="Passwort wiedrholen"><br><br><br><br>
                <Button class="center_view_btn">Registrieren</Button><br><br><br>
            </form>
            <p>
                <a class="center_viw_link" href="login.php">Schon einen Account, hier geht's zur Anmeldung...</a>
            </p>
            <br>
        </div>
    </div>
</body>
</html>