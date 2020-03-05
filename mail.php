<?php
require_once 'db/connect.php';

if (isset($_POST["email"])){
$email = $_POST["email"];
try {
$getUser = $conn->prepare("SELECT * FROM user WHERE email= :email");
$getUser->bindparam(":email", $email);
$getUser->execute();
$users = $getUser->fetch();
if ($email != $users["email"]){
    die ("Emails do not match");
}
} catch (PDOException $e) {
    print "Error : ".$e->getMessage()."<br/>";
    die("Emails do not match");
}
$url = $users["url"];
$username = $users["username"];
$password = $users["pass"];

$to = $email;
$subject = 'Verification';
$message = '

Please click the link below to activate your account:

http://www.localhost:8080/camagru/verify.php?email='.$email.'&hash='.$url.'
';

$headers = 'From:noreply@camagru.com';
mail($to, $subject, $message, $headers);

$conn =null;
header("location: index.php");
}
else if (isset($_SESSION["mail"])){
    if ($_SESSION["mail"] = "password"){            /* PASSWORD RESET EMAIL */

$email = $_SESSION["email"];
$getUser = $conn->prepare("SELECT * FROM user WHERE email= '$email'");
$getUser->execute();
$users = $getUser->fetch();
$url = $users["url"];
$username = $users["username"];

$to = $email;
$subject = 'Verification';
$message = '

You have requested for a password reset. If you have not requested for this reset please ignore this email.

If you have requested for the reset please click the link below and enter your new password.

http://www.localhost:8080/camagru/verify.php?url='.$url.'
';

$headers = 'From:noreply@camagru.com';
mail($to, $subject, $message, $headers);
$_SESSION["mail"] = null;
$conn =null;
header("location: index.php");
    }
}

?>