<?php
session_start();
require_once("php/connection.php");


if (isset($_POST["email"])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $username = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $query    = mysql_query("SELECT * FROM timetable.users WHERE email='" . $username . "' AND password='" . $password . "'");

        $numrows  = mysql_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysql_fetch_assoc($query)) {
                $dbusername = $row['email'];
                $dbpassword = $row['password'];
            }
            if ($username == $dbusername && $password == $dbpassword) {              
                $_SESSION['session_username'] = $username;

                header("Location: index.php");
            }
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
        <strong>Ошибка!</strong> Неверный логин или пароль. Попробуйте еще раз!
      </div>";
        }
    } else {
       echo "All fields are required!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form action="/amm-vsu.ru/login.php" id="loginform" method="post" name="loginform" class="form-signin">
        <h2 class="form-signin-heading">Пожалуйста войдите</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        
        <input type="text" name="email" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
        
        <label for="inputPassword" class="sr-only">Password</label>
        
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
        
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
