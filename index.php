<?php
require_once('sql.php');

?>

<!DOCTYPE html>
<html>
<head>
 <meta chaeset = "utf-8">
 <title>USK's Way to Programer</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="postscreen">
 <img src='photo.jpg' class="photo">           
  <h1> <a href='index.php'  class="name">USK's Way to Programer</a></h1>
  <h3>Total <?php echo $count ?> posts</h3>
  <form action="write.php" method="post" enctype="multipart/form-data" class='form'>
   <p>TITLE:<input type='text' name='title' rows='1'></p>
   <p>LANGUAGE:
    <select name="language">
     <option value="php">PHP</option>
     <option value="javascript">JavaScript</option>
     <option value="htmlcss">HTML/CSS</option>
     <option value="other">Other</option>
    </select>
   <p>TAG:<textarea name="tag1" rows='1'>#</textarea>
    <textarea name="tag2" rows='1'>#</textarea>
    <textarea name="tag3" rows='1'>#</textarea></p>
   <p>REFERENCE:<input type="file" name="img"></p>
   <p class ="memo">MEMO:</p>
   <p class="textarea"><textarea name="memo" rows="15"  cols="60" maxlength="500" wrap=”hard”></textarea></p>
   <p>TYPE: <input type="radio" name="type" value="todo">TO_DO
    <input type="radio" name="type" value="question"> QUESTION
    <input type="radio" name="type" value="progress">PROGRESS
    <input type="radio" name="type" value="test"> TEST</p>
   <p><input type='password' name="pass" placeholder='pass' autocomplete="off"></textarea></p>
   <p><input type="submit" value="POST"></p>
  </form>
  
  <br>
  <h2>NEW</h2>
   <?php
   try{
      $db = new PDO($dsn,$user,$password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      /*取得件数制限3件*/
      $stmt = $db->prepare(
      "SELECT * FROM pile ORDER BY id DESC LIMIT 3");
      $stmt->execute();
    } catch(PDOException $e){
      echo "エラー:" . $e->getMessage();
    }
   while ($row=$stmt->fetch()):
   ?>
   <p>
    <a href="show.php?id=<?php echo $row['id'] ?>"><?php echo $row['date'].'&nbsp;'. $row['title'] ?></a>
   </p>
   <?php
   endwhile;
   ?>
   <br>
  
   <h2>TO_DO</h2>
   <?php 
   try{
     $db = new PDO($dsn,$user,$password);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $stmt = $db->prepare(" SELECT * FROM pile WHERE type = 'todo' AND answer is null ");
     $stmt->execute();
    } catch(PDOException $e) {
       echo "エラー:" . $e->getMessage();}
   ?>
   <?php while ($row=$stmt->fetch()):?>
   <p>
    <a href="show.php?id=<?php echo $row['id'] ?>"><?php echo $row['date'].'&nbsp;'. $row['title'] ?></a>
   </p>
   <?php
    endwhile;?>
    <br>

  <h2>QUESTION</h2>
   <?php 
     try{
       $db = new PDO($dsn,$user,$password);
       $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
       $stmt = $db->prepare(" SELECT * FROM pile WHERE type = 'question' AND answer is null ");
       $stmt->execute();
      } catch(PDOException $e) {
          echo "エラー:" . $e->getMessage();}
   ?>
   <?php while ($row=$stmt->fetch()):?>
   <p>
    <a href="show.php?id=<?php echo $row['id'] ?>"><?php echo $row['date'].'&nbsp;'. $row['title'] ?></a>
   </p>
   <?php
    endwhile;?>
    <br>

  <h2>PROGRESS</h2>
   <?php 
   try{
     $db = new PDO($dsn,$user,$password);
     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
     $stmt = $db->prepare(" SELECT * FROM pile WHERE type = 'progress' OR answer is not null ");
     $stmt->execute();
   } catch(PDOException $e) {
       echo "エラー:" . $e->getMessage();}
   ?>
   <?php while ($row=$stmt->fetch()):?>
   <p>
    <a href="show.php?id=<?php echo $row['id'] ?>"><?php echo $row['date'].'&nbsp;'. $row['title'] ?></a>
   </p>
   <?php
    endwhile;?>
    <br>

  <h2>SEARCH</h2>
  <?php require_once('sql.php'); ?>
  <form action="search.php" method="post" enctype="multipart/form-data">
   <select name="search">
     <option value="php">PHP</option>
     <option value="javascript">JavaScript</option>
     <option value="htmlcss">HTML/CSS</option>
     <option value="other">Other</option>
   </select>
   <input type="submit" value="EXCUTE">
  </form>
  <br>
  <form action="search.php" method="post" enctype="multipart/form-data">
   <textarea name="search" rows='1'>#</textarea>
   <input type="submit" value="EXCUTE">
  </form>
  <br>
  <br>

</body>
