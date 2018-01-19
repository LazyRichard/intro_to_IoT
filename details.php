<!DOCTYPE html>
<html>
<head>
  <title>AmbiLamp</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/details.css">

</head>

<body>

<?php
  include "header.php"
?>

<input type="button" id="temp-btn" class="btn" value="View Temperature Chart" onclick="drawTemp()">
<canvas id="temp-chart-long" class="chart" width="900" height="350" hidden></canvas>
<input type="button" id="sound-btn" class="btn" value="View Sound Chart" onclick="drawSound()">
<canvas id="sound-chart-long" class="chart" width="900" height="350" hidden></canvas>

<div id="tables">
  <div class="table">
    <table id="temperature">
      <tr>
	<th>Time</th>
	<th>Temperature</th>
	<th>Deviation from Average</th>
      </tr>

<?php
      ini_set('display_errors', 'On');
      include "db.php"
      $db = new MyDB();

      $sql =<<<EOF
SELECT * FROM temp LIMIT 100;
EOF;
      $ret = $db -> query($sql);

      while($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
	echo "<td>". $row['Timestamp']. "</td>";
	echo "<td>". $row['Value']. "</td>";
	echo "</tr>";
      }

      $db -> close();
    ?>

    </table>
  </div>
  <div class="table">
    <table id="sound">
      <tr>
        <th>Time</th>
	<th>Amplitude</th>
	<th>Deviation from Average</th>
      </tr>

<!--?php
      $db = new MyDB();
      $sql =<<<EOF
SELECT * FROM sound LIMIT 100;
EOF;
      $ret = $db -> query($sql);
      while ($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
	      echo "<tr>";
	echo "<td>". $row['Timestamp']. "</td>";
	echo "<td>". $row['Audio']. "</td>";
	echo "</tr>";
      }

      $db -> close();
?-->
     </table>
  </div>

<!--?php
  $db = new MyDB();
      $sql =<<<EOF
SELECT * FROM temp LIMIT 25;
EOF;
      $ret = $db -> query($sql);
      $temperatureX = array();
      $temperatureData = array();
      while ($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
            array_push($temperatureX, $row['Timestamp']);
	    array_push($temperatureData, $row['Value']);
      }

      $db -> close();

  
      echo "<script>";
      echo "var temperatureData = ". $temperatureData;
      echo "var temperatureX = ". $temperatureX;
      echo "</script>";
//      echo "temperatureX = ". $temperatureX;
//      echo "temperatureData = ". $temperatureData;
?-->

</body>

<script type="text/javascript" src="assets/js/details.js"></script>

</html>
