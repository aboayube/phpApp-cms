<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';

if(isset($_POST['add'])){
    if(empty($_POST['cat'])){
$msg= '<div class="alert alert-danger">يجيب انت تدخل  التنصيف</div>';
    }else{
        $stmt=$con->prepare("insert into categories(cat) values (?)");
        $stmt->execute(array($_POST['cat']));
$msg= '<div class="alert alert-success">تم اضافة بنجاح</div>';
        
    }
}

if(isset($_GET['delete'])){
    $del=$con->prepare("delete from categories where id=?");
    $del->execute(array($_GET['delete']));
    $msg2='<div class="alert alert-success">تم حذف بنجاح</div>';
}
?>
    <article class="col-lg-9">
        <div class="row">
        <div class="col-md-7">
            <?php if(isset($msg2)){echo $msg2;}?>
               <div class="panel panel-info">
  <div class="panel-heading">التصنيفات</div>
  <div class="panel-body">
      <table class="table table-hover">
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>اسم التصنيف</th>
          <th>تعديل</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody>
          <?php
          $stmt=$con->prepare("select * from categories order by id desc");
          $stmt->execute();
          $cats=$stmt->fetchAll();
          foreach($cats as $cat){
              echo'    <tr>
          <td>'.$cat['id'].'</td>
          <td>'.$cat['cat'].'</td>
          <td><a href="editcat.php?cat='.$cat['id'].'" class="btn btn-warning btn-xs">تعديل</a></td>
          <td><a href="categore.php?delete='.$cat['id'].'" class="btn btn-danger btn-xs">حذف</a></td>
         </tr>
              
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table>
  </div>
</div>
            </div>
        <div class="col-md-4">
               <div class="panel panel-info">
  <div class="panel-heading">اضافة تصنيف جديد</div>
  <div class="panel-body">
      <form class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">اسم التصنيف</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" id="cat" placeholder="ادخل اسم التصنيف" name="cat">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <?php if(isset($msg)){echo $msg; }?>
      <input type="submit" class="btn btn-info" value="اضافة" name="add">
    </div>
  </div>
</form>
  </div>
</div>
            </div>
        
        </div>
     
</article>
      
<?php
include 'inc/footer.php';

?>