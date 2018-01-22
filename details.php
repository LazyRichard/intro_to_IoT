<!DOCTYPE html>
<html>
<head>
  <title>AmbiLamp</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/details.css">

</head>

<?php
  include "header.php"
?>

<body>

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
      </tr>

<?php
  include "db.php";
  $db = new MyDB();

  $sql = "SELECT * FROM temp ORDER by ID DESC LIMIT 100";
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
      </tr>

<?php
      $db = new MyDB();
      $sql = "SELECT * FROM sound ORDER by ID DESC LIMIT 100";
      $ret = $db -> query($sql);
      while ($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
	      echo "<tr>";
	echo "<td>". $row['Timestamp']. "</td>";
	echo "<td>". $row['Audio']. "</td>";
	echo "</tr>";
      }

      $db -> close();
?>
     </table>
  </div>

<?php
  $db = new MyDB();
      $sql = "SELECT * FROM temp ORDER by ID DESC LIMIT 25";
      $ret = $db -> query($sql);
      $temperatureX = array();
      $temperatureData = array();
      while ($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
            array_push($temperatureX, $row['Timestamp']);
	    array_push($temperatureData, $row['Value']);
      }

      $sql = "SELECT * FROM sound ORDER by ID DESC LIMIT 25";
      $ret = $db -> query($sql);
      $audioX = array();
      $audioData = array();
      while ($row = $ret -> fetchArray(SQLITE3_ASSOC)) {
        array_push($audioX, $row['Timestamp']);
	array_push($audioData, $row['Audio']);
      }

    $db -> close();

    $js_tempX = json_encode($temperatureX);
    $js_tempData = json_encode($temperatureData);
    $js_audioX = json_encode($audioX);
    $js_audioData = json_encode($audioData);

    echo "<script type='text/javascript'>";
    echo "var temperatureX = ". $js_tempX. ";\n";
    echo "var temperatureData = ". $js_tempData. ";\n";
    echo "var audioX = ". $js_audioX. ";\n";
    echo "var audioData = ". $js_audioData. ";\n";
    echo "</script>";

?>

</body>

<script type="text/javascript" src="assets/js/details.js"></script>

</html>
