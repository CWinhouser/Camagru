<?php
session_start();

$conn = new PDO('mysql:host=localhost;dbname=app', "root", "Dem0lition");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>