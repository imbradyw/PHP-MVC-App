<?php
try {
  $db = new PDO("mysql:host=localhost; dbname=comp1006", 'root', '');
}
catch (PDOException $e) {
  $error_message = $e->getMessage(); 
  include('../errors/database_error.php');
  exit();
}
?>