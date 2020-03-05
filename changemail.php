<?php
require_once 'db/connect.php';

if ($_SESSION["logged"] == 0){
    //header("location: index.php");
}
?>
<a> Please note that you will have to reactivate your account through your new email. </a>
<form method="post">
Old Email: <br>
<input type="text" name="email"> <br>
New Email: <br> 
<input type="text" name="newmail"><br>
<input type="submit">
<br>
</form>


<?php
$email = $_POST["email"];
$newmail = $_POST["newmail"];
$active = 0;
$getUser = $conn->prepare("SELECT * FROM user WHERE email = :email");
$getUser->bindparam(":email", $email);
$getUser->execute();
$user = $getUser->fetch();
$test = $_POST["email"];
if ($test == $user["email"] && !empty($test)){
    $id = $_SESSION["id"];
} else if (isset($_POST["email"])){
    die ("Your current emails don't match");
}
if (!filter_var($newmail, FILTER_VALIDATE_EMAIL) && isset($_POST["newmail"])) {
    $emailErr = "Invalid email format";
    die ("incorrect email format");
} else if (isset($_POST["email"]) && isset($_POST["newmail"])){
    echo $newmail . '<br>';
    $stmt = $conn->prepare("UPDATE user SET email= :newmail, active=:active WHERE id = :id");
    $stmt->bindparam(':newmail', $newmail);
    $stmt->bindparam(':id', $id);
    $stmt->bindparam(':active', $active);
    $stmt->execute();
    header ('location: logout.php?logout=yeet');
}

?>