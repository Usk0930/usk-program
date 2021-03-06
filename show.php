<?php
$dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4aae764a6bba763;charset=utf8';
$user = 'b29e771eedb27c';
$password = '10698e23';


$id=$_GET['id'];

try{
  $db = new PDO($dsn,$user,$password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  /*取得件数制限なし*/
  $stmt = $db->prepare(
    "SELECT * FROM pile WHERE id = $id"
  );
  $stmt->execute();
} catch(PDOException $e){
  echo "エラー:" . $e->getMessage();
}

$row=$stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
 <meta chaeset = "utf-8">
 <title>USK's Way to Programer_Show page</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="postscreen">
  <h1> <a href='index.php' class ='name'>USK's Way to Programer</a></h1>
  <div class='show'>
  <h2><?php echo strtoupper($row['type']) . " : " . $row['title'] ?></h2>
  <p>LANGUAGE:<?php echo $row['language']?></p>
  <p><?php if ($row['tag1'] !== '#'):?>
   TAG:<?php echo $row['tag1'] ?> <?php endif; ?>
   <?php if ($row['tag2'] !== '#'):?>
    &nbsp<?php echo $row['tag2'] ?> <?php endif; ?>
   <?php if ($row['tag3'] !== '#'):?>
    &nbsp<?php echo $row['tag3'] ?> <?php endif; ?></p> 
  <?php if ($row['memo'] !== ''):?>
  <p><img src=<?php echo $row['img'] ?>>
  <p>MEMO:</p>
  <p><?php echo nl2br(htmlspecialchars($row['memo'], ENT_QUOTES, 'UTF-8')) ?> <?php endif; ?></p>
 </div> 
  <br>

  <?php if ($row['type'] == 'question'):?>
  <h2>ANSWER:</h2>
   <?php if ($row['answer'] !== ''):?>
   <?php echo nl2br(htmlspecialchars($row['answer'], ENT_QUOTES, 'UTF-8')) ?> <?php endif; ?>
   <?php if ($row['answer'] == ''):?>
   <form action="answer.php" method="post" enctype="multipart/form-data">
    <p><textarea name="answer" cols="90" rows="15" maxlength="500" wrap=”hard”  class="textarea"></textarea></p>
    <p>REFERENCE:<input type="file" name="img"></p>
    <p><input type="hidden" name="id" value= <?php echo $id ?> /></p>
    <input type="submit" value="POST">
   </form><?php endif; ?><?php endif; ?></p>

  <?php if ($row['type'] == 'todo' && is_null($row['answer']) ):?>
   <form action="answer.php" method="post" enctype="multipart/form-data"> 
    <input type="checkbox" name="answer" value="finished">
    <input type="hidden" name="id" value= <?php echo $id ?> >
    <input type="submit" value="Finished">
   </form></p>
   <?php elseif ($row['type'] == 'todo' && isset($row['answer'])): ?>
   <h2>⇒Finished</h2>
   <?php endif; ?>

  <br>
 <form action="editshow.php" method="post" enctype="multipart/form-data">
    <p><input type='password' name="pass" placeholder='pass' autocomplete="off"></textarea>
    <input type="hidden" name="id" value= <?php echo $id ?> />
    <input type="submit" value="EDIT">
  </form>
  <br>

