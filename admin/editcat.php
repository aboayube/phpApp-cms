<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';

if(isset($_GET['cat'])){
    $stmt=$con->prepare("select * from categories where id=?");
    $stmt->execute(array($_GET['cat']));
    $cat=$stmt->fetch();
}
if(isset($_POST['edit'])){
    if(empty($_POST['cat'])){
$msg= '<div class="alert alert-danger">يجيب انت تدخل  التنصيف</div>';
    }else{
        
    $stmt=$con->prepare("update categories set cat=? where id=?");
    $stmt->execute(array($_POST['cat'],$_POST['id']));
$msg= '<div class="alert alert-success">تم تعديل بنجاح</div>';
    header("Location:categore.php");}
}
?>
    <article class="col-lg-9">
        <div class="row">
        <div class="col-md-4">
               <div class="panel panel-info">
  <div class="panel-heading">  تعديل التصنيف  <?php echo $cat['cat']?></div>
  <div class="panel-body">
      <form class="form-horizontal" action="" method="post">
  <div class="form-group">
      <input type="hidden" name="id" value="<?php echo $cat['id']?>">
    <label for="inputEmail3" class="col-sm-4 control-label">اسم التصنيف</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="cat" placeholder="ادخل اسم التصنيف" name="cat" value="<?php echo $cat['cat'];?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <input type="submit" class="btn btn-info" value="تعديل التصنيف" name="edit">
    </div>
  </div>
</form>
      <?php if (isset($msg)){echo $msg;}?>
  </div>
</div>
            </div>
        
        </div>
     
</article>
      
<?php
include 'inc/footer.php';

?>