<?php session_start();?>
<?php
    if(!isset($_SESSION['userid'])) {
        echo "<script>window.location.href='login.php'</script>";
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
        <h1>DASHBOARD</h1>
    </div>
</body>
</html>