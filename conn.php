<?php

$config = require "db_var.php";

$conn_string = "mysql:host=" . $config['host'] . ";dbname=" . $config["db_name"];
$conn = new PDO($conn_string, $config["username"], $config["password"]);