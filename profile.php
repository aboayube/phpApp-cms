<?php
ob_start();
include_once 'include/header.php';
include_once 'include/asidpar.php';
$id=$_GET['user'];
$stmt=$con->prepare("select * from users where id=?");
$stmt->execute(array($id));
$count=$stmt->rowCount();
if($count!=1){
header("Location:index.php");
}
$user=$stmt->fetch();

?>


<article class="col-md-9 col-lg-9 ">
    
<ol class="breadcrumb">
  <li><a href="index">الرئيسية</a></li>
  <li><a href="#">صفحة الشخصية<?php echo $user['username']?></a></li>
</ol>
<div class="col-lg-12 art_bg">
   <div class="page-header">
  <h1>Example page header <small>Subtext for header</small></h1>
      
       <img src="<?php echo $user['img']?>">
        <?php
       if($user['id']==$_SESSION['id']){
echo '<a href="#">تعديل</a>';}
       ?>
</div> 
    </div>
</article>


<?php include_once 'include/footer.php';?>