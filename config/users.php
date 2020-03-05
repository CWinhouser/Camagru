<?php
require_once '../db/connect.php';

$username = "CarlWinhouser";
$password = "1234";
$email = "kyletwomey99@gmail.com";
$active = "0";
$hash = password_hash($password, PASSWORD_DEFAULT);
$url = $hash;
$notifications = "0";

$stmt = $conn->prepare("INSERT INTO user (`username`, `pass`, `email`, `active`, `url`, `notifications`) VALUES (:username, :pass, :email, :active, :url, :notifications)");
$stmt->bindparam(':username', $username);
$stmt->bindparam(':pass', $hash);
$stmt->bindparam(':email', $email);
$stmt->bindparam(':active', $active);
$stmt->bindparam(':url', $url);
$stmt->bindparam(':notifications', $notifications);
$stmt->execute();

?>
