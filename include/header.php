<?php
session_start();
include 'connect.php';
include 'function.php';

$stmt=$con->prepare("select * from setting");
$stmt->execute();
$setting=$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $setting['name']?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  </head>
  <body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?php echo $setting['name']?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">الرئيسية <span class="sr-only">(current)</span></a></li>
       
        <li><a href="categories.php">مقالات</a></li>
           <?php
          $stmt=$con->prepare("select * from categories");
          $stmt->execute();
          $cats=$stmt->fetchAll();
          foreach($cats as $cat){
              echo '<li><a href="post.php">'.$cat['cat'].'</a></li>';
          }
          
          ?>
      </ul>
        <?php if(isset($_SESSION['id'])){
?>
	  
      <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">الإعدادات <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">الصفحة الشخصية</a></li>
            <li role="separator" class="divider"></li>
              <?php 
              if($_SESSION['roll']==1){
                  echo' <li><a href="admin/index.php">لوحة التحكم</a></li>';
              }
              ?>
           
            <li><a href="logout.php?id=<?php echo $_SESSION['id']?>">تسجيل الخروج</a></li>
          </ul>
        </li>
      </ul>
          <?php 
              }
              ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- logo site -->
<section id="logo">
	<img src="images/logo.png" width="320px" />
</section>

<!-- end logo site -->

<!-- body -->
<section class="container-fluid" style="margin-top: 20px;">

