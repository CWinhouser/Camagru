<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />
</head>
<body>
<form action="logout.php" method="post">
<input type="submit" name="logout" value="Logout">
</form>
<?php
require_once 'db/connect.php';

$current = $_SESSION["user"];
$getuser = $conn->prepare("SELECT * FROM user WHERE email = '$current'");
$getuser->execute();
$user = $getuser->fetch();
$id = $_SESSION["id"];
$notification = $user["notifications"];
?>
<form action="settings.php">
<input type="submit" value="New Username" width="20">
<br>
</form>
<form action="verify.php" method="get">
<input type="submit" value="Change Password" name="url">
</form>
</form>
<form action="changemail.php" method="get">
<input type="submit" value="Change email" name="url">
</form>
<?PHP
    if($notification == 1){
?>
<a>Your Notifications are currently turned on</a>
<?PHP
    } else {
?>
<a> Your Notifications are currently turned off</a>
<?php
    }
?>
<form method="get">
<input type="submit" name="notifications" Value="Notifications" width ="20">
</form>
<?php
if (isset($_GET["notifications"])){
$notification = $user["notifications"];
if ($notification == 0)
{
    $stmt = $conn->prepare("UPDATE user SET notifications = 1 WHERE email = '$current'");
    $stmt->execute();
    header ("location: {$_SERVER['HTTP_REFERER']}");
} else {
    $stmt = $conn->prepare("UPDATE user SET notifications = 0 WHERE email = '$current'");
    $stmt->execute();
    header ("location: {$_SERVER['HTTP_REFERER']}");
    }
}
?>
<form action="newpic.php" method="post">
<input type="submit" name="Picture" Value="Take a Picture" width = "20">
</form>
<?php

$results_per_page = 6;
$number_of_rows = $conn->query("SELECT * FROM gallery WHERE id = $id")->rowCount();
$number_of_pages = ceil($number_of_rows / $results_per_page);
//echo $number_of_pages;

if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = $_GET['page'];
}

$page_display = ($page - 1) * $results_per_page;
echo $id . '<br>' . $results_per_page . '<br>' . $page_display . '<br>';
$stmt = $conn->prepare("SELECT * FROM gallery WHERE id = $id LIMIT $results_per_page OFFSET $page_display");
if ($stmt->execute())
{
$display = $stmt->fetchall();
} else {
    echo "yo this is fucked up";
}

foreach ($display as $pictures){
    ?>
    <div><a href="profileimage.php?image= <?php echo $pictures["img_id"]?>"> <img src= "images/gallery/<?php echo $pictures["filename"] ?>" alt= <?php echo $pictures["filename"] ?> style="img"></a></div>
<?php
}
$conn = null;
?> 
    <div class="pagination">
  <a href="Camagru/index.php/page=<?php $page - 1?>">&laquo;</a>
  <a href="Camagru/index.php/page=1">Start</a>
  <a href="Camagru/index.php/page=<?php $number_of_pages?>">End</a>
  <a href="Camagru/index.php/page=<?php $page + 1?>">&raquo;</a>
</div>
<div class="footer">
		<p class='right' style="color: white">&copyktwomey</p>	
		<ul class="footer">
			<li><a href="index.php">Home</a></li>
			<?php
			?>
		</ul>
	</div>
</body>
</html>
