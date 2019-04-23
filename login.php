<?php 
require_once "classes/Session.php";
$data = Session::getStart();
require_once "classes/Connection.php";
require_once "classes/Auth.php";
require_once "header.php";
?>

<?php 
require_once "footer.php";
?>