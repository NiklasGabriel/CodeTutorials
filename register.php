<?php
session_start();

// Standart Variablen
$errorMessage = "";

// Verbindung zur Datenbank
$db_name = 'db.db';
$server = "sqlite:$db_name";
$verbindung = new PDO($server);

// Verbindung zur Datenbank
$db_name = 'user.db';
$server = "sqlite:$db_name";
$verbindung_user = new PDO($server);

if(isset($_GET['register'])) {
    $error = false;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwort1 = $_POST['password1'];
    $passwort2 = $_POST['password2'];
    
    // Eingaben überprüfen
    if(strlen($username) == 0) {
        $errorMessage = 'Bitte einen Benutzernamen angeben.';
        $error = true;
    }     
    if(strlen($passwort1) == 0) {
        $errorMessage = 'Bitte ein Passwort angeben.';
        $error = true;
    }
    if($passwort1 != $passwort2) {
        $errorMessage = 'Die Passwörter müssen übereinstimmen.';
        $error = true;
    }

    //Überprüfe, dass der Benutzername noch nicht registriert wurde
    if(!$error) { 
        $statement = $verbindung->prepare("SELECT * FROM users WHERE username = '$username'");
        $result = $statement->execute();
        $user = $statement->fetch();
        
        if($user !== false) {
            $errorMessage = 'Dieser Benutzername ist bereits vergeben.';
            $error = true;
        }    
    }
    
    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) { 
        $statement = $verbindung->prepare("SELECT * FROM users WHERE email = '$email'");
        $result = $statement->execute();
        $user = $statement->fetch();
        
        if($user !== false) {
            $errorMessage = 'Diese E-Mail Adresse ist bereits vergeben.';
            $error = true;
        }    
    }
    
    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort1, PASSWORD_DEFAULT);
        $verbindung->exec("INSERT INTO users (username, email, passwort) VALUES ('$username', '$email', '$passwort_hash')");

        $verbindung_user->exec(
        "CREATE TABLE '$username' (
            'Spalte1' TEXT,
            'Spalte2' TEXT
        )"
        );
        

        echo "<script>window.location.href='login.php'</script>";
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