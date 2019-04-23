<?php 
require_once "classes/Session.php";
$data = Session::getStart();
require_once "classes/Connection.php";
require_once "classes/Auth.php";
$Auth = Auth::getInstance();
require_once "header.php";
?>

<form action="login.php" method="post">
    <label for="Email">Email: </label>
    <input type="email" name="email" id="email">

    <label for="password">Password: </label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Login" name="login">
</form>

<?php 
require_once "footer.php";
?>