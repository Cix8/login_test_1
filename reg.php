<?php
session_start();
require_once("conn.php");

if(!empty($_POST)) {
    if($_POST["_csrf"] === $_SESSION["csrf"]) {
        var_dump("Codice corretto");
    } else {
        $_SESSION = [];
        header("Location: register.php");
        exit;
    }

    if(!empty($_POST["email"]) && !empty($_POST["password"])) {
        if(!$conn) {
            $_SESSION = [];
            header("Location: register.php");
        }
        $stmtGetAll = $conn->prepare("SELECT * FROM users");
        $stmtGetAll->execute();
        
        $result = $stmtGetAll->fetchAll(PDO::FETCH_ASSOC);
        $user_exist = false;
        foreach($result as $single_res) {
            if($single_res["email"] === $_POST["email"]) {
                $user_exist = true;
                break;
            }
        }
        if($user_exist) {
            $_SESSION = [];
            header("Location: register.php");
            exit;
        } else {

            try {
                $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
                $stmt->bindParam("email", $_POST["email"], PDO::PARAM_STR);
                $stmt->bindParam("password", password_hash($_POST["password"], PASSWORD_DEFAULT), PDO::PARAM_STR);
                $stmt->execute();
                $stmtGetAll->execute();
                $result = $stmtGetAll->fetchAll(PDO::FETCH_ASSOC);
                echo "Salvato";
                var_dump($result);
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

var_dump("Ok");