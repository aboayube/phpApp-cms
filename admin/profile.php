<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';
$stmt=$con->prepare('select * from users where id=?');
$stmt->execute(array($_SESSION['id']));
$user=$stmt->fetch();


if(isset($_GET['delete'])){
    $stmt=$con->prepare("delete from posts where id=?");
    $stmt->execute(array($_GET['delete']));
 $msg='<div class="alert  alert-danger">delete is done</div>';
}
if(isset($_GET['stuts']) && isset($_GET['post'])){
    $stmt=$con->prepare("update posts set status=? where id=?");
    $stmt->execute(array($_GET['stuts'],$_GET['post']));
}
?>
    <article class="col-lg-9">
        <div class="col-md-1"></div>
    <div class="col-md-10">
         <div class="panel panel-info">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
      <div class="col-md-9">
      <p>اسم السمتخدم:<?php echo $user['username']?></p>
      <p>البريد الالكتروني:<?php echo $user['email']?></p>
      <p>الجنس:<?php if($user['gender']==1){echo 'ذكر';}else{echo 'انثي';}?></p>
      <p>روابط التواصل:
          <a href="<?php echo $user['face']?>" target="_blank"><i class="fab fa-facebook fa-lg"></i></a> |
          <a href="<?php echo $user['twit']?>" target="_blank"><i class="fab fa-twitter fa-lg"></i></a> |
          <a href="<?php echo $user['yout']?>" target="_blank"><i class="fab fa-youtube fa-lg"></i></a> |</p>
      
      </div>
      <div class="col-md-3">
      <img src="../<?php echo $user['img']?>" class="img-thumbnail" width="100%" height="150px">
      </div>
      <div class="co-md-12">
          <p><b>الوصف المختصر</b></p>
          <p class="text-center"><?php echo $user['about']?></p>
          <a class="btn btn-danger pull-left" href="editusers.php?user=">تعديل البيانات</a>
      </div>
  </div>
</div>
        
        </div>
        <div class="col-md-12">
            <div class="row">
        <div class="col-md-1"></div>
        <div class="col-lg-10">
        <div class="panel panel-warning">
            <div class="panel-heading">المواضيع التي قمت بكتابتها</div>
            <div class="panel-body">
            
      <table class="table table-hover">
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>عنوان المقال</th>
          <th>صورة المقال</th>
          <th>تاريخ النشر</th>
          <th>مشاهدة</th>
          <th>الحالة</th>
          <th>تعديل</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody>
          <?php
          $stmt=$con->prepare("select * from posts  where auther=? order by id desc limit 3");
          $stmt->execute(array($_SESSION['user']));
          $posts=$stmt->fetchAll();
          foreach($posts as $post){
              echo'    <tr>
          <td>'.$post['id'].'</td>
          <td>'.substr($post['title'],0,10).'</td>
          <td><img src="../'.$post['img'].'" class="img-rounded" width="80px" height="50px"></td>
          <td>'.$post['regdata'].'</td>
          <td><a href="../post.php?id='.$post['id'].'" class="btn btn-primary" target="_blank">مشاهده المقال</td>
          <td>';
              if( $post['status']=='derft'){
                  echo 
 '<a class="btn btn-info" href="profile.php?stuts=publish&post='.$post['id'].'">    نشر       </a>';
              }
              
              if( $post['status']=='publish'){
  echo '<a class="btn btn-warning" href="profile.php?stuts=derft&post='.$post['id'].'">تعطيل</a>';
              }
              
              echo'</td>
          <td><a href="editpost.php?post='.$post['id'].'" class="btn btn-warning ">تعديل</a></td>
          <td><a href="profile.php?delete='.$post['id'].'" class="btn btn-danger ">حذف</a></td>
         </tr>
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table></div>
            </div>
            </div>
        </div></div>
        </article>
      
<?php
include 'inc/footer.php';

?>