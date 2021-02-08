<?php
$search = $_POST['search'];

$dsn = 'mysql:host=us-cdbr-east-02.cleardb.com;dbname=heroku_4aae764a6bba763;charset=utf8';
$user = 'b29e771eedb27c';
$password = '10698e23';

try{
  $db = new PDO($dsn,$user,$password);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  $stmt = $db->prepare(" SELECT * FROM pile WHERE tag1 LIKE :search1 OR tag2 LIKE :search2 OR tag3 LIKE :search3 OR language LIKE :search4");
  $stmt->bindParam(':search1',$search,PDO::PARAM_STR);
  $stmt->bindParam(':search2',$search,PDO::PARAM_STR);
  $stmt->bindParam(':search3',$search,PDO::PARAM_STR);
  $stmt->bindParam(':search4',$search,PDO::PARAM_STR);

  $stmt->execute();
} catch(PDOException $e) {
  echo "エラー:" . $e->getMessage();}
  $count = $stmt->rowCount();
?>

<!DOCTYPE html>
<html>
<head>
 <meta chaeset = "utf-8">
 <title>USK Programer Way</title>
 <link rel="" rel="stylesheet" type="text/css">
 <style>
  body{
    text-align: center
  }

  .name{
    height: 50px;
    width: 900px;
    font-size: 60px;     
    color :black;
    text-decoration:none;
  }
  
  .form{
    width: 80%;
    margin-left: auto;
	  margin-right: auto;
    background-color: #EEEEEE;
    border: solid 1px black
  }

  .memo{
    position:relative;
    right: 285px
  }

 </style>
</head>
<body>
 <div class="postscreen">
  <h1> <a href='index.php' class='name'>USK Programer Way</a></h1>
  <h2>SEARCH RESULT</h2>
  <h3>TERM:<?php echo $search ?></h3>
  <h3><?php echo $count ?> posts</h3>
 <?php while ($row=$stmt->fetch()):?>
   <p>
    <a href="show.php?id=<?php echo $row['id'] ?>"><?php echo $row['date'].'&nbsp;'. $row['title'] ?></a>
   </p>
   <?php
    endwhile;
   ?>
