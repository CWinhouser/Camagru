<?php
require_once 'db/connect.php';
//if ($_SESSION["logged"] != 1){
  //  header("location: index.php");
//}


$email = $_POST["email"];
$url = password_hash($email, PASSWORD_DEFAULT);
$getUser = $conn->prepare("SELECT * FROM user WHERE email = '$email'");
$getUser->execute();
$user = $getUser->fetch();
$stmt = $conn->prepare("UPDATE user SET `url` = '$url' WHERE email = '$email'");
$stmt->execute();
$_SESSION["mail"] = "password";
$_SESSION["email"] = $email;
header("location: mail.php");
?>