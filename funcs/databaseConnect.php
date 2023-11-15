<?php
//TODO: may need .env or similar
$host='';
$username='';
$password='';
$dbname='todoList';

try {
  $db=new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
  echo "error: " . $error->getMessage();
}
?> 