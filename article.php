<?php session_start();?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?php include("extra/head.php");?>
    <?php
        $path_in_foler = $_GET["path"];
        if ($path_in_foler == 0) {
            echo "<script>window.location.href='error.php'</script>";
        }
    ?>
</head>
<body>
    <?php include("extra/menu.php");?>
    <div class="content">
    <?php include("articles/$path_in_foler");?>
    </div>
</body>
</html>