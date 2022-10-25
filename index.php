<?php 
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"] === null) {
    $_SESSION = [];
    header("Location: guest.php");
    exit;
}

require_once("html_up.php");
?>

<div class="container mt-5 p-5 ms_box">
    <h1 class="text-success">Sei dentro! Ciao <?php echo $_SESSION["user"]["email"]; ?></h1>
    <small class="text-warning">Aggiunto il: <? echo $_SESSION["user"]["created_at"]; ?></small>
</div>

<?php
    require_once("html_down.php");
?>