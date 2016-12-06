<?php
session_start();
if (!isset($_SESSION["session_username"])) {
    header("Location: login.php");
}
?>


<?php
require_once("php/connection.php");

if (isset($_POST["subjectcabinet"])) {
    if (!empty($_POST['subjectcabinet'])) {
        $name_temp = explode(" ", $_POST['subjectcabinet']);
        $subject   = htmlspecialchars($name_temp[0]);
        $cabinet   = htmlspecialchars($name_temp[1]);
        $query     = mysql_query("SELECT * FROM timetable.subjects WHERE subject='" . $subject . "' AND cabinet='" . $cabinet . "'");
        $numrows   = mysql_num_rows($query);
        if ($_POST['action'] == "delete") {
            if ($numrows != 0) {
                $sql    = "DELETE FROM timetable.subjects WHERE subject='" . $subject . "' AND cabinet='" . $cabinet . "'";
                $result = mysql_query($sql);
                if ($result) {
                    echo "<div class=\"alert alert-success\" role=\"alert\">
          <strong>Все отлично!</strong> Предмет удален из базы данных.
        </div>";
                } else {
                    echo "<div class=\"alert alert-danger\" role=\"alert\">
          <strong>Ошибка!</strong> Ошибка какая-то странная.
        </div>";
                }
            } else {
                echo "<div class=\"alert alert-warning\" role=\"alert\">
            <strong>Предупреждение!</strong> Такого предмета нет в базе данных.
          </div>";
            }
        }
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

    <title>Starter Template for Bootstrap</title>

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
          <a class="navbar-brand" href="#">Расписание</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/amm-vsu.ru/">Главная страница</a></li>
            <li class="active"><a href="subjects.php">Предметы</a></li>
            <li><a href="teachers.php">Преподаватели</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Выйти</a></li>
          </ul>
        </div>
        <!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">

        <h1>Выберите предмет</h1>
        <hr>
        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">

          <form action="/amm-vsu.ru/subject-delete.php" id="loginform" method="post" name="loginform" class="form-signin">
            <div class="form-group">
              <select class="form-control" id="sel1" name="subjectcabinet">
                <?php

$query   = mysql_query("SELECT * FROM timetable.subjects");
$numrows = mysql_num_rows($query);

while ($row = mysql_fetch_assoc($query)) {
    $vall = $row['subject'] . " " . $row['cabinet'];
    echo "<option value=\"" . $vall . "\">" . $row['subject'] . " | ауд. " . $row['cabinet'] . ", преп. " . $row['teacher'] . ", " . $row['time'] . "</option>";
}
?>
              </select>
            </div>
            <p style="margin-top: 30px;">
              <button class="btn btn-lg btn-danger" type="submit" value="delete" name="action">Удалить</button>
              <button onclick="location.href = 'subjects.php';" type="button" class="btn btn-lg btn-link btn-block">Назад</button>
            </p>
          </form>
        </div>

      </div>
      <!-- /.container -->


      <!-- Bootstrap core JavaScript
    ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script>
        window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>

  </html>