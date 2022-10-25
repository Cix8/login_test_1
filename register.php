<?php
session_start();
$bytes = random_bytes(32);
$token = bin2hex($bytes);
$csrf = hash("sha256", $token);
$_SESSION["csrf"] = $csrf;


require_once("html_up.php");
?>

<?php if (isset($_SESSION["error-mex"])) { ?>
    <div id="error" class="alert alert-danger" role="alert">
        <?php 
            echo $_SESSION["error-mex"];
            unset($_SESSION["error-mex"]);
        ?>
    </div>
<?php } ?>

<div class="container-fluid p-3">
    <a class="btn btn-primary" href="guest.php">Home</a>
</div>

<h1 class="text-center text-warning py-5">Register</h1>

<div class="container w-50">
    <div class="row">
        <form class="bg-dark text-white p-5 ms_form" action="reg.php" method="POST">
            <input type="hidden" name="_csrf" value="<?php echo $_SESSION["csrf"]; ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Inserisci la tua email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci una password">
            </div>
            <div class="pt-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="js/mex_handler/script.js"></script>

<?php
require_once("html_down.php");
?>