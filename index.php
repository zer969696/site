<?php
session_start();
if (!isset($_SESSION["session_username"])) {
    header("Location: login.php");
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
          <li class="active"><a href="/amm-vsu.ru/">Главная страница</a></li>
          <li><a href="subjects.php">Предметы</a></li>
          <li><a href="teachers.php">Преподаватели</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php">Выйти</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </nav>

  <!--<div class="container">-->

    <div class="starter-template">
      <div class="col-md-12" style ="width:auto;">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>КУРС</th>
              <th>1 мех (ММКИ)</th>
              <th>1 мех (МДТС)</th>
              <th>ФММ</th>
              <th>ВМ</th>
              <th>ТКиАР (КИС)</th>
              <th>ТКиАР (ОЗИ)</th>
              <th>МиПА</th>
              <th>НК</th>
              <th>ММИО</th>
              <th>МО ЭВМ</th>
              <th>ФИИТ (1 подгруппа)</th>
              <th>ФИИТ (2 подгруппа)</th>
              <th>БИ (1 подгруппа)</th>
              <th>БМ (2 подгруппа)</th>
              <th>МОиАИС (1 подгруппа)</th>
              <th>МОиАИС (2 подгруппа)</th>
            </tr>
          </thead>
          <tbody>
            <?php
require_once("php/connection.php");

$query = mysql_query("SELECT * FROM timetable.subjects");

$arr_time = array(
    "8.00 - 9.35",
    "9.45 - 11.20",
    "11.30 - 13.05",
    "13.25 - 15.00",
    "15.10 - 16.45",
    "16.55 - 18.30",
    "18.40 - 20.00"
);

$arr_group = array(
    "1 мех (ММКИ)",
    "1 мех (МДТС)",
    "ФММ",
    "ВМ",
    "ТКиАР (КИС)",
    "ТКиАР (ОЗИ)",
    "МиПА",
    "НК",
    "ММИО",
    "МО ЭВМ",
    "ФИИТ (1 подгруппа)",
    "ФИИТ (2 подгруппа)",
    "БИ (1 подгруппа)",
    "БИ (2 подгруппа)",
    "МОиАИС (1 подгруппа)",
    "МОиАИС (2 подгруппа)"
);
foreach ($arr_time as &$valuetime) {
    echo "<tr>";
    echo "<td>$valuetime</td>";
    
    
    foreach ($arr_group as &$valuegroup) {
        mysql_data_seek($query, 0);
        $flag = false;
        
        while ($row = mysql_fetch_assoc($query)) {
            $dbcourse   = $row['course'];
            $dbgroup    = $row['group'];
            $dbsubgroup = $row['subgroup'];
            $dbsubject  = $row['subject'];
            $dbcabinet  = $row['cabinet'];
            $dbteacher  = $row['teacher'];
            $dbtime     = $row['time'];
            
            
            if (empty($dbsubgroup)) {
                $dbgroup = $dbgroup;
                
                if ($dbtime == $valuetime) {
                    if ($dbgroup == $valuegroup) {
                        echo "<td>" . $dbsubject . "<br>" . $dbcabinet . "<br>" . $dbteacher . "</td>";
                        $flag = true;
                    }
                }
            } else {
                $dbgroup = $dbgroup . " (" . $dbsubgroup . ")";
                
                if ($dbtime == $valuetime) {
                    if ($dbgroup == $valuegroup) {
                        echo "<td>" . $dbsubject . "<br>" . $dbcabinet . "<br>" . $dbteacher . "</td>";
                        $flag = true;
                    }
                }
            }
        }
        
        if ($flag) {
            $flag = false;
        } else {
            echo "<td></td>";
        }
        
    }
    echo "</tr>";
}

?>
              
              <?
php;
?>
              <!--
              <tr>
                <td>8.00 - 9.35</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
                <td>предмет</td>
              </tr>
              -->
          </tbody>
        </table>
      </div>
   <!-- </div>-->

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