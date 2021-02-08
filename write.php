<?php
  $pass = $_POST['pass'];

  if($pass != '1322'){
    echo 'Password is incorrect!';
  
      exit();
  }

  $language = $_POST['language'];
  $title = $_POST['title'];
  $tag1 = $_POST['tag1'];
  $tag2 = $_POST['tag2'];
  $tag3 = $_POST['tag3'];
  $img_data = file_get_contents($_FILES['img']['tmp_name']);
  $memo = $_POST['memo'];
  $type = $_POST['type'];
  $answer = $_POST['answer'];

  if ($language == '' || $title == ''){
      header('Location: index.php');
      exit();
  }

  $dsn = 'mysql:host=localhost;dbname=uskprogram;charset=utf8';
  $user = 'usk';
  $password = '1322';
  
  try{
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $stmt = $db->prepare("
        INSERT INTO pile (title, language, date, tag1, tag2, tag3, img, memo, type, answer)
        VALUES (:title, :language, now(), :tag1, :tag2, :tag3, :img, :memo, :type, :answer )" 
     );
     
      $stmt->bindParam(':title',$title,PDO::PARAM_STR);
      $stmt->bindParam(':language',$language,PDO::PARAM_STR);
      $stmt->bindParam(':tag1',$tag1,PDO::PARAM_STR);
      $stmt->bindParam(':tag2',$tag2,PDO::PARAM_STR);
      $stmt->bindParam(':tag3',$tag3,PDO::PARAM_STR);
      $stmt->bindParam(':img',$img_data,PDO::PARAM_STR);
      $stmt->bindParam(':memo',$memo,PDO::PARAM_STR);
      $stmt->bindParam(':type',$type,PDO::PARAM_STR);
      $stmt->bindParam(':answer',$answer,PDO::PARAM_STR);
    $stmt->execute();

    header('Location: index.php');
    exit();
  } catch (PDOException $e){
      exit('データベースに接続できませんでした'.$e->getMessage());
  }

  ?>