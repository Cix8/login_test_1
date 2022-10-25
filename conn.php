<?php
require_once("db_var.php");

$conn_string = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$conn = new PDO($conn_string, DB_USER, DB_PASSWORD);
