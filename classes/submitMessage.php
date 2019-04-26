<?php
require_once "Connection.php";
require_once "Contact.php";
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\"?>\n";
echo "<names>\n";
$Contact    = ContactUs::getInstance();
echo "</names>"; 
?>
