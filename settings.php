<html>
<?php
require_once 'db/connect.php';
?>
<form action="update.php" method="post">
old username: <br>
<input type="text" name="oldusername">
new username: <br> 
<input type="text" name="newusername"><br>
<input type="submit">
<br>
</form>
<?php
$conn = null;
?>
</html>