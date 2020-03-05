<html>
<head>

</head>
<body>
<?php
require_once 'db/connect.php';

if ($_SESSION["logged"] == 0){
    $conn = null;
    header("location: index.php");
}

$display = $_GET["image"];
$getpic = $conn->prepare("SELECT * FROM gallery WHERE img_id = '$display'");
$getpic->execute();
$pic = $getpic->fetch();
$picture = $pic["filename"];
$picid = $pic["img_id"];
$getlikes= $conn->prepare("SELECT * FROM likes WHERE img_id = '$display'");
$getlikes->execute();
$likes = $getlikes->fetch();
$like = $likes["likes"];
$getComments = $conn->prepare("SELECT * FROM comments WHERE img_id = '$display'");
$getComments->execute();
$comments = $getComments->fetchall();
$findowner = $pic["id"];
$getNotifications = $conn->prepare("SELECT * FROM user WHERE id = $findowner");
$getNotifications->execute();
$notification = $getNotifications->fetch();
$_SESSION["imgowner"] = $notification["id"];
$_SESSION["notifications"] = $notification["notifications"];
?>
<form action="profile.php" method="post">
<input type="submit" value="Profile">
</form>
<form action="logout.php" method="post">
<input type="submit" name="logout" value="Logout">
</form>
<div><img src= "images/gallery/<?php echo $picture ?>" alt= <?php echo $picture ?> style="img"></div>
<div> <?php foreach($comments as $comment){
    echo $comment["comment"] . '<br>';
}
    ?> </div>
<form action="comment.php" method="post">
Comment: <input type="text" name="comment" pattern="[a-zA-Z0-9 !@#$%^*_|]{1,255}">
<input type="submit" name="submit" value="comment"<?php  $_SESSION["display"] = $display ?>>
</form>
<form method="post">
Likes <?php echo $like ?> :<input type="submit" name="like" value="like">
</form>

<?php
if (isset($_POST["like"])){
    $like = $like + 1;
    $stmt = $conn->prepare("UPDATE likes SET likes = :likes WHERE img_id = :display");
    $stmt->bindparam(':likes', $like);
    $stmt->bindparam(':display', $display);
    $stmt->execute();
    if ($_SESSION["notifications"] == 1){

        $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindparam(':id', $_SESSION["imgowner"]);
        $stmt->execute();
        $mail = $stmt->fetch();
        $email = $mail["email"];
        $to = $email;
        $subject = 'Liked';
        $message = '
        Someone just liked your pitcure!
        
        You have:'.$like.' like/s
        ';
        
        $headers = 'From:noreply@camagru.com';
        mail($to, $subject, $message, $headers);
    }
    header("Refresh:0");
}
?>

<form method="post">
DELETE: <input type="submit" name="delete" value="DELETE">
</form>
<?php

echo $_POST["delete"];

if (isset($_POST["delete"])){
    echo "FUCKED";
    $sql = "DELETE FROM gallery WHERE img_id = $picid";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    header('Location: profile.php');
}

?>
</body>
</html>