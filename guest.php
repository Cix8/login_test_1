<?php
session_start();
require_once("html_up.php");
?>

<div class="container">
    <div class="vh-100 d-flex justify-content-center align-items-center flex-column">
        <div class="py-4">
            <h1>Sei fuori</h1>
        </div>
        <div>
            <?php if(!isset($_SESSION["user"]) || empty($_SESSION["user"])) { ?>
                <a class="btn btn-primary me-2" href="login.php">Effettua il login</a>
                <a class="btn btn-primary" href="register.php">Registrati</a>
            <?php } ?>
            <a class="btn btn-success ms-2" href="index.php">Entra</a>
        </div>
    </div>
</div>




<?php
require_once("html_down.php");
?>