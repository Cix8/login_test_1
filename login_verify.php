<?php
session_start();
require_once("conn.php");

if (isset($_POST) && !empty($_POST)) {
    if(!empty($_POST["action"]) && $_POST["action"] == "logout") {
        session_regenerate_id();
        $_SESSION = [];
        header("Location: guest.php");
        exit;
    }
    if($_POST["_csrf"] === $_SESSION["csrf"]) {
        var_dump("Codice corretto");
    } else {
        $_SESSION = [];
        header("Location: login.php");
        exit;
    }
    $dirty_email = $_POST["email"];
    $dirty_email = filter_var($dirty_email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($dirty_email, FILTER_VALIDATE_EMAIL);

    $user;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam("email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($results) < 1) {
        $_SESSION = [];
        header("Location: login.php");
        exit;
    } else {
        $user = $results[0];
    }

    if (password_verify($_POST["password"], $user["password"])) {
        session_regenerate_id();
        unset($user["password"]);
        $_SESSION["user"] = $user;
        header("Location: index.php");
    } else {
        $_SESSION = [];
        header("Location: login.php");
        exit;
    }
    var_dump($user);
} else {
    $_SESSION = [];
    header("Location: login.php");
    exit;
}
