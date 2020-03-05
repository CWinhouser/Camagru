<?php
require_once 'db/connect.php';
if ($_SESSION["logged"] != 1){
    header("location: index.php");
}

if (isset($_POST["oldusername"])){
$old = $_POST["oldusername"];
if(!preg_match('/^[a-z\d_]{2,16}$/i', $_POST["newusername"])){
    die ("Please enter a valid username");
}
$new = $_POST["newusername"];

$email = $_SESSION["user"];


$getUsers = $conn->prepare("SELECT * FROM user");
$getUsers->execute();
$users = $getUsers->fetchall();
foreach ($users as $user) {
  if ($user['username'] == $new)
  {
    die ('Username alreday exists');
  }
}

$getuser = $conn->prepare("SELECT username FROM user WHERE email = '$email'");
$getuser->execute();
$user = $getuser->fetch();
$id = $user["username"];

if ($id != $old){
    die ("please enter the correct username you want to change from");
} else if ($id == $new){
    die ("Username has nothing to change");
} else {
$stmt = $conn->prepare("UPDATE user SET username = '$new' WHERE username = '$old'");
$stmt->execute();
header("location: index.php");
}
} else if (isset($_POST["notifications"])) {
}
$conn = null;
?>