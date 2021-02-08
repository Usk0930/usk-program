<?php
  $answer = $_POST['answer'];
  $id=$_POST['id'];

  if ($answer == '' ){
      header('Location: index.php');
      exit();
  }

  $dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4aae764a6bba763;charset=utf8';
  $user = 'b29e771eedb27c';
  $password = '10698e23';


  
  try{
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $db->prepare("
      UPDATE pile SET answer = :answer WHERE id = :id");
      $stmt->bindParam(':answer',$answer,PDO::PARAM_STR);
      $stmt->bindParam(':id',$id,PDO::PARAM_STR);
      $stmt->execute();
      
    header('Location: index.php');
    exit();
  } catch (PDOException $e){
      exit('データベースに接続できませんでした'.$e->getMessage());
  }
  ?>