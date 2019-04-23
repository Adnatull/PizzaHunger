<?php 
require_once "classes/Session.php";
$data = Session::getStart();
require_once "classes/Connection.php";
require_once "classes/Auth.php";
$Auth = Auth::getInstance();
require_once "header.php";
?>

<form action="signup.php" method="post">
    <label for="Email">Email: </label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password: </label>
    <input type="password" name="password" id="password" required>

    <label for="confirm_password">Confirm Password: </label>
    <input type="password" name="confirm_password" id="confirm_password" required>

    <input type="submit" value="Sign-UP" name="signup">
</form>

<?php 
require_once "footer.php";
?>