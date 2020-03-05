<?php
require 'db/connect.php';

$_SESSION["logged"] = 0;

$username = $_POST["name"];
$password = $_POST["password"];
$hash = password_hash($password, PASSWORD_DEFAULT);

try {
    $getUser = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $getUser->bindparam(":username", $username);
    if ($getUser->execute()){
        $user = $getUser->fetch();
    } else {
        die ("Incorrect Username chief");
    }
}
catch (PDOException $e) 
{
    print "Error : ".$e->getMessage()."<br/>";
    die("What");
}
if (strcmp($user["username"], $username) == 0 ){
    if (password_verify($password, $user["pass"])){
    if ($user["active"] == 1){
        $_SESSION["logged"] = 1;
        $_SESSION["user"] = $user["email"];
        $_SESSION["id"] = $user["id"];
        $_SESSION["email"] = $user["email"];
    } else if ($user["active"] == 0){
        echo "Your account needs to be activated would you like us to resend your email?";
?>
<form action="mail.php" method="post">
e-mail: <br> 
<input type="text" name="email" rows="5" cols="50" size="50"><br>
<br>
<input type="submit" value="send new mail">
</form>
<?php
        }
    } else {
        die ("The password entered was incorrect");
    }
}

if ($_SESSION["logged"] == 1){
$conn = null;
header("location: index.php");
}
?>