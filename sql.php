<?php

$dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4aae764a6bba763;charset=utf8';
$user = 'b29e771eedb27c';
$password = '10698e23';

try{
  $db = new PDO($dsn,$user,$password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $stmt = $db->prepare("SELECT * FROM pile ");
  $stmt->execute();} catch(PDOException $e) {
  echo "エラー:" . $e->getMessage();}

$count = $stmt->rowCount();
?>