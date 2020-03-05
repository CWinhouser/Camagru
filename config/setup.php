<?php
include 'config.php';

$dbname = "app";

$conn = new PDO("mysql:host=localhost", $DB_USER, $DB_PASSWORD);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$dbname = "`".str_replace("`","``",$dbname)."`";
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->query("use $dbname");

try {
    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(16) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    active INT(1) NOT NULL,
    notifications INT(1) NOT NULL
    )";
    // use exec() because no results are returned
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS gallery (
        id INT(6) NOT NULL,
        `filename` VARCHAR(255) NOT NULL
        )";
    
    $conn->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS likes(
        id INT(6) NOT NULL,
        likes INT(6) NOT NULL,
        `filename` VARCHAR(255) NOT NULL
        )";

    $conn->exec($sql);
    }
catch(PDOException $e)
{
    $e->getMessage();
}

?>