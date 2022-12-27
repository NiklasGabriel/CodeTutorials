<?php
    if(isset($_SESSION['userid'])) {
        $locker = "Abmelden";
    } else {
        $locker = "Anmelden";
    }
?>
<div class="menu">
    <table id="menuPC">
        <tr>
            <td id="menuPC_header"><h1>CodeTutorials</h1></td>
            <td id="menuPC_rechts">
                <a href="index.php">Home</a>
                <a href="preview.php">Artikel</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="login.php"><?php echo $locker;?></a>
            </td>
        </tr>
    </table>
</div>