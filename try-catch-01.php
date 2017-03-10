<?php
try {
  include 'exeption-throw.php';
} catch (Exception $e) {
  echo $e->getMessage()."\n";
  exit();
}
