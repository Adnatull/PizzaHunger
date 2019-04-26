<?php 
require_once "classes/Session.php";
$data = Session::getStart();
require_once "classes/Connection.php";
require_once "classes/Auth.php";
$Auth = Auth::getInstance();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="css/style2.css">

<!------ Include the above in your HEAD tag ---------->

</head>
<body>

<?php if(count($Auth->errors)>0): ?>
<?php foreach($Auth->errors as $error): ?>
  <h3> <?php echo $error; ?></h3>
<?php endforeach ?>
<?php endif ?>
 
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <!-- <div class="fadeIn first">
      <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
    </div> -->
    <div class="fadeIn first">
        <h1 class="text-danger">Login</h1>
    </div>

    <!-- Login Form -->
    <form action="login.php" method="POST">
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="Email">
      <br>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <br>
      <input type="submit" name="login" class="btn" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Sign Up</a>
    </div>

  </div>
</div>   
<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
</body>
</html>

