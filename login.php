<html>
    <head>
    <style>
a {
    display: inline; /* the default for span */
    width: 100px;
    height: 100px;
    padding: 5px;
    border: 1px solid blue;    
    background-color: yellow; 
}
/*input[type=button], input[type=reset] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    cursor: pointer;
}*/

.register{
    padding: 200px;
    text-align: center;
}

input[type=submit]{
    left: center;
    background-color: Grey;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    cursor: pointer;
}

</style>
</head>
<body>
<div class="register">
<form action="accept.php" method="post">
Username: <br>
<input type="text" name="name" size="50"><br>
password: <br>
<input type="text" name="password" size="50"><br>
<br>
<input type="submit">
</form>
<p><a href="http://www.localhost:8080/camagru/forgotpassword.php">Forgot Password?</a></p>
</div>

</body>
</html>