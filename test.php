<?php
  require __DIR__ . '/vendor/autoload.php';
  ini_set('display_errors', 'On');
  $conn = new MongoDB/Driver/Manager("mongodb://test:test@ds155091.mlab.com:55091/u_mon_test");
?>
