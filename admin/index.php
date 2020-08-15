<?php 
 include 'inc/header.php';
 include 'inc/sidebar.php';


$stmt=$con->prepare('select * from users where id=?');
$stmt->execute(array($_SESSION['id']));
$user=$stmt->fetch();

$stmt2=$con->prepare('select count(id) from users ');
$stmt2->execute();
$numuser=$stmt2->fetchColumn();

$stmt3=$con->prepare('select count(id) from posts');
$stmt3->execute();
$numpost=$stmt3->fetchColumn();

$stmt4=$con->prepare('select count(id) from comment');
$stmt4->execute();
$numcomment=$stmt4->fetchColumn();

?>
    <article class="col-lg-9">
    <div class="col-lg-12">
        <div class="row">
        <div class="col-md-3">
                <div class="panel panel-info">
  <div class="panel-heading">اهلا وسهلا بك يا<?php echo $user['username']?></div>
  <div class="panel-body">
<div class="text-center">
      <img src="../<?php echo $user['img']?>" width="100" style="min-width:150px">
    <hr> </div>
      <div class="text-right">
      <p>البريد:<?php echo $user['email']?></p>
      <p>الصلاحية:<?php if($user['roll']==1){echo 'مدير';}?></p>
      <p class="text-left"><a href="" class="btn btn-warning btn-xs">تعديل البيانات</a></p>
          
      </div>
  </div>
</div>
            </div>
        <div class="col-md-3">
            <div class="panel panel-info">
  <div class="panel-heading">المقالات</div>
  <div class="panel-body">
      <div class="col-md-8"><i class="far fa-list-alt fa-5x"></i></div>
      <div class="col-md-4">
      <p style=" padding: 15px;"><b><?php echo $numpost?></b></p></div>
  </div>
            <div class="panel-footer text-center"><a href=""><i class="far fa-eye"></i>مشاهدة</a></div>
</div>
            </div>
            <div class="col-md-3">
            <div class="panel panel-info">
  <div class="panel-heading">الاعضاء</div>
  <div class="panel-body">
      <div class="col-md-8"><i class="fas fa-users fa-5x"></i></div>
      <div class="col-md-4">
      <p style=" padding: 15px;"><b><?php echo $numuser?></b></p></div>
  </div>
            <div class="panel-footer text-center"><a href=""><i class="far fa-eye"></i>مشاهدة</a></div>
</div>
            </div>
            <div class="col-md-3">
            <div class="panel panel-info">
  <div class="panel-heading">التعليقات</div>
  <div class="panel-body">
      <div class="col-md-8"><i class="fas fa-comments fa-5x"></i></div>
      <div class="col-md-4">
      <p style=" padding: 15px;"><b><?php echo $numcomment?></b></p></div>
  </div>
            <div class="panel-footer text-center"><a href=""><i class="far fa-eye"></i>مشاهدة</a></div>
</div>
            </div>
            
            <div class="col-md-12">
            
        <div class="panel panel-info">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
            
      <table class="table table-hover">
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>عنوان المقال</th>
          <th>صورة المقال</th>
          <th>الكاتب</th>
          <th>تاريخ النشر</th>
          <th>مشاهدة</th>
          <th>الحالة</th>
          <th>تعديل</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody>
          <?php
          $stmt=$con->prepare("select * from posts order by id desc limit 5");
          $stmt->execute();
          $posts=$stmt->fetchAll();
          foreach($posts as $post){
              echo'    <tr>
          <td>'.$post['id'].'</td>
          <td>'.substr($post['title'],0,10).'</td>
          <td><img src="../'.$post['img'].'" class="img-rounded" width="80px" height="50px"></td>
          <td>'.$post['auther'].'</td>
          <td>'.$post['regdata'].'</td>
          <td><a href="../post.php?id='.$post['id'].'" class="btn btn-primary" target="_blank">مشاهده المقال</td>
          <td>';
              if( $post['status']=='derft'){
                  echo 
 '<a class="btn btn-info" href="posts.php?stuts=publish&post='.$post['id'].'">    نشر       </a>';
              }
              
              if( $post['status']=='publish'){
  echo '<a class="btn btn-warning" href="posts.php?stuts=derft&post='.$post['id'].'">تعطيل</a>';
              }
              
              echo'</td>
          <td><a href="editpost.php?post='.$post['id'].'" class="btn btn-warning ">تعديل</a></td>
          <td><a href="posts.php?delete='.$post['id'].'" class="btn btn-danger ">حذف</a></td>
         </tr>
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table>
  </div>
</div>
        <div class="panel panel-info">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
      
      <table class="table table-hover">
  <tr>
      <thead><tr>
          <th>#الرقم</th>
          <th>الصورة الرمزية</th>
          <th>اسم العضو</th>
          <th>البريد الالكتروني</th>
          <th>الجنس</th>
          <th>صفحة الشخصية</th>
          <th>تعديل البيانات</th>
          <th>حذف</th>
         </tr>
          </thead>
      
      <tbody class="top">
          <?php
          $stmt=$con->prepare("select * from users order by id desc limit 5");
          $stmt->execute();
          $users=$stmt->fetchAll();
          foreach($users as $user){
              echo'    <tr>
          <td style=" padding-top:20px;">'.$user['id'].'</td>
          <td ><img src="../'.$user['img'].'"  class="img-rounded" width="80px" height="50px"></td>
          <td  style="    padding-top:20px;">'.$user['username'].'</td>
          <td style="    padding-top:20px;">'.$user['email'].'</td>
          <td style="    padding-top:20px;">';if($user['gender']==1){ echo 'ذكر';}else{ echo 'انثي'; } echo'</td>
          <td style="    padding-top:20px;"><a href="" target="_blank">صفحة الشخصية</a></td>
   <td style="    padding-top:20px;"> <a href="editusers.php?user='.$user['id'].'" class="btn btn-warning  ">تعديل</a></td>
<td style="    padding-top:20px;"><a href="users.php?delete='.$user['id'].'" class="btn btn-danger ">حذف</a></td>
         </tr>
              
              ';
          }
          
          
          ?>
          
  
      
      
      </tbody>
</table>
  </div>
</div>
            </div>
        </div>
        </div>
        
        </article>
      
<?php
include 'inc/footer.php';

?>