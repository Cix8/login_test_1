<?php 
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"] === null) {
    $_SESSION = [];
    header("Location: guest.php");
    exit;
}
var_dump($_SESSION["user"]);

require_once("html_up.php");
?>

<h1 class="text-success">Sei dentro! Ciao <?php echo $_SESSION["user"]["email"] ?></h1>

<?php
    require_once("html_down.php");
?>