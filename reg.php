<?php
session_start();
require_once("conn.php");

if (!empty($_POST)) {
    if ($_POST["_csrf"] === $_SESSION["csrf"]) {
        var_dump("Codice corretto");
    } else {
        $_SESSION = [];
        $_SESSION["error-mex"] = "token non corretto";
        header("Location: register.php");
        exit;
    }

    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        if (!$conn) {
            $_SESSION = [];
            header("Location: register.php");
            exit;
        }
        $stmtGet = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $email = $_POST["email"];
        $stmtGet->bindParam("email", $email, PDO::PARAM_STR);
        $stmtGet->execute();

        $result = $stmtGet->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            $_SESSION = [];
            $_SESSION["error-mex"] = "Email non valida";
            header("Location: register.php");
            exit;
        } else {

            try {
                $stmt = $conn->prepare("INSERT INTO users (email, password, created_at) VALUES (:email, :password, :created)");
                $stmt->bindParam("email", $_POST["email"], PDO::PARAM_STR);
                $stmt->bindParam("password", password_hash($_POST["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);
                $stmt->bindParam("created", date("Y-m-d H:i:s", time() + 7200));
                $stmt->execute();
                $stmtGet->execute();
                $result = $stmtGet->fetchAll(PDO::FETCH_ASSOC);
                $user = $result[0];
                session_regenerate_id();
                $_SESSION = [];
                $_SESSION["user"] = $user;
                $_SESSION["success-mex"] = "Registrazione effettuata correttamente";
                header("Location: index.php");
                exit;
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    } else {
        $_SESSION = [];
        header("Location: register.php");
        exit;
    }
}

header("Location: register.php");
