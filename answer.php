<?php
  $answer = $_POST['answer'];
  $id=$_POST['id'];

  if ($answer == '' ){
      header('Location: toppage.php');
      exit();
  }

  $dsn = 'mysql:host=localhost;dbname=uskprogram;charset=utf8';
  $user = 'usk';
  $password = '1322';


  
  try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $db->prepare("
      UPDATE pile SET answer = :answer WHERE id = :id");
      $stmt->bindParam(':answer',$answer,PDO::PARAM_STR);
      $stmt->bindParam(':id',$id,PDO::PARAM_STR);
      $stmt->execute();
      
    header('Location: toppage.php');
    exit();
  } catch (PDOException $e){
      exit('データベースに接続できませんでした'.$e->getMessage());
  }
  ?>