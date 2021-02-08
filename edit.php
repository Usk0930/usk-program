<?php
  $language = $_POST['language'];
  $title = $_POST['title'];
  $tag1 = $_POST['tag1'];
  $tag2 = $_POST['tag2'];
  $tag3 = $_POST['tag3'];
  $memo = $_POST['memo'];
  $type = $_POST['type'];
  $answer = $_POST['answer'];
  $id = $_POST['id'];

  if ($language == '' || $title == ''){
    var_dump($language);
    var_dump($title);
    die();
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
        UPDATE pile SET title = :title, language = :language, tag1 = :tag1, tag2 = :tag2, tag3 = :tag3, memo = :memo, type = :type, answer = :answer WHERE id = :id ");
        $stmt->bindParam(':title',$title,PDO::PARAM_STR);
        $stmt->bindParam(':language',$language,PDO::PARAM_STR);
        $stmt->bindParam(':tag1',$tag1,PDO::PARAM_STR);
        $stmt->bindParam(':tag2',$tag2,PDO::PARAM_STR);
        $stmt->bindParam(':tag3',$tag3,PDO::PARAM_STR);
        $stmt->bindParam(':memo',$memo,PDO::PARAM_STR);
        $stmt->bindParam(':type',$type,PDO::PARAM_STR);
        $stmt->bindParam(':answer',$answer,PDO::PARAM_STR);
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);

        $stmt->execute();
        header('Location: index.php');
        exit();

  } catch (PDOException $e){
      exit('データベースに接続できませんでした'.$e->getMessage());
  }

  ?>