<?php
session_start();
if (!isset($_SESSION["session_username"])) {
    header("Location: login.php");
}
?>


<?php
require_once("php/connection.php");

if (isset($_POST["name"])) {
    if (!empty($_POST['name']) && !empty($_POST['surname'])) {
        $name    = htmlspecialchars($_POST['name']);
        $surname = htmlspecialchars($_POST['surname']);
        $query   = mysql_query("SELECT * FROM timetable.teachers WHERE name='" . $name . "' AND surname='" . $surname . "'");
        $numrows = mysql_num_rows($query);
        if ($numrows == 0) {
            $sql    = "INSERT INTO timetable.teachers
(name, surname)
VALUES('$name','$surname')";
            $result = mysql_query($sql);
            if ($result) {
                echo "<div class=\"alert alert-success\" role=\"alert\">
        <strong>Все отлично!</strong> Преподаватель успешно добавлен в базу данных.
      </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
        <strong>Ошибка!</strong> Ошибка добавления преподавателя в базу данных.
      </div>";
            }
        } else {
            echo "<div class=\"alert alert-warning\" role=\"alert\">
        <strong>Предупреждение!</strong> Такой преподаватель уже существует в базе данных.
      </div>";
        }
    } else {
        echo "<div class=\"alert alert-warning\" role=\"alert\">
        <strong>Предупреждение!</strong> Нужно заполнить все поля.
      </div>";
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

    <title>Расписание</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

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

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ВГУ ПММ</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/amm-vsu.ru/">Главная страница</a></li>
            <li><a href="subjects.php">Предметы</a></li>
            <li class="active"><a href="teachers.php">Преподаватели</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Выйти</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Введите данные преподавателя</h1>
        <hr>
        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">
        
        <form action="/amm-vsu.ru/teacher-add.php" id="loginform" method="post" name="loginform" class="form-signin">

          <input type="text" name="name" class="form-control" placeholder="Имя" required autofocus>
          <input style="margin-top: 10px;" type="text" name="surname" class="form-control" placeholder="Фамилия" required>

          <button class="btn btn-lg btn-success btn-block" style="margin-top: 30px;" type="submit">Сохранить</button>
          <button onclick="location.href = 'teachers.php';" type="button" class="btn btn-lg btn-link ">Назад</button>
        </form>
       </div>
        
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
