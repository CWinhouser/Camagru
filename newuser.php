<?php
require 'db/connect.php';

if ($_SESSION["logged"] == 0){
$username = $_POST["name"];

$password = $_POST["password"];

$retype = $_POST["retype"];

$email = $_POST["email"];

$url = $_POST["name"];

$active = 0;

if (ctype_lower($password)){
  die ("password must contain at least one upper case character");
}

if(!preg_match('/^[a-z\d_]{2,16}$/i', $username)){
  die ("Please enter a valid username");
}

if(!preg_match('/^[a-z\d_]{2,16}$/i', $password)){
  die ("Please enter a valid password");
}

$url = password_hash($url, PASSWORD_DEFAULT);

$getUsers = $conn->prepare("SELECT * FROM user");
$getUsers->execute();
$users = $getUsers->fetchall();
foreach ($users as $user) {
  if ($user['username'] == $username)
  {
    die ('Username alreday exists');
  }
  if ($user['email'] == $email){
    die ('That email address is already in use');
  }
}

$notifications = 0;

$hash = password_hash($password, PASSWORD_DEFAULT);
if ($password == $retype){
if (password_verify($password, $hash)){
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
  die ('incorrect email format');
} else {
$stmt = $conn->prepare("INSERT INTO user (`username`, `pass`, `email`, `active`, `url`, `notifications`) VALUES (:username, :pass, :email, :active, :url, :notifications)");
$stmt->bindparam(':username', $username);
$stmt->bindparam(':pass', $hash);
$stmt->bindparam(':email', $email);
$stmt->bindparam(':active', $active);
$stmt->bindparam(':url', $url);
$stmt->bindparam(':notifications', $notifications);
$stmt->execute();
    }
  } else {
    echo 'hash failed';
  }
} else {
  echo "Passwords don't match";
}

echo $email;

$to = $email;
$subject = 'Verification';
$message = '

Thanks for signing up!
You can find your login details below.

Username = '.$username.'
Password = '.$password.'

Please click the link below to activate your account:

http://www.localhost:8080/camagru/verify.php?email='.$email.'&hash='.$url.'
';

$headers = 'From:noreply@camagru.com';
mail($to, $subject, $message, $headers);

echo $username;
$conn = null;
header("location: index.php");
} else{
  header("location: index.php");
}
?>