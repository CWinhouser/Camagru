<?php
require_once 'db/connect.php';

if ($_SESSION["notifications"] == 1){

  $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
  $stmt->bindparam(':id', $_SESSION["imgowner"]);
  $stmt->execute();
  $mail = $stmt->fetch();
  $email = $mail["email"];
  $to = $email;
  $subject = 'Comment';
  $message = '
  Someone just commented on your pitcure!
  
  '.$_POST["comment"].'
  ';
  
  $headers = 'From:noreply@camagru.com';
  mail($to, $subject, $message, $headers);
}

echo $_POST["comment"];


if(!preg_match('/^[a-z\d_\w\W]{1,255}$/i', $_POST["comment"])){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    die("WTF");
  }
$stmt = $conn->prepare("INSERT INTO comments (`img_id`, `user_id`, `comment`) VALUES (:img_id, :user_id, :comment)");
$stmt->bindparam(':comment', $_POST["comment"]);
$stmt->bindparam(':user_id', $_SESSION["id"]);
$stmt->bindparam(':img_id', $_SESSION["display"]);
$stmt->execute();
unset($_SESSION["display"]);
header('Location: ' . $_SERVER['HTTP_REFERER']);
$conn = NULL;
?>