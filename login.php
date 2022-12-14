<?php session_start();?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("extra/head.php");?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
        <div class="center_view">
            <h1>LOG IN</h1>
            <br><br>
            <form action="?login=1">
                <input class="center_view_input" type="email" name="email" placeholder="E-Mail"><br><br><br>
                <input class="center_view_input" type="password" name="passwort" placeholder="Passwort"><br><br><br><br>
                <Button class="center_view_btn">Anmelden</Button><br><br><br>
            </form>
            <p>
                <a class="center_viw_link" href="register.php">Noch keinen Account, hier geht's zur Registrierung...</a>
            </p>
            <br>
        </div>
    </div>
</body>
</html>