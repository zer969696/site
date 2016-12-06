<?php
session_start();
if (!isset($_SESSION["session_username"])) {
    header("Location: login.php");
}
?>


<?php
require_once("php/connection.php");

if (isset($_POST['course'])) {
    if (!empty($_POST['group']) && !empty($_POST['subject']) && !empty($_POST['cabinet']) && !empty($_POST['teacher']) && !empty($_POST['time'])) {
        $course   = htmlspecialchars($_POST['course']);
        $group    = htmlspecialchars($_POST['group']);
        $subgroup = htmlspecialchars($_POST['subgroup']);
        $subject  = htmlspecialchars($_POST['subject']);
        $cabinet  = htmlspecialchars($_POST['cabinet']);
        $teacher  = htmlspecialchars($_POST['teacher']);
        $time     = htmlspecialchars($_POST['time']);
        
        $query   = mysql_query("SELECT * FROM timetable.subjects WHERE cabinet='" . $cabinet . "' AND time='" . $time . "'");
        $numrows = mysql_num_rows($query);
        
        while ($row = mysql_fetch_assoc($query)) {
            $dbteacher = $row['teacher'];
        }
        if (($numrows == 0) || ((($numrows != 0)) && ($dbteacher == $teacher))) {
            
            $sql = "INSERT INTO timetable.subjects (`id`, `course`, `group`, `subgroup`, `subject`, `cabinet`, `teacher`, `time`)
VALUES(NULL,'$course','$group','$subgroup','$subject','$cabinet','$teacher','$time')";
            
            $result = mysql_query($sql);
            if ($result) {
                echo "<div class=\"alert alert-success\" role=\"alert\">
        <strong>Все отлично!</strong> Предмет успешно добавлен в расписание.
      </div>";
            } else {
                echo "<div class=\"alert alert-danger\" role=\"alert\">
        <strong>Ошибка!</strong> Ошибка добавления предмета в расписание.
      </div>";
            }
        } else {
            echo "<div class=\"alert alert-warning\" role=\"alert\">
        <strong>Предупреждение!</strong> Этот кабинет уже занят в это время.
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
        <h1>Введите данные о предмете</h1>
        <hr>
        <div class="col-md-6 col-md-offset-3" style="margin-top: 50px;">

          <form action="/amm-vsu.ru/subject-add.php" id="loginform" method="post" name="loginform" class="form-signin">

            <!--<input type="text" name="name" class="form-control" placeholder="Курс" required autofocus>-->
            <select class="form-control" id="sel1" name="course" required autofocus>
              <option value="1">1 курс</option>
              <option value="2">2 курс</option>
              <option value="3">3 курс</option>
              <option value="4">4 курс</option>
              <option value="5">5 курс</option>
              <option value="6">6 курс</option>
            </select>
            <!--<input style="margin-top: 10px;" type="text" name="group" class="form-control" placeholder="Группа" required>-->
            <select style="margin-top: 10px;" class="form-control" id="group-select" name="group" required>
              <option value="1 мех">1 мех</option>
              <option value="ФММ">ФММ</option>
              <option value="ВМ">ВМ</option>
              <option value="ТКиАР">ТКиАР</option>
              <option value="МиПА">МиПА</option>
              <option value="НК">НК</option>
              <option value="ММИО">ММИО</option>
              <option value="МО ЭВМ">МО ЭВМ</option>
              <option value="ФИИТ">ФИИТ</option>
              <option value="БИ">БИ</option>
              <option value="МОиАИС">МОиАИС</option>
            </select>
            
             <select style="margin-top: 10px;" class="form-control" name="subgroup" id="subgrp-meh">
              <option disabled selected value> -- select an option -- </option>
              <option value="ММКИ">ММКИ</option>
              <option value="МДТС">МДТС</option>
            </select>
            
            <select style="margin-top: 10px;" class="form-control" name="subgroup" id="subgrp-tkiar">
             <option disabled selected value> -- select an option -- </option>
              <option value="КИС">КИС</option>
              <option value="ОЗИ">ОЗИ</option>
            </select>
            
            <select style="margin-top: 10px;" class="form-control" name="subgroup" id="subgrp-other">
              <option disabled selected value> -- select an option -- </option>
              <option value="1 подгруппа">1 подгруппа</option>
              <option value="2 подгруппа">2 подгруппа</option>
            </select>

            <!--<input style="margin-top: 10px;" type="text" name="subgroup" class="form-control" placeholder="Подгруппа" id="subgrp">-->
            <input style="margin-top: 10px;" type="text" name="subject" class="form-control" placeholder="Предмет" required>
            <input style="margin-top: 10px;" type="text" name="cabinet" class="form-control" placeholder="Аудитория" required>
            <select class="form-control" id="sel1" name="teacher" style="margin-top: 10px;">
              <?php

$query   = mysql_query("SELECT * FROM timetable.teachers");
$numrows = mysql_num_rows($query);

while ($row = mysql_fetch_assoc($query)) {
    echo "<option>" . $row['name'] . " " . $row['surname'] . "</option>";
}
?>
            </select>
            <select class="form-control" id="sel2" name="time" style="margin-top: 10px;">
              <option value="8.00 - 9.35">1 пара (8.00 - 9.35)</option>
              <option value="9.45 - 11.20">2 пара (9.45 - 11.20)</option>
              <option value="11.30 - 13.05">3 пара (11.30 - 13.05)</option>
              <option value="13.25 - 15.00">4 пара (13.25 - 15.00)</option>
              <option value="15.10 - 16.45">5 пара (15.10 - 16.45)</option>
              <option value="16.55 - 18.30">6 пара (16.55 - 18.30)</option>
              <option value="18.40 - 20.00">7 пара (18.40 - 20.00)</option>
            </select>

            <button class="btn btn-lg btn-success btn-block" style="margin-top: 30px;" type="submit">Добавить предмет в расписание</button>
            <button onclick="location.href = 'subjects.php';" type="button" class="btn btn-lg btn-link ">Назад</button>
          </form>
        </div>

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

    <script type="text/javascript">
      $('#subgrp-tkiar').hide();
      
      $('#subgrp-other').hide();
      
      $('#group-select').change(function () {
        switch ($(this).val()) {
          case "1 мех":
            $('#subgrp-meh').show();
            $('#subgrp-tkiar').hide();
            $('#subgrp-other').hide();
            break;
          case "ТКиАР":
            $('#subgrp-tkiar').show();
            $('#subgrp-meh').hide();
            $('#subgrp-other').hide();
            break;
          case "ФИИТ":
            $('#subgrp-other').show();
            $('#subgrp-tkiar').hide();
            $('#subgrp-meh').hide();
            break;
          case "БИ":
            $('#subgrp-other').show();
            $('#subgrp-tkiar').hide();
            $('#subgrp-meh').hide();
            break;
          case "МОиАИС":
            $('#subgrp-other').show();
            $('#subgrp-tkiar').hide();
            $('#subgrp-meh').hide();
            break;
          default:
            $('#subgrp-tkiar').hide();
            $('#subgrp-meh').hide();
            $('#subgrp-other').hide();
            break;
          
        }
      });
    </script>
  </body>

  </html>
