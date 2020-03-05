<?php
require 'db/connect.php';

if (isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['hash']) && !empty($_GET['hash'])){
    $email = $_GET['email'];
    $hash = $_GET['hash'];
} else if (!isset($_GET["url"])){
    echo 'Invalid verification attempt';
} else{
    $mail = $_SESSION["email"];
}

$getUser = $conn->prepare("SELECT * FROM user WHERE email = '$email'");
$getUser->execute();
$user = $getUser->fetch();
if (isset($_GET["url"])){
$getUser = $conn->prepare("SELECT * FROM user WHERE email = '$mail'");
$getUser->execute();
$user = $getUser->fetch();
}
$id = $user["id"];
$pass = $user["pass"];

if ($email == $user["email"] && $hash == $user["url"] && !isset($mail)){
$active = 1;
$stmt = $conn->prepare("UPDATE user SET active=:active WHERE id = $id");
$stmt->bindparam(':active', $active);
$stmt->execute();
$_SESSION["logged"] = 1;
$_SESSION["user"] = $email;
$_SESSION["id"] = $id;
$conn = null;
header("location: index.php");
} else if (isset($_GET["url"])) {
    ?>
<form method="post">
password: <br>
<input type="text" name="password"> <br>
retype password: <br> 
<input type="text" name="retype"><br>
<input type="submit">
<br>
</form>
    <?php
    if (isset($_POST["password"])){
    $password = $_POST["password"];
    $retype = $_POST["retype"];
    if (ctype_lower($retype)){
        die ("password must contain at least one upper case character");
      }
    if(!preg_match('/^[a-z\d_]{2,16}$/i', $password)){
        die ("Please enter a valid password");
    }   else {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if (password_verify($password, $user["pass"])){
        die ("You must create a new password");
    } 
    if ($password == $retype){
    if (password_verify($retype, $hash)){
        $stmt = $conn->prepare("UPDATE user SET `pass`='$hash' WHERE email = '$mail'");
        $stmt->execute();
        header("location: index.php");
                }
            } else {
                die ("Passwords are not the same");
            }
        }
    }
    $conn = null;
}
?>