<?php
require_once 'db/connect.php';
if (isset($_POST["logout"]) || isset($_GET["logout"])){
    session_destroy();
    $conn = null;
    header("location: index.php");
} else if (!isset($_POST["logout"])){
header ("location: index.php");
}
?>