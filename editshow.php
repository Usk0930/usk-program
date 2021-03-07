<?php
$dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4aae764a6bba763;charset=utf8';
$user = 'b29e771eedb27c';
$password = '10698e23';

$pass = $_POST['pass'];
$id = $_POST['id'];

if($pass != '1322'){
  echo 'Password is incorrect!';

    exit();
}

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
 <title>USK's Way to Programer_Edit page</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
 <div class="postscreen">
 <h1> <a href='index.php' class="name">USK's Way to Programer</a></h1>
  <form action="edit.php" method="post" enctype="multipart/form-data" class = 'form'>
   <p>TITLE:<input type='text' name='title' rows='1'value=<?php echo $row['title'] ?>></p>
   <p>LANGUAGE:
    <select name="language">
     <option value="php" <?php if($row['language']=='php'){echo 'selected';}?>>PHP</option>
     <option value="javascript" <?php if($row['language']=='javascript'){echo 'selected';}?>>JavaScript</option>
     <option value="htmlcss" <?php if($row['language']=='htmlcss'){echo 'selected';}?>>HTML/CSS</option>
     <option value="other" <?php if($row['language']=='other'){echo 'selected';}?>>Other</option>
    </select>
   <p>TAG:<textarea name="tag1" name="tag1" rows='1'><?php echo $row['tag1'] ;?></textarea>
    <textarea name="tag2" rows='1'><?php echo $row['tag2'] ;?></textarea>
    <textarea name="tag3" rows='1'><?php echo $row['tag3'] ; ?></textarea></p>
   <p>REFERENCE:<input type="file" name="img"></p>
   <p>MEMO:<textarea name="memo" cols="90" rows="15" maxlength="500" wrap=”hard”  class="textarea"><?php echo $row['memo'] ?></textarea></p>
   <p>category:
     <input type="radio" name="category" value="todo" <?php if($row['category']=='todo'){echo 'checked';}?>> To Do
     <input type="radio" name="category" value="question" <?php if($row['category']=='question'){echo 'checked';}?>> Question
     <input type="radio" name="category" value="progress" <?php if($row['tycategorype']=='progress'){echo 'checked';}?>>Progress
     <input type="radio" name="category" value="test" <?php if($row['category']=='test'){echo 'checked';}?>> Test</p>
    <input type="submit" value="POST">
    <input type="hidden" name="id" value= <?php echo $id ?> />
  </form>

  <?php if ($row['category'] == 'question'):?>
   <br>
  <h2>ANSWER:</h2>
   <?php if ($row['answer'] !== ''):?> 
   <form action="answer.php" method="post" enctype="multipart/form-data">
    <p><textarea name="answer" cols="90" rows="15" maxlength="500" wrap=”hard”><?php echo $row['answer'] ?> </textarea></p>
    <p>REFERENCE:<input type="file" name="img"></p>
    <input type="hidden" name="id" value= <?php echo $id ?> />
    <input type="submit" value="POST">
  </form><?php endif; ?><?php endif; ?></p>
  <br>
