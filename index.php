<html>
    <head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/pic.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="css/w3.css" />
    <style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}
input[type=button], input[type=reset] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    cursor: pointer;
}
input[type=submit]{
background-color: Grey;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    width: 100px;
    cursor: pointer;
}
</style>
</head>
<body>

<?php
require 'db/connect.php';

if (!isset($_SESSION["logged"]))
    $_SESSION["logged"] = 0;
echo $_SESSION["logged"];

?>
<?php

if ($_SESSION["logged"] != 1){
?>

<form action="register.php">
<input type="submit" value="Register" width="20">
</form>
<form action="login.php">
<input type="submit" value="Login" width="20">
</form>

<?php
} else {
?>
<form action="profile.php" method="post">
<input type="submit" value="Profile">
</form>
<form action="logout.php" method="post">
<input type="submit" name="logout" value="Logout">
</form>
<?php
}

$results_per_page = 6;
$number_of_rows = $conn->query('SELECT * FROM gallery')->rowCount();
$number_of_pages = ceil($number_of_rows / $results_per_page);

if (!isset($_GET['page'])) {
    $page = 1;
}
else {
    $page = $_GET['page'];
}

$page_display = ($page - 1) * $results_per_page;
$stmt = $conn->prepare("SELECT * FROM `gallery` LIMIT $results_per_page OFFSET $page_display");
$stmt->execute();
$display = $stmt->fetchall();

foreach ($display as $pictures){
    ?>
    <div><a href="likecomment.php?image= <?php echo $pictures["img_id"]?>"> <img src= "images/gallery/<?php echo $pictures["filename"] ?>" alt= <?php echo $pictures["filename"] ?> style="img"></a></div>

<?php
}
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
			<?php
			?>
		</ul>
	</div>
</body>
</html>